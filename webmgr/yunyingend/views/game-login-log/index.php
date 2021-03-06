
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;

use backend\models\GameLoginLog;
use backend\widgets\SearchFormCommonField;
$modelLabel = new \backend\models\GameLoginLog();
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
                <?php ActiveForm::begin(['id' => 'game-login-log-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('game-login-log/index')]); ?>     
                
                  <?=SearchFormCommonField::widget()?>

                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('account')?>:</label>
                      <input type="text" class="form-control" id="query[account]" name="query[account]"  value="<?=isset($query["account"]) ? $query["account"] : "" ?>">
                  </div>
                  
                  <div class="form-group" style="margin: 5px;">
                      <label>角色ID</label>
                      <input type="text" class="form-control" id="query[charid]" name="query[charid]"  value="<?=isset($query["charid"]) ? $query["charid"] : "" ?>">
                  </div>

                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('charname')?>:</label>
                      <input type="text" class="form-control" id="query[charname]" name="query[charname]"  value="<?=isset($query["charname"]) ? $query["charname"] : "" ?>">
                  </div>

                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('logdate')?>:</label>
                      <input type="text" class="form-control date" id="query[logdate]" name="query[logdate]"  value="<?=isset($query["logdate"]) ? $query["logdate"] : "" ?>">
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
              echo '<th onclick="orderby(\'server\', \'desc\')" '.CommonFun::sortClass($orderby, 'server').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('server').'</th>';
              echo '<th onclick="orderby(\'account\', \'desc\')" '.CommonFun::sortClass($orderby, 'account').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('account').'</th>';
              echo '<th onclick="orderby(\'spid\', \'desc\')" '.CommonFun::sortClass($orderby, 'spid').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('spid').'</th>';
              echo '<th onclick="orderby(\'charname\', \'desc\')" '.CommonFun::sortClass($orderby, 'charname').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('charname').'</th>';
              echo '<th onclick="orderby(\'platform\', \'desc\')" '.CommonFun::sortClass($orderby, 'platform').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('platform').'</th>';
              echo '<th onclick="orderby(\'ipaddr\', \'desc\')" '.CommonFun::sortClass($orderby, 'ipaddr').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('ipaddr').'</th>';
              echo '<th onclick="orderby(\'macaddr\', \'desc\')" '.CommonFun::sortClass($orderby, 'macaddr').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('macaddr').'</th>';
              echo '<th onclick="orderby(\'cversion\', \'desc\')" '.CommonFun::sortClass($orderby, 'cversion').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('cversion').'</th>';
              echo '<th onclick="orderby(\'createserver\', \'desc\')" '.CommonFun::sortClass($orderby, 'createserver').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('createserver').'</th>';
              echo '<th onclick="orderby(\'logdate\', \'desc\')" '.CommonFun::sortClass($orderby, 'logdate').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('logdate').'</th>';
         
			?>
	
            </tr>
            </thead>
            <tbody>
            
            <?php
            foreach ($models as $model) {
                echo '<tr id="rowid_">';
                echo '  <td>' . $model->server . '</td>';
                echo '  <td>' . $model->account . '</td>';
                echo '  <td>' . $model->spid . '</td>';
                echo '  <td>' . $model->charname . '</td>';
                echo '  <td>' . $model->platform . '</td>';
                echo '  <td>' . $model->ipaddr . '</td>';
                echo '  <td>' . $model->macaddr . '</td>';
                echo '  <td>' . $model->cversion . '</td>';
                echo '  <td>' . $model->createserver . '</td>';
                echo '  <td>' . $model->logdate . '</td>';
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
                <?php $form = ActiveForm::begin(["id" => "game-login-log-form", "class"=>"form-horizontal", "action"=>Url::toRoute("game-login-log/save")]); ?>                      
                 
          <input type="hidden" class="form-control" id="server" name="server" />

          <div id="account_div" class="form-group">
              <label for="account" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("account")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="account" name="GameLoginLog[account]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="spid_div" class="form-group">
              <label for="spid" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("spid")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="spid" name="GameLoginLog[spid]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="sbid_div" class="form-group">
              <label for="sbid" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("sbid")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="sbid" name="GameLoginLog[sbid]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="charname_div" class="form-group">
              <label for="charname" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("charname")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="charname" name="GameLoginLog[charname]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="platform_div" class="form-group">
              <label for="platform" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("platform")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="platform" name="GameLoginLog[platform]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="ipaddr_div" class="form-group">
              <label for="ipaddr" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("ipaddr")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="ipaddr" name="GameLoginLog[ipaddr]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="macaddr_div" class="form-group">
              <label for="macaddr" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("macaddr")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="macaddr" name="GameLoginLog[macaddr]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="cversion_div" class="form-group">
              <label for="cversion" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("cversion")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="cversion" name="GameLoginLog[cversion]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="createserver_div" class="form-group">
              <label for="createserver" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("createserver")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="createserver" name="GameLoginLog[createserver]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="logdate_div" class="form-group">
              <label for="logdate" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("logdate")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="logdate" name="GameLoginLog[logdate]" placeholder="必填" />
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
		$('#game-login-log-search-form').submit();
	}
 function viewAction(id){
		initModel(id, 'view', 'fun');
	}

 function initEditSystemModule(data, type){
	if(type == 'create'){
		$("#server").val('');
		$("#account").val('');
		$("#spid").val('');
		$("#sbid").val('');
		$("#charname").val('');
		$("#platform").val('');
		$("#ipaddr").val('');
		$("#macaddr").val('');
		$("#cversion").val('');
		$("#createserver").val('');
		$("#logdate").val('');
		
	}
	else{
		$("#server").val(data.server);
    	$("#account").val(data.account);
    	$("#spid").val(data.spid);
    	$("#sbid").val(data.sbid);
    	$("#charname").val(data.charname);
    	$("#platform").val(data.platform);
    	$("#ipaddr").val(data.ipaddr);
    	$("#macaddr").val(data.macaddr);
    	$("#cversion").val(data.cversion);
    	$("#createserver").val(data.createserver);
    	$("#logdate").val(data.logdate);
    	}
	if(type == "view"){
      $("#server").attr({readonly:true,disabled:true});
      $("#account").attr({readonly:true,disabled:true});
      $("#spid").attr({readonly:true,disabled:true});
      $("#sbid").attr({readonly:true,disabled:true});
      $("#charname").attr({readonly:true,disabled:true});
      $("#platform").attr({readonly:true,disabled:true});
      $("#ipaddr").attr({readonly:true,disabled:true});
      $("#macaddr").attr({readonly:true,disabled:true});
      $("#cversion").attr({readonly:true,disabled:true});
      $("#createserver").attr({readonly:true,disabled:true});
      $("#logdate").attr({readonly:true,disabled:true});
	$('#edit_dialog_ok').addClass('hidden');
	}
	else{
      $("#server").attr({readonly:false,disabled:false});
      $("#account").attr({readonly:false,disabled:false});
      $("#spid").attr({readonly:false,disabled:false});
      $("#sbid").attr({readonly:false,disabled:false});
      $("#charname").attr({readonly:false,disabled:false});
      $("#platform").attr({readonly:false,disabled:false});
      $("#ipaddr").attr({readonly:false,disabled:false});
      $("#macaddr").attr({readonly:false,disabled:false});
      $("#cversion").attr({readonly:false,disabled:false});
      $("#createserver").attr({readonly:false,disabled:false});
      $("#logdate").attr({readonly:false,disabled:false});
		$('#edit_dialog_ok').removeClass('hidden');
		}
		$('#edit_dialog').modal('show');
}

function initModel(id, type, fun){
	
	$.ajax({
		   type: "GET",
		   url: "<?=Url::toRoute('game-login-log/view')?>",
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
				   url: "<?=Url::toRoute('game-login-log/delete')?>",
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
	$('#game-login-log-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#game-login-log-form').bind('submit', function(e) {
	e.preventDefault();
	var id = $("#id").val();
	var action = id == "" ? "<?=Url::toRoute('game-login-log/create')?>" : "<?=Url::toRoute('game-login-log/update')?>";
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