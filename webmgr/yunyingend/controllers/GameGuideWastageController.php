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
 * GameGuideWastageController implements the CRUD actions for GameChardesc model.
 */
class GameGuideWastageController extends BaseController
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
        
        $rows=$query->select(['guildid','count(*) nums'])->groupBy('guildid')->orderBy('guildid')->indexBy('guildid')->asArray()->all();
        
//         $rows=[1=>['nums'=>rand(99, 999)],2=>['nums'=>rand(99,999)],3=>['nums'=>rand(99,999)]];
        
        $pieData=[];
        $barData=[];
        foreach ($rows as $key=>$row){
        	$level="任务".$key;
        	$pieData[]=[$level,$row['nums']];
        	$barData[$level]=$row['nums'];
        }

        return $this->render('index', [
            'dataSet'=>['pieData'=>$pieData,'barData'=>$barData],
            'query'=>$querys,
        ]);
    }
}
