<?php

namespace backend\controllers;

use common\utils\CommonFun;

use Yii;
use yii\data\Pagination;
use backend\models\GameUsers;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GameUsersDaybackController implements the CRUD actions for GameUsers model.
 */
class GameUsersDaybackController extends BaseController
{
	public $layout = "lte_main";

    /**
     * Lists all GameUsers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = GameUsers::find();
         $querys = Yii::$app->request->get('query');
         $serverId=Yii::$app->request->get('serverId');
         $spId = Yii::$app->request->get('spId');
         $createtime=$querys['createtime'];
         unset($querys['createtime']);
         $start=date('Y-m-01');
         $end=date('Y-m-d');
         CommonFun::parse_date_range($createtime, $start, $end);
         
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
        
        $query->andWhere(['between','createtime',$start,$end]);
        if ($serverId){
        	$query->andWhere(['in','serverid',explode(",", $serverId)]);
        }
        if ($spId){
            $query->andWhere(['in','createspid',explode(",", $spId)]);
        }
        
        $dataSet=[];
//         $dataSet['totalReg']=$query->count();	// 总注册数
        
        $field=[];
        $field[]='date(createtime) date';
        $field[]='count(*) reg';
        for ($i=0;$i<30;$i++){
        	$j=$i+1;
        	$field[]="sum(if(dayback & 1<<{$i},1,0)) '{$j}'";
        }
        $query_data=$query->select($field)->groupBy('date')->orderBy('createtime')->asArray()->all();
        foreach ($query_data as &$row){
        	for($i=1;$i<=30;$i++){
        		$login=$row[$i];
        		$row[$i]=[];
        		$row[$i][0]=$login;
        		$row[$i][1]=round($login/$row['reg']*100,2);
        	}
        }
        $dataSet['remained']=$query_data;
        
        $querys['createtime']="{$start} / {$end}";
        $this->view->params['start']=$start;
        $this->view->params['end']=$end;
        return $this->render('index', [
            'dataSet'=>$dataSet,
            'query'=>$querys,
        ]);
    }
}
