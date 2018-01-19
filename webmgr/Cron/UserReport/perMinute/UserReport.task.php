<?php
/**
 * 打点日志处理
 * 目录 /data/web/gamelog/gamelog_{serverid}/user-report-log/{timestamp}.log
 * $Id$
 */
namespace UserReport\perMinute;

class UserReport
{
    public function run ()
    {
        $db=new \Db(C('YUNYINGEND_DB'));
        $fields="`id`,`state`,`value`,`firststate`,`firstvalue`,`serverid`,`userid`,`devname`,`sysname`,`sysver`,`cver`,`spid`,`sbid`,`createdate`,`logdate`,`firstlogdate`,`dups`,`stage`,`extrainfo`";
        $errorLogFile=LOG_ROOT.'UserReportLog.err'; // 错误日志文件
        $EventLogPath=C('EVENT_LOG_PATH');	// 行为日志目录
        
        $updates="`state`=values(`state`),";
        $updates.="`value`=values(`value`),";
        $updates.="`serverid`=values(`serverid`),";
        $updates.="`userid`=values(`userid`),";
        $updates.="`devname`=values(`devname`),";
        $updates.="`sysname`=values(`sysname`),";
        $updates.="`sysver`=values(`sysver`),";
        $updates.="`cver`=values(`cver`),";
        $updates.="`spid`=values(`spid`),";
        $updates.="`sbid`=values(`sbid`),";
        $updates.="`logdate`=values(`logdate`),";
        $updates.="`dups`=values(`dups`),";
        $updates.="`stage`=values(`stage`),";
        $updates.="`extrainfo`=values(`extrainfo`)";
        
        // 遍历所有服务器下的日志
        $serverdirs=glob($EventLogPath."*");
        
        if ($serverdirs){
            
            foreach ($serverdirs as $serverdir){
                if (!is_dir($serverdir))continue;
                
                $eventdir=$serverdir."/user-report-log/";
                if (!is_dir($eventdir))continue;
                
                // 处理各个事件日志
                $filepath=$eventdir;
                $point=$filepath.'UserReport.point';
                
                if (!file_exists($point)){
                    // 默认从一分钟前开始读取
                    @file_put_contents($point, strtotime('-1 min')-1,LOCK_EX);
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
                                
                                $id=$row[0];
                                $state=$row[1];
                                $value=$row[2];
                                $firststate=$row[1];
                                $firstvalue=$row[2];
                                $userid=0;
                                $devname=$row[6];
                                $sysname=$row[7];
                                $sysver=$row[8];
                                $cver=$row[9];
                                $spid=$row[4];
                                $sbid=$row[5];
                                $createdate=$row[11];
                                $logdate=$row[11];
                                $firstlogdate=$row[11];
                                $dups=1;
                                $stage=$row[3];
                                $extrainfo=$row[10];
                                
                                $values="('{$id}',";
                                $values.="'{$state}',";
                                $values.="'{$value}',";
                                $values.="'{$firststate}',";
                                $values.="'{$firstvalue}',";
                                $values.="'{$serverId}',";
                                $values.="'{$userid}',";
                                $values.="'{$devname}',";
                                $values.="'{$sysname}',";
                                $values.="'{$sysver}',";
                                $values.="'{$cver}',";
                                $values.="'{$spid}',";
                                $values.="'{$sbid}',";
                                $values.="'{$createdate}',";
                                $values.="'{$logdate}',";
                                $values.="'{$firstlogdate}',";
                                $values.="'{$dups}',";
                                $values.="'{$stage}',";
                                $values.="'{$extrainfo}')";
                                
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
                            $sql="insert into `game_user_report` ({$fields}) values {$sqlValues}";
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
                        $sql="insert into `game_user_report` ({$fields}) values {$sqlValues}";
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
                    if ($pointInterval>600){
                        $currentFileName+=($pointInterval-600);
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
