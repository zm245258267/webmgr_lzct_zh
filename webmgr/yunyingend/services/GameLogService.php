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
		$data->field1=CommonFun::CurrencyIdToName($data->field1)."[{$data->field1}]";	// 资源类型
		$data->field4=CommonFun::ModuleIdToName($data->field4)."[{$data->field4}]";	// 模块
		$data->field5=CommonFun::SubModuleIdToName($data->field5)."[{$data->field5}]";	// 子模块
		return $data;
	}
	
	/**
	 * 资源使用日志
	 * @param object $data
	 */
	public function format_log_data_6($data){
		$data->field1=CommonFun::CurrencyIdToName($data->field1)."[{$data->field1}]";
		$data->field4=CommonFun::ModuleIdToName($data->field4)."[{$data->field4}]";	// 模块
		$data->field5=CommonFun::SubModuleIdToName($data->field5)."[{$data->field5}]";	// 子模块
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
		$data->field4=CommonFun::ModuleIdToName($data->field4)."[{$data->field4}]";	// 模块
		$data->field5=CommonFun::SubModuleIdToName($data->field5)."[{$data->field5}]";	// 子模块
		return $data;
	}
	
	/**
	 * 获取兵
	 * @param object $data
	 */
	public function format_log_data_10($data){
		$data->field3=CommonFun::ModuleIdToName($data->field3)."[{$data->field3}]";	// 模块
		return $data;
	}
	
	/**
	 * 道具消耗日志
	 * @param object $data
	 */
	public function format_log_data_19($data){
		$data->field4=CommonFun::ModuleIdToName($data->field4)."[{$data->field4}]";	// 模块
		$data->field5=CommonFun::SubModuleIdToName($data->field5)."[{$data->field5}]";	// 子模块
		return $data;
	}
	
	/**
	 * 英雄召唤
	 * @param object $data
	 */
	public function format_log_data_20($data){
		$data->field2=CommonFun::ModuleIdToName($data->field2)."[{$data->field2}]";	// 模块
		$data->field3=CommonFun::SubModuleIdToName($data->field3)."[{$data->field3}]";	// 子模块
		return $data;
	}
	
	public function __call($name,$data){
		if (stripos($name, 'format_log_data_')!==false){
			return array_shift($data);
		}
	}
}
