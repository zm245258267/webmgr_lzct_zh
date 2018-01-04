<?php

namespace backend\controllers;

use Yii;
use backend\models\GameCmd;
use backend\services\GameCmdLogService;

/**
 * GameCmdController implements the CRUD actions for GameCmd model.
 */
class GameCmdOperatorController extends BaseController
{
	public $layout = "lte_main";

    /**
     * Lists all GameCmd models.
     * @return mixed
     */
    public function actionIndex()
    {
    	$request=\Yii::$app->request;
    	if($request->getIsPost()){
    		$step=$request->post('step');
    		/**
    		 * 切换cmd
    		 */
    		if ($step=='changeCmd'){
    			$cmd=$request->post('cmd');
    			$cmdInfo=GameCmd::find()->where(['cmd'=>$cmd])->asArray()->one();
    			$content=$this->renderPartial('lib_cmd_params_form',['cmdInfo'=>$cmdInfo]);
    			die(json_encode(['content'=>$content]));
    		}
    	}
    	
        // 查询所有指令
    	$cmds = GameCmd::find()->indexBy('cmd')->asArray()->all();
        return $this->render('index', [
        	'cmds'=>$cmds,
        ]);
    }
    
    /**
     * 执行
     */
    public function actionOperator(){
    	$Service=new GameCmdLogService();
    	$request=\Yii::$app->request;
    	$serverid=$request->post('serverId')+0;
    	$cmd=$request->post('cmd');
    	$params=$request->post('params');
    	$reason=$request->post('reason');
    	
    	if ($serverid==''){
    		$errmsg='请选择服务器';
    	}elseif ($cmd==''){
    		$errmsg='请选择操作';
    	}elseif (is_array($params)){
    		$params=array_filter($params);
    		if (empty($params)){
    			$errmsg="相关参数不能为空";
    		}
    	}
    	
    	// 操作原因可写可不写
    	
    	if ($errmsg){
    		die(json_encode(['errno'=>1,'msg'=>$errmsg]));
    	}
    	
    	$errmsg='';
    	$rs=$Service->exec($serverid, $cmd, $params, $reason,$errmsg);
    	
    	if ($rs===true){
    		die(json_encode(['errno'=>0,'msg'=>"执行成功。".$errmsg]));
    	}else{
    		die(json_encode(['errno'=>1,'msg'=>"执行失败。".$errmsg]));
    	}
    	return;
    }
    
    /**
     * 通用GM操作
     */
    public function actionCommon(){
    	return $this->render('common', []);
    }
    
    /**
     * 通用GM操作执行
     */
    public function actionCommonOperator(){
    	$Service=new GameCmdLogService();
    	$request=\Yii::$app->request;
    	$serverid=$request->post('serverId')+0;
    	$reason=$request->post('reason');
    	$cmd=$request->post('cmd');
    	
    	if ($serverid==''){
    		$errmsg='请选择服务器';
    	}elseif ($cmd==''){
    		$errmsg="请输入指令";
    	}
    	// 原因可写可不写
    	
    	if ($errmsg){
    		die(json_encode(['errno'=>1,'msg'=>$errmsg]));
    	}
    	
    	// 指令处理
    	$cmd=trim($cmd);
    	$cmd_data=explode(" ", $cmd);
    	$cmd=array_shift($cmd_data);
    	if (empty($cmd_data)){
    		$params=null;
    	}else{
    		$params=$cmd_data;
    	}
    	
    	$errmsg='';
    	$rs=$Service->exec($serverid, $cmd, $params, $reason,$errmsg);
    	
    	if ($rs===true){
    		die(json_encode(['errno'=>0,'msg'=>"执行成功。".$errmsg]));
    	}else{
    		die(json_encode(['errno'=>1,'msg'=>"执行失败。".$errmsg]));
    	}
    	return;
    }
    
}
