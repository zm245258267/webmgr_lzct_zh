
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;

use backend\models\GameEventMap;

$modelLabel = new \backend\models\GameEventMap();
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
          <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
                <button id="create_btn" type="button" class="btn btn-xs btn-primary">添&nbsp;&emsp;加</button>
        			|
        		<button id="delete_btn" type="button" class="btn btn-xs btn-danger">批量删除</button>
            </div>
          </div>
        </div>
        <!-- /.box-header -->
        
        <div class="box-body">
          <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <!-- row start search-->
          	<div class="row">
          	<div class="col-sm-12">
                <?php ActiveForm::begin(['id' => 'game-event-map-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('game-event-map/index')]); ?>     
                
                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('event_id')?>:</label>
                      <input type="text" class="form-control" id="query[event_id]" name="query[event_id]"  value="<?=isset($query["event_id"]) ? $query["event_id"] : "" ?>">
                  </div>

                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('event_name')?>:</label>
                      <input type="text" class="form-control" id="query[event_name]" name="query[event_name]"  value="<?=isset($query["event_name"]) ? $query["event_name"] : "" ?>">
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
		      echo '<th><input id="data_table_check" type="checkbox"></th>';
              echo '<th onclick="orderby(\'id\', \'desc\')" '.CommonFun::sortClass($orderby, 'id').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('id').'</th>';
              echo '<th onclick="orderby(\'event_id\', \'desc\')" '.CommonFun::sortClass($orderby, 'event_id').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('event_id').'</th>';
              echo '<th onclick="orderby(\'event_name\', \'desc\')" '.CommonFun::sortClass($orderby, 'event_name').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('event_name').'</th>';
              echo '<th onclick="orderby(\'target_id\', \'desc\')" '.CommonFun::sortClass($orderby, 'target_id').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('target_id').'</th>';
              echo '<th onclick="orderby(\'target_name\', \'desc\')" '.CommonFun::sortClass($orderby, 'target_name').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('target_name').'</th>';
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
              echo '<th onclick="orderby(\'notes\', \'desc\')" '.CommonFun::sortClass($orderby, 'notes').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('notes').'</th>';
              echo '<th onclick="orderby(\'record_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'record_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('record_time').'</th>';
         
			?>
	
            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >操作</th>
            </tr>
            </thead>
            <tbody>
            
            <?php
            foreach ($models as $model) {
                echo '<tr id="rowid_' . $model->id . '">';
                echo '  <td><label><input type="checkbox" value="' . $model->id . '"></label></td>';
                echo '  <td>' . $model->id . '</td>';
                echo '  <td>' . $model->event_id . '</td>';
                echo '  <td>' . $model->event_name . '</td>';
                echo '  <td>' . $model->target_id . '</td>';
                echo '  <td>' . $model->target_name . '</td>';
                echo '  <td>' . $model->field1 . '</td>';
                echo '  <td>' . $model->field2 . '</td>';
                echo '  <td>' . $model->field3 . '</td>';
                echo '  <td>' . $model->field4 . '</td>';
                echo '  <td>' . $model->field5 . '</td>';
                echo '  <td>' . $model->field6 . '</td>';
                echo '  <td>' . $model->field7 . '</td>';
                echo '  <td>' . $model->field8 . '</td>';
                echo '  <td>' . $model->field9 . '</td>';
                echo '  <td>' . $model->field10 . '</td>';
                echo '  <td>' . $model->notes . '</td>';
                echo '  <td>' . $model->record_time . '</td>';
                echo '  <td class="center">';
                echo '      <a id="view_btn" onclick="viewAction(' . $model->id . ')" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>查看</a>';
                echo '      <a id="edit_btn" onclick="editAction(' . $model->id . ')" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-edit icon-white"></i>修改</a>';
                echo '      <a id="delete_btn" onclick="deleteAction(' . $model->id . ')" class="btn btn-danger btn-sm" href="#"> <i class="glyphicon glyphicon-trash icon-white"></i>删除</a>';
                echo '  </td>';
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
                <?php $form = ActiveForm::begin(["id" => "game-event-map-form", "class"=>"form-horizontal", "action"=>Url::toRoute("game-event-map/save")]); ?>                      
                 
          <input type="hidden" class="form-control" id="id" name="id" />

          <div id="event_id_div" class="form-group">
              <label for="event_id" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("event_id")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="event_id" name="GameEventMap[event_id]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="event_name_div" class="form-group">
              <label for="event_name" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("event_name")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="event_name" name="GameEventMap[event_name]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="target_id_div" class="form-group">
              <label for="target_id" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("target_id")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="target_id" name="GameEventMap[target_id]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="target_name_div" class="form-group">
              <label for="target_name" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("target_name")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="target_name" name="GameEventMap[target_name]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="field1_div" class="form-group">
              <label for="field1" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("field1")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="field1" name="GameEventMap[field1]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="field2_div" class="form-group">
              <label for="field2" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("field2")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="field2" name="GameEventMap[field2]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="field3_div" class="form-group">
              <label for="field3" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("field3")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="field3" name="GameEventMap[field3]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="field4_div" class="form-group">
              <label for="field4" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("field4")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="field4" name="GameEventMap[field4]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="field5_div" class="form-group">
              <label for="field5" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("field5")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="field5" name="GameEventMap[field5]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="field6_div" class="form-group">
              <label for="field6" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("field6")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="field6" name="GameEventMap[field6]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="field7_div" class="form-group">
              <label for="field7" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("field7")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="field7" name="GameEventMap[field7]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="field8_div" class="form-group">
              <label for="field8" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("field8")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="field8" name="GameEventMap[field8]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="field9_div" class="form-group">
              <label for="field9" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("field9")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="field9" name="GameEventMap[field9]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="field10_div" class="form-group">
              <label for="field10" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("field10")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="field10" name="GameEventMap[field10]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="notes_div" class="form-group">
              <label for="notes" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("notes")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="notes" name="GameEventMap[notes]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="record_time_div" class="form-group">
              <label for="record_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("record_time")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="record_time" name="GameEventMap[record_time]" placeholder="必填" />
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
		$('#game-event-map-search-form').submit();
	}
 function viewAction(id){
		initModel(id, 'view', 'fun');
	}

 function initEditSystemModule(data, type){
	if(type == 'create'){
		$("#id").val('');
		$("#event_id").val('');
		$("#event_name").val('');
		$("#target_id").val('');
		$("#target_name").val('');
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
		$("#notes").val('');
		$("#record_time").val('');
		
	}
	else{
		$("#id").val(data.id);
    	$("#event_id").val(data.event_id);
    	$("#event_name").val(data.event_name);
    	$("#target_id").val(data.target_id);
    	$("#target_name").val(data.target_name);
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
    	$("#notes").val(data.notes);
    	$("#record_time").val(data.record_time);
    	}
	if(type == "view"){
      $("#id").attr({readonly:true,disabled:true});
      $("#id").parent().parent().show();
      $("#event_id").attr({readonly:true,disabled:true});
      $("#event_name").attr({readonly:true,disabled:true});
      $("#target_id").attr({readonly:true,disabled:true});
      $("#target_name").attr({readonly:true,disabled:true});
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
      $("#notes").attr({readonly:true,disabled:true});
      $("#record_time").attr({readonly:true,disabled:true});
      $("#record_time").parent().parent().show();
	$('#edit_dialog_ok').addClass('hidden');
	}
	else{
      $("#id").attr({readonly:false,disabled:false});
      // $("#id").parent().parent().hide();
      $("#event_id").attr({readonly:false,disabled:false});
      $("#event_name").attr({readonly:false,disabled:false});
      $("#target_id").attr({readonly:false,disabled:false});
      $("#target_name").attr({readonly:false,disabled:false});
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
      $("#notes").attr({readonly:false,disabled:false});
      $("#record_time").attr({readonly:false,disabled:false});
      $("#record_time").parent().parent().hide();
		$('#edit_dialog_ok').removeClass('hidden');
		}
		$('#edit_dialog').modal('show');
}

function initModel(id, type, fun){
	
	$.ajax({
		   type: "GET",
		   url: "<?=Url::toRoute('game-event-map/view')?>",
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
				   url: "<?=Url::toRoute('game-event-map/delete')?>",
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
	$('#game-event-map-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#game-event-map-form').bind('submit', function(e) {
	e.preventDefault();
	var id = $("#id").val();
	var action = id == "" ? "<?=Url::toRoute('game-event-map/create')?>" : "<?=Url::toRoute('game-event-map/update')?>";
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