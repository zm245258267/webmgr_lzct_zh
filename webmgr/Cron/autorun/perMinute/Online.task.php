<?php
/**
 * 在线日志处理
 * /data/web/webmgr/Cron/data/gamelog/gamelog_99001/1/1511877899.log
 * $Id$
 */
namespace autorun\perMinute;

class Online
{
    public function run ()
    {
    		$db=new \Db(C('YUNYINGEND_DB'));
    		$errorLogFile=LOG_ROOT.'OnlineLog.err'; // 错误日志文件
    		$EventLogPath=C('EVENT_LOG_PATH');	// 行为日志目录

    		// 遍历所有服务器下的日志
    		$serverdirs=glob($EventLogPath."*");
    		if ($serverdirs){
    			foreach ($serverdirs as $serverdir){
    				
    				if (!is_dir($serverdir))continue;
    				$eventdir=$serverdir."/1/";	// 在线日志
    				
    				// 处理各个事件日志
    				$filepath=$eventdir;
    				$point=$filepath.'Online.point';
    				
    				if (!file_exists($point)){
    					// 默认从一天前开始读取
    					file_put_contents($point, strtotime('-1 day'),FILE_APPEND);
    				}
    				
    				if (file_exists($point)){
    					
    					$pointfilename=file_get_contents($point);
    					$currentFileName=$pointfilename;	// 当前文件名(保存当前实际文件 名)
    					$timestamp=$pointfilename+0;
    					$date=date('Ymd',$timestamp);
    					$nowtime=time();
    					$sqlValues='';
    					
    					for ($i=$timestamp;$i<$nowtime;$i++){
    						
    						$filename=$filepath.$pointfilename.'.log';
    						
    						if (file_exists($filename)){
    							
    							$content=addslashes(trim(file_get_contents($filename)));
    							$rows=explode("\r\n", $content);
    							
    							foreach ($rows as $row){
    								
    								$row=explode(",", $row);
    								$serverId=str_ireplace("gamelog_","",basename($serverdir));
    								$online=$row[10];
    								$viponline=$row[11];
    								$spid=$row[20];
    								$sbid=$row[21];
    								$logdate=$row[22];
    								
    								// 历史在线
    								$hour=date('G',strtotime($logdate));
    								$sqlValues="('{$serverId}','{$online}','{$viponline}','{$spid}','{$sbid}','{$logdate}')";
    								$sql="insert into `game_hour_online` (`server`,`h{$hour}`,`s{$hour}`,`spid`,`sbid`,`logdate`) values {$sqlValues} ";
    								$sql.="on duplicate key update `h{$hour}`=values(`h{$hour}`),`s{$hour}`=values(`s{$hour}`)";
    								$db->insertAll($sql);
    								$error=$db->getError();
    								if($error){
    									$error='['.date('Y-m-d H:i:s').']'.$error."[{$sql}]\r\n";
    									file_put_contents($errorLogFile,$error,FILE_APPEND);
    								}
    							}
    							$currentFileName=$pointfilename;
    						}
    						$pointfilename+=1;
    					}
    					// 入库(实时在线)
    					if ($sqlValues){
    						$sql="insert into `game_real_online` (`server`,`online`,`viponine`,`spid`,`sbid`,`uptime`)  values {$sqlValues} ";
    						$sql.="on duplicate key update `online`=values(online),`viponine`=values(viponine)";
    						$db->insertAll($sql);
    						$error=$db->getError();
    						if($error){
    							$error='['.date('Y-m-d H:i:s').']'.$error."[{$sql}]\r\n";
    							file_put_contents($errorLogFile,$error,FILE_APPEND);
    						}
    					}
    					
    					// 超过一天未同步的直接PASS
    					$pointInterval=($pointfilename-$currentFileName);
    					if ($pointInterval>86400){
    						$currentFileName+=($pointInterval-86400);
    					}
    					
    					// 保存当前指针
    					if ($currentFileName!=$timestamp){
    						file_put_contents($point, $currentFileName+1);
    					}
    				}
    			}
    		}
    }
}
