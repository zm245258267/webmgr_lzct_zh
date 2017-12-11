<?php

namespace backend\controllers;

use common\utils\CommonFun;

use Yii;
use yii\data\Pagination;
use backend\models\GameLog;
use backend\models\GameEventMap;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\services\GameLogService;
use yii\db\Query;
use yii\base\Object;
use yii\db\Command;

/**
 * GameLogController implements the CRUD actions for GameLog model.
 */
class GameLogController extends BaseController
{
	public $layout = "lte_main";

    /**
     * Lists all GameLog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = GameLog::find();
         $querys = Yii::$app->request->get('query');
         $serverId = Yii::$app->request->get('serverId');
         $time=$querys['time'];
         $eventId=$querys['eventId'];
         unset($querys['time'],$querys['serverid'],$querys['eventId']);
         
         $start=date('Y-m-d');
         $end=date('Y-m-d H:i');
         CommonFun::parse_date_range($time, $start, $end);
         
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
        $query->andWhere(['between','time',$start,$end.":59"]);
        if ($eventId){
        	$query->andWhere(['in','eventId',explode(",", $eventId)]);
        }
        
        // 获取存在的表名
        $start_date=date('Y-m-d',strtotime($start));
        $end_date=date('Y-m-d',strtotime($end));
        $start_gmt=strtotime($start_date);
        $end_gmt=strtotime($end_date);
        $tables=[];
        while ($start_gmt<=$end_gmt){
        	$cur_date=date('Ymd',$start_gmt);
        	$cur_table="gamelog_{$serverId}_{$cur_date}";
        	
        	$rs=\Yii::$app->log_db->createCommand("show tables like '{$cur_table}'")->queryScalar();
        	if ($rs){
        		$tables[]=$cur_table;
        	}
        	$start_gmt=strtotime("+1 day",$start_gmt);
        }
        $table=array_shift($tables);
        $query->from($table);
        GameLog::$tableName=$table;
        if (!empty($tables)){
        	foreach ($tables as $table){
        		$query->union(GameLog::find()->where($query->where)->from($table),true);
        	}
        }
        
        $totalCount=0;
        if (!empty($table)){
        	$totalCount=$query->count();
        }
        
        $pagination = new Pagination([
        		'totalCount' =>$totalCount,
        		'pageSize' => (\Yii::$app->params['pageSize']?\Yii::$app->params['pageSize']:10),
        		'pageParam'=>'page',
        		'pageSizeParam'=>'per-page']
        );
        
        $orderby = Yii::$app->request->get('orderby', '');
        if(empty($orderby) == false){
        	$query = $query->orderBy($orderby);
        }
        
        if (!empty($table)){
        	//$models = $query
        	//->offset($pagination->offset)
//         	->limit($pagination->limit)
        	//->all();
        	
        	$sql=$query->createCommand()->rawSql." limit {$pagination->offset},{$pagination->limit}";
        	$models=\Yii::$app->log_db->createCommand($sql)->queryAll();
        	$models=$models;
        }
        
        $models=CommonFun::ArrayToObject($models);
        
       	// 行为定义表
        $GameEventMap=GameEventMap::find();
        $events=$GameEventMap->indexBy("event_id")->asArray()->all();
        
        // 格式化数据
        $models=(new GameLogService())->formatData($models);
        
        $querys['serverid']=$serverid;
        $querys['time']="{$start} / {$end}";
        $querys['eventId']=$eventId;
        $this->view->params['start']=$start;
        $this->view->params['end']=$end;
        return $this->render('index', [
            'models'=>$models,
            'pages'=>$pagination,
            'query'=>$querys,
            'events'=>$events,
            'eventName'=>\Yii::$app->request->get('eventName'),
        ]);
    }

    /**
     * Displays a single GameLog model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        echo json_encode($model->getAttributes());

    }

    /**
     * Finds the GameLog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GameLog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GameLog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
