<?php
/**
 * 消费日志处理
 * eventId:6[资源使用] field1=1[金币] field2[消费数量] field3[剩余总量] field4[消费渠道] field5[消费子渠道]
 * 日志文件DEMO /data/web/webmgr/Cron/data/gamelog/gamelog_99001/1/1511877899.log
 * $Id$
 */
namespace autorun\perMinute;

class Consume
{
    public function run ()
    {
    		$db=new \Db(C('YUNYINGEND_DB'));
    		$fields="`server`,`account`,`charname`,`charid`,`module_type`,`module_sub_type`,`pricetype`,`totalprice`,`countryid`,`charlevel`,`castlelevel`,`afteramount`,`logtime`";
    		$errorLogFile=LOG_ROOT.'ConsumeLog.err'; // 错误日志文件
    		$EventLogPath=C('EVENT_LOG_PATH');	// 行为日志目录
    		
    		// 遍历所有服务器下的日志
    		$serverdirs=glob($this->eventLogPath."*");
    		
    		if ($serverdirs){
    			
    			foreach ($serverdirs as $serverdir){
    				
    				$eventdir=$serverdir."/6/";	// 资源使用
    				
    				// 处理各个事件日志
    				$filepath=$eventdir;
    				$point=$filepath.'Consume.point';
    				
    				if (!file_exists($point)){
    					// 默认从一天前开始读取
    					file_put_contents($point, strtotime('-1 day'));
    				}
    				
    				if (file_exists($point)){
    					$pointfilename=file_get_contents($point);
    					$currentFileName=$pointfilename;	// 当前文件名(保存当前实际文件 名)
    					$timestamp=$pointfilename+0;
    					$sqlValues='';
    					$nowtime=time();
    					$totalRecord=0;	// 总记录数
    					
    					// 读取至当前时间
    					for ($i=$timestamp;$i<$nowtime;$i++){
    						
    						$filename=$filepath.$pointfilename.'.log';
    						
    						if (file_exists($filename)){
    							
    							$content=addslashes(trim(file_get_contents($filename)));
    							$rows=explode("\r\n", $content);
    							
    							foreach ($rows as $row){
    								$row=explode(",", $row);
    								
    								// 只记录金币消耗
    								if ($row[10]!='1')continue;
    								
    								// 取出字段
    								$serverId=str_ireplace("gamelog_","",basename($serverdir));
    								$account=$row[3];
    								$charname=$row[2];
    								$charid=$row[1];
    								$module_type=$row[13];
    								$module_sub_type=$row[14];
    								$pricetype=1;	// 1为金币
    								$totalprice=$row[11];
    								$countryid=$row[5];
    								$charlevel=$row[7];
    								$castlelevel=$row[4];
    								$afteramount=$row[12];
    								$logtime=($row[22]?$row[22]:date('Y-m-d H:i:s'));
    								
    								$values="('{$serverId}',";
    								$values.="'{$account}',";
    								$values.="'{$charname}',";
    								$values.="'{$charid}',";
    								$values.="'{$module_type}',";
    								$values.="'{$module_sub_type}',";
    								$values.="'{$pricetype}',";
    								$values.="'{$totalprice}',";
    								$values.="'{$countryid}',";
    								$values.="'{$charlevel}',";
    								$values.="'{$castlelevel}',";
    								$values.="'{$afteramount}',";
    								$values.="'{$logtime}')";
    								
    								if ($sqlValues==''){
    									$sqlValues.=$values;
    								}else{
    									$sqlValues.=",{$values}";
    								}
    								$totalRecord+=1;
    								$currentFileName=$pointfilename;	// 当前读到了哪个文件
    							}
    						}
    						
    						// 一次插2000
    						if ($totalRecord>=2000){
    							$sql="insert into `game_goods_log` ({$fields}) values {$sqlValues}";
    							$db->insertAll($sql);
    							
    							// 记录错误日志
    							$error=$db->getError();
    							if($error){
    								$error='['.date('Y-m-d H:i:s').']'.$error."[{$sql}]\r\n";
    								file_put_contents($errorLogFile,$error,FILE_APPEND);
    							}
    							
    							// 复原
    							$totalRecord=0;
    							$sqlValues='';
    						}
    						
    						$pointfilename+=1;
    					}
    					
    					if ($sqlValues!=''){
    						$sql="insert into `game_goods_log` ({$fields}) values {$sqlValues}";
    						$db->insertAll($sql);
    						
    						// 记录错误日志
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
