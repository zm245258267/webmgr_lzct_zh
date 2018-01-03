<?php
namespace backend\controllers;

use Yii;
use backend\models\GameChardesc;
use backend\services\GameChardescService;

/**
 * GameCharLevelDistController implements the CRUD actions for GameChardesc model.
 */
class GameCharLevelDistController extends BaseController
{
    public $layout = "lte_main";

    /**
     * Lists all GameChardesc models.
     * 
     * @return mixed
     */
    public function actionIndex()
    {
        $querys = Yii::$app->request->get( 'query' );
        $querys['serverId'] = Yii::$app->request->get( 'serverId' );
        
        $ChardescService = new GameChardescService();
        
        $castleData = $ChardescService->queryLevelDist( $querys, 'castlelevel' );
        $charData = $ChardescService->queryLevelDist( $querys, 'charlevel' );
        
        return $this->render( 'index', [ 
                'castleData' => $castleData,
                'charData' => $charData,
                'query' => $querys 
        ] );
    }
}
