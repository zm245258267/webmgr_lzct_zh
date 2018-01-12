<?php
/**
 * 打点日志处理脚本
 * 数据目录 /data/web/user-report-log/{Y-m-d}/{timestamp}.log
 * 每天等待10分钟同步时间进入下一天
 * $Id$
 */
namespace UserReport\perMinute;

class UserReport
{
    public $db=new \Db(C('YUNYINGEND_DB')); // 数据库操作
    public $errorLogFile=LOG_ROOT.'UserReport.err'; // 错误日志文件
    public $userReportLogPath=C('USER_REPORT_LOG_PATH');	// 日志目录
    public $userReportLogFetchWaitSecond=C('USER_REPORT_LOG_FETCH_WAIT_SECOND');
    public $pointerFile='UserReport.point';
    
    public function run ()
    {
        $date=$this->currentDate();
        
        $dir=$this->userReportLogPath.$date.'/';
        
        if (is_dir($dir)){
            $pointer=$this->getPointer($dir);
            
            
        }
        
    		// 遍历所有服务器下的日志
    		$serverdirs=glob($this->userReportLogPath."*");
    		
    		if ($serverdirs){
    			
    			foreach ($serverdirs as $serverdir){
    				if (!is_dir($serverdir))continue;
    				
    				$eventdir=$serverdir."/6/";	// 资源使用
    				
    				// 处理各个事件日志
    				$filepath=$eventdir;
    				$point=$filepath.'Consume.point';
    				
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
    								$goodsId=$row[15]+0;
    								$goodsNum=$row[16]+0;
    								$spid=$row[20];
    								$sbid=$row[21];
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
    								$values.="'{$goodsId}',";
    								$values.="'{$goodsNum}',";
    								$values.="'{$spid}',";
    								$values.="'{$sbid}',";
    								$values.="'{$logtime}')";
    								
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
    							$sql="insert into `game_goods_log` ({$fields}) values {$sqlValues}";
    							$db->insertAll($sql);
    							
    							// 记录错误日志
    							$error=$db->getError();
    							if($error){
    								$error='['.date('Y-m-d H:i:s').']'.$error."[{$sql}]\r\n";
    								@file_put_contents($errorLogFile,$error,FILE_APPEND|LOCK_EX);
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
    
    /**
     * 获取当前扫描日期
     * @return string
     */
    public function currentDate(){
        $interval=(time()-strtotime(date('Y-m-d')));
        if ($interval<$this->userReportLogFetchWaitSecond){
            return date('Y-m-d',strtotime('-1 day'));
        }else{
            return date('Y-m-d');
        }
    }
    
    /**
     * 获取当前指针
     * @return string
     */
    public function getPointer(){
        $filename=$dir.$this->pointerFile;
        if (file_exists($filename)){
            return file_get_contents($filename);
        }else{
            file_put_contents($filename, )
        }
    }
    
    public function closePointer(){
        
    }
    
    public function updatePointer(){
        
    }
}
