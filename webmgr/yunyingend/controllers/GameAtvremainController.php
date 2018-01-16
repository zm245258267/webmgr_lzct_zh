<?php
namespace backend\controllers;

use Yii;
use yii\data\Pagination;
use backend\models\GameAtvremain;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\utils\CommonFun;

/**
 * GameAtvremainController implements the CRUD actions for GameAtvremain model.
 */
class GameAtvremainController extends BaseController
{
    public $layout = "lte_main";

    /**
     * Lists all GameAtvremain models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $query = GameAtvremain::find();
        $querys = Yii::$app->request->get( 'query' );
        
        $serverId = Yii::$app->request->get( 'serverId' );
        $logdate = $querys['logdate'];
        unset( $querys['logdate'] );
        $start = date( 'Y-m-d', strtotime( '-1 month' ) );
        $end = date( 'Y-m-d' );
        
        CommonFun::parse_date_range( $logdate, $start, $end );
        
        $where = [ ];
        $where = [ 
                'and',
                $where,
                [ 
                        'between',
                        'logdate',
                        $start,
                        $end 
                ] 
        ];
        
        $field = "oldusers";
        if ($serverId) {
            $field = "oldusers_full";
            $where = [ 
                    'and',
                    $where,
                    [ 
                            'in',
                            'serverid',
                            explode( ",", $serverId ) 
                    ] 
            ];
        }
        
        $models = $query->select( "date(logdate) logdate,sum({$field}) totalAtvUser" )
            ->where( $where )
            ->groupBy( 'logdate' )
            ->orderBy( 'logdate' )
            ->indexBy( 'logdate' )
            ->asArray()
            ->all();
        
        $lineData = [ ];
        foreach ( $models as $date => $row ) {
            $lineData['x'][] = $date;
            $lineData['y'][0]['name'] = '人数';
            $lineData['y'][0]['data'][] = $row['totalAtvUser'] + 0;
        }
        
        $dataSet = [ 
                'lineData' => $lineData 
        ];
        
        $querys['logdate'] = "{$start} / {$end}";
        return $this->render( 'index', [ 
                'dataSet' => $dataSet,
                'query' => $querys 
        ] );
    }

    /**
     * Finds the GameAtvremain model based on its primary key value. If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $serverid            
     * @param string $spid            
     * @param string $sbid            
     * @param string $logdate            
     * @return GameAtvremain the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($serverid, $spid, $sbid, $logdate)
    {
        if (($model = GameAtvremain::findOne( [ 
                'serverid' => $serverid,
                'spid' => $spid,
                'sbid' => $sbid,
                'logdate' => $logdate 
        ] )) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException( 'The requested page does not exist.' );
        }
    }
}
