<?php
namespace backend\widgets;

use yii\helpers\Html;

use yii\base\Widget;

use Yii;

class SearchFormCommonField extends Widget{
	
	public function init(){
		parent::init();
	}
	
	public function run(){
		return $this->render('SearchFormCommonField');
	}
}

