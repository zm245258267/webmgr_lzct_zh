<?php
namespace backend\services;

use backend\models\GameCmdLog;
use backend\models\GameServer;

class GameCmdLogService extends GameCmdLog{
	
	/**
	 * 执行CMD
	 * @param int $serverid
	 * @param string $cmd
	 * @param array $params
	 * @param string $reason
	 * @param string $errmsg
	 * @return boolean
	 */
	public function exec($serverid,$cmd,$params,$reason,&$errmsg=''){
		$host=GameServer::find()->where(['serverId'=>$serverid])->select('socket')->scalar();
		$host=explode(":", $host);
		$port=array_pop($host);
		$host=implode(":",$host);
		
		if ($host==''){
			$errmsg="服务器未配置socket地址";
		}elseif ($port==''){
			$errmsg="服务器socket地址未带端口";	
		}else{
			$fp = fsockopen($host, $port, $errno, $errstr,15);
			if (!$fp) {
				$errmsg="ERROR: $errno - ";
			} else {
			    if (empty($params) || !is_array($params)){
					$cmd_data=$cmd;
				}else{
					$params=array_map(function($val){return htmlspecialchars(str_ireplace(" ", "&nbsp;", str_ireplace(["\r\n","\n"], ";", trim($val))));}, $params);
					$cmd_data=($cmd." ".json_encode($params));
				}
				fwrite($fp, $cmd_data."\r\n");
				$result=fread($fp, 1024);
				fclose($fp);
			}
		}
		if ($errmsg){
			return false;
		}
		// 执行结果返回
		$errmsg=$result;
		$username=\Yii::$app->user->identity->uname;
		$this->log($serverid,$cmd,$cmd_data,$result,$username,$reason);
		return true;
	}
	
	/**
	 * 记录日志
	 * @param int $serverid
	 * @param string $cmd
	 * @param string $data
	 * @param string $result
	 * @param string $username
	 * @param string $reason
	 */
	public function log($serverid,$cmd,$data,$result,$username,$reason){
		$values=[];
		$values['serverid']=$serverid;
		$values['cmd']=$cmd;
		$values['data']=$data;
		$values['result']=$result;
		$values['opperson']=$username;
		$values['notes']=$reason;
		$this->setAttributes($values);
		return $this->save();
	}
}
