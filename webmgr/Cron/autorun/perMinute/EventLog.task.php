<?php
/**
 * $Id$
 * 行为日志处理
 * /data/web/webmgr/Cron/data/gamelog/gamelog_99001/1/1511877899.log
 */
namespace autorun\perMinute;

class EventLog
{
    public function run ()
    {
    		$db=new \Db(C('LOG_DB'));
    		$fields="`eventId`,`playerId`,`playerName`,`playerAccount`,`castleLevel`,`countryId`,`viplv`,`charlevel`,`targetId`,`targetName`,`field1`,`field2`,`field3`,`field4`,`field5`,`field6`,`field7`,`field8`,`field9`,`field10`,`spid`,`sbid`,`time`";
    		$errorLogFile=LOG_ROOT.'EventLog.err'; // 错误日志文件
    		$EventLogPath=C('EVENT_LOG_PATH');	// 行为日志目录

    		// 遍历所有服务器下的日志
    		$serverdirs=glob($EventLogPath."*");
    		
    		if ($serverdirs){
    			foreach ($serverdirs as $serverdir){
    				
    				if (!is_dir($serverdir))continue;
    				
    				$eventdirs=glob($serverdir."/*");
    				
    				if ($eventdirs){
    					foreach ($eventdirs as $eventdir){
    						
    						$eventId=basename($eventdir);
    						
    						if (!is_dir($eventdir))continue;
    						if (in_array($eventId, [1,38]))continue;// 在线日志等不用记录
    						
    						// 处理各个事件日志
    						$filepath=$eventdir."/";
    						$point=$filepath.'EventLog.point';
    						
    						if (!file_exists($point)){
    							// 默认从一天前开始读取
    							@file_put_contents($point, strtotime('-1 day'),LOCK_EX);
    						}
    						
    						// 读文件 
    						if (file_exists($point)){
    							
    							$pointfilename=file_get_contents($point);
    							$currentFileName=$pointfilename;	// 当前文件名(保存当前实际文件 名)
    							$timestamp=$pointfilename+0;
    							$date=date('Ymd',$timestamp);
    							$sqlValues='';
    							$nowtime=time();
    							$n=0;// 长度限制
    							
    							// 读取文件
    							for ($i=$timestamp;$i<$nowtime;$i++){
    								
    								$filename=$filepath.$pointfilename.'.log';
    								
    								if (file_exists($filename)){
    									
    									$curdate=date('Ymd',$pointfilename);
    									
    									// 跨天了
    									if ($curdate!=$date){
    										
    										if ($sqlValues){
    											$tablename=basename($serverdir).'_'.$date;
    											$sql="insert into {$tablename} ({$fields}) values {$sqlValues}";
    											$db->insertAll($sql);
    											$error=$db->getError();
    											if($error){
    												$error='['.date('Y-m-d H:i:s').']'.$error."\r\n";
    												@file_put_contents($errorLogFile,$error,FILE_APPEND|LOCK_EX);
    											}
    										}
    										
    										// 复原
    										$sqlValues='';
    										$n=0;
    										
    										$date=$curdate;
    									}
    									
    									$content=addslashes(trim(file_get_contents($filename)));
    									$rows=explode("\r\n", $content);
    									
    									foreach ($rows as $row){
    										if ($sqlValues==''){
    											$sqlValues="('".str_replace(",", "','", $row)."')";
    										}else{
    											$sqlValues.=",('".str_replace(",", "','", $row)."')";
    										}
    										$n++;
    									}
    									
    									// 分批次
    									if ($n>=1000){
    										$tablename=basename($serverdir).'_'.$date;
    										$sql="insert into {$tablename} ({$fields}) values {$sqlValues}";
    										$db->insertAll($sql);
    										$error=$db->getError();
    										if($error){
    											$error='['.date('Y-m-d H:i:s').']'.$error."\r\n";
    											@file_put_contents($errorLogFile,$error,FILE_APPEND|LOCK_EX);
    										}
    										
    										// 复原
    										$sqlValues='';
    										$n=0;
    									}
    									
    									$currentFileName=$pointfilename;
    								}
    								
    								$pointfilename+=1;
    							}
    							
    							// 没跨天且条数没超过一千
    							if ($sqlValues){
    								$tablename=basename($serverdir).'_'.$date;
    								$sql="insert into {$tablename} ({$fields}) values {$sqlValues}";
    								$db->insertAll($sql);
    								$error=$db->getError();
    								if($error){
    									$error='['.date('Y-m-d H:i:s').']'.$error."\r\n";
    									@file_put_contents($errorLogFile,$error,FILE_APPEND|LOCK_EX);
    								}
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
    }
}
