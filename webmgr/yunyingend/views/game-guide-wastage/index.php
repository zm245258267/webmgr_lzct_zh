
<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

use backend\models\GameChardesc;
use backend\widgets\SearchFormCommonField;
$modelLabel = new \backend\models\GameChardesc();
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
                <?php ActiveForm::begin(['id' => 'game-guide-wastage-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('game-guide-wastage/index')]); ?>     

                  <?=SearchFormCommonField::widget()?>
              <div class="form-group">
              	<a onclick="searchAction()" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>搜索</a>
           	  </div>
               <?php ActiveForm::end(); ?> 
            </div>
          	</div>
          	<!-- row end search -->
          	
          <!-- row start -->
          <!-- 
          <div class="row">
          	<div class="col-sm-12"><div id="chat-bar">没有数据！</div></div>
		  </div>
		   -->
		  <!-- row end -->
		  
		  <!-- row start -->
		  <!-- 
          <div class="row">
          	<div class="col-sm-12"><div id="chat-pie">没有数据！</div></div>
		  </div>
		   -->
		  <!-- row end -->
		  
		  <div class="table-responsive">
		  	<table class="table table-bordered">
		  		<caption>任务流失</caption>
		  		<thead>
		  			<tr>
		  				<th>任务名</th>
		  				<th>未完成人数</th>
		  				<th title="当前任务人数（包括前置任务）/总任务人数*100">流失率</th>
		  			</tr>
		  		</thead>
		  		<tbody>
		  			<?php foreach ($dataSet['tableData'] as $key=>$row):?>
		  			<tr>
		  				<td title="<?=$key?>"><?=$row['name']?></td>
		  				<td><?=$row['totalPersons']?></td>
		  				<td><?=$row['percent']?>%</td>
		  			</tr>
		  			<?php endforeach;?>
		  		</tbody>
		  	</table>
		  	
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
		$('#game-guide-wastage-search-form').submit();
	}

	<?php if (!empty($dataSet['barData'])):?>
	show_simple_bar_chart("#chat-bar",<?=json_encode($dataSet['barData'])?>,'任务流失','当前人数');
	show_simple_pie_chart("#chat-pie",<?=json_encode($dataSet['pieData'])?>,'任务流失','当前人数');
	<?php endif;?>
</script>
<?php $this->endBlock(); ?>