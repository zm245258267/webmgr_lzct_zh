<?php
namespace backend\widgets;
use yii\base\Widget;
class SearchFormCommonField extends Widget{
	
	public function init(){
		parent::init();
	}
	
	public function run(){
		return $this->render('SearchFormCommonField');
	}
}

