<?php

namespace backend\controllers;

use common\utils\CommonFun;

use Yii;
use yii\data\Pagination;
use backend\models\GameDayOnlineTime;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GameDayOnlineTimeController implements the CRUD actions for GameDayOnlineTime model.
 */
class GameDayOnlineTimeController extends BaseController
{
	public $layout = "lte_main";
	
	public $timeInterval=[
		'10-'=>[0,600],
		'10-30'=>[600,1800],
		'30-60'=>[1800,3600],
		'60-120'=>[3600,7200],
		'120+'=>[7200,0],
	];

    /**
     * Lists all GameDayOnlineTime models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = GameDayOnlineTime::find();
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

        $fields=[];
        foreach ($this->timeInterval as $key=>$val){
        	if ($val[1]>0){
        		$fields[]="count(distinct if(onlinetime>={$val[0]} and onlinetime<{$val['1']},account,null)) '{$key}'";
        	}else{
        		$fields[]="count(distinct if(onlinetime>={$val[0]},account,null)) '{$key}'";
        	}
        }unset($key,$val);
        
        $row=$query->select($fields)->asArray()->one();
        
        $pieData=[];
        $lineData=[];
        foreach ($row as $key=>$val){
        	$pieData[]=[$key,$val+0];
        	$lineData['x'][]=$key;
        	$lineData['y'][0]['name']='人数';
        	$lineData['y'][0]['data'][]=$val+0;
        }
        $this->view->params['start']=$start;
        $this->view->params['end']=$end;
        $querys['logdate']="{$start} / {$end}";
        return $this->render('index', [
        		'dataSet'=>['pieData'=>$pieData,'lineData'=>$lineData],
        		'query'=>$querys,
        		]);
    }
}
