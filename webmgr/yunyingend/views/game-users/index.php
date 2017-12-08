<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;

use backend\models\GameUsers;
use backend\widgets\SearchFormCommonField;

$modelLabel = new \backend\models\GameUsers();
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
                <?php ActiveForm::begin(['id' => 'game-users-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('game-users/index')]); ?>     
                
                  <!-- 
                  <div class="form-group" style="margin: 5px;">
                      <label>渠道ID:</label>
                      <input type="text" class="form-control" id="query[createspid]" name="query[createspid]"  value="<?=isset($query["createspid"]) ? $query["createspid"] : "" ?>">
                  </div>
                   -->
                  <?=SearchFormCommonField::widget()?>
                  <div class="form-group" style="margin: 5px;">
                      <label>注册日期:</label>
                      <input type="text" class="form-control date" id="query[createtime]" name="query[createtime]"  value="<?=isset($query["createtime"]) ? $query["createtime"] : "" ?>">
                  </div>
                  <div class="form-group" style="margin: 5px;">
                      <label>时间类型:</label>
                      <select class="form-control" id="query[timetype]" name="query[timetype]">
                      	<option value="h" <?=($query['timetype']=='h'?'selected="selected"':"")?>>每时</option>
                      	<option value="d" <?=($query['timetype']=='d'?'selected="selected"':"")?>>每日</option>
                      	<option value="m" <?=($query['timetype']=='m'?'selected="selected"':"")?>>每月</option>
                      </select>
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
          			<div>总注册：<b><?=$dataSet['totalReg']?></b></div>
          		</div>
          	</div>
          	
          	<div class="row">
          		<div class="col-sm-12">
          			<div id="chat-line">没有数据!</div>
          		</div>
          	</div>
          	
          	<div class="row">
          		<div class="col-sm-12 table-responsive">
          			<table id="data_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="data_table_info">
          				<thead>
				            <tr role="row">
				            <?php 
				              echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" >年</th>';
				              echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" >月</th>';
				              
				              if($query['timetype']=='d'){
				              	echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" >日</th>';
				              }
				              
				              if($query['timetype']=='h'){
				              	 echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" >日</th>';
								echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" >时</th>';
				              }
				              
				              echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" >注册人数</th>';
				         
							?>
				            </tr>
				         </thead>
          				<tbody>
				            <?php
				            foreach ($dataSet['tableData'] as $row) {
				                echo '<tr id="rowid_">';
				                echo '  <td>' . $row['Y'] . '</td>';
				                echo '  <td>' . $row['m'] . '</td>';
				                echo '  <td>' . $row['d'] . '</td>';
				                echo '  <td>' . $row['H'] . '</td>';
				                echo '  <td>' . $row['nums'] . '</td>';
				                echo '</tr>';
				            }
				            ?>
				            </tbody>
          			</table>
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
		$('#game-users-search-form').submit();
	}

	<?php if($dataSet['lineData']):?>
	show_simple_line_chart('#chat-line',<?=json_encode($dataSet['lineData'])?>,'注册统计','人数');
	<?php endif;?>
 </script>
<?php $this->endBlock(); ?>