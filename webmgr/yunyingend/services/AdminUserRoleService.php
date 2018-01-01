<?php
namespace backend\services;

use backend\models\AdminUserRole;
use common\utils\CommonFun;

class AdminUserRoleService extends AdminUserRole
{

    public function saveUserRole($userId, $roleId, &$error = '')
    {
        if ($userId == '') {
            $error = "用户ID为空";
            return false;
        }
        
        if ($roleId == '') {
            $error = "角色ID为空";
            return false;
        }
        
        $where = [
            'user_id' => $userId,
            'role_id' => $roleId
        ];
        
        $row=$this->find()
            ->where($where)
            ->one();
        
        $this->setIsNewRecord(!$row);
        
        $data = [
            'user_id' => $userId,
            'role_id' => $roleId
        ];
        
        if ($this->getIsNewRecord()) {
            $data['create_user']=\Yii::$app->user->identity->uname;
            $data['create_date']=date('Y-m-d H:i:s');
        } else {
            $data['update_user']=\Yii::$app->user->identity->uname;
            $data['update_date']=date('Y-m-d H:i:s');
        }
        
        $formData = [
            'form-data' => $data
        ];
        
        if ($this->load($formData, 'form-data')) {
            if ($this->validate()) {
                $res = $this->save();
                $error = CommonFun::modelErrorsToString($this->getErrors());
                return $res;
            } else {
                $error = CommonFun::modelErrorsToString($this->getErrors());
                return false;
            }
        } else {
            $error = CommonFun::modelErrorsToString($this->getErrors());
            return false;
        }
        
        $error = "未知错误";
        return false;
    }
}
