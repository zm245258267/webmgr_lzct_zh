<?php
namespace common\utils;
use yii\base\Object;
use Yii;
use backend\models\GameEventMap;
class CommonFun extends Object{
    /*
    * 二维数组按照指定的键值进行排序
    */
   public  static function arraySort($arr,$keys,$type='asc'){ 
       $keysvalue = $new_array = array();
       foreach ($arr as $k=>$v){
               $keysvalue[$k] = $v[$keys];
       }
       if(strtolower($type) == 'asc'){
               asort($keysvalue);
       }else{
               arsort($keysvalue);
       }
       reset($keysvalue);
       foreach ($keysvalue as $k=>$v){
               $new_array[$k] = $arr[$k];
       }
       return $new_array; 
   }    
   
   
   //单位转换
   public  static function sizecount($filesize) {
        if ($filesize >= 1073741824) {
            $filesize = round($filesize / 1073741824 * 100) / 100 . ' GB';
        } elseif ($filesize >= 1048576) {
            $filesize = round($filesize / 1048576 * 100) / 100 . ' MB';
        } elseif ($filesize >= 1024) {
            $filesize = round($filesize / 1024 * 100) / 100 . ' KB';
        } else {
            $filesize = $filesize . ' Bytes';
        }
        return $filesize;
    }
    
