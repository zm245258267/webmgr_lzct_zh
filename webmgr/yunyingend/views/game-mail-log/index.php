
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;

use backend\models\GameMailLog;

$modelLabel = new \backend\models\GameMailLog();
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
                <?php ActiveForm::begin(['id' => 'game-mail-log-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('game-mail-log/index')]); ?>     
                
                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('id')?>:</label>
                      <input type="text" class="form-control" id="query[id]" name="query[id]"  value="<?=isset($query["id"]) ? $query["id"] : "" ?>">
                  </div>

                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('type')?>:</label>
                      <input type="text" class="form-control" id="query[type]" name="query[type]"  value="<?=isset($query["type"]) ? $query["type"] : "" ?>">
                  </div>

                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('server_id')?>:</label>
                      <input type="text" class="form-control" id="query[server_id]" name="query[server_id]"  value="<?=isset($query["server_id"]) ? $query["server_id"] : "" ?>">
                  </div>

                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('status')?>:</label>
                      <input type="text" class="form-control" id="query[status]" name="query[status]"  value="<?=isset($query["status"]) ? $query["status"] : "" ?>">
                  </div>

                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('record_user')?>:</label>
                      <input type="text" class="form-control" id="query[record_user]" name="query[record_user]"  value="<?=isset($query["record_user"]) ? $query["record_user"] : "" ?>">
                  </div>

                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('update_user')?>:</label>
                      <input type="text" class="form-control" id="query[update_user]" name="query[update_user]"  value="<?=isset($query["update_user"]) ? $query["update_user"] : "" ?>">
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
              echo '<th onclick="orderby(\'title\', \'desc\')" '.CommonFun::sortClass($orderby, 'title').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('title').'</th>';
              echo '<th onclick="orderby(\'content\', \'desc\')" '.CommonFun::sortClass($orderby, 'content').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('content').'</th>';
              echo '<th onclick="orderby(\'type\', \'desc\')" '.CommonFun::sortClass($orderby, 'type').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('type').'</th>';
              echo '<th onclick="orderby(\'type_value\', \'desc\')" '.CommonFun::sortClass($orderby, 'type_value').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('type_value').'</th>';
              echo '<th onclick="orderby(\'server_id\', \'desc\')" '.CommonFun::sortClass($orderby, 'server_id').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('server_id').'</th>';
              echo '<th onclick="orderby(\'spid\', \'desc\')" '.CommonFun::sortClass($orderby, 'spid').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('spid').'</th>';
              echo '<th onclick="orderby(\'sbid\', \'desc\')" '.CommonFun::sortClass($orderby, 'sbid').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('sbid').'</th>';
              echo '<th onclick="orderby(\'attach\', \'desc\')" '.CommonFun::sortClass($orderby, 'attach').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('attach').'</th>';
              echo '<th onclick="orderby(\'status\', \'desc\')" '.CommonFun::sortClass($orderby, 'status').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('status').'</th>';
              echo '<th onclick="orderby(\'notes\', \'desc\')" '.CommonFun::sortClass($orderby, 'notes').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('notes').'</th>';
              echo '<th onclick="orderby(\'record_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'record_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('record_time').'</th>';
              echo '<th onclick="orderby(\'record_user\', \'desc\')" '.CommonFun::sortClass($orderby, 'record_user').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('record_user').'</th>';
              echo '<th onclick="orderby(\'update_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'update_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('update_time').'</th>';
              echo '<th onclick="orderby(\'update_user\', \'desc\')" '.CommonFun::sortClass($orderby, 'update_user').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('update_user').'</th>';
              echo '<th onclick="orderby(\'send_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'send_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('send_time').'</th>';
              echo '<th onclick="orderby(\'send_user\', \'desc\')" '.CommonFun::sortClass($orderby, 'send_user').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('send_user').'</th>';
              echo '<th onclick="orderby(\'result\', \'desc\')" '.CommonFun::sortClass($orderby, 'result').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('result').'</th>';
         
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
                echo '  <td title="'.$model->title.'"><div>' . $model->title . '</div></td>';
                echo '  <td title="'.$model->content.'"><div>' . $model->content . '</div></td>';
                echo '  <td>' . $model->type . '</td>';
                echo '  <td title="'.$model->type_value.'"><div>' . $model->type_value . '</div></td>';
                echo '  <td>' . $model->server_id . '</td>';
                echo '  <td>' . $model->spid . '</td>';
                echo '  <td>' . $model->sbid . '</td>';
                echo '  <td title="'.$model->attach.'"><div>' . $model->attach . '</div></td>';
                echo '  <td>' . $model->status . '</td>';
                echo '  <td title="'.$model->notes.'"><div>' . $model->notes . '</div></td>';
                echo '  <td>' . $model->record_time . '</td>';
                echo '  <td>' . $model->record_user . '</td>';
                echo '  <td>' . $model->update_time . '</td>';
                echo '  <td>' . $model->update_user . '</td>';
                echo '  <td>' . $model->send_time . '</td>';
                echo '  <td>' . $model->send_user . '</td>';
                echo '  <td>' . $model->result . '</td>';
                echo '  <td class="center">';
                echo '      <a id="view_btn" onclick="viewAction(' . $model->id . ')" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>查看</a>';
//                 echo '      <a id="edit_btn" onclick="editAction(' . $model->id . ')" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-edit icon-white"></i>修改</a>';
//                 echo '      <a id="delete_btn" onclick="deleteAction(' . $model->id . ')" class="btn btn-danger btn-sm" href="#"> <i class="glyphicon glyphicon-trash icon-white"></i>删除</a>';
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
                <?php $form = ActiveForm::begin(["id" => "game-mail-log-form", "class"=>"form-horizontal", "action"=>Url::toRoute("game-mail-log/save")]); ?>                      
                 
          <input type="hidden" class="form-control" id="id" name="id" />

          <div id="title_div" class="form-group">
              <label for="title" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("title")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="title" name="GameMailLog[title]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="content_div" class="form-group">
              <label for="content" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("content")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="content" name="GameMailLog[content]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="type_div" class="form-group">
              <label for="type" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("type")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="type" name="GameMailLog[type]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="type_value_div" class="form-group">
              <label for="type_value" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("type_value")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="type_value" name="GameMailLog[type_value]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="server_id_div" class="form-group">
              <label for="server_id" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("server_id")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="server_id" name="GameMailLog[server_id]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="spid_div" class="form-group">
              <label for="spid" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("spid")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="spid" name="GameMailLog[spid]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="sbid_div" class="form-group">
              <label for="sbid" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("sbid")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="sbid" name="GameMailLog[sbid]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="attach_div" class="form-group">
              <label for="attach" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("attach")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="attach" name="GameMailLog[attach]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="status_div" class="form-group">
              <label for="status" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("status")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="status" name="GameMailLog[status]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="notes_div" class="form-group">
              <label for="notes" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("notes")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="notes" name="GameMailLog[notes]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="record_time_div" class="form-group">
              <label for="record_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("record_time")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="record_time" name="GameMailLog[record_time]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="record_user_div" class="form-group">
              <label for="record_user" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("record_user")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="record_user" name="GameMailLog[record_user]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="update_time_div" class="form-group">
              <label for="update_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("update_time")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="update_time" name="GameMailLog[update_time]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="update_user_div" class="form-group">
              <label for="update_user" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("update_user")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="update_user" name="GameMailLog[update_user]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="send_time_div" class="form-group">
              <label for="sned_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("send_time")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="send_time" name="GameMailLog[send_time]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="send_user_div" class="form-group">
              <label for="send_user" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("send_user")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="send_user" name="GameMailLog[send_user]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="result_div" class="form-group">
              <label for="result" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("result")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="result" name="GameMailLog[result]" placeholder="" />
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
		$('#game-mail-log-search-form').submit();
	}
 function viewAction(id){
		initModel(id, 'view', 'fun');
	}

 function initEditSystemModule(data, type){
	if(type == 'create'){
		$("#id").val('');
		$("#title").val('');
		$("#content").val('');
		$("#type").val('');
		$("#type_value").val('');
		$("#server_id").val('');
		$("#spid").val('');
		$("#sbid").val('');
		$("#attach").val('');
		$("#status").val('');
		$("#notes").val('');
		$("#record_time").val('');
		$("#record_user").val('');
		$("#update_time").val('');
		$("#update_user").val('');
		
	}
	else{
		$("#id").val(data.id);
    	$("#title").val(data.title);
    	$("#content").val(data.content);
    	$("#type").val(data.type);
    	$("#type_value").val(data.type_value);
    	$("#server_id").val(data.server_id);
    	$("#spid").val(data.spid);
    	$("#sbid").val(data.sbid);
    	$("#attach").val(data.attach);
    	$("#status").val(data.status);
    	$("#notes").val(data.notes);
    	$("#record_time").val(data.record_time);
    	$("#record_user").val(data.record_user);
    	$("#update_time").val(data.update_time);
    	$("#update_user").val(data.update_user);
    	$("#send_time").val(data.send_time);
    	$("#send_user").val(data.send_user);
    	$("#result").val(data.result);
    	}
	if(type == "view"){
      $("#id").attr({readonly:true,disabled:true});
      $("#title").attr({readonly:true,disabled:true});
      $("#content").attr({readonly:true,disabled:true});
      $("#type").attr({readonly:true,disabled:true});
      $("#type_value").attr({readonly:true,disabled:true});
      $("#server_id").attr({readonly:true,disabled:true});
      $("#spid").attr({readonly:true,disabled:true});
      $("#sbid").attr({readonly:true,disabled:true});
      $("#attach").attr({readonly:true,disabled:true});
      $("#status").attr({readonly:true,disabled:true});
      $("#notes").attr({readonly:true,disabled:true});
      $("#record_time").attr({readonly:true,disabled:true});
      $("#record_time").parent().parent().show();
      $("#record_user").attr({readonly:true,disabled:true});
      $("#record_user").parent().parent().show();
      $("#update_time").attr({readonly:true,disabled:true});
      $("#update_time").parent().parent().show();
      $("#update_user").attr({readonly:true,disabled:true});
      $("#update_user").parent().parent().show();
      $("#send_time").attr({readonly:true,disabled:true});
      $("#send_time").parent().parent().show();
      $("#send_user").attr({readonly:true,disabled:true});
      $("#send_user").parent().parent().show();
      $("#result").attr({readonly:true,disabled:true});
      $("#result").parent().parent().show();
	$('#edit_dialog_ok').addClass('hidden');
	}
	else{
      $("#id").attr({readonly:false,disabled:false});
      $("#title").attr({readonly:false,disabled:false});
      $("#content").attr({readonly:false,disabled:false});
      $("#type").attr({readonly:false,disabled:false});
      $("#type_value").attr({readonly:false,disabled:false});
      $("#server_id").attr({readonly:false,disabled:false});
      $("#spid").attr({readonly:false,disabled:false});
      $("#sbid").attr({readonly:false,disabled:false});
      $("#attach").attr({readonly:false,disabled:false});
      $("#status").attr({readonly:false,disabled:false});
      $("#notes").attr({readonly:false,disabled:false});
      $("#record_time").attr({readonly:false,disabled:false});
      $("#record_time").parent().parent().hide();
      $("#record_user").attr({readonly:false,disabled:false});
      $("#record_user").parent().parent().hide();
      $("#update_time").attr({readonly:false,disabled:false});
      $("#update_time").parent().parent().hide();
      $("#update_user").attr({readonly:false,disabled:false});
      $("#update_user").parent().parent().hide();
		$('#edit_dialog_ok').removeClass('hidden');
		}
		$('#edit_dialog').modal('show');
}

function initModel(id, type, fun){
	
	$.ajax({
		   type: "GET",
		   url: "<?=Url::toRoute('game-mail-log/view')?>",
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
				   url: "<?=Url::toRoute('game-mail-log/delete')?>",
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
	$('#game-mail-log-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#game-mail-log-form').bind('submit', function(e) {
	e.preventDefault();
	var id = $("#id").val();
	var action = id == "" ? "<?=Url::toRoute('game-mail-log/create')?>" : "<?=Url::toRoute('game-mail-log/update')?>";
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