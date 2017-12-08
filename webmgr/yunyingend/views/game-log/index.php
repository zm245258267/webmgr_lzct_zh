<?php
use backend\widgets\SearchFormCommonField;

use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;

use backend\models\GameLog;

$modelLabel = new \backend\models\GameLog();
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
                <?php ActiveForm::begin(['id' => 'game-log-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('game-log/index')]); ?>     
                <?=SearchFormCommonField::widget()?>
                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('eventId')?>:</label>
                      <a id="eventSelect"><?=($eventName?$eventName:"请选择")?></a>
                      <input type="hidden" class="form-control" id="query[eventId]" name="query[eventId]"  value="<?=isset($query["eventId"]) ? $query["eventId"] : "" ?>">
                      <input type="hidden" class="form-control" id="eventName" name="eventName"  value="<?=isset($eventName) ? $eventName : "" ?>">
                  </div>
                  
                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('playerId')?>:</label>
                      <input type="text" class="form-control" id="query[playerId]" name="query[playerId]"  value="<?=isset($query["playerId"]) ? $query["playerId"] : "" ?>">
                  </div>

                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('playerName')?>:</label>
                      <input type="text" class="form-control" id="query[playerName]" name="query[playerName]"  value="<?=isset($query["playerName"]) ? $query["playerName"] : "" ?>">
                  </div>

                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('playerAccount')?>:</label>
                      <input type="text" class="form-control" id="query[playerAccount]" name="query[playerAccount]"  value="<?=isset($query["playerAccount"]) ? $query["playerAccount"] : "" ?>">
                  </div>

                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('time')?>:</label>
                      <input type="text" class="form-control date" id="query[time]" name="query[time]"  value="<?=isset($query["time"]) ? $query["time"] : "" ?>">
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
              $orderby = isset($_GET['orderby']) ? $_GET['orderby'] : '';
              echo '<th onclick="orderby(\'eventId\', \'desc\')" '.CommonFun::sortClass($orderby, 'eventId').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('eventId').'</th>';
              echo '<th onclick="orderby(\'playerId\', \'desc\')" '.CommonFun::sortClass($orderby, 'playerId').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('playerId').'</th>';
              echo '<th onclick="orderby(\'playerName\', \'desc\')" '.CommonFun::sortClass($orderby, 'playerName').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('playerName').'</th>';
              echo '<th onclick="orderby(\'playerAccount\', \'desc\')" '.CommonFun::sortClass($orderby, 'playerAccount').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('playerAccount').'</th>';
//               echo '<th onclick="orderby(\'viplv\', \'desc\')" '.CommonFun::sortClass($orderby, 'viplv').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('viplv').'</th>';
              echo '<th onclick="orderby(\'charlevel\', \'desc\')" '.CommonFun::sortClass($orderby, 'charlevel').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('charlevel').'</th>';
              echo '<th onclick="orderby(\'castleLevel\', \'desc\')" '.CommonFun::sortClass($orderby, 'castleLevel').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('castleLevel').'</th>';
              echo '<th onclick="orderby(\'countryId\', \'desc\')" '.CommonFun::sortClass($orderby, 'countryId').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('countryId').'</th>';
              echo '<th onclick="orderby(\'targetId\', \'desc\')" '.CommonFun::sortClass($orderby, 'targetId').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('targetId').'</th>';
              echo '<th onclick="orderby(\'targetName\', \'desc\')" '.CommonFun::sortClass($orderby, 'targetName').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('targetName').'</th>';
              echo '<th onclick="orderby(\'field1\', \'desc\')" '.CommonFun::sortClass($orderby, 'field1').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('field1').'</th>';
              echo '<th onclick="orderby(\'field2\', \'desc\')" '.CommonFun::sortClass($orderby, 'field2').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('field2').'</th>';
              echo '<th onclick="orderby(\'field3\', \'desc\')" '.CommonFun::sortClass($orderby, 'field3').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('field3').'</th>';
              echo '<th onclick="orderby(\'field4\', \'desc\')" '.CommonFun::sortClass($orderby, 'field4').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('field4').'</th>';
              echo '<th onclick="orderby(\'field5\', \'desc\')" '.CommonFun::sortClass($orderby, 'field5').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('field5').'</th>';
              echo '<th onclick="orderby(\'field6\', \'desc\')" '.CommonFun::sortClass($orderby, 'field6').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('field6').'</th>';
              echo '<th onclick="orderby(\'field7\', \'desc\')" '.CommonFun::sortClass($orderby, 'field7').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('field7').'</th>';
              echo '<th onclick="orderby(\'field8\', \'desc\')" '.CommonFun::sortClass($orderby, 'field8').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('field8').'</th>';
              echo '<th onclick="orderby(\'field9\', \'desc\')" '.CommonFun::sortClass($orderby, 'field9').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('field9').'</th>';
              echo '<th onclick="orderby(\'field10\', \'desc\')" '.CommonFun::sortClass($orderby, 'field10').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('field10').'</th>';
              echo '<th onclick="orderby(\'time\', \'desc\')" '.CommonFun::sortClass($orderby, 'time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('time').'</th>';
         
			?>
	
            </tr>
            </thead>
            <tbody>
            
            <?php
            foreach ($models as $model) {
                echo '<tr id="rowid_">';
                echo '  <td>' . ($events[$model->eventId]['event_name']?$events[$model->eventId]['event_name']:$model->eventId) . '</td>';
                echo '  <td>' . $model->playerId . '</td>';
                echo '  <td>' . $model->playerName . '</td>';
                echo '  <td>' . $model->playerAccount . '</td>';
//                 echo '  <td>' . $model->viplv . '</td>';
                echo '  <td>' . $model->charlevel . '</td>';
                echo '  <td>' . $model->castleLevel . '</td>';
                echo '  <td>' . ($model->countryId) . '</td>';	// @todo 游戏定义
                echo '  <td title="'.$events[$model->eventId]['target_id'].'">' . $model->targetId . '</td>';
                echo '  <td title="'.$events[$model->eventId]['target_name'].'">' . $model->targetName . '</td>';
                echo '  <td title="'.$events[$model->eventId]['field1'].'">' . $model->field1 . '</td>';
                echo '  <td title="'.$events[$model->eventId]['field2'].'">' . $model->field2 . '</td>';
                echo '  <td title="'.$events[$model->eventId]['field3'].'">' . $model->field3 . '</td>';
                echo '  <td title="'.$events[$model->eventId]['field4'].'">' . $model->field4 . '</td>';
                echo '  <td title="'.$events[$model->eventId]['field5'].'">' . $model->field5 . '</td>';
                echo '  <td title="'.$events[$model->eventId]['field6'].'">' . $model->field6 . '</td>';
                echo '  <td title="'.$events[$model->eventId]['field7'].'">' . $model->field7 . '</td>';
                echo '  <td title="'.$events[$model->eventId]['field8'].'">' . $model->field8 . '</td>';
                echo '  <td title="'.$events[$model->eventId]['field9'].'">' . $model->field9 . '</td>';
                echo '  <td title="'.$events[$model->eventId]['field10'].'">' . $model->field10 . '</td>';
                echo '  <td>' . $model->time . '</td>';
                echo '</tr>';
            }
            
            ?>
            
           
           
            </tbody>
            <!-- <tfoot></tfoot> -->
          </table>
          </div>
          </div>
          <!-- row end -->
          
          <!-- row start -->
          <div class="row">
          	<div class="col-sm-5">
            	<div class="dataTables_info" id="data_table_info" role="status" aria-live="polite">
            		<div class="infos">
            		从<?= $pages->getPage() * $pages->getPageSize() + 1 ?>            		到 <?= ($pageCount = ($pages->getPage() + 1) * $pages->getPageSize()) < $pages->totalCount ?  $pageCount : $pages->totalCount?>            		 共 <?= $pages->totalCount?> 条记录</div>
            	</div>
            </div>
          	<div class="col-sm-7">
              	<div class="dataTables_paginate paging_simple_numbers" id="data_table_paginate">
              	<?= LinkPager::widget([
              	    'pagination' => $pages,
              	    'nextPageLabel' => '»',
              	    'prevPageLabel' => '«',
              	    'firstPageLabel' => '首页',
              	    'lastPageLabel' => '尾页',
              	]); ?>	
              	
              	</div>
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

<div class="modal fade" id="edit_dialog" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
                <?php $form = ActiveForm::begin(["id" => "game-log-form", "class"=>"form-horizontal", "action"=>Url::toRoute("game-log/save")]); ?>                      
                 
          <input type="hidden" class="form-control" id="eventId" name="eventId" />

          <div id="playerId_div" class="form-group">
              <label for="playerId" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("playerId")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="playerId" name="GameLog[playerId]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="playerName_div" class="form-group">
              <label for="playerName" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("playerName")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="playerName" name="GameLog[playerName]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="playerAccount_div" class="form-group">
              <label for="playerAccount" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("playerAccount")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="playerAccount" name="GameLog[playerAccount]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="viplv_div" class="form-group">
              <label for="viplv" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("viplv")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="viplv" name="GameLog[viplv]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="charlevel_div" class="form-group">
              <label for="charlevel" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("charlevel")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="charlevel" name="GameLog[charlevel]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="targetId_div" class="form-group">
              <label for="targetId" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("targetId")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="targetId" name="GameLog[targetId]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="targetName_div" class="form-group">
              <label for="targetName" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("targetName")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="targetName" name="GameLog[targetName]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="field1_div" class="form-group">
              <label for="field1" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("field1")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="field1" name="GameLog[field1]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="field2_div" class="form-group">
              <label for="field2" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("field2")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="field2" name="GameLog[field2]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="field3_div" class="form-group">
              <label for="field3" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("field3")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="field3" name="GameLog[field3]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="field4_div" class="form-group">
              <label for="field4" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("field4")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="field4" name="GameLog[field4]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="field5_div" class="form-group">
              <label for="field5" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("field5")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="field5" name="GameLog[field5]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="field6_div" class="form-group">
              <label for="field6" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("field6")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="field6" name="GameLog[field6]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="field7_div" class="form-group">
              <label for="field7" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("field7")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="field7" name="GameLog[field7]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="field8_div" class="form-group">
              <label for="field8" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("field8")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="field8" name="GameLog[field8]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="field9_div" class="form-group">
              <label for="field9" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("field9")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="field9" name="GameLog[field9]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="field10_div" class="form-group">
              <label for="field10" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("field10")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="field10" name="GameLog[field10]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="time_div" class="form-group">
              <label for="time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("time")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="time" name="GameLog[time]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>
                    

			<?php ActiveForm::end(); ?>          
                </div>
			<div class="modal-footer">
				<a href="#" class="btn btn-default" data-dismiss="modal">关闭</a> <a
					id="edit_dialog_ok" href="#" class="btn btn-primary">确定</a>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="eventDialog" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>行为</h3>
			</div>
			<div class="modal-body">
                <?php $form = ActiveForm::begin(["id" => "game-log-event-form", "class"=>"form-horizontal", "action"=>Url::toRoute("game-log/save")]); ?>                      
                 

          <div id="playerId_div" class="form-group">
              <ul class="select_ul w100">
              	<?php foreach ($events as $eventId=>$eventName):?>
              	<li><label title="<?=$eventName['event_name']?>"><input type="checkbox" name="eventId" value="<?=$eventId?>" eventName="<?=$eventName['event_name']?>" /> <?=$eventName['event_name']?></label></li>
              	<?php endforeach;?>
              </ul>
              <div class="clear"></div>
          </div>

			<?php ActiveForm::end(); ?>          
                </div>
			<div class="modal-footer">
				<a href="#" class="btn btn-default" data-dismiss="modal">关闭</a> <a
					id="event_dialog_ok" href="#" class="btn btn-primary">确定</a>
			</div>
		</div>
	</div>
</div>

<?php $this->beginBlock('footer');  ?>
<!-- <body></body>后代码块 -->
 <script>
function orderby(field, op){
	 var url = window.location.search;
	 var optemp = field + " desc";
	 if(url.indexOf('orderby') != -1){
		 url = url.replace(/orderby=([^&?]*)/ig,  function($0, $1){ 
			 var optemp = field + " desc";
			 optemp = decodeURI($1) != optemp ? optemp : field + " asc";
			 return "orderby=" + optemp;
		   }); 
	 }
	 else{
		 if(url.indexOf('?') != -1){
			 url = url + "&orderby=" + encodeURI(optemp);
		 }
		 else{
			 url = url + "?orderby=" + encodeURI(optemp);
		 }
	 }
	 window.location.href=url; 
 }
 function searchAction(){
		$('#game-log-search-form').submit();
	}
 function viewAction(id){
		initModel(id, 'view', 'fun');
	}

 function initEditSystemModule(data, type){
	if(type == 'create'){
		$("#eventId").val('');
		$("#playerId").val('');
		$("#playerName").val('');
		$("#playerAccount").val('');
		$("#viplv").val('');
		$("#charlevel").val('');
		$("#targetId").val('');
		$("#targetName").val('');
		$("#field1").val('');
		$("#field2").val('');
		$("#field3").val('');
		$("#field4").val('');
		$("#field5").val('');
		$("#field6").val('');
		$("#field7").val('');
		$("#field8").val('');
		$("#field9").val('');
		$("#field10").val('');
		$("#time").val('');
		
	}
	else{
		$("#eventId").val(data.eventId);
    	$("#playerId").val(data.playerId);
    	$("#playerName").val(data.playerName);
    	$("#playerAccount").val(data.playerAccount);
    	$("#viplv").val(data.viplv);
    	$("#charlevel").val(data.charlevel);
    	$("#targetId").val(data.targetId);
    	$("#targetName").val(data.targetName);
    	$("#field1").val(data.field1);
    	$("#field2").val(data.field2);
    	$("#field3").val(data.field3);
    	$("#field4").val(data.field4);
    	$("#field5").val(data.field5);
    	$("#field6").val(data.field6);
    	$("#field7").val(data.field7);
    	$("#field8").val(data.field8);
    	$("#field9").val(data.field9);
    	$("#field10").val(data.field10);
    	$("#time").val(data.time);
    	}
	if(type == "view"){
      $("#eventId").attr({readonly:true,disabled:true});
      $("#playerId").attr({readonly:true,disabled:true});
      $("#playerName").attr({readonly:true,disabled:true});
      $("#playerAccount").attr({readonly:true,disabled:true});
      $("#viplv").attr({readonly:true,disabled:true});
      $("#charlevel").attr({readonly:true,disabled:true});
      $("#targetId").attr({readonly:true,disabled:true});
      $("#targetName").attr({readonly:true,disabled:true});
      $("#field1").attr({readonly:true,disabled:true});
      $("#field2").attr({readonly:true,disabled:true});
      $("#field3").attr({readonly:true,disabled:true});
      $("#field4").attr({readonly:true,disabled:true});
      $("#field5").attr({readonly:true,disabled:true});
      $("#field6").attr({readonly:true,disabled:true});
      $("#field7").attr({readonly:true,disabled:true});
      $("#field8").attr({readonly:true,disabled:true});
      $("#field9").attr({readonly:true,disabled:true});
      $("#field10").attr({readonly:true,disabled:true});
      $("#time").attr({readonly:true,disabled:true});
	$('#edit_dialog_ok').addClass('hidden');
	}
	else{
      $("#eventId").attr({readonly:false,disabled:false});
      $("#playerId").attr({readonly:false,disabled:false});
      $("#playerName").attr({readonly:false,disabled:false});
      $("#playerAccount").attr({readonly:false,disabled:false});
      $("#viplv").attr({readonly:false,disabled:false});
      $("#charlevel").attr({readonly:false,disabled:false});
      $("#targetId").attr({readonly:false,disabled:false});
      $("#targetName").attr({readonly:false,disabled:false});
      $("#field1").attr({readonly:false,disabled:false});
      $("#field2").attr({readonly:false,disabled:false});
      $("#field3").attr({readonly:false,disabled:false});
      $("#field4").attr({readonly:false,disabled:false});
      $("#field5").attr({readonly:false,disabled:false});
      $("#field6").attr({readonly:false,disabled:false});
      $("#field7").attr({readonly:false,disabled:false});
      $("#field8").attr({readonly:false,disabled:false});
      $("#field9").attr({readonly:false,disabled:false});
      $("#field10").attr({readonly:false,disabled:false});
      $("#time").attr({readonly:false,disabled:false});
		$('#edit_dialog_ok').removeClass('hidden');
		}
		$('#edit_dialog').modal('show');
}

function initModel(id, type, fun){
	
	$.ajax({
		   type: "GET",
		   url: "<?=Url::toRoute('game-log/view')?>",
		   data: {"id":id},
		   cache: false,
		   dataType:"json",
		   error: function (xmlHttpRequest, textStatus, errorThrown) {
			    alert("出错了，" + textStatus);
			},
		   success: function(data){
			   initEditSystemModule(data, type);
		   }
		});
}
	
function editAction(id){
	initModel(id, 'edit');
}

function deleteAction(id){
	var ids = [];
	if(!!id == true){
		ids[0] = id;
	}
	else{
		var checkboxs = $('#data_table :checked');
	    if(checkboxs.size() > 0){
	        var c = 0;
	        for(i = 0; i < checkboxs.size(); i++){
	            var id = checkboxs.eq(i).val();
	            if(id != ""){
	            	ids[c++] = id;
	            }
	        }
	    }
	}
	if(ids.length > 0){
		admin_tool.confirm('请确认是否删除', function(){
		    $.ajax({
				   type: "GET",
				   url: "<?=Url::toRoute('game-log/delete')?>",
				   data: {"ids":ids},
				   cache: false,
				   dataType:"json",
				   error: function (xmlHttpRequest, textStatus, errorThrown) {
					    admin_tool.alert('msg_info', '出错了，' + textStatus, 'warning');
					},
				   success: function(data){
					   for(i = 0; i < ids.length; i++){
						   $('#rowid_' + ids[i]).remove();
					   }
					   admin_tool.alert('msg_info', '删除成功', 'success');
					   window.location.reload();
				   }
				});
		});
	}
	else{
		admin_tool.alert('msg_info', '请先选择要删除的数据', 'warning');
	}
    
}

function getSelectedIdValues(formId)
{
	var value="";
	$( formId + " :checked").each(function(i)
	{
		if(!this.checked)
		{
			return true;
		}
		value += this.value;
		if(i != $("input[name='id']").size()-1)
		{
			value += ",";
		}
	 });
	return value;
}

$('#edit_dialog_ok').click(function (e) {
    e.preventDefault();
	$('#game-log-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

// 行为选择
$('#eventSelect').click(function(e){
	e.preventDefault();
	$('#eventDialog').modal('show');
});

$('#event_dialog_ok').click(function (e) {
    e.preventDefault();
    var eventIdStr='';
    var eventNameStr='';
	$('#game-log-event-form input[name=eventId]:checked').each(function(i){
			eventIdStr+=(this.value+',');
			eventNameStr+=($(this).attr("eventName")+',');
		});
	eventIdStr=eventIdStr.slice(0,-1);
	eventNameStr=eventNameStr.slice(0,-1);

	if(eventNameStr==''){
		eventNameStr='请选择';
	}
	$("#eventSelect").html(eventNameStr);
	$("#eventSelect").attr("title",eventNameStr);
	$("input[type=hidden][id='query[eventId]']").val(eventIdStr);
	$("input[type=hidden][id='eventName']").val(eventNameStr);

	$('#eventDialog').modal('hide');
	return;
});

// 选中行为
$(function(){
	var eventIdStr=$("input[type=hidden][id='query[eventId]']").val();
	if(eventIdStr){
		$('#game-log-event-form input[name=eventId]').check(eventIdStr);
	}
});

$('#game-log-form').bind('submit', function(e) {
	e.preventDefault();
	var id = $("#id").val();
	var action = id == "" ? "<?=Url::toRoute('game-log/create')?>" : "<?=Url::toRoute('game-log/update')?>";
    $(this).ajaxSubmit({
    	type: "post",
    	dataType:"json",
    	url: action,
    	success: function(value) 
    	{
        	if(value.errno == 0){
        		$('#edit_dialog').modal('hide');
        		admin_tool.alert('msg_info', '添加成功', 'success');
        		window.location.reload();
        	}
        	else{
            	var json = value.data;
        		for(var key in json){
        			$('#' + key).attr({'data-placement':'bottom', 'data-content':json[key], 'data-toggle':'popover'}).addClass('popover-show').popover('show');
        			
        		}
        	}

    	}
    });
});

 
</script>
<?php $this->endBlock(); ?>