    /**
     * 获取客户端IP
     * @return string 返回ip地址,如127.0.0.1
     */
    public static function getClientIp()
    {
        $onlineip = 'Unknown';
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $ips = explode(",", $_SERVER['HTTP_X_FORWARDED_FOR']);
            $real_ip = $ips['0'];
            if ($_SERVER['HTTP_X_FORWARDED_FOR'] && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $real_ip))
            {
                $onlineip = $real_ip;
            }
            elseif ($_SERVER['HTTP_CLIENT_IP'] && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP']))
            {
                $onlineip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
        if ($onlineip == 'Unknown' && isset($_SERVER['HTTP_CDN_SRC_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CDN_SRC_IP']))
        {
            $onlineip = $_SERVER['HTTP_CDN_SRC_IP'];
            $c_agentip = 0;
        }
        if ($onlineip == 'Unknown' && isset($_SERVER['HTTP_NS_IP']) && preg_match ( '/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER ['HTTP_NS_IP'] ))
        {
            $onlineip = $_SERVER ['HTTP_NS_IP'];
            $c_agentip = 0;
        }
        if ($onlineip == 'Unknown' && isset($_SERVER['REMOTE_ADDR']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['REMOTE_ADDR']))
        {
            $onlineip = $_SERVER['REMOTE_ADDR'];
            $c_agentip = 0;
        }
        return $onlineip;
    }
    
    /**
     * 读取文本末尾n行
     * @param string $fp
     * @param int $n
     * @param number $base
     * @return multitype:
     */
    public static function tail($fileName, $n, $base = 5) {
        $fp = fopen($fileName, "r+");
        $pos = $n + 1;
        $lines = array ();
        while ( count ( $lines ) <= $n ) {
            try {
                fseek ( $fp, - $pos, SEEK_END );
            } catch ( Exception $e ) {
                fseek ( 0 );
                break;
            }
            $pos *= $base;
            while ( ! feof ( $fp ) ) {
                array_unshift ( $lines, fgets ( $fp ) );
            }
        }
        //echo implode ( "", array_reverse ( $lines ) );
        return array_reverse ( array_slice ( $lines, 0, $n ) );
    }
   
    
    public static function sortClass($orderby, $key){
        $data = explode(' ', $orderby);
        $sortClass = 'class="sorting"';
        if(count($data) > 0){
            if(empty($data[0]) == false && $data[0] == $key){
                if(empty($data[1]) == false && $data[1] == 'desc'){
                    $sortClass = 'class="sorting_desc"';
                    
                }
                else{
                    $sortClass = 'class="sorting_asc"';
                }
            }
        }
        return $sortClass;
    }
    
    public static function is_mobile($number){
    	$pattern="/^((13[0-9])|(14[5-9])|(15([0-3]|[5-9]))|(166)|(17[0-8])|(18[0-9])|(19[8-9]))\\d{8}$/";
    	return preg_match($pattern, $number);
    }
    
    /**
     * 远程获取数据，POST模式
     *
     * 注意：
     * 1.使用crul需要修改服务器中php.ini文件的设置，找到php_curl.dll去掉前面的";"就行了
     * 2.文件夹中cacert.pem是SSL证书请保证其路径有效，目前默认路径是：getcwd().'\\cacert.pem'
     *
     * @param $url 指定URL完整路径地址
     * @param $cacert_url 证书地址
     * @param $params 请求的数据
     *        	return 远程输出的数据
     */
    public static function http_post($url,$params,&$err=''){
    	$curl=curl_init($url);
    	curl_setopt($curl,CURLOPT_HEADER,0); // 过滤HTTP头
    	curl_setopt($curl,CURLOPT_RETURNTRANSFER,1); // 返回输出结果
    	curl_setopt($curl,CURLOPT_POST,TRUE); // post传输数据
    	curl_setopt($curl,CURLOPT_POSTFIELDS,$params); // post传输数据
    
    	$responseText=curl_exec($curl);
    	$errno=curl_errno($curl);
    	$errmsg=curl_error($curl);
    	$err = curl_error($curl);
    
    	curl_close($curl);
    
    	return $responseText;
    }
    
    /**
     * @param $url 指定URL完整路径地址
     * @param $err 错误信息
     *        	return 远程输出的数据
     */
    public static function http_get($url,&$err=''){
    	$curl=curl_init($url);
    	curl_setopt($curl,CURLOPT_HEADER,0); // 过滤HTTP头
    	curl_setopt($curl,CURLOPT_RETURNTRANSFER,1); // 返回输出结果
    
    	$responseText=curl_exec($curl);
    
    	$err = curl_error($curl);
    
    	curl_close($curl);
    
    	return $responseText;
    }
    
    /**
     * 格式化时间范围
     * @param string $date_range
     * @param date $start
     * @param date $end
     */
    public static function parse_date_range($date_range,&$start,&$end){
    	if ($date_range){
    		$date_range=explode("/", $date_range);
    		$start=trim($date_range[0]);
    		$end=trim($date_range[1]);
    	}
    	return;
    }
    
    /**
     * 货币ID转货币名
     * @param int $id
     * @return string
     */
    public static function CurrencyIdToName($id){
    	$game_currency_config=\Yii::$app->params['GAME_CURRENCY_CONFIG'];
    	if ($game_currency_config[$id]){
    		return $game_currency_config[$id];
    	}
    	return $id;
    }
    
    /**
     * 物品ID转物品名
     * @param int $id
     * @return string
     */
    public static function GoodsIdToName($id){
    	$game_goods_config=\Yii::$app->params['GAME_GOODS_CONFIG'];
    	if ($game_goods_config[$id]){
    		return $game_goods_config[$id];
    	}
    	return $id;
    }
    
    /**
     * 任务ID转任务名
     * @param int $id
     * @return string
     */
    public static function TaskIdToName($id){
    	$game_task_config=\Yii::$app->params['GAME_TASK_CONFIG'];
    	if ($game_task_config[$id]){
    		return $game_task_config[$id];
    	}
    	return $id;
    }
    
    /**
     * 任务ID转任务名
     * @param int $id
     * @return string
     */
    public static function TaskGroupIdToName($id){
    	$game_task_config=\Yii::$app->params['GAME_TASK_GROUP_CONFIG'];
    	if ($game_task_config[$id]['name']){
    		return $game_task_config[$id]['name'];
    	}
    	return $id;
    }
    
    /**
     * 行为ID转行为名
     * @param int $id
     * @return string
     */
    public static function EventIdToName($id){
    	static $events;
    	if (!$events){
    		$GameEventMap=GameEventMap::find();
    		$events=$GameEventMap->indexBy("event_id")->asArray()->all();
    	}
    	if ($events[$id]['event_name']){
    		return $events[$id]['event_name'];
    	}
    	return $id;
    }
    
    /**
     * 模块ID转模块名
     * @param int $id
     * @return string
     */
    public static function ModuleIdToName($id){
    	$game_module_type_config=\Yii::$app->params['GAME_MODULE_TYPE_CONFIG'];
    	if ($game_module_type_config[$id]){
    		return $game_module_type_config[$id];
    	}
    	return $id;
    }
    
    /**
     * 子模块ID转子模块名
     * @param int $id
     * @return string
     */
    public static function SubModuleIdToName($id){
    	$game_module_sub_type_config=\Yii::$app->params['GAME_MODULE_SUB_TYPE_CONFIG'];
    	if ($game_module_sub_type_config[$id]){
    		return $game_module_sub_type_config[$id];
    	}
    	return $id;
    }
    
    /**
     * 数组转对象
     * @param array $array
     * @return \stdClass[]
     */
    public static function ArrayToObject($array){
    	$result=[];
    	if (is_array($array)){
    		foreach ($array as $key=>$row){
    			$obj=new \stdClass();
    			foreach ($row as $k=>$v){
    				$obj->$k=$v;
    			}
    			$result[$key]=$obj;
    		}
    	}
    	return $result;
    }
    
    /**
     * 对象转数组
     * @param array $array
     * @return \stdClass[]
     */
    public static function ObjectToArray($Object){
    	$result=[];
    	if (is_array($Object))return $Object;
    	if (is_object($Object)){
    		foreach ($Object as $key=>$val){
    			$result[$key]=$val;
    		}
    	}
    	return $result;
    }
}
