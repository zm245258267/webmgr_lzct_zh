<?php
/**
 * 任务日志	8
 * $Id$
 */
namespace autorun\perMinute;

class Guide
{
    public function run ()
    {
    		$db=new \Db(C('GAME_DB'));
    		$fields="`charid`,`spid`,`sbid`,`userid`,`account`,`charname`,`serverid`,`charlevel`,`gold`,`guildid`,`guildstatus`,`charstate`,`createtime`,`updatetime`,`loginip`,`viplv`,`vipexp`,`castlelevel`,`countryid`,`firstrechargetime`,`firstrechargelevel`,`totalrecharge`";
    		$errorLogFile=LOG_ROOT.'GuideLog.err'; // 错误日志文件
    		$EventLogPath=C('EVENT_LOG_PATH');	// 行为日志目录
    		
    		$updates='';
    		$updates.="`guildid`=values(`guildid`),";
    		$updates.="`guildstatus`=values(`guildstatus`)";
    		
    		// 遍历所有服务器下的日志
    		$serverdirs=glob($EventLogPath."*");
    		
    		if ($serverdirs){
    			
    			foreach ($serverdirs as $serverdir){
    				if (!is_dir($serverdir))continue;
    				
    				$eventdir=$serverdir."/8/";
    				if (!is_dir($eventdir))continue;
    				
    				// 处理各个事件日志
    				$filepath=$eventdir;
    				$point=$filepath.'Guide.point';
    				
    				if (!file_exists($point)){
    				    // 默认从一天前开始读取
    				    @file_put_contents($point, strtotime('-1 day'),LOCK_EX);
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
    				                
    				                // 取出字段
    				                $serverId=str_ireplace("gamelog_","",basename($serverdir));
    				                $charid=$row[1];
    				                $spid=$row[20];
    				                $sbid=$row[21];
    				                $userid=0;
    				                $account=$row[3];
    				                $charname=$row[2];
    				                $charlevel=$row[7];
    				                $gold=0;
    				                $guildid=$row[10];
    				                $guildstatus=$row[11];
    				                $charstate=0;
    				                $createtime=($row[22]?$row[22]:date('Y-m-d H:i:s'));
    				                $updatetime=($row[22]?$row[22]:date('Y-m-d H:i:s'));
    				                $loginip='';
    				                $viplv=$row[6]+0;
    				                $vipexp=0;
    				                $castlelevel=$row[4]+0;
    				                $countryid=$row[5]+0;
    				                $firstrechargetime=0;
    				                $firstrechargelevel=0;
    				                $totalrecharge=0;
    				                
    				                $values="('{$charid}',";
    				                $values.="'{$spid}',";
    				                $values.="'{$sbid}',";
    				                $values.="'{$userid}',";
    				                $values.="'{$account}',";
    				                $values.="'{$charname}',";
    				                $values.="'{$serverId}',";
    				                $values.="'{$charlevel}',";
    				                $values.="'{$gold}',";
    				                $values.="'{$guildid}',";
    				                $values.="'{$guildstatus}',";
    				                $values.="'{$charstate}',";
    				                $values.="'{$createtime}',";
    				                $values.="'{$updatetime}',";
    				                $values.="'{$loginip}',";
    				                $values.="'{$viplv}',";
    				                $values.="'{$vipexp}',";
    				                $values.="'{$castlelevel}',";
    				                $values.="'{$countryid}',";
    				                $values.="'{$firstrechargetime}',";
    				                $values.="'{$firstrechargelevel}',";
    				                $values.="'{$totalrecharge}')";
    				                
    				                if ($sqlValues==''){
    				                    $sqlValues.=$values;
    				                }else{
    				                    $sqlValues.=",{$values}";
    				                }
    				                $totalRecord+=1;
    				            }
    				            $currentFileName=$pointfilename;	// 当前读到了哪个文件
    				        }
    				        
    				        // 一次插2000
    				        if ($totalRecord>=2000){
    				            $sql="insert into `game_chardesc` ({$fields}) values {$sqlValues}";
    				            $sql.=" on duplicate key update {$updates}";
    				            
    				            $db->insertAll($sql);
    				            
    				            // 记录错误日志
    				            $error=$db->getError();
    				            if($error){
    				                $error='['.date('Y-m-d H:i:s').']'.$error."[{$sql}]\r\n";
    				                @file_put_contents($errorLogFile,$error,LOCK_EX|FILE_APPEND);
    				            }
    				            
    				            // 复原
    				            $totalRecord=0;
    				            $sqlValues='';
    				        }
    				        
    				        $pointfilename+=1;
    				    }
    				    
    				    if ($sqlValues!=''){
    				        $sql="insert into `game_chardesc` ({$fields}) values {$sqlValues}";
    				        $sql.=" on duplicate key update {$updates}";
    				        $db->insertAll($sql);
    				        
    				        // 记录错误日志
    				        $error=$db->getError();
    				        if($error){
    				            $error='['.date('Y-m-d H:i:s').']'.$error."[{$sql}]\r\n";
    				            @file_put_contents($errorLogFile,$error,LOCK_EX|FILE_APPEND);
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
