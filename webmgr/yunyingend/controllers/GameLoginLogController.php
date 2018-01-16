<?php

namespace backend\controllers;

use common\utils\CommonFun;

use Yii;
use yii\data\Pagination;
use backend\models\GameLoginLog;
use yii\web\NotFoundHttpException;

/**
 * GameLoginLogController implements the CRUD actions for GameLoginLog model.
 */
class GameLoginLogController extends BaseController
{
	public $layout = "lte_main";

    /**
     * Lists all GameLoginLog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = GameLoginLog::find();
         $querys = Yii::$app->request->get('query');
         $serverId = Yii::$app->request->get('serverId');
         
         $logdate=$querys['logdate'];
         unset($querys['logdate']);
         $start=date('Y-m-d');
         $end=date('Y-m-d H:i');
         CommonFun::parse_date_range($logdate, $start, $end);
         
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
        $query->andWhere(['between','logdate',$start,$end]);
        if ($serverId){
        	$query->andWhere(['in','server',explode(",", $serverId)]);
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
        $this->view->params['start']=$start;
        $this->view->params['end']=$end;
        $querys['logdate']="{$start} / {$end}";
        return $this->render('index', [
            'models'=>$models,
            'pages'=>$pagination,
            'query'=>$querys,
        ]);
    }

    /**
     * Displays a single GameLoginLog model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        echo json_encode($model->getAttributes());

    }

    /**
     * Finds the GameLoginLog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GameLoginLog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GameLoginLog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
