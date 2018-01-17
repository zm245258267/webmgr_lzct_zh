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
 * GameUsersController implements the CRUD actions for GameUsers model.
 */
class GameUsersController extends BaseController
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
         $serverId = Yii::$app->request->get('serverId');
         $spId = Yii::$app->request->get('spId');
         $createtime=$querys['createtime'];
         $timetype=$querys['timetype']?$querys['timetype']:'h';
         unset($querys['createtime'],$querys['timetype']);
         $start=date('Y-m-d');
         $end=date('Y-m-d H:i');
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
        
        $query->andWhere(['between','createtime',$start,$end.':59']);
        if ($serverId){
        	$query->andWhere(['in','serverid',explode(",", $serverId)]);
        }
        if ($spId){
            $query->andWhere(['in','createspid',explode(",", $spId)]);
        }
        
        $totalReg=$query->count();
        
        $field=[];
        if ($timetype=='m'){
        	$field[]="date_format(createtime,'%Y-%m') date";
        }elseif($timetype=='d'){
        	$field[]="date(createtime) date";
        }else{
        	$field[]="date_format(createtime,'%Y-%m-%d %H') date";
        }
        
        $field[]="count(*) nums";
        $rows=$query->select($field)->groupBy('date')->orderBy('createtime')->asArray()->all();
        
        $lineData=[];
        $tableData=[];
        
        if (!empty($rows)){
        	foreach ($rows as $row){
        		$date=$row['date'];
        		$lineData['x'][]=$date;
        		$lineData['y'][0]['name']='人数';
        		$lineData['y'][0]['data'][]=$row['nums']+0;
        		 
        		$date=explode('-', $date);
        		$item=[];
        		$item['Y']=$date[0];
        		$item['m']=$date[1];
        		$h=explode(" ", $date[2]);
        		$item['d']=$h[0];
        		$item['H']=$h[1];
        		$item['nums']=$row['nums'];
        		$tableData[]=$item;
        		 
        		$d="{$item['Y']}-{$item['m']}-{$item['d']}";
        		$m="{$item['Y']}-{$item['m']}";
        		$totalDay[$d]+=$row['nums'];
        		$totalMonth[$m]+=$row['nums'];
        		$totalYear[$item['Y']]+=$row['nums'];
        		$totalAll['total']+=$row['nums'];
        	}
        	$day=key($totalDay);
        	$month=key($totalMonth);
        	$year=key($totalYear);
        	
        	if ($timetype=='m'){
        		$item=[];
        		$item['Y']=$year;
        		$item['m']='年总计';
        		$item['d']=null;
        		$item['H']=null;
        		$item['nums']=$totalYear[$year];
        		$tableData[]=$item;
        		 
        		$item=[];
        		$item['Y']='全部结果总计';
        		$item['m']=$totalAll['total'];
        		$item['d']=null;
        		$item['H']=null;
        		$item['nums']=$totalAll['total'];
        		$tableData[]=$item;
        	}elseif ($timetype=='d'){
        		$month=explode('-', $month);
        		$item=[];
        		$item['Y']=$month[0];
        		$item['m']=$month[1];
        		$item['d']='月总计';
        		$item['H']=null;
        		$item['nums']=$totalYear[$year];
        		$tableData[]=$item;
        	
        		$item=[];
        		$item['Y']=$year;
        		$item['m']='年总计';
        		$item['d']=null;
        		$item['H']=null;
        		$item['nums']=$totalYear[$year];
        		$tableData[]=$item;
        	
        		$item=[];
        		$item['Y']='全部结果总计';
        		$item['m']=$totalAll['total'];
        		$item['d']=null;
        		$item['H']=null;
        		$item['nums']=$totalAll['total'];
        		$tableData[]=$item;
        	}else{
        		$day=explode('-', $day);
        		$item=[];
        		$item['Y']=$day[0];
        		$item['m']=$day[1];
        		$item['d']=$day[2];
        		$item['H']='日总计';
        		$item['nums']=$totalYear[$year];
        		$tableData[]=$item;
        		 
        		$month=explode('-', $month);
        		$item=[];
        		$item['Y']=$month[0];
        		$item['m']=$month[1];
        		$item['d']='月总计';
        		$item['H']=null;
        		$item['nums']=$totalYear[$year];
        		$tableData[]=$item;
        		 
        		$item=[];
        		$item['Y']=$year;
        		$item['m']='年总计';
        		$item['d']=null;
        		$item['H']=null;
        		$item['nums']=$totalYear[$year];
        		$tableData[]=$item;
        		 
        		$item=[];
        		$item['Y']='全部结果总计';
        		$item['m']=$totalAll['total'];
        		$item['d']=null;
        		$item['H']=null;
        		$item['nums']=$totalAll['total'];
        		$tableData[]=$item;
        	}
        }
        
        $querys['createtime']="{$start} / {$end}";
        $querys['timetype']=$timetype;
        $this->view->params['start']=$start;
        $this->view->params['end']=$end;
        return $this->render('index', [
            'dataSet'=>['lineData'=>$lineData,'totalReg'=>$totalReg,'tableData'=>$tableData],
            'query'=>$querys,
        ]);
    }
}
