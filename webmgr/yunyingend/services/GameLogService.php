<?php
namespace backend\services;

use backend\models\GameLog;
use common\utils\CommonFun;

class GameLogService extends GameLog{

	public function formatData($data){
		if (!$data) return null;
		foreach ($data as &$row){
			$func="format_log_data_{$row->eventId}";
			$row=$this->$func($row);
		}
		return $data;
	}
	
	/**
	 * 资源获取日志
	 * @param object $data
	 */
	public function format_log_data_5($data){
		$data->field1=CommonFun::CurrencyIdToName($data->field1)."[{$data->field1}]";
		return $data;
	}
	
	/**
	 * 资源使用日志
	 * @param object $data
	 */
	public function format_log_data_6($data){
		$data->field1=CommonFun::CurrencyIdToName($data->field1)."[{$data->field1}]";
		return $data;
	}
	
	/**
	 * 任务日志
	 * @param object $data
	 */
	public function format_log_data_8($data){
		$data->field1=CommonFun::TaskIdToName($data->field1)."[{$data->field1}]";
		return $data;
	}
	
	/**
	 * 道具日志
	 * @param object $data
	 */
	public function format_log_data_9($data){
		$data->field1=CommonFun::GoodsIdToName($data->field1)."[{$data->field1}]";
		return $data;
	}
	
	public function __call($name,$data){
		if (stripos($name, 'format_log_data_')!==false){
			return array_shift($data);
		}
	}
}
