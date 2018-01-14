<?php

namespace backend\controllers;

use Yii;
use backend\models\GameChardesc;
use common\utils\CommonFun;

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
        
        $rows=$query->select(['guildid','sum(if(`guildstatus`=1,1,0)) getNums','sum(if(`guildstatus`=3,1,0)) completedNums'])->groupBy('guildid')->orderBy('guildid')->indexBy('guildid')->asArray()->all();
        
//         $barData=[];
        $tableData=[];
        
        foreach ($rows as $key=>$row){
            $task=CommonFun::TaskIdToName($key);
//         	$barData[$task]=$row['getNums']+0;
            $completeRate=@round($row['completed']/($row['completed']+$row['get']),4);
            $completeRate=($completeRate>0?$completeRate:0);
        	$tableData[$task]=['get'=>$row['getNums']+0,'completed'=>$row['completedNums']+0,'completeRate'=>$completeRate];
        	
        }

        return $this->render('index', [
            'dataSet'=>['pieData'=>$pieData,'barData'=>$barData,'tableData'=>$tableData],
            'query'=>$querys,
        ]);
    }
}
