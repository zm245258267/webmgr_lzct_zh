<?php

namespace backend\controllers;

use backend\services\AdminUserRoleService;

use Yii;
use yii\data\Pagination;
use backend\models\AdminUser;
use yii\web\NotFoundHttpException;
use yii\db\Transaction;
use backend\models\AdminUserRole;

/**
 * AdminUserController implements the CRUD actions for AdminUser model.
 */
class AdminUserController extends BaseController
{
	public $layout = "lte_main";

    /**
     * Lists all AdminUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        AdminUser::$tableName='view_admin_user';
        $query = AdminUser::find();
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
        //$models = $query->orderBy('display_order')
        $pagination = new Pagination([
            'totalCount' =>$query->count(), 
            'pageSize' => '10', 
            'pageParam'=>'page', 
            'pageSizeParam'=>'per-page']
        );
        $models = $query
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();
        return $this->render('index', [
            'models'=>$models,
            'pages'=>$pagination,
            'query'=>$querys,
        ]);
    }

    /**
     * Displays a single AdminUser model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        //$id = Yii::$app->request->post('id');
//         $model = $this->findModel($id);
        AdminUser::$tableName='view_admin_user';
        $model=AdminUser::find()->where(['id'=>$id])->one();
        echo json_encode($model->getAttributes());

    }

    /**
     * Creates a new AdminUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AdminUser();
        $rq=\Yii::$app->request;
        
        if ($model->load($rq->post())) {
            if(empty($model->is_online) == true){
                $model->is_online = 'n';
            }
            if(empty($model->status) == true){
              $model->status = 10;
            }
            $model->password = Yii::$app->security->generatePasswordHash($model->password);
            $model->create_user = Yii::$app->user->identity->uname;
            $model->create_date = date('Y-m-d H:i:s');
            $model->update_user = Yii::$app->user->identity->uname;
            $model->update_date = date('Y-m-d H:i:s');
            
            // 开启事务
            $transaction=$model->getDb()->beginTransaction(Transaction::SERIALIZABLE);
            
            try {
                
                if($model->validate() == true && $model->save()){
                    // 关联用户角色
                    $role_id=$rq->post('role_id');
                    if ($role_id>0){
                        $errorMsg='';
                        if((new AdminUserRoleService())->saveUserRole($model->id, $role_id,$errorMsg)===false){
                            throw new \Exception('角色关联失败,请尝试刷新重试。'.$errorMsg);
                        }
                    }
                    
                    $msg = array('errno'=>0, 'msg'=>'保存成功');
                    echo json_encode($msg);
                    
                }else{
                    $msg = array('errno'=>2, 'data'=>$model->getErrors());
                    echo json_encode($msg);
                }
                
                $transaction->commit();
            }catch (\Exception $e){
                $transaction->rollBack();
                
                $msg = array('errno'=>2, 'msg'=>"添加失败。".$e->getMessage());
                echo json_encode($msg);
            }
            
        } else {
            $msg = array('errno'=>2, 'msg'=>'数据出错');
            echo json_encode($msg);
        }
    }

    /**
     * Updates an existing AdminUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate()
    {
    	$rq=Yii::$app->request;
        $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post())) {
              
            //$model->is_online = 'n';
            //$model->status = 10;
            $model->update_user = Yii::$app->user->identity->uname;
            $model->update_date = date('Y-m-d H:i:s');
            
            $transaction=$model->getDb()->beginTransaction(Transaction::SERIALIZABLE);
            
            try {
                if($model->validate() == true && $model->save()){
                    // 关联用户角色
                    $role_id=$rq->post('role_id');
                    if ($role_id>0){
                        $errorMsg='';
                        if((new AdminUserRoleService())->saveUserRole($model->id, $role_id,$errorMsg)===false){
                            throw new \Exception('角色关联失败,请尝试刷新重试。'.$errorMsg);
                        }
                    }else{
                        AdminUserRole::deleteAll(['user_id'=>$model->id]);
                    }
                    
                    $msg = array('errno'=>0, 'msg'=>'保存成功');
                    echo json_encode($msg);
                }
                else{
                    $msg = array('errno'=>2, 'data'=>$model->getErrors());
                    echo json_encode($msg);
                }
                
                $transaction->commit();
            }catch (\Exception $e){
                $transaction->rollBack();
                $msg = array('errno'=>3, 'msg'=>'保存失败。'.$e->getMessage());
                echo json_encode($msg);
            }
            
        } else {
            $msg = array('errno'=>2, 'msg'=>'数据出错');
            echo json_encode($msg);
        }
    
    }

    /**
     * Deletes an existing AdminUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete(array $ids)
    {
        if(count($ids) > 0){
            $c = AdminUser::deleteAll(['in', 'id', $ids]);
            echo json_encode(array('errno'=>0, 'data'=>$c, 'msg'=>json_encode($ids)));
        }
        else{
            echo json_encode(array('errno'=>2, 'msg'=>''));
        }
    
  
    }

    /**
     * Finds the AdminUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AdminUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminUser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
