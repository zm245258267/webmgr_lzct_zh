<?php

namespace backend\controllers;

use Yii;
use backend\models\GameUserReport;
use yii\web\NotFoundHttpException;
use yii\db\Query;
use backend\services\GameUserReportService;

/**
 * GameUserReportController implements the CRUD actions for GameUserReport model.
 */
class GameUserReportController extends BaseController
{
	public $layout = "lte_main";

    /**
     * Lists all GameUserReport models.
     * @return mixed
     */
    public function actionIndex()
    {
        $orderby = Yii::$app->request->get('orderby', '');
        if(empty($orderby)){
            $orderby='state';
        }
        
        $spId=Yii::$app->request->get('spId', '');
        $serverId=Yii::$app->request->get('serverId', '');
        
        $querys=['spId'=>$spId,'serverId'=>$serverId];
        
        $dataSet=(new GameUserReportService())->queryData(['querys'=>$querys,'orderby'=>$orderby]);
        
        return $this->render('index', [
            'dataSet'=>$dataSet,
        ]);
    }

//     /**
//      * Displays a single GameUserReport model.
//      * @param string $id
//      * @return mixed
//      */
//     public function actionView($id)
//     {
//         $model = $this->findModel($id);
//         echo json_encode($model->getAttributes());

//     }

//     /**
//      * Creates a new GameUserReport model.
//      * If creation is successful, the browser will be redirected to the 'view' page.
//      * @return mixed
//      */
//     public function actionCreate()
//     {
//         $model = new GameUserReport();
//         if ($model->load(Yii::$app->request->post())) {
        
        
//             if($model->validate() == true && $model->save()){
//                 $msg = array('errno'=>0, 'msg'=>'保存成功');
//                 echo json_encode($msg);
//             }
//             else{
//                 $msg = array('errno'=>2, 'data'=>$model->getErrors());
//                 echo json_encode($msg);
//             }
//         } else {
//             $msg = array('errno'=>2, 'msg'=>'数据出错');
//             echo json_encode($msg);
//         }
//     }

//     /**
//      * Updates an existing GameUserReport model.
//      * If update is successful, the browser will be redirected to the 'view' page.
//      * @param string $id
//      * @return mixed
//      */
//     public function actionUpdate()
//     {
//         $id = Yii::$app->request->post('id');
//         $model = $this->findModel($id);
//         if ($model->load(Yii::$app->request->post())) {
        
        
        
//             if($model->validate() == true && $model->save()){
//                 $msg = array('errno'=>0, 'msg'=>'保存成功');
//                 echo json_encode($msg);
//             }
//             else{
//                 $msg = array('errno'=>2, 'data'=>$model->getErrors());
//                 echo json_encode($msg);
//             }
//         } else {
//             $msg = array('errno'=>2, 'msg'=>'数据出错');
//             echo json_encode($msg);
//         }
    
//     }

//     /**
//      * Deletes an existing GameUserReport model.
//      * If deletion is successful, the browser will be redirected to the 'index' page.
//      * @param string $id
//      * @return mixed
//      */
//     public function actionDelete(array $ids)
//     {
//         if(count($ids) > 0){
//             $c = GameUserReport::deleteAll(['in', 'id', $ids]);
//             echo json_encode(array('errno'=>0, 'data'=>$c, 'msg'=>json_encode($ids)));
//         }
//         else{
//             echo json_encode(array('errno'=>2, 'msg'=>''));
//         }
    
  
//     }

    /**
     * Finds the GameUserReport model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return GameUserReport the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GameUserReport::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
