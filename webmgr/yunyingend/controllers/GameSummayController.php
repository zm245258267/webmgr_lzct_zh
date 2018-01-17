<?php

namespace backend\controllers;

use common\utils\CommonFun;

use Yii;
use yii\data\Pagination;
use backend\models\GameSummary;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GameSummayController implements the CRUD actions for GameSummary model.
 */
class GameSummayController extends BaseController
{
	public $layout = "lte_main";

    /**
     * Lists all GameSummary models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = GameSummary::find();
         $querys = Yii::$app->request->get('query');
         $serverId = Yii::$app->request->get('serverId');
         
         $date=$querys['date'];
         unset($querys['date']);
         $start=date('Y-m-01');
         $end=date('Y-m-d');
         CommonFun::parse_date_range($date, $start, $end);
         
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
        
        $query->andWhere(['between','date',$start,$end]);
        if ($serverId){
        	$query->andWhere(['in','serverid',explode(",", $serverId)]);
        }
        $spId = Yii::$app->request->get('spId');
        if ($spId){
            $query->andWhere(['in','spid',explode(",", $spId)]);
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
        $querys['date']="{$start} / {$end}";
        $this->view->params['start']=$start;
        $this->view->params['end']=$end;
        
        return $this->render('index', [
            'models'=>$models,
            'pages'=>$pagination,
            'query'=>$querys,
        ]);
    }

    /**
     * Displays a single GameSummary model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        echo json_encode($model->getAttributes());

    }

    /**
     * Creates a new GameSummary model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GameSummary();
        if ($model->load(Yii::$app->request->post())) {
        
              if(empty($model->date) == true){
                  $model->date = '0000-00-00';
              }
              if(empty($model->update_time) == true){
                  $model->update_time = 'CURRENT_TIMESTAMP';
              }
        
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
     * Updates an existing GameSummary model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
        
             if(empty($model->date) == true){
                 $model->date = '0000-00-00';
             }             if(empty($model->update_time) == true){
                 $model->update_time = 'CURRENT_TIMESTAMP';
             }        
        
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
     * Deletes an existing GameSummary model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete(array $ids)
    {
        if(count($ids) > 0){
            $c = GameSummary::deleteAll(['in', 'id', $ids]);
            echo json_encode(array('errno'=>0, 'data'=>$c, 'msg'=>json_encode($ids)));
        }
        else{
            echo json_encode(array('errno'=>2, 'msg'=>''));
        }
    
  
    }

    /**
     * Finds the GameSummary model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GameSummary the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GameSummary::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
