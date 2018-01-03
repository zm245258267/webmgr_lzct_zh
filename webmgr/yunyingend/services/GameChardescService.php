<?php
namespace backend\services;

use backend\models\GameChardesc;

class GameChardescService extends GameChardesc
{

    public function queryLevelDist($querys, $levelField)
    {
        $query = GameChardesc::find();
        $serverId = $querys['serverId'];
        if (count( $querys ) > 0) {
            $condition = "";
            $parame = array ();
            foreach ( $querys as $key => $value ) {
                $value = trim( $value );
                if (empty( $value ) == false) {
                    $parame[":{$key}"] = $value;
                    if (empty( $condition ) == true) {
                        $condition = " {$key}=:{$key} ";
                    } else {
                        $condition = $condition . " AND {$key}=:{$key} ";
                    }
                }
            }
            if (count( $parame ) > 0) {
                $query = $query->where( $condition, $parame );
            }
        }
        
        if ($serverId) {
            $where = [ 
                    'in',
                    'serverid',
                    explode( ",", $serverId ) 
            ];
            $query->andWhere( $where );
        }
        
        $field = [
                $levelField,
                'count(*) nums'
        ];
        
        $rows = $query->select( $field )
            ->groupBy( $levelField )
            ->orderBy( $levelField )
            ->indexBy( $levelField )
            ->asArray()
            ->all();
        
        $pieData = [ ];
        $lineData = [ ];
        $totalNums = 0;
        
        foreach ( $rows as $row ) {
            $totalNums += $row['nums'];
            
            $level = $row[$levelField] . "级";
            $pieData[] = [ 
                    $level,
                    $row['nums'] + 0 
            ];
            $lineData['x'][] = $level;
            $lineData['y'][0]['name'] = '人数';
            $lineData['y'][0]['data'][] = $row['nums'] + 0;
        }
        
        return ['pieData'=>$pieData,'lineData'=>$lineData,'totalNums'=>$totalNums,'tableData'=>$pieData];
    }
}
