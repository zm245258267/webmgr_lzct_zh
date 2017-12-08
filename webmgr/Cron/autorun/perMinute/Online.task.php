<?php
/**
 * 在线日志处理
 * $Id$
 */
namespace autorun\perMinute;

class Online
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
    				$eventdir=$serverdir."/1/";	// 在线日志
    				
    				// 处理各个事件日志
    				$filepath=$eventdir;
    				$point=$filepath.'Online.point';
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
    					// 读取60个
    					$vals='';
    					$nowtime=time();
    					$n=0;
    					for ($i=$timestamp;$i<$nowtime;$i++){
    						$filename=$filepath.$pointfilename.'.log';
    						if (file_exists($filename)){
    							// 限制长度
    							if ($n>999){
    								break;
    							}
    							$content=addslashes(trim(file_get_contents($filename)));
    							$rows=explode("\r\n", $content);
    							foreach ($rows as $row){
    								$n++;
    								$row=explode(",", $row);
    								$serverId=str_ireplace("gamelog_","",basename($serverdir));
    								$online=$row[10];
    								$viponline=$row[11];
    								$spid=$row[20];
    								$sbid=$row[21];
    								$logdate=$row[22];
    								if ($vals){
    									$vals.=",('{$serverId}','{$online}','{$viponline}','{$spid}','{$sbid}','{$logdate}')";
    								}else{
    									$vals.="('{$serverId}','{$online}','{$viponline}','{$spid}','{$sbid}','{$logdate}')";
    								}
    								
    								// 历史在线
    								$hour=date('G',strtotime($logdate));
    								$valsHistory="('{$serverId}','{$online}','{$viponline}','{$spid}','{$sbid}','{$logdate}')";
    								$sql="insert into `game_hour_online` (`server`,`h{$hour}`,`s{$hour}`,`spid`,`sbid`,`logdate`) values {$valsHistory} ";
    								$sql.="on duplicate key update `h{$hour}`=values(`h{$hour}`),`s{$hour}`=values(`s{$hour}`)";
    								$db->insertAll($sql);
    								$error=$db->getError();
    								if($error){
    									$error='['.date('Y-m-d H:i:s').']'.$error."[{$sql}]\r\n";
    									file_put_contents($this->logPath.'OnlineLog.err',$error,FILE_APPEND);
    								}else{	// 执行成功后保存新的指针文件
    									$currentFileName=$pointfilename;
    								}
    								
    							}
    						}
    						$pointfilename+=1;
    					}
    					// 入库(实时在线)
    					if ($vals){
    						$sql="insert into `game_real_online` (`server`,`online`,`viponine`,`spid`,`sbid`,`uptime`)  values {$vals} ";
    						$sql.="on duplicate key update `online`=values(online),`viponine`=values(viponine)";
    						$db->insertAll($sql);
    						$error=$db->getError();
    						if($error){
    							$error='['.date('Y-m-d H:i:s').']'.$error."[{$sql}]\r\n";
    							file_put_contents($this->logPath.'OnlineLog.err',$error,FILE_APPEND);
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
