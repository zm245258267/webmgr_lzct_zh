<?php
namespace backend\controllers;
use backend\models\GameServerGroup;

use Yii;
use yii\web\Controller;
use yii\web\BadRequestHttpException;
use yii\helpers\Url;
use yii\web\ForbiddenHttpException;
use backend\models\AdminLog;
use common\utils\CommonFun;
use yii\helpers\StringHelper;
use yii\helpers\Inflector;
class BaseController extends Controller
{
    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if($this->verifyPermission($action) == true){
            	
            	// assign 服务器列表
            	$GameServerGroup=GameServerGroup::find();
            	$GameServerGroup->leftJoin('game_server','game_server_group.id=game_server.groupId');
            	$queryData=$GameServerGroup->select(["game_server_group.groupName","game_server.*"])->asArray()->all();
            	
            	// 默认服务器
            	$defaultServer=[];
            	$defaultServer['serverId']=$queryData[0]['serverId'];
            	$defaultServer['serverName']=$queryData[0]['serverName'];
            	
            	$groupServers=[];
            	foreach ($queryData as $row){
            		$groupServers[$row['groupId']]['groupName']=$row['groupName'];
            		$groupServers[$row['groupId']]['serverList'][]=$row;
            	}
            	
            	$groupServersParams=[];
            	$groupServersParams['serverId']=\Yii::$app->request->get('serverId');
            	$groupServersParams['serverName']=\Yii::$app->request->get('serverName');
            	
            	// 服务器默认选择处理
            	if(!isset($groupServersParams['serverId'])){
            	    $groupServersParams['serverId']=$defaultServer['serverId'];
            	    $groupServersParams['serverName']=$defaultServer['serverName'];
            	    
            	    // 重置参数
            	    $params=\Yii::$app->request->getQueryParams();
            	    $params['serverId']=$groupServersParams['serverId'];
            	    \Yii::$app->request->setQueryParams($params);
            	}
            	
            	$this->view->params['groupServers']=$groupServers;
            	$this->view->params['groupServersParams']=$groupServersParams;
                return true;
            }
        }
        return false;
    }
    
    private function verifyPermission($action){
        $route = $this->route;
        // 检查是否已经登录
        if(Yii::$app->user->isGuest){
            $allowUrl = ['site/index', 'site/login'];
            if(in_array($route, $allowUrl) == false){
                $this->redirect(Url::toRoute('site/index'));
                return false;
            }
        }
        else{
            $system_rights = Yii::$app->user->identity->getSystemRights();
            $loginAllowUrl = ['site/index', 'site/logout', 'site/psw', 'site/psw-save'];
            if(in_array($route, $loginAllowUrl) == false){
               if((empty($system_rights) == true || empty($system_rights[$route]) == true)){
                    header("Content-type: text/html; charset=utf-8");
                    //exit('没有权限访问'.$route);
               }
               $rights = $system_rights[$route];
               if($route != 'system-log/index'){
                    $systemLog = new AdminLog();
                    $systemLog->url = $route;
                    $systemLog->controller_id = $action->controller->id;
                    $systemLog->action_id = $action->id;
                    $systemLog->module_name = $rights['module_name'];
                    $systemLog->func_name = $rights['menu_name'];
                    $systemLog->right_name = $rights['right_name'];
                    $systemLog->create_date = date('Y-m-d H:i:s');
                    $systemLog->create_user = Yii::$app->user->identity->uname;
                    $systemLog->client_ip = CommonFun::getClientIp();
                    $systemLog->save();
               }
            }
        }
        return true;
    }
    
    protected function getAllController(){
        $className = get_class($this);
        $mn = explode('\\', $className);
        array_pop($mn);
        $classNameSpace = implode('\\', $mn);
        $dir = dirname(__FILE__);
        $classfiles = glob ( $dir . "/*Controller.php" );
        $controllerDatas = [];
        foreach($classfiles as $file){
            $info = pathinfo($file);
            $controllerClass = $classNameSpace . '\\' . $info[ 'filename' ];
            $controllerDatas[$info[ 'filename' ]] = $controllerClass;
        }
        $rightActionData = [];
        foreach($controllerDatas as $c){
            if(StringHelper::startsWith($c, 'backend\controllers') == true && $c != 'backend\controllers\BaseController'){
                $controllerName = substr($c, 0, strlen($c) - 10);
                $cUrl = Inflector::camel2id(StringHelper::basename($controllerName));
                $methods = get_class_methods($c);
                $rightTree = ['text'=>$c, 'selectable'=>false, 'state'=>['checked'=>false], 'type'=>'r'];
                foreach($methods as $m){
                    if($m != 'actions' && StringHelper::startsWith($m, 'action') !== false){
                        $actionName = substr($m, 6, strlen($m));
                        $aUrl = Inflector::camel2id($actionName);
                        $actionTree = ['text'=>$aUrl . "&nbsp;&nbsp;($cUrl/$aUrl)", 'c'=>$cUrl, 'a'=>$aUrl, 'selectable'=>true, 'state'=>['checked'=>false], 'type'=>'a'];
                        if(isset($rightUrls[$cUrl.'/'.$aUrl]) == true){
                            $actionTree['state']['checked'] = true;
                            $rightTree['state']['checked'] = true;
                        }
                        $rightTree['nodes'][] = $actionTree;
                    }
                }
                $rightActionData[] = $rightTree;
            }
        }
        return $rightActionData;
    }
}

?>