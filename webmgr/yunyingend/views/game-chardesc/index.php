
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;

use backend\models\GameChardesc;
use backend\widgets\SearchFormCommonField;
$modelLabel = new \backend\models\GameChardesc();
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
                <?php ActiveForm::begin(['id' => 'game-chardesc-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('game-chardesc/index')]); ?>     
                
                	
                <?=SearchFormCommonField::widget()?>
                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('charid')?>:</label>
                      <input type="text" class="form-control" id="query[charid]" name="query[charid]"  value="<?=isset($query["charid"]) ? $query["charid"] : "" ?>">
                  </div>

                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('account')?>:</label>
                      <input type="text" class="form-control" id="query[account]" name="query[account]"  value="<?=isset($query["account"]) ? $query["account"] : "" ?>">
                  </div>

                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('charname')?>:</label>
                      <input type="text" class="form-control" id="query[charname]" name="query[charname]"  value="<?=isset($query["charname"]) ? $query["charname"] : "" ?>">
                  </div>

                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('charlevel')?>:</label>
                      <input type="text" class="form-control" id="query[charlevel]" name="query[charlevel]"  value="<?=isset($query["charlevel"]) ? $query["charlevel"] : "" ?>">
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
              echo '<th onclick="orderby(\'charid\', \'desc\')" '.CommonFun::sortClass($orderby, 'charid').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('charid').'</th>';
//               echo '<th onclick="orderby(\'userid\', \'desc\')" '.CommonFun::sortClass($orderby, 'userid').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('userid').'</th>';
              echo '<th onclick="orderby(\'account\', \'desc\')" '.CommonFun::sortClass($orderby, 'account').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('account').'</th>';
              echo '<th onclick="orderby(\'charname\', \'desc\')" '.CommonFun::sortClass($orderby, 'charname').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('charname').'</th>';
              echo '<th onclick="orderby(\'spid\', \'desc\')" '.CommonFun::sortClass($orderby, 'spid').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('spid').'</th>';
              echo '<th onclick="orderby(\'serverid\', \'desc\')" '.CommonFun::sortClass($orderby, 'serverid').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('serverid').'</th>';
              echo '<th onclick="orderby(\'countryid\', \'desc\')" '.CommonFun::sortClass($orderby, 'countryid').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('countryid').'</th>';
              echo '<th onclick="orderby(\'charlevel\', \'desc\')" '.CommonFun::sortClass($orderby, 'charlevel').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('charlevel').'</th>';
              echo '<th onclick="orderby(\'castlelevel\', \'desc\')" '.CommonFun::sortClass($orderby, 'castlelevel').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('castlelevel').'</th>';
              echo '<th onclick="orderby(\'gold\', \'desc\')" '.CommonFun::sortClass($orderby, 'gold').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('gold').'</th>';
//               echo '<th onclick="orderby(\'charstate\', \'desc\')" '.CommonFun::sortClass($orderby, 'charstate').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('charstate').'</th>';
              echo '<th onclick="orderby(\'createtime\', \'desc\')" '.CommonFun::sortClass($orderby, 'createtime').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('createtime').'</th>';
              echo '<th onclick="orderby(\'updatetime\', \'desc\')" '.CommonFun::sortClass($orderby, 'updatetime').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('updatetime').'</th>';
         
			?>
	
            </tr>
            </thead>
            <tbody>
            
            <?php
            foreach ($models as $model) {
                echo '<tr id="rowid_">';
                echo '  <td>' . $model->charid . '</td>';
//                 echo '  <td>' . $model->userid . '</td>';
                echo '  <td>' . $model->account . '</td>';
                echo '  <td>' . $model->charname . '</td>';
                echo '  <td title="'.$model->spid.'">' . CommonFun::spIdToName($model->spid) . '</td>';
                echo '  <td>' . $model->serverid . '</td>';
                echo '  <td title="'.$model->countryid.'">' . CommonFun::nationIdToName($model->countryid) . '</td>';
                echo '  <td>' . $model->charlevel . '</td>';
                echo '  <td>' . $model->castlelevel . '</td>';
                echo '  <td>' . $model->gold . '</td>';
//                 echo '  <td>' . $model->charstate . '</td>';
                echo '  <td>' . $model->createtime . '</td>';
                echo '  <td>' . $model->updatetime . '</td>';
                //echo '  <td>' . $model->loginip . '</td>';
                //echo '  <td>' . $model->vipexp . '</td>';
                //echo '  <td>' . $model->firstrechargetime . '</td>';
                //echo '  <td>' . $model->firstrechargelevel . '</td>';
                //echo '  <td>' . $model->totalrecharge . '</td>';
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
                <?php $form = ActiveForm::begin(["id" => "game-chardesc-form", "class"=>"form-horizontal", "action"=>Url::toRoute("game-chardesc/save")]); ?>                      
                 
          <input type="hidden" class="form-control" id="charid" name="charid" />

          <div id="userid_div" class="form-group">
              <label for="userid" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("userid")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="userid" name="GameChardesc[userid]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="account_div" class="form-group">
              <label for="account" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("account")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="account" name="GameChardesc[account]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="charname_div" class="form-group">
              <label for="charname" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("charname")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="charname" name="GameChardesc[charname]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="serverid_div" class="form-group">
              <label for="serverid" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("serverid")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="serverid" name="GameChardesc[serverid]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="charlevel_div" class="form-group">
              <label for="charlevel" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("charlevel")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="charlevel" name="GameChardesc[charlevel]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="gold_div" class="form-group">
              <label for="gold" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("gold")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="gold" name="GameChardesc[gold]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="guildid_div" class="form-group">
              <label for="guildid" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("guildid")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="guildid" name="GameChardesc[guildid]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="charstate_div" class="form-group">
              <label for="charstate" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("charstate")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="charstate" name="GameChardesc[charstate]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="createtime_div" class="form-group">
              <label for="createtime" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("createtime")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="createtime" name="GameChardesc[createtime]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="updatetime_div" class="form-group">
              <label for="updatetime" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("updatetime")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="updatetime" name="GameChardesc[updatetime]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="loginip_div" class="form-group">
              <label for="loginip" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("loginip")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="loginip" name="GameChardesc[loginip]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="viplv_div" class="form-group">
              <label for="viplv" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("viplv")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="viplv" name="GameChardesc[viplv]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="vipexp_div" class="form-group">
              <label for="vipexp" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("vipexp")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="vipexp" name="GameChardesc[vipexp]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="firstrechargetime_div" class="form-group">
              <label for="firstrechargetime" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("firstrechargetime")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="firstrechargetime" name="GameChardesc[firstrechargetime]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="firstrechargelevel_div" class="form-group">
              <label for="firstrechargelevel" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("firstrechargelevel")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="firstrechargelevel" name="GameChardesc[firstrechargelevel]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="totalrecharge_div" class="form-group">
              <label for="totalrecharge" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("totalrecharge")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="totalrecharge" name="GameChardesc[totalrecharge]" placeholder="必填" />
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
		$('#game-chardesc-search-form').submit();
	}
 function viewAction(id){
		initModel(id, 'view', 'fun');
	}

 function initEditSystemModule(data, type){
	if(type == 'create'){
		$("#charid").val('');
		$("#userid").val('');
		$("#account").val('');
		$("#charname").val('');
		$("#serverid").val('');
		$("#charlevel").val('');
		$("#gold").val('');
		$("#guildid").val('');
		$("#charstate").val('');
		$("#createtime").val('');
		$("#updatetime").val('');
		$("#loginip").val('');
		$("#viplv").val('');
		$("#vipexp").val('');
		$("#firstrechargetime").val('');
		$("#firstrechargelevel").val('');
		$("#totalrecharge").val('');
		
	}
	else{
		$("#charid").val(data.charid);
    	$("#userid").val(data.userid);
    	$("#account").val(data.account);
    	$("#charname").val(data.charname);
    	$("#serverid").val(data.serverid);
    	$("#charlevel").val(data.charlevel);
    	$("#gold").val(data.gold);
    	$("#guildid").val(data.guildid);
    	$("#charstate").val(data.charstate);
    	$("#createtime").val(data.createtime);
    	$("#updatetime").val(data.updatetime);
    	$("#loginip").val(data.loginip);
    	$("#viplv").val(data.viplv);
    	$("#vipexp").val(data.vipexp);
    	$("#firstrechargetime").val(data.firstrechargetime);
    	$("#firstrechargelevel").val(data.firstrechargelevel);
    	$("#totalrecharge").val(data.totalrecharge);
    	}
	if(type == "view"){
      $("#charid").attr({readonly:true,disabled:true});
      $("#userid").attr({readonly:true,disabled:true});
      $("#account").attr({readonly:true,disabled:true});
      $("#charname").attr({readonly:true,disabled:true});
      $("#serverid").attr({readonly:true,disabled:true});
      $("#charlevel").attr({readonly:true,disabled:true});
      $("#gold").attr({readonly:true,disabled:true});
      $("#guildid").attr({readonly:true,disabled:true});
      $("#charstate").attr({readonly:true,disabled:true});
      $("#createtime").attr({readonly:true,disabled:true});
      $("#updatetime").attr({readonly:true,disabled:true});
      $("#loginip").attr({readonly:true,disabled:true});
      $("#viplv").attr({readonly:true,disabled:true});
      $("#vipexp").attr({readonly:true,disabled:true});
      $("#firstrechargetime").attr({readonly:true,disabled:true});
      $("#firstrechargelevel").attr({readonly:true,disabled:true});
      $("#totalrecharge").attr({readonly:true,disabled:true});
	$('#edit_dialog_ok').addClass('hidden');
	}
	else{
      $("#charid").attr({readonly:false,disabled:false});
      $("#userid").attr({readonly:false,disabled:false});
      $("#account").attr({readonly:false,disabled:false});
      $("#charname").attr({readonly:false,disabled:false});
      $("#serverid").attr({readonly:false,disabled:false});
      $("#charlevel").attr({readonly:false,disabled:false});
      $("#gold").attr({readonly:false,disabled:false});
      $("#guildid").attr({readonly:false,disabled:false});
      $("#charstate").attr({readonly:false,disabled:false});
      $("#createtime").attr({readonly:false,disabled:false});
      $("#updatetime").attr({readonly:false,disabled:false});
      $("#loginip").attr({readonly:false,disabled:false});
      $("#viplv").attr({readonly:false,disabled:false});
      $("#vipexp").attr({readonly:false,disabled:false});
      $("#firstrechargetime").attr({readonly:false,disabled:false});
      $("#firstrechargelevel").attr({readonly:false,disabled:false});
      $("#totalrecharge").attr({readonly:false,disabled:false});
		$('#edit_dialog_ok').removeClass('hidden');
		}
		$('#edit_dialog').modal('show');
}

function initModel(id, type, fun){
	
	$.ajax({
		   type: "GET",
		   url: "<?=Url::toRoute('game-chardesc/view')?>",
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
				   url: "<?=Url::toRoute('game-chardesc/delete')?>",
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
	$('#game-chardesc-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#game-chardesc-form').bind('submit', function(e) {
	e.preventDefault();
	var id = $("#id").val();
	var action = id == "" ? "<?=Url::toRoute('game-chardesc/create')?>" : "<?=Url::toRoute('game-chardesc/update')?>";
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