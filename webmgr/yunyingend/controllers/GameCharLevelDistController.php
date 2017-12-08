<?php

namespace backend\controllers;

use Yii;
use yii\data\Pagination;
use backend\models\GameChardesc;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GameCharLevelDistController implements the CRUD actions for GameChardesc model.
 */
class GameCharLevelDistController extends BaseController
{
	public $layout = "lte_main";

    /**
     * Lists all GameChardesc models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = GameChardesc::find();
         $querys = Yii::$app->request->get('query');
         $serverId = Yii::$app->request->get('serverId');
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
        
        if ($serverId){
        	$query->andWhere(['in','serverid',explode(",", $serverId)]);
        }
        
        $rows=$query->select(['charlevel','count(*) nums'])->groupBy('charlevel')->orderBy('charlevel')->indexBy('charlevel')->asArray()->all();
        
        $pieData=[];
        $lineData=[];
        foreach ($rows as $row){
        	$level=$row['charlevel']."级";
        	$pieData[]=[$level,$row['nums']];
        	$lineData['x'][]=$level;
        	$lineData['y'][0]['name']='人数';
        	$lineData['y'][0]['data'][]=$row['nums']+0;
        }

        return $this->render('index', [
            'dataSet'=>['pieData'=>$pieData,'lineData'=>$lineData],
            'query'=>$querys,
        ]);
    }
}
