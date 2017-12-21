<?php
/**
 * 注册日志处理
 * /data/web/webmgr/Cron/data/gamelog/gamelog_99001/1/1511877899.log
 * $Id$
 */
namespace autorun\perMinute;

class Reg
{
    public function run ()
    {
    		$db=new \Db(C('YUNYINGEND_DB'));
    		$errorLogFile=LOG_ROOT.'RegLog.err'; // 错误日志文件
    		$EventLogPath=C('EVENT_LOG_PATH');	// 行为日志目录

    		// 遍历所有服务器下的日志
    		$serverdirs=glob($EventLogPath."*");
    		if ($serverdirs){
    			foreach ($serverdirs as $serverdir){
    				
    				if (!is_dir($serverdir))continue;
    				$eventdir=$serverdir."/2/";	// 注册日志
    				
    				// 处理各个事件日志
    				$filepath=$eventdir;
    				$point=$filepath.'Reg.point';
    				
    				if (!file_exists($point)){
    					// 默认从一天前开始读取
    					@file_put_contents($point, strtotime('-1 day'),LOCK_EX);
    				}
    				
    				if (file_exists($point)){
    					
    					$pointfilename=file_get_contents($point);
    					$currentFileName=$pointfilename;	// 当前文件名(保存当前实际文件 名)
    					$timestamp=$pointfilename+0;
    					$nowtime=time();
    					
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
    									@file_put_contents($errorLogFile,$error,LOCK_EX|FILE_APPEND);
    								}
    							}
    							$currentFileName=$pointfilename;
    						}
    						$pointfilename+=1;
    					}
    					
    					// 超过一天未同步的直接PASS
    					$pointInterval=($pointfilename-$currentFileName);
    					if ($pointInterval>86400){
    						$currentFileName+=($pointInterval-86400);
    					}
    					
    					// 保存当前指针
    					if ($currentFileName!=$timestamp){
    						@file_put_contents($point, $currentFileName+1,LOCK_EX);
    					}
    				}
    			}
    		}
    }
}
