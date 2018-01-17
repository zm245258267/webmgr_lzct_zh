<?php
namespace backend\services;

use backend\models\GameUserReport;
use yii\db\Query;

class GameUserReportService extends GameUserReport
{

    /**
     * 查询数据
     *
     * @param array $params            
     * @return number[]
     */
    public function queryData($params)
    {
        $condition=[];
        if ($params['querys']['spId']){
            $condition=['and',$condition,['in','spid',explode(",", $params['querys']['spId'])]];
        }
        if ($params['querys']['serverId']){
            $condition=['and',$condition,['in','serverid',explode(",", $params['querys']['serverId'])]];
        }
        
        $query = GameUserReport::find();
        $query->select( "state,count(*) totalDevice" )
            ->groupBy( "state" )->where($condition);
        
        $subSql = $query->createCommand()->rawSql;
        
        $dataSet = (new Query())->select( "state,totalDevice" )
            ->from( "({$subSql}) tmp" )
            ->orderBy( $params['orderby'] )
            ->indexBy( 'state' )
            ->all();
        
        $result = [ ];
        $status = \Yii::$app->params['GAME_LOGIN_STATUS_CONFIG'];
        
        foreach ( $status as $id => $val ) {
            $result[$id] = $dataSet[$id]['totalDevice'] + 0;
        }
        
        return $result;
    }
}
