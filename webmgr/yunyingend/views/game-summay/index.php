
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;
use backend\widgets\SearchFormCommonField;

use backend\models\GameSummary;

$modelLabel = new \backend\models\GameSummary();
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
                <?php ActiveForm::begin(['id' => 'game-summay-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('game-summay/index')]); ?>     
                
                  <!-- 
                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('id')?>:</label>
                      <input type="text" class="form-control" id="query[id]" name="query[id]"  value="<?=isset($query["id"]) ? $query["id"] : "" ?>">
                  </div>
                   -->

                  <?=SearchFormCommonField::widget()?>

                  <!-- 
                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('spid')?>:</label>
                      <input type="text" class="form-control" id="query[spid]" name="query[spid]"  value="<?=isset($query["spid"]) ? $query["spid"] : "" ?>">
                  </div>
                   -->

                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('date')?>:</label>
                      <input type="text" class="form-control date" id="query[date]" name="query[date]"  value="<?=isset($query["date"]) ? $query["date"] : "" ?>">
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
              echo '<th onclick="orderby(\'id\', \'desc\')" '.CommonFun::sortClass($orderby, 'id').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('id').'</th>';
              echo '<th onclick="orderby(\'serverid\', \'desc\')" '.CommonFun::sortClass($orderby, 'serverid').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('serverid').'</th>';
              echo '<th onclick="orderby(\'spid\', \'desc\')" '.CommonFun::sortClass($orderby, 'spid').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('spid').'</th>';
              echo '<th onclick="orderby(\'total_reg\', \'desc\')" '.CommonFun::sortClass($orderby, 'total_reg').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('total_reg').'</th>';
              echo '<th onclick="orderby(\'total_max_online\', \'desc\')" '.CommonFun::sortClass($orderby, 'total_max_online').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('total_max_online').'</th>';
              echo '<th onclick="orderby(\'total_charnge_mony\', \'desc\')" '.CommonFun::sortClass($orderby, 'total_charnge_mony').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('total_charnge_mony').'</th>';
              echo '<th onclick="orderby(\'total_charge_person\', \'desc\')" '.CommonFun::sortClass($orderby, 'total_charge_person').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('total_charge_person').'</th>';
              echo '<th onclick="orderby(\'total_login\', \'desc\')" '.CommonFun::sortClass($orderby, 'total_login').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('total_login').'</th>';
              echo '<th onclick="orderby(\'date\', \'desc\')" '.CommonFun::sortClass($orderby, 'date').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('date').'</th>';
              echo '<th onclick="orderby(\'update_time\', \'desc\')" '.CommonFun::sortClass($orderby, 'update_time').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('update_time').'</th>';
         
			?>
	
            </tr>
            </thead>
            <tbody>
            
            <?php
            foreach ($models as $model) {
                echo '<tr id="rowid_' . $model->id . '">';
                echo '  <td>' . $model->id . '</td>';
                echo '  <td>' . $model->serverid . '</td>';
                echo '  <td>' . $model->spid . '</td>';
                echo '  <td>' . $model->total_reg . '</td>';
                echo '  <td>' . $model->total_max_online . '</td>';
                echo '  <td>' . $model->total_charnge_mony . '</td>';
                echo '  <td>' . $model->total_charge_person . '</td>';
                echo '  <td>' . $model->total_login . '</td>';
                echo '  <td>' . $model->date . '</td>';
                echo '  <td>' . $model->update_time . '</td>';
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
                <?php $form = ActiveForm::begin(["id" => "game-summay-form", "class"=>"form-horizontal", "action"=>Url::toRoute("game-summay/save")]); ?>                      
                 
          <input type="hidden" class="form-control" id="id" name="id" />

          <div id="serverid_div" class="form-group">
              <label for="serverid" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("serverid")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="serverid" name="GameSummary[serverid]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="spid_div" class="form-group">
              <label for="spid" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("spid")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="spid" name="GameSummary[spid]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="total_reg_div" class="form-group">
              <label for="total_reg" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("total_reg")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="total_reg" name="GameSummary[total_reg]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="total_max_online_div" class="form-group">
              <label for="total_max_online" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("total_max_online")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="total_max_online" name="GameSummary[total_max_online]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="total_charnge_mony_div" class="form-group">
              <label for="total_charnge_mony" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("total_charnge_mony")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="total_charnge_mony" name="GameSummary[total_charnge_mony]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="total_charge_person_div" class="form-group">
              <label for="total_charge_person" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("total_charge_person")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="total_charge_person" name="GameSummary[total_charge_person]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="total_login_div" class="form-group">
              <label for="total_login" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("total_login")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="total_login" name="GameSummary[total_login]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="date_div" class="form-group">
              <label for="date" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("date")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="date" name="GameSummary[date]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="update_time_div" class="form-group">
              <label for="update_time" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("update_time")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="update_time" name="GameSummary[update_time]" placeholder="必填" />
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
		$('#game-summay-search-form').submit();
	}
 function viewAction(id){
		initModel(id, 'view', 'fun');
	}

 function initEditSystemModule(data, type){
	if(type == 'create'){
		$("#id").val('');
		$("#serverid").val('');
		$("#spid").val('');
		$("#total_reg").val('');
		$("#total_max_online").val('');
		$("#total_charnge_mony").val('');
		$("#total_charge_person").val('');
		$("#total_login").val('');
		$("#date").val('');
		$("#update_time").val('');
		
	}
	else{
		$("#id").val(data.id);
    	$("#serverid").val(data.serverid);
    	$("#spid").val(data.spid);
    	$("#total_reg").val(data.total_reg);
    	$("#total_max_online").val(data.total_max_online);
    	$("#total_charnge_mony").val(data.total_charnge_mony);
    	$("#total_charge_person").val(data.total_charge_person);
    	$("#total_login").val(data.total_login);
    	$("#date").val(data.date);
    	$("#update_time").val(data.update_time);
    	}
	if(type == "view"){
      $("#id").attr({readonly:true,disabled:true});
      $("#serverid").attr({readonly:true,disabled:true});
      $("#spid").attr({readonly:true,disabled:true});
      $("#total_reg").attr({readonly:true,disabled:true});
      $("#total_max_online").attr({readonly:true,disabled:true});
      $("#total_charnge_mony").attr({readonly:true,disabled:true});
      $("#total_charge_person").attr({readonly:true,disabled:true});
      $("#total_login").attr({readonly:true,disabled:true});
      $("#date").attr({readonly:true,disabled:true});
      $("#update_time").attr({readonly:true,disabled:true});
	$('#edit_dialog_ok').addClass('hidden');
	}
	else{
      $("#id").attr({readonly:false,disabled:false});
      $("#serverid").attr({readonly:false,disabled:false});
      $("#spid").attr({readonly:false,disabled:false});
      $("#total_reg").attr({readonly:false,disabled:false});
      $("#total_max_online").attr({readonly:false,disabled:false});
      $("#total_charnge_mony").attr({readonly:false,disabled:false});
      $("#total_charge_person").attr({readonly:false,disabled:false});
      $("#total_login").attr({readonly:false,disabled:false});
      $("#date").attr({readonly:false,disabled:false});
      $("#update_time").attr({readonly:false,disabled:false});
		$('#edit_dialog_ok').removeClass('hidden');
		}
		$('#edit_dialog').modal('show');
}

function initModel(id, type, fun){
	
	$.ajax({
		   type: "GET",
		   url: "<?=Url::toRoute('game-summay/view')?>",
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
				   url: "<?=Url::toRoute('game-summay/delete')?>",
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
	$('#game-summay-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#game-summay-form').bind('submit', function(e) {
	e.preventDefault();
	var id = $("#id").val();
	var action = id == "" ? "<?=Url::toRoute('game-summay/create')?>" : "<?=Url::toRoute('game-summay/update')?>";
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