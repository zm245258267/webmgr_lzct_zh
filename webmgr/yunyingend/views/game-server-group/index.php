
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;

use backend\models\GameServerGroup;

$modelLabel = new \backend\models\GameServerGroup();
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
                <?php ActiveForm::begin(['id' => 'game-server-group-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('game-server-group/index')]); ?>     
                
                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('pid')?>:</label>
                      <input type="text" class="form-control" id="query[pid]" name="query[pid]"  value="<?=isset($query["pid"]) ? $query["pid"] : "" ?>">
                  </div>

                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('groupName')?>:</label>
                      <input type="text" class="form-control" id="query[groupName]" name="query[groupName]"  value="<?=isset($query["groupName"]) ? $query["groupName"] : "" ?>">
                  </div>

                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('spids')?>:</label>
                      <input type="text" class="form-control" id="query[spids]" name="query[spids]"  value="<?=isset($query["spids"]) ? $query["spids"] : "" ?>">
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
              echo '<th onclick="orderby(\'groupId\', \'desc\')" '.CommonFun::sortClass($orderby, 'groupId').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('groupId').'</th>';
              echo '<th onclick="orderby(\'pid\', \'desc\')" '.CommonFun::sortClass($orderby, 'pid').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('pid').'</th>';
              echo '<th onclick="orderby(\'groupName\', \'desc\')" '.CommonFun::sortClass($orderby, 'groupName').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('groupName').'</th>';
              echo '<th onclick="orderby(\'spids\', \'desc\')" '.CommonFun::sortClass($orderby, 'spids').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('spids').'</th>';
              echo '<th onclick="orderby(\'cversion_higher\', \'desc\')" '.CommonFun::sortClass($orderby, 'cversion_higher').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('cversion_higher').'</th>';
              echo '<th onclick="orderby(\'cversion_lower\', \'desc\')" '.CommonFun::sortClass($orderby, 'cversion_lower').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('cversion_lower').'</th>';
              echo '<th onclick="orderby(\'notes\', \'desc\')" '.CommonFun::sortClass($orderby, 'notes').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('notes').'</th>';
         
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
                echo '  <td>' . $model->groupId . '</td>';
                echo '  <td>' . $model->pid . '</td>';
                echo '  <td>' . $model->groupName . '</td>';
                echo '  <td>' . $model->spids . '</td>';
                echo '  <td>' . $model->cversion_higher . '</td>';
                echo '  <td>' . $model->cversion_lower . '</td>';
                echo '  <td>' . $model->notes . '</td>';
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
                <?php $form = ActiveForm::begin(["id" => "game-server-group-form", "class"=>"form-horizontal", "action"=>Url::toRoute("game-server-group/save")]); ?>                      
                 
          <input type="hidden" class="form-control" id="id" name="id" />

          <div id="groupId_div" class="form-group">
              <label for="groupId" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("groupId")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="groupId" name="GameServerGroup[groupId]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="pid_div" class="form-group">
              <label for="pid" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("pid")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="pid" name="GameServerGroup[pid]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="groupName_div" class="form-group">
              <label for="groupName" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("groupName")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="groupName" name="GameServerGroup[groupName]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="spids_div" class="form-group">
              <label for="spids" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("spids")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="spids" name="GameServerGroup[spids]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="cversion_higher_div" class="form-group">
              <label for="cversion_higher" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("cversion_higher")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="cversion_higher" name="GameServerGroup[cversion_higher]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="cversion_lower_div" class="form-group">
              <label for="cversion_lower" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("cversion_lower")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="cversion_lower" name="GameServerGroup[cversion_lower]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="notes_div" class="form-group">
              <label for="notes" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("notes")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="notes" name="GameServerGroup[notes]" placeholder="必填" />
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
		$('#game-server-group-search-form').submit();
	}
 function viewAction(id){
		initModel(id, 'view', 'fun');
	}

 function initEditSystemModule(data, type){
	if(type == 'create'){
		$("#id").val('');
		$("#groupId").val('');
		$("#pid").val('');
		$("#groupName").val('');
		$("#spids").val('');
		$("#cversion_higher").val('');
		$("#cversion_lower").val('');
		$("#notes").val('');
		
	}
	else{
		$("#id").val(data.id);
    	$("#groupId").val(data.groupId);
    	$("#pid").val(data.pid);
    	$("#groupName").val(data.groupName);
    	$("#spids").val(data.spids);
    	$("#cversion_higher").val(data.cversion_higher);
    	$("#cversion_lower").val(data.cversion_lower);
    	$("#notes").val(data.notes);
    	}
	if(type == "view"){
      $("#id").attr({readonly:true,disabled:true});
      $("#id").parent().parent().show();
      $("#groupId").attr({readonly:true,disabled:true});
      $("#pid").attr({readonly:true,disabled:true});
      $("#groupName").attr({readonly:true,disabled:true});
      $("#spids").attr({readonly:true,disabled:true});
      $("#cversion_higher").attr({readonly:true,disabled:true});
      $("#cversion_lower").attr({readonly:true,disabled:true});
      $("#notes").attr({readonly:true,disabled:true});
	$('#edit_dialog_ok').addClass('hidden');
	}
	else{
      $("#id").attr({readonly:false,disabled:false});
      //$("#id").parent().parent().hide();
      $("#groupId").attr({readonly:false,disabled:false});
      $("#pid").attr({readonly:false,disabled:false});
      $("#groupName").attr({readonly:false,disabled:false});
      $("#spids").attr({readonly:false,disabled:false});
      $("#cversion_higher").attr({readonly:false,disabled:false});
      $("#cversion_lower").attr({readonly:false,disabled:false});
      $("#notes").attr({readonly:false,disabled:false});
		$('#edit_dialog_ok').removeClass('hidden');
		}
		$('#edit_dialog').modal('show');
}

function initModel(id, type, fun){
	
	$.ajax({
		   type: "GET",
		   url: "<?=Url::toRoute('game-server-group/view')?>",
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
				   url: "<?=Url::toRoute('game-server-group/delete')?>",
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
	$('#game-server-group-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#game-server-group-form').bind('submit', function(e) {
	e.preventDefault();
	var id = $("#id").val();
	var action = id == "" ? "<?=Url::toRoute('game-server-group/create')?>" : "<?=Url::toRoute('game-server-group/update')?>";
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