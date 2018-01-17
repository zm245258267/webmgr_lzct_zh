
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;

use backend\models\GameUserReport;
use backend\widgets\SearchFormCommonField;
use yii\base\Widget;

$modelLabel = new \backend\models\GameUserReport();
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
                <?php ActiveForm::begin(['id' => 'game-user-report-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('game-user-report/index')]); ?>     
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
          	<div class="col-sm-12 table-responsive">
          	<table id="data_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="data_table_info">
            <thead>
            <tr role="row">
            
            <?php 
              $orderby = isset($_GET['orderby']) ? $_GET['orderby'] : '';
              echo '<th onclick="orderby(\'state\', \'desc\')" '.CommonFun::sortClass($orderby, 'state').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >状态</th>';
              echo '<th onclick="orderby(\'totalDevice\', \'desc\')" '.CommonFun::sortClass($orderby, 'totalDevice').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >设备数</th>';
			?>
	
            </tr>
            </thead>
            <tbody>
            
            <?php
            foreach ($dataSet as $id=>$totalDevice) {
                echo '<tr id="rowid_">';
                echo '  <td title="'.$id.'">' . CommonFun::stateToName($id) . '</td>';
                echo '  <td>' . $totalDevice . '</td>';
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

<div class="modal fade" id="edit_dialog" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
                <?php $form = ActiveForm::begin(["id" => "game-user-report-form", "class"=>"form-horizontal", "action"=>Url::toRoute("game-user-report/save")]); ?>                      
                 
          <input type="hidden" class="form-control" id="id" name="id" />

          <div id="state_div" class="form-group">
              <label for="state" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("state")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="state" name="GameUserReport[state]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="value_div" class="form-group">
              <label for="value" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("value")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="value" name="GameUserReport[value]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="firststate_div" class="form-group">
              <label for="firststate" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("firststate")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="firststate" name="GameUserReport[firststate]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="firstvalue_div" class="form-group">
              <label for="firstvalue" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("firstvalue")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="firstvalue" name="GameUserReport[firstvalue]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="serverid_div" class="form-group">
              <label for="serverid" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("serverid")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="serverid" name="GameUserReport[serverid]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="userid_div" class="form-group">
              <label for="userid" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("userid")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="userid" name="GameUserReport[userid]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="devname_div" class="form-group">
              <label for="devname" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("devname")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="devname" name="GameUserReport[devname]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="sysname_div" class="form-group">
              <label for="sysname" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("sysname")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="sysname" name="GameUserReport[sysname]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="sysver_div" class="form-group">
              <label for="sysver" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("sysver")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="sysver" name="GameUserReport[sysver]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="cver_div" class="form-group">
              <label for="cver" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("cver")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="cver" name="GameUserReport[cver]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="spid_div" class="form-group">
              <label for="spid" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("spid")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="spid" name="GameUserReport[spid]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="sbid_div" class="form-group">
              <label for="sbid" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("sbid")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="sbid" name="GameUserReport[sbid]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="createdate_div" class="form-group">
              <label for="createdate" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("createdate")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="createdate" name="GameUserReport[createdate]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="logdate_div" class="form-group">
              <label for="logdate" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("logdate")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="logdate" name="GameUserReport[logdate]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="firstlogdate_div" class="form-group">
              <label for="firstlogdate" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("firstlogdate")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="firstlogdate" name="GameUserReport[firstlogdate]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="dups_div" class="form-group">
              <label for="dups" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("dups")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="dups" name="GameUserReport[dups]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="stage_div" class="form-group">
              <label for="stage" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("stage")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="stage" name="GameUserReport[stage]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="extrainfo_div" class="form-group">
              <label for="extrainfo" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("extrainfo")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="extrainfo" name="GameUserReport[extrainfo]" placeholder="" />
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
		$('#game-user-report-search-form').submit();
	}
 function viewAction(id){
		initModel(id, 'view', 'fun');
	}

 function initEditSystemModule(data, type){
	if(type == 'create'){
		$("#id").val('');
		$("#state").val('');
		$("#value").val('');
		$("#firststate").val('');
		$("#firstvalue").val('');
		$("#serverid").val('');
		$("#userid").val('');
		$("#devname").val('');
		$("#sysname").val('');
		$("#sysver").val('');
		$("#cver").val('');
		$("#spid").val('');
		$("#sbid").val('');
		$("#createdate").val('');
		$("#logdate").val('');
		$("#firstlogdate").val('');
		$("#dups").val('');
		$("#stage").val('');
		$("#extrainfo").val('');
		
	}
	else{
		$("#id").val(data.id);
    	$("#state").val(data.state);
    	$("#value").val(data.value);
    	$("#firststate").val(data.firststate);
    	$("#firstvalue").val(data.firstvalue);
    	$("#serverid").val(data.serverid);
    	$("#userid").val(data.userid);
    	$("#devname").val(data.devname);
    	$("#sysname").val(data.sysname);
    	$("#sysver").val(data.sysver);
    	$("#cver").val(data.cver);
    	$("#spid").val(data.spid);
    	$("#sbid").val(data.sbid);
    	$("#createdate").val(data.createdate);
    	$("#logdate").val(data.logdate);
    	$("#firstlogdate").val(data.firstlogdate);
    	$("#dups").val(data.dups);
    	$("#stage").val(data.stage);
    	$("#extrainfo").val(data.extrainfo);
    	}
	if(type == "view"){
      $("#id").attr({readonly:true,disabled:true});
      $("#state").attr({readonly:true,disabled:true});
      $("#value").attr({readonly:true,disabled:true});
      $("#firststate").attr({readonly:true,disabled:true});
      $("#firstvalue").attr({readonly:true,disabled:true});
      $("#serverid").attr({readonly:true,disabled:true});
      $("#userid").attr({readonly:true,disabled:true});
      $("#devname").attr({readonly:true,disabled:true});
      $("#sysname").attr({readonly:true,disabled:true});
      $("#sysver").attr({readonly:true,disabled:true});
      $("#cver").attr({readonly:true,disabled:true});
      $("#spid").attr({readonly:true,disabled:true});
      $("#sbid").attr({readonly:true,disabled:true});
      $("#createdate").attr({readonly:true,disabled:true});
      $("#logdate").attr({readonly:true,disabled:true});
      $("#firstlogdate").attr({readonly:true,disabled:true});
      $("#dups").attr({readonly:true,disabled:true});
      $("#stage").attr({readonly:true,disabled:true});
      $("#extrainfo").attr({readonly:true,disabled:true});
	$('#edit_dialog_ok').addClass('hidden');
	}
	else{
      $("#id").attr({readonly:false,disabled:false});
      $("#state").attr({readonly:false,disabled:false});
      $("#value").attr({readonly:false,disabled:false});
      $("#firststate").attr({readonly:false,disabled:false});
      $("#firstvalue").attr({readonly:false,disabled:false});
      $("#serverid").attr({readonly:false,disabled:false});
      $("#userid").attr({readonly:false,disabled:false});
      $("#devname").attr({readonly:false,disabled:false});
      $("#sysname").attr({readonly:false,disabled:false});
      $("#sysver").attr({readonly:false,disabled:false});
      $("#cver").attr({readonly:false,disabled:false});
      $("#spid").attr({readonly:false,disabled:false});
      $("#sbid").attr({readonly:false,disabled:false});
      $("#createdate").attr({readonly:false,disabled:false});
      $("#logdate").attr({readonly:false,disabled:false});
      $("#firstlogdate").attr({readonly:false,disabled:false});
      $("#dups").attr({readonly:false,disabled:false});
      $("#stage").attr({readonly:false,disabled:false});
      $("#extrainfo").attr({readonly:false,disabled:false});
		$('#edit_dialog_ok').removeClass('hidden');
		}
		$('#edit_dialog').modal('show');
}

function initModel(id, type, fun){
	
	$.ajax({
		   type: "GET",
		   url: "<?=Url::toRoute('game-user-report/view')?>",
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
				   url: "<?=Url::toRoute('game-user-report/delete')?>",
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
	$('#game-user-report-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#game-user-report-form').bind('submit', function(e) {
	e.preventDefault();
	var id = $("#id").val();
	var action = id == "" ? "<?=Url::toRoute('game-user-report/create')?>" : "<?=Url::toRoute('game-user-report/update')?>";
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