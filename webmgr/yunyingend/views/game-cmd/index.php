
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;

use backend\models\GameCmd;

$modelLabel = new \backend\models\GameCmd();
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
                <?php ActiveForm::begin(['id' => 'game-cmd-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('game-cmd/index')]); ?>     
                
                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('id')?>:</label>
                      <input type="text" class="form-control" id="query[id]" name="query[id]"  value="<?=isset($query["id"]) ? $query["id"] : "" ?>">
                  </div>

                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('cmd')?>:</label>
                      <input type="text" class="form-control" id="query[cmd]" name="query[cmd]"  value="<?=isset($query["cmd"]) ? $query["cmd"] : "" ?>">
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
              echo '<th onclick="orderby(\'cmd\', \'desc\')" '.CommonFun::sortClass($orderby, 'cmd').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('cmd').'</th>';
              echo '<th onclick="orderby(\'name\', \'desc\')" '.CommonFun::sortClass($orderby, 'name').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('name').'</th>';
              echo '<th onclick="orderby(\'p1\', \'desc\')" '.CommonFun::sortClass($orderby, 'p1').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('p1').'</th>';
              echo '<th onclick="orderby(\'p2\', \'desc\')" '.CommonFun::sortClass($orderby, 'p2').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('p2').'</th>';
              echo '<th onclick="orderby(\'p3\', \'desc\')" '.CommonFun::sortClass($orderby, 'p3').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('p3').'</th>';
              echo '<th onclick="orderby(\'p4\', \'desc\')" '.CommonFun::sortClass($orderby, 'p4').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('p4').'</th>';
              echo '<th onclick="orderby(\'p5\', \'desc\')" '.CommonFun::sortClass($orderby, 'p5').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('p5').'</th>';
              echo '<th onclick="orderby(\'p6\', \'desc\')" '.CommonFun::sortClass($orderby, 'p6').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('p6').'</th>';
              echo '<th onclick="orderby(\'p7\', \'desc\')" '.CommonFun::sortClass($orderby, 'p7').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('p7').'</th>';
              echo '<th onclick="orderby(\'p8\', \'desc\')" '.CommonFun::sortClass($orderby, 'p8').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('p8').'</th>';
              echo '<th onclick="orderby(\'p9\', \'desc\')" '.CommonFun::sortClass($orderby, 'p9').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('p9').'</th>';
              echo '<th onclick="orderby(\'p10\', \'desc\')" '.CommonFun::sortClass($orderby, 'p10').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('p10').'</th>';
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
                echo '  <td>' . $model->cmd . '</td>';
                echo '  <td>' . $model->name . '</td>';
                echo '  <td>' . $model->p1 . '</td>';
                echo '  <td>' . $model->p2 . '</td>';
                echo '  <td>' . $model->p3 . '</td>';
                echo '  <td>' . $model->p4 . '</td>';
                echo '  <td>' . $model->p5 . '</td>';
                echo '  <td>' . $model->p6 . '</td>';
                echo '  <td>' . $model->p7 . '</td>';
                echo '  <td>' . $model->p8 . '</td>';
                echo '  <td>' . $model->p9 . '</td>';
                echo '  <td>' . $model->p10 . '</td>';
                //echo '  <td>' . $model->f1 . '</td>';
                //echo '  <td>' . $model->f2 . '</td>';
                //echo '  <td>' . $model->f3 . '</td>';
                //echo '  <td>' . $model->f4 . '</td>';
                //echo '  <td>' . $model->f5 . '</td>';
                //echo '  <td>' . $model->f6 . '</td>';
                //echo '  <td>' . $model->f7 . '</td>';
                //echo '  <td>' . $model->f8 . '</td>';
                //echo '  <td>' . $model->f9 . '</td>';
                //echo '  <td>' . $model->f10 . '</td>';
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
                <?php $form = ActiveForm::begin(["id" => "game-cmd-form", "class"=>"form-horizontal", "action"=>Url::toRoute("game-cmd/save")]); ?>                      
                 
          <input type="hidden" class="form-control" id="id" name="id" />

          <div id="cmd_div" class="form-group">
              <label for="cmd" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("cmd")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="cmd" name="GameCmd[cmd]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>
          
          <div id="name_div" class="form-group">
              <label for="name" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("name")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="name" name="GameCmd[name]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="p1_div" class="form-group">
              <label for="p1" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("p1")?></label>
              <div class="col-sm-6">
                  <input type="text" class="form-control" id="p1" name="GameCmd[p1]" placeholder="" />
              </div>
              <div class="col-sm-4">
              	<select id="f1" class="form-control" name="GameCmd[f1]">
              		<option value="input">input</option>
              		<option value="textarea">textarea</option>
              	</select>
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="p2_div" class="form-group">
              <label for="p2" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("p2")?></label>
              <div class="col-sm-6">
                  <input type="text" class="form-control" id="p2" name="GameCmd[p2]" placeholder="" />
              </div>
              <div class="col-sm-4">
              	<select id="f2" class="form-control" name="GameCmd[f2]">
              		<option value="input">input</option>
              		<option value="textarea">textarea</option>
              	</select>
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="p3_div" class="form-group">
              <label for="p3" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("p3")?></label>
              <div class="col-sm-6">
                  <input type="text" class="form-control" id="p3" name="GameCmd[p3]" placeholder="" />
              </div>
              <div class="col-sm-4">
              	<select id="f3" class="form-control" name="GameCmd[f3]">
              		<option value="input">input</option>
              		<option value="textarea">textarea</option>
              	</select>
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="p4_div" class="form-group">
              <label for="p4" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("p4")?></label>
              <div class="col-sm-6">
                  <input type="text" class="form-control" id="p4" name="GameCmd[p4]" placeholder="" />
              </div>
              <div class="col-sm-4">
              	<select id="f4" class="form-control" name="GameCmd[f4]">
              		<option value="input">input</option>
              		<option value="textarea">textarea</option>
              	</select>
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="p5_div" class="form-group">
              <label for="p5" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("p5")?></label>
              <div class="col-sm-6">
                  <input type="text" class="form-control" id="p5" name="GameCmd[p5]" placeholder="" />
              </div>
              <div class="col-sm-4">
              	<select id="f5" class="form-control" name="GameCmd[f5]">
              		<option value="input">input</option>
              		<option value="textarea">textarea</option>
              	</select>
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="p6_div" class="form-group">
              <label for="p6" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("p6")?></label>
              <div class="col-sm-6">
                  <input type="text" class="form-control" id="p6" name="GameCmd[p6]" placeholder="" />
              </div>
              <div class="col-sm-4">
              	<select id="f6" class="form-control" name="GameCmd[f6]">
              		<option value="input">input</option>
              		<option value="textarea">textarea</option>
              	</select>
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="p7_div" class="form-group">
              <label for="p7" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("p7")?></label>
              <div class="col-sm-6">
                  <input type="text" class="form-control" id="p7" name="GameCmd[p7]" placeholder="" />
              </div>
              <div class="col-sm-4">
              	<select id="f7" class="form-control" name="GameCmd[f7]">
              		<option value="input">input</option>
              		<option value="textarea">textarea</option>
              	</select>
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="p8_div" class="form-group">
              <label for="p8" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("p8")?></label>
              <div class="col-sm-6">
                  <input type="text" class="form-control" id="p8" name="GameCmd[p8]" placeholder="" />
              </div>
              <div class="col-sm-4">
              	<select id="f8" class="form-control" name="GameCmd[f8]">
              		<option value="input">input</option>
              		<option value="textarea">textarea</option>
              	</select>
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="p9_div" class="form-group">
              <label for="p9" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("p9")?></label>
              <div class="col-sm-6">
                  <input type="text" class="form-control" id="p9" name="GameCmd[p9]" placeholder="" />
              </div>
              <div class="col-sm-4">
              	<select id="f9" class="form-control" name="GameCmd[f9]">
              		<option value="input">input</option>
              		<option value="textarea">textarea</option>
              	</select>
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="p10_div" class="form-group">
              <label for="p10" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("p10")?></label>
              <div class="col-sm-6">
                  <input type="text" class="form-control" id="p10" name="GameCmd[p10]" placeholder="" />
              </div>
              <div class="col-sm-4">
              	<select id="f10" class="form-control" name="GameCmd[f10]">
              		<option value="input">input</option>
              		<option value="textarea">textarea</option>
              	</select>
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="notes_div" class="form-group">
              <label for="notes" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("notes")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="notes" name="GameCmd[notes]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="record_time_div" class="form-group">
              <label for="record_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("record_time")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="record_time" name="GameCmd[record_time]" placeholder="必填" />
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
		$('#game-cmd-search-form').submit();
	}
 function viewAction(id){
		initModel(id, 'view', 'fun');
	}

 function initEditSystemModule(data, type){
	if(type == 'create'){
		$("#id").val('');
		$("#cmd").val('');
		$("#name").val('');
		$("#p1").val('');
		$("#p2").val('');
		$("#p3").val('');
		$("#p4").val('');
		$("#p5").val('');
		$("#p6").val('');
		$("#p7").val('');
		$("#p8").val('');
		$("#p9").val('');
		$("#p10").val('');
		$("#f1").val('');
		$("#f2").val('');
		$("#f3").val('');
		$("#f4").val('');
		$("#f5").val('');
		$("#f6").val('');
		$("#f7").val('');
		$("#f8").val('');
		$("#f9").val('');
		$("#f10").val('');
		$("#notes").val('');
		$("#record_time").val('');
		
	}
	else{
		$("#id").val(data.id);
    	$("#cmd").val(data.cmd);
    	$("#name").val(data.name);
    	$("#p1").val(data.p1);
    	$("#p2").val(data.p2);
    	$("#p3").val(data.p3);
    	$("#p4").val(data.p4);
    	$("#p5").val(data.p5);
    	$("#p6").val(data.p6);
    	$("#p7").val(data.p7);
    	$("#p8").val(data.p8);
    	$("#p9").val(data.p9);
    	$("#p10").val(data.p10);
    	$("#f1").val(data.f1);
    	$("#f2").val(data.f2);
    	$("#f3").val(data.f3);
    	$("#f4").val(data.f4);
    	$("#f5").val(data.f5);
    	$("#f6").val(data.f6);
    	$("#f7").val(data.f7);
    	$("#f8").val(data.f8);
    	$("#f9").val(data.f9);
    	$("#f10").val(data.f10);
    	$("#notes").val(data.notes);
    	$("#record_time").val(data.record_time);
    	}
	if(type == "view"){
      $("#id").attr({readonly:true,disabled:true});
      $("#cmd").attr({readonly:true,disabled:true});
      $("#name").attr({readonly:true,disabled:true});
      $("#p1").attr({readonly:true,disabled:true});
      $("#p2").attr({readonly:true,disabled:true});
      $("#p3").attr({readonly:true,disabled:true});
      $("#p4").attr({readonly:true,disabled:true});
      $("#p5").attr({readonly:true,disabled:true});
      $("#p6").attr({readonly:true,disabled:true});
      $("#p7").attr({readonly:true,disabled:true});
      $("#p8").attr({readonly:true,disabled:true});
      $("#p9").attr({readonly:true,disabled:true});
      $("#p10").attr({readonly:true,disabled:true});
      $("#f1").attr({readonly:true,disabled:true});
      $("#f2").attr({readonly:true,disabled:true});
      $("#f3").attr({readonly:true,disabled:true});
      $("#f4").attr({readonly:true,disabled:true});
      $("#f5").attr({readonly:true,disabled:true});
      $("#f6").attr({readonly:true,disabled:true});
      $("#f7").attr({readonly:true,disabled:true});
      $("#f8").attr({readonly:true,disabled:true});
      $("#f9").attr({readonly:true,disabled:true});
      $("#f10").attr({readonly:true,disabled:true});
      $("#notes").attr({readonly:true,disabled:true});
      $("#record_time").attr({readonly:true,disabled:true});
      $("#record_time").parent().parent().show();
	$('#edit_dialog_ok').addClass('hidden');
	}
	else{
      $("#id").attr({readonly:false,disabled:false});
      $("#cmd").attr({readonly:false,disabled:false});
      $("#name").attr({readonly:false,disabled:false});
      $("#p1").attr({readonly:false,disabled:false});
      $("#p2").attr({readonly:false,disabled:false});
      $("#p3").attr({readonly:false,disabled:false});
      $("#p4").attr({readonly:false,disabled:false});
      $("#p5").attr({readonly:false,disabled:false});
      $("#p6").attr({readonly:false,disabled:false});
      $("#p7").attr({readonly:false,disabled:false});
      $("#p8").attr({readonly:false,disabled:false});
      $("#p9").attr({readonly:false,disabled:false});
      $("#p10").attr({readonly:false,disabled:false});
      $("#f1").attr({readonly:false,disabled:false});
      $("#f2").attr({readonly:false,disabled:false});
      $("#f3").attr({readonly:false,disabled:false});
      $("#f4").attr({readonly:false,disabled:false});
      $("#f5").attr({readonly:false,disabled:false});
      $("#f6").attr({readonly:false,disabled:false});
      $("#f7").attr({readonly:false,disabled:false});
      $("#f8").attr({readonly:false,disabled:false});
      $("#f9").attr({readonly:false,disabled:false});
      $("#f10").attr({readonly:false,disabled:false});
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
		   url: "<?=Url::toRoute('game-cmd/view')?>",
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
				   url: "<?=Url::toRoute('game-cmd/delete')?>",
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
	$('#game-cmd-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#game-cmd-form').bind('submit', function(e) {
	e.preventDefault();
	var id = $("#id").val();
	var action = id == "" ? "<?=Url::toRoute('game-cmd/create')?>" : "<?=Url::toRoute('game-cmd/update')?>";
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