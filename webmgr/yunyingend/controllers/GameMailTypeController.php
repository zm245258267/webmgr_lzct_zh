<?php

namespace backend\controllers;

use Yii;
use yii\data\Pagination;
use backend\models\GameMailType;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\utils\CommonFun;
use backend\models\GameMailSend;

/**
 * GameMailTypeController implements the CRUD actions for GameMailType model.
 */
class GameMailTypeController extends BaseController
{
	public $layout = "lte_main";

    /**
     * Lists all GameMailType models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = GameMailType::find();
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
     * Displays a single GameMailType model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        echo json_encode($model->getAttributes());

    }

    /**
     * Creates a new GameMailType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GameMailType();
        if ($model->load(Yii::$app->request->post())) {
        
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
     * Updates an existing GameMailType model.
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
     * Updates an existing GameMailType model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionSubmit()
    {
    	$rq=Yii::$app->request;
    	$id = $rq->post('id');
    	$step=$rq->post('step');
    	
    	if ($step=='info'){
    		$model = $this->findModel($id);
    		$info=CommonFun::ObjectToArray($model);
    		if (empty($info)){
    			echo json_encode(['msg'=>'记录不存在，请重试!','info'=>$info]);
    		}else{
    			echo json_encode(['msg'=>'','info'=>$info]);
    		}
    		die;
    	}
        
    	// 提审
        $info = $this->findModel($id);
        
        $data['attach']=$info->attach;
        $data['title']=$info->title;
        $data['content']=$info->content;
        $data['record_user']=Yii::$app->user->identity->uname;
        
        $tmp=$rq->post('GameMailSend');
        unset($tmp['id']);
        
        $data=array_merge($data,$tmp);
        
        $model = new GameMailSend();
        if ($model->load(['game-mail-send'=>$data],'game-mail-send')) {
        	
        	if($model->validate() == true && $model->save()){
        		$msg = array('errno'=>0, 'msg'=>'提审成功');
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
     * Deletes an existing GameMailType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete(array $ids)
    {
        if(count($ids) > 0){
            $c = GameMailType::deleteAll(['in', 'id', $ids]);
            echo json_encode(array('errno'=>0, 'data'=>$c, 'msg'=>json_encode($ids)));
        }
        else{
            echo json_encode(array('errno'=>2, 'msg'=>''));
        }
    
  
    }

    /**
     * Finds the GameMailType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GameMailType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GameMailType::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
