
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
                <?php ActiveForm::begin(['id' => 'game-users-dayback-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('game-users-dayback/index')]); ?>     
                
                  <?=SearchFormCommonField::widget()?>
                  <div class="form-group" style="margin: 5px;">
                      <label>注册时间:</label>
                      <input type="text" class="form-control date" id="query[createtime]" name="query[createtime]"  value="<?=isset($query["createtime"]) ? $query["createtime"] : "" ?>">
                  </div>
              <div class="form-group">
              	<a onclick="searchAction()" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>搜索</a>
           	  </div>
               <?php ActiveForm::end(); ?> 
            </div>
          	</div>
          	<!-- row end search -->
          	
          	<!-- row start -->
          	<div class="row">
          	<div class="col-sm-12 table-responsive">
          	<table id="data_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="data_table_info">
            <thead>
            <tr role="row">
            
            <?php 
              echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1">日期</th>';
              echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1">注册</th>';
              for($i=1;$i<=30;$i++){
              	echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1">'.$i.'日</th>';
              }
			?>
	
            </tr>
            </thead>
            <tbody>
            
            <?php
            foreach ($dataSet['remained'] as $row) {
                echo '<tr id="rowid_">';
                echo '  <td>' . $row['date'] . '</td>';
                echo '  <td>' . $row['reg'] . '</td>';
                for($i=1;$i<=30;$i++){
                	echo ($row[$i][0]?'  <td>' . $row[$i][0].'<br />'.$row[$i][1] . '%</td>':'<td>--</td>');
                }
                echo '</tr>';
            }
            
            ?>
            </tbody>
            <!-- <tfoot></tfoot> -->
          </table>
          </div>
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
		$('#game-users-dayback-search-form').submit();
	}
</script>
<?php $this->endBlock(); ?>