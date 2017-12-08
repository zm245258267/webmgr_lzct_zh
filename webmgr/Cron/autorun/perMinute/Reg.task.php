<?php
/**
 * 注册日志处理
 * $Id$
 */
namespace autorun\perMinute;

class Reg
{
	public $eventLogPath='/data/web/webmgr/Cron/data/gamelog/';
	public $logPath='/data/web/webmgr/Cron/logs/';

    public function run ()
    {
    		$db=new \Db(C('YUNYINGEND_DB'));
    		// /data/web/webmgr/Cron/data/gamelog/gamelog_99001/1/1511877899.log

    		// 遍历所有服务器下的日志
    		$serverdirs=glob($this->eventLogPath."*");
    		if ($serverdirs){
    			foreach ($serverdirs as $serverdir){
    				$eventdir=$serverdir."/2/";	// 注册日志
    				
    				// 处理各个事件日志
    				$filepath=$eventdir;
    				$point=$filepath.'Reg.point';
    				$pointfilename="*";
    				if (!file_exists($point)){
    					$files=glob($filepath.$pointfilename);
    					$tmpfilename=array_shift($files);
    					$timestamp=basename($tmpfilename,'.log');
    					if ($timestamp){
    						file_put_contents($point, $timestamp);
    					}
    				}
    				
    				if (file_exists($point)){
    					$pointfilename=file_get_contents($point);
    					$currentFileName=$pointfilename;	// 当前文件名(保存当前实际文件 名)
    					$timestamp=$pointfilename+0;
    					$date=date('Ymd',$timestamp);
    					$sql='';
    					$nowtime=time();
    					// 读取60个
    					for ($i=$timestamp;$i<$nowtime;$i++){
    						$filename=$filepath.$pointfilename.'.log';
    						if (file_exists($filename)){
    							$content=addslashes(trim(file_get_contents($filename)));
    							$rows=explode("\r\n", $content);
    							foreach ($rows as $row){
    								
    								$row=explode(",", $row);
    								$serverId=str_ireplace("gamelog_","",basename($serverdir));
    								$account=$row[3];
    								$platform=$row['11'];
    								$mac=$row['13'];
    								$ip=$row[10];
    								$clientVersion=$row[14];
    								$sbid=$row[21];
    								$logdate=$row[22];
    								
    								$params="'{$serverId}','{$account}','{$platform}','{$mac}','{$ip}','{$clientVersion}','1','{$sbid}','{$logdate}'";
    								$sql="call proc_record_game_user_login({$params})";
    								$db->execute($sql);
    								$error=$db->getError();
    								if($error){
    									$error='['.date('Y-m-d H:i:s').']'.$error."[{$sql}]\r\n";
    									file_put_contents($this->logPath.'RegLog.err',$error,FILE_APPEND);
    								}else{	// 执行成功后保存新的指针文件
    									$currentFileName=$pointfilename;
    								}
    							}
    						}
    						$pointfilename+=1;
    					}
    					
    					// 超过一天未同步的直接PASS
    					$pointInterval=($pointfilename-$currentFileName);
    					if ($pointInterval>86400){
    						$currentFileName+=($pointInterval-86400);
    					}
    					
    					// 保存当前指针
    					file_put_contents($point, $currentFileName+1);
    				}
    				
    				
    			}
    		}
    }
   
}
