<?php

namespace backend\controllers;

use Yii;
use yii\data\Pagination;
use backend\models\GameMailSend;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\GameMailLog;
use common\utils\CommonFun;
use backend\services\GameCmdLogService;

/**
 * GameMailSendController implements the CRUD actions for GameMailSend model.
 */
class GameMailSendController extends BaseController
{
	public $layout = "lte_main";

    /**
     * Lists all GameMailSend models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = GameMailSend::find();
         $querys = Yii::$app->request->get('query');
        if(count($querys) > 0){
            $condition = "";
            $parame = array();
            foreach($querys as $key=>$value){
                $value = trim($value);
                if(empty($value) == false){
                    $parame[":{$key}"]=$value;
                    if(empty($condition) == true){
                        $condition = " {$key}=:{$key} ";
                    }
                    else{
                        $condition = $condition . " AND {$key}=:{$key} ";
                    }
                }
            }
            if(count($parame) > 0){
                $query = $query->where($condition, $parame);
            }
        }

        $pagination = new Pagination([
            'totalCount' =>$query->count(), 
            'pageSize' => '10', 
            'pageParam'=>'page', 
            'pageSizeParam'=>'per-page']
        );
        
        $orderby = Yii::$app->request->get('orderby', '');
        if(empty($orderby) == false){
            $query = $query->orderBy($orderby);
        }
        
        
        $models = $query
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();
        return $this->render('index', [
            'models'=>$models,
            'pages'=>$pagination,
            'query'=>$querys,
        ]);
    }

    /**
     * Displays a single GameMailSend model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        echo json_encode($model->getAttributes());

    }

    /**
     * Creates a new GameMailSend model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GameMailSend();
        if ($model->load(Yii::$app->request->post())) {
        
              if(empty($model->status) == true){
                  $model->status = 1;
              }
              if(empty($model->record_time) == true){
                  $model->record_time = 'CURRENT_TIMESTAMP';
              }
              $model->update_user = Yii::$app->user->identity->uname;
        
            if($model->validate() == true && $model->save()){
                $msg = array('errno'=>0, 'msg'=>'保存成功');
                echo json_encode($msg);
            }
            else{
                $msg = array('errno'=>2, 'data'=>$model->getErrors());
                echo json_encode($msg);
            }
        } else {
            $msg = array('errno'=>2, 'msg'=>'数据出错');
            echo json_encode($msg);
        }
    }

    /**
     * Updates an existing GameMailSend model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
        
            $model->update_user = Yii::$app->user->identity->uname;
            $model->update_time = date('Y-m-d H:i:s');
        
            if($model->validate() == true && $model->save()){
                $msg = array('errno'=>0, 'msg'=>'保存成功');
                echo json_encode($msg);
            }
            else{
                $msg = array('errno'=>2, 'data'=>$model->getErrors());
                echo json_encode($msg);
            }
        } else {
            $msg = array('errno'=>2, 'msg'=>'数据出错');
            echo json_encode($msg);
        }
    
    }

    /**
     * Deletes an existing GameMailSend model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete(array $ids)
    {
        if(count($ids) > 0){
            $c = GameMailSend::deleteAll(['in', 'id', $ids]);
            echo json_encode(array('errno'=>0, 'data'=>$c, 'msg'=>json_encode($ids)));
        }
        else{
            echo json_encode(array('errno'=>2, 'msg'=>''));
        }
    
  
    }
    
    /**
     * Deletes an existing GameMailSend model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionSend()
    {
    	$id = Yii::$app->request->post('id');
    	$rowModel=$this->findModel($id);
    	$info = CommonFun::ObjectToArray($rowModel);
    	
    	$res=['errno'=>1,'msg'=>'发送失败'];
    	
    	if (empty($info)){
    		$res['msg']='记录不存在，请刷新重试';
    		die(json_encode($res));
    	}
    	
    	$sendResult='success';// @todo 指令结果待程序实现
    	
    	$params=[];
    	$params['title']=$info['title'];
    	$params['content']=$info['content'];
    	$params['attach']=$info['attach'];
    	$params['type']=$info['type'];
    	$params['type_value']=$info['type_value'];
    	$params['spid']=$info['spid'];
    	$params['sbid']=$info['sbid'];
    	
    	$params=array_filter($params);
    	
    	$Service=new GameCmdLogService();
    	$rs=$Service->exec($info['server_id'], 'mail', $params, '邮件',$errmsg);
    	if ($rs===true){
    		$sendResult="发送成功。[{$errmsg}]";
    		$errno=0;
    	}else{
    		$sendResult="发送失败。[{$errmsg}]";
    		$errno=1;
    		$res['msg']=$sendResult;
    		$res['errno']=$errno;
    		die(json_encode($res));
    	}
    	
    	$model = new GameMailLog();
    	
    	if ($model->load(['game-mail-send-from'=>$info],'game-mail-send-from')) {
    		
    		$model->send_user = Yii::$app->user->identity->uname;
    		$model->send_time = date('Y-m-d H:i:s');
    		$model->result = $sendResult;
    		
    		if($model->validate() == true && $model->save()){
    			$msg = array('errno'=>$errno, 'msg'=>$sendResult);
    			echo json_encode($msg);
    		}
    		else{
    			$msg = array('errno'=>$errno, 'msg'=>$sendResult."<br />日志记录失败.<br />".implode("<br />", $model->getErrors()));
    			echo json_encode($msg);
    		}
    	} else {
    		$msg = array('errno'=>2, 'msg'=>'数据出错');
    		echo json_encode($msg);
    	}
    }
    
    

    /**
     * Finds the GameMailSend model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GameMailSend the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GameMailSend::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
