
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
                <?php ActiveForm::begin(['id' => 'game-char-level-dist-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('game-char-level-dist/index')]); ?>     
                  
                  <?=SearchFormCommonField::widget()?>
                  
              <div class="form-group">
              	<a onclick="searchAction()" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>搜索</a>
           	  </div>
               <?php ActiveForm::end(); ?> 
            </div>
          	</div>
          	<!-- row end search -->
          	
          	<!-- row start -->
          	
          	<div class="row">
          		<div class="col-sm-12">
          			<div id="chat-pie">没有数据!</div>
          		</div>
          	</div>
          	
          	<div class="row">
          		<div class="col-sm-12">
          			<div id="chat-line">没有数据!</div>
          		</div>
          	</div>
          	
          	<div class="table-responsive">
              	<table class="table table-bordered table-hover">
              		<caption>领主等级流失</caption>
              		<thead>
              			<tr>
              				<th>等级</th>
              				<th>角色数</th>
              				<th>占比</th>
              			</tr>
              		</thead>
              		<tbody>
              			<?php foreach ($charData['tableData'] as $row):?>
              			<tr>
              				<td><?=$row[0]?></td>
              				<td><?=$row[1]?></td>
              				<td><?=round($row[1]/$charData['totalNums'],4)*100?>%</td>
              			</tr>
              			<?php endforeach;?>
              		</tbody>
              	</table>
          	</div>
          	
          	<!-- row end -->
          	
        </div>
        
          <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
          	<!-- row start -->
          	<div class="row">
          		<div class="col-sm-12">
          			<div id="castle-chat-pie">没有数据!</div>
          		</div>
          	</div>
          	
          	<div class="row">
          		<div class="col-sm-12">
          			<div id="castle-chat-line">没有数据!</div>
          		</div>
          	</div>
          	
          	<div class="table-responsive">
              	<table class="table table-bordered table-hover">
              		<caption>城堡等级流失</caption>
              		<thead>
              			<tr>
              				<th>等级</th>
              				<th>角色数</th>
              				<th>占比</th>
              			</tr>
              		</thead>
              		<tbody>
              			<?php foreach ($castleData['tableData'] as $row):?>
              			<tr>
              				<td><?=$row[0]?></td>
              				<td><?=$row[1]?></td>
              				<td><?=round($row[1]/$castleData['totalNums'],4)*100?>%</td>
              			</tr>
              			<?php endforeach;?>
              		</tbody>
              	</table>
          	</div>
          	
          	<!-- row end -->
          	
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
		$('#game-char-level-dist-search-form').submit();
	}
	<?php if (!empty($charData['pieData'])):?>
 	show_simple_line_chart("#chat-line",<?=json_encode($charData['lineData'])?>,'领主等级分布','人数'); 
 	show_simple_pie_chart("#chat-pie",<?=json_encode($charData['pieData'])?>,'领主等级占比','人数');
 	<?php endif;?>
	<?php if (!empty($castleData['pieData'])):?>
 	show_simple_line_chart("#castle-chat-line",<?=json_encode($castleData['lineData'])?>,'城堡等级分布','人数'); 
 	show_simple_pie_chart("#castle-chat-pie",<?=json_encode($castleData['pieData'])?>,'城堡等级占比','人数');
 	<?php endif;?>
</script>
<?php $this->endBlock(); ?>