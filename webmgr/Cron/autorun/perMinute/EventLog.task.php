<?php
/**
 * $Id$
 */
namespace autorun\perMinute;

class EventLog
{
	public $eventLogPath='/data/web/webmgr/Cron/data/gamelog/';
	public $logPath='/data/web/webmgr/Cron/logs/';

    public function run ()
    {
    		$db=new \Db(C('LOG_DB'));
    		// /data/web/webmgr/Cron/data/gamelog/gamelog_99001/1/1511877899.log

    		// 遍历所有服务器下的日志
    		$serverdirs=glob($this->eventLogPath."*");
    		if ($serverdirs){
    			foreach ($serverdirs as $serverdir){
    				$eventdirs=glob($serverdir."/*");
    				if ($eventdirs){
    					foreach ($eventdirs as $eventdir){
    						// 处理各个事件日志
    						$filepath=$eventdir."/";
    						$point=$filepath.'EventLog.point';
    						$pointfilename="*";
    						
    						// 第一次取第一个
    						if (!file_exists($point)){
    							$files=glob($filepath.$pointfilename);
    							$tmpfilename=array_shift($files);
    							$timestamp=basename($tmpfilename,'.log');
    							if ($timestamp){
    								file_put_contents($point, $timestamp);
    							}
    						}
    						
    						// 读文件 
    						if (file_exists($point)){
    							$pointfilename=file_get_contents($point);
    							$currentFileName=$pointfilename;	// 当前文件名(保存当前实际文件 名)
    							$timestamp=$pointfilename+0;
    							$date=date('Ymd',$timestamp);
    							$is_cross=false;
    							$sql='';
    							$nowtime=time();
    							// 长度限制
    							$n=0;
    							// 读取文件
    							for ($i=$timestamp;$i<$nowtime;$i++){
    								$curdate=date('Ymd',$pointfilename);
    								if ($curdate!=$date){	// 跨天了
    									$is_cross=true;
    									break;
    								}
    								
    								$filename=$filepath.$pointfilename.'.log';
    								if (file_exists($filename)){
    									// 限制长度
    									if ($n>999){
    										break;
    									}
    									$content=addslashes(trim(file_get_contents($filename)));
    									$content="'".str_replace(",", "','", $content)."'";
    									$content="(".str_replace("\r\n", "'),('", $content).")";
    									if($sql==''){
    										$sql=$content;
    									}else{
    										$sql.=(','.$content);
    									}
    									$currentFileName=$pointfilename;
    									$n++;
    								}
    								$pointfilename+=1;
    							}
    							
    							// 入库
    							$fields="`eventId`,`playerId`,`playerName`,`playerAccount`,`castleLevel`,`countryId`,`viplv`,`charlevel`,`targetId`,`targetName`,`field1`,`field2`,`field3`,`field4`,`field5`,`field6`,`field7`,`field8`,`field9`,`field10`,`spid`,`sbid`,`time`";
    							if ($sql!=''){
    								$tablename=basename($serverdir).'_'.$date;
    								$sql="insert into {$tablename} ({$fields}) values {$sql}";
    								$db->insertAll($sql);
									$error=$db->getError();
									if($error){
										$error='['.date('Y-m-d H:i:s').']'.$error."\r\n";
										file_put_contents($this->logPath.'EventLog.err',$error,FILE_APPEND);
										break;
									}
    								$sql='';	// 复原
    							}
    							
    							// 跨天追加处理
    							// 长度限制
    							$n=0;
    							if ($is_cross){
    								// 读取文件
    								$date=date('Ymd',$pointfilename);
    								for ($i=$pointfilename;$i<$nowtime;$i++){
    									$filename=$filepath.$pointfilename.'.log';
    									$curdate=date('Ymd',$pointfilename);
    									if ($curdate!=$date){
    										break;
    									}
    									if (file_exists($filename)){
    										// 限制长度
    										if ($n>999){
    											break;
    										}
    										
    										$content=addslashes(trim(file_get_contents($filename)));
    										$content="'".str_replace(",", "','", $content)."'";
    										$content="(".str_replace("\r\n", "'),('", $content).")";
    										if($sql==''){
    											$sql=$content;
    										}else{
    											$sql.=(','.$content);
    										}
    										$currentFileName=$pointfilename;
    										$n++;
    									}
    									$pointfilename+=1;
    								}
    									
    								if ($sql!=''){
    									$tablename=basename($serverdir).'_'.$date;
    									$sql="insert into {$tablename} ({$fields}) values {$sql}";
    									$db->insertAll($sql);
										
										$error=$db->getError();
										if($error){
											$error='['.date('Y-m-d H:i:s').']'.$error."\r\n";
											file_put_contents($this->logPath.'EventLog.err',$error,FILE_APPEND);
											break;
										}
    								}
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
    }
   
}
