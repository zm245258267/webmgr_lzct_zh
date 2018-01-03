<?php

namespace backend\controllers;

use common\utils\CommonFun;

use Yii;
use yii\data\Pagination;
use backend\models\GameGoodsLog;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GameGoodsLogController implements the CRUD actions for GameGoodsLog model.
 */
class GameGoodsLogController extends BaseController
{
	public $layout = "lte_main";

    /**
     * Lists all GameGoodsLog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = GameGoodsLog::find();
         $querys = Yii::$app->request->get('query');
         $serverId = Yii::$app->request->get('serverId');
         
         $logtime=$querys['logtime'];
         unset($querys['logtime']);
         $start=date('Y-m-d');
         $end=date('Y-m-d H:i');
         CommonFun::parse_date_range($logtime, $start, $end);
         
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
        $query->andWhere(['between','logtime',$start,$end.":59"]);
        if ($serverId){
        	$query->andWhere(['in','server',explode(",", $serverId)]);
        }

        $pagination = new Pagination([
            'totalCount' =>$query->count(), 
            'pageSize' => (\Yii::$app->params['pageSize']?\Yii::$app->params['pageSize']:10), 
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
        $this->view->params['start']=$start;
        $this->view->params['end']=$end;
        $querys['logtime']="{$start} / {$end}";
        return $this->render('index', [
            'models'=>$models,
            'pages'=>$pagination,
            'query'=>$querys,
        ]);
    }
    
    /**
     * Lists all GameGoodsLog models.
     * @return mixed
     */
    public function actionGoods()
    {
        $query = GameGoodsLog::find();
         $querys = Yii::$app->request->get('query');
         $serverId = Yii::$app->request->get('serverId');
         
         $logtime=$querys['logtime'];
         unset($querys['logtime']);
         $start=date('Y-m-d');
         $end=date('Y-m-d H:i');
         CommonFun::parse_date_range($logtime, $start, $end);
         
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
        $query->andWhere(['between','logtime',$start,$end.":59"]);
        if ($serverId){
        	$query->andWhere(['in','server',explode(",", $serverId)]);
        }
        
        $query->groupBy(['module_sub_type','goods_id']);

        $pagination = new Pagination([
            'totalCount' =>$query->count(), 
            'pageSize' => (\Yii::$app->params['pageSize']?\Yii::$app->params['pageSize']:10), 
            'pageParam'=>'page', 
            'pageSizeParam'=>'per-page']
        );
        
        $orderby = Yii::$app->request->get('orderby', '');
        if(empty($orderby) == false){
            $query = $query->orderBy($orderby);
        }else{
        	$query=$query->orderBy(['totalprice'=>SORT_DESC]);
        }
        
        $models = $query
        ->select(['module_sub_type','goods_id','sum(`goods_num`) goods_num','sum(`totalprice`) totalprice','count(*) times','count(distinct `account`) persons'])
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->asArray()
        ->all();
        
        $total_times=0;
        $total_persons=0;
        $total_amount=0;
        foreach ($models as $row){
        	$total_times+=$row['times'];
        	$total_persons+=$row['persons'];
        	$total_amount+=$row['totalprice'];
        }
        
        $this->view->params['start']=$start;
        $this->view->params['end']=$end;
        $querys['logtime']="{$start} / {$end}";
        return $this->render('goods', [
            'models'=>CommonFun::ArrayToObject($models),
            'pages'=>$pagination,
            'query'=>$querys,
            'total_times'=>$total_times,
            'total_persons'=>$total_persons,
            'total_amount'=>$total_amount,
        ]);
    }

    /**
     * Displays a single GameGoodsLog model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        echo json_encode($model->getAttributes());

    }

    /**
     * Finds the GameGoodsLog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GameGoodsLog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GameGoodsLog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
