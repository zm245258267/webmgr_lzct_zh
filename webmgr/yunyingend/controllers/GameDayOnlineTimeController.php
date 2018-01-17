<?php

namespace backend\controllers;

use common\utils\CommonFun;

use Yii;
use backend\models\GameDayOnlineTime;

/**
 * GameDayOnlineTimeController implements the CRUD actions for GameDayOnlineTime model.
 */
class GameDayOnlineTimeController extends BaseController
{
	public $layout = "lte_main";
	
	public $timeInterval=[
		'5-'=>[0,300],
		'5-10'=>[300,600],
		'10-20'=>[600,1200],
		'20-30'=>[1200,1800],
		'30-60'=>[1200,3600],
		'60-120'=>[3600,7200],
		'120-180'=>[3600,10800],
		'180-240'=>[10800,14400],
	    '240+'=>[14400,0],
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
        
        $spId = Yii::$app->request->get('spId');
        if ($spId){
            $query->andWhere(['in','spid',explode(",", $spId)]);
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
                'dataSet'=>['pieData'=>$pieData,'lineData'=>$lineData,'tableData'=>$pieData],
        		'query'=>$querys,
        		]);
    }
}
