<?php

namespace backend\controllers;

use common\utils\CommonFun;

use Yii;
use yii\data\Pagination;
use backend\models\GameHourOnline;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GameHourOnlineController implements the CRUD actions for GameHourOnline model.
 */
class GameHourOnlineController extends BaseController
{
	public $layout = "lte_main";

    /**
     * Lists all GameHourOnline models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = GameHourOnline::find();
         $querys = Yii::$app->request->get('query');
         $serverId = Yii::$app->request->get('serverId');
         
         $logdate=$querys['logdate'];
         unset($querys['logdate']);
         $start=date('Y-m-d');
         $end=date('Y-m-d');
         CommonFun::parse_date_range($logdate,$start,$end);
         
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
        $spId = Yii::$app->request->get('spId');
        if ($spId){
            $query->andWhere(['in','spid',explode(",", $spId)]);
        }

        $fields=[];
        $lineData=[];
        if ($start==$end){
        	for($i=0;$i<24;$i++){
        		$fields[]="sum(h{$i}) h{$i}";
        	}
        	$query_data=$query->select($fields)->asArray()->one();
        	foreach ($query_data as $key=>$val){
        		$lineData['x'][]=$key;
        		$lineData['y'][0]['name']='人数';
        		$lineData['y'][0]['data'][]=$val+0;
        	}
        	
        }else{
        	$field="logdate,sum(";
        	for($i=0;$i<24;$i++){
        		$field.="h{$i}+";
        	}
        	$field.="0) num";
        	$fields=$field;
        	$query->groupBy('logdate');
        	$query_data=$query->orderBy('logdate')->select($fields)->asArray()->all();
        	foreach ($query_data as $key=>$val){
        		$lineData['x'][]=$val['logdate'];
        		$lineData['y'][0]['name']='人数';
        		$lineData['y'][0]['data'][]=$val['num']+0;
        	}
        }
        $this->view->params['start']=$start;
        $this->view->params['end']=$end;
        $querys['logdate']="{$start} / {$end}";
        return $this->render('index', [
        		'dataSet'=>['lineData'=>$lineData],
        		'query'=>$querys,
        		]);
    }
}
