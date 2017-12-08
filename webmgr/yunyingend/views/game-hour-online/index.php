
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;

use backend\models\GameHourOnline;
use backend\widgets\SearchFormCommonField;

$modelLabel = new \backend\models\GameHourOnline();
?>

<?php $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
      
        <div class="box-header">
          <h3 class="box-title">数据列表</h3>
        </div>
        <!-- /.box-header -->
        
        <div class="box-body">
          <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <!-- row start search-->
          	<div class="row">
          	<div class="col-sm-12">
                <?php ActiveForm::begin(['id' => 'game-hour-online-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('game-hour-online/index')]); ?>     
                
                <?=SearchFormCommonField::widget()?>
                  <div class="form-group" style="margin: 5px;">
                      <label>渠道ID:</label>
                      <input type="text" class="form-control" id="query[spid]" name="query[spid]"  value="<?=isset($query["spid"]) ? $query["spid"] : "" ?>">
                  </div>

                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('logdate')?>:</label>
                      <input type="text" class="form-control date" id="query[logdate]" name="query[logdate]"  value="<?=isset($query["logdate"]) ? $query["logdate"] : "" ?>">
                  </div>
              <div class="form-group">
              	<a onclick="searchAction()" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>搜索</a>
           	  </div>
               <?php ActiveForm::end(); ?> 
            </div>
          	</div>
          	<!-- row end search -->
          	
          	<div class="row">
          		<div class="col-sm-12">
          			<div id="chat-line">没有数据!</div>
          		</div>
          	</div>
          
        </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->

<?php $this->beginBlock('footer');  ?>
<!-- <body></body>后代码块 -->
 <script>
 function searchAction(){
		$('#game-hour-online-search-form').submit();
	}
 	<?php if (!empty($dataSet['lineData'])):?>
	show_simple_line_chart("#chat-line",<?=json_encode($dataSet['lineData'])?>,'历史在线','人数'); 
	<?php endif;?>
</script>
<?php $this->endBlock(); ?>