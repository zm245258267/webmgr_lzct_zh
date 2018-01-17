<?php

namespace backend\controllers;

use Yii;
use yii\data\Pagination;
use backend\models\GameRealOnline;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GameRealOnlineController implements the CRUD actions for GameRealOnline model.
 */
class GameRealOnlineController extends BaseController
{
	public $layout = "lte_main";

    /**
     * Lists all GameRealOnline models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = GameRealOnline::find();
//         $query->createCommand()->delete('game_real_online',['<','uptime',date('Y-m-d H:i:s',strtotime('-600 second'))]);
         $querys = Yii::$app->request->get('query');
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
        
        $serverId = Yii::$app->request->get('serverId');
        if ($serverId){
            $query->andWhere(['in','server',explode(",", $serverId)]);
        }
        $spId = Yii::$app->request->get('spId');
        if ($spId){
            $query->andWhere(['in','spid',explode(",", $spId)]);
        }

        $rows=$query->select(['server','sum(online) num'])->groupBy('server')->orderBy('num desc')->asArray()->all();
        
        $barData=[];
        foreach ($rows as $key=>$row){
        	$level=$row['server'];
        	$barData[$level]=$row['num'];
        }
        
        return $this->render('index', [
        		'dataSet'=>['barData'=>$barData],
        		'query'=>$querys,
        		]);
    }
}
