<?php

namespace backend\controllers;

use Yii;
use backend\models\GameChardesc;

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
        $spId = Yii::$app->request->get('spId');
        if ($spId){
            $query->andWhere(['in','spid',explode(",", $spId)]);
        }
        $query->andWhere(['>','guildid',0]);
        
        $rows=$query->select(['guildid','count(*) totalPersons'])->groupBy('guildid')->indexBy('guildid')->asArray()->all();
        
        $tableData=[];
        
        // 总任务人数
        $totalPersons=0;;
        foreach ($rows as $key=>$row){
            $totalPersons+=$row['totalPersons'];
        }
        
        // 流失率
        $tasks=\Yii::$app->params['GAME_TASK_CONFIG'];
        $currentTotalPersons=0;
        foreach ($tasks as $taskId=>$taskName){
            $currentTotalPersons+=$rows[$taskId]['totalPersons'];
            $percent=@round($currentTotalPersons/$totalPersons*100,2);
            $tableData[$taskId]=['name'=>$taskName,'totalPersons'=>$rows[$taskId]['totalPersons']+0,'percent'=>$percent+0];
        }
        

        return $this->render('index', [
            'dataSet'=>['pieData'=>$pieData,'barData'=>$barData,'tableData'=>$tableData],
            'query'=>$querys,
        ]);
    }
}
