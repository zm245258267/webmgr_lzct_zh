
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;

use backend\models\GameGoodsLog;
use backend\widgets\SearchFormCommonField;
$modelLabel = new \backend\models\GameGoodsLog();
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
                <?php ActiveForm::begin(['id' => 'game-goods-log-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('game-goods-log/index')]); ?>     
                
                <!-- 
                  <div class="form-group" style="margin: 5px;">
                      <label>渠道ID:</label>
                      <input type="text" class="form-control" id="query[spid]" name="query[spid]"  value="<?=isset($query["spid"]) ? $query["spid"] : "" ?>">
                  </div>
                   -->
                  
                  <?=SearchFormCommonField::widget()?>

                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('account')?>:</label>
                      <input type="text" class="form-control" id="query[account]" name="query[account]"  value="<?=isset($query["account"]) ? $query["account"] : "" ?>">
                  </div>

                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('charname')?>:</label>
                      <input type="text" class="form-control" id="query[charname]" name="query[charname]"  value="<?=isset($query["charname"]) ? $query["charname"] : "" ?>">
                  </div>

                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('charid')?>:</label>
                      <input type="text" class="form-control" id="query[charid]" name="query[charid]"  value="<?=isset($query["charid"]) ? $query["charid"] : "" ?>">
                  </div>

                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('goodsname')?>:</label>
                      <input type="text" class="form-control" id="query[goodsname]" name="query[goodsname]"  value="<?=isset($query["goodsname"]) ? $query["goodsname"] : "" ?>">
                  </div>

                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('pricetype')?>:</label>
                      <input type="text" class="form-control" id="query[pricetype]" name="query[pricetype]"  value="<?=isset($query["pricetype"]) ? $query["pricetype"] : "" ?>">
                  </div>

                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('logtime')?>:</label>
                      <input type="text" class="form-control date" id="query[logtime]" name="query[logtime]"  value="<?=isset($query["logtime"]) ? $query["logtime"] : "" ?>">
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
              echo '<th onclick="orderby(\'charname\', \'desc\')" '.CommonFun::sortClass($orderby, 'charname').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('charname').'</th>';
              echo '<th onclick="orderby(\'charid\', \'desc\')" '.CommonFun::sortClass($orderby, 'charid').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('charid').'</th>';
              echo '<th onclick="orderby(\'goodsname\', \'desc\')" '.CommonFun::sortClass($orderby, 'goodsname').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('goodsname').'</th>';
              echo '<th onclick="orderby(\'buycount\', \'desc\')" '.CommonFun::sortClass($orderby, 'buycount').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('buycount').'</th>';
              echo '<th onclick="orderby(\'pricetype\', \'desc\')" '.CommonFun::sortClass($orderby, 'pricetype').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('pricetype').'</th>';
              echo '<th onclick="orderby(\'totalprice\', \'desc\')" '.CommonFun::sortClass($orderby, 'totalprice').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('totalprice').'</th>';
              echo '<th onclick="orderby(\'beforeamount\', \'desc\')" '.CommonFun::sortClass($orderby, 'beforeamount').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('beforeamount').'</th>';
              echo '<th onclick="orderby(\'afteramount\', \'desc\')" '.CommonFun::sortClass($orderby, 'afteramount').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('afteramount').'</th>';
              echo '<th onclick="orderby(\'buychannel\', \'desc\')" '.CommonFun::sortClass($orderby, 'buychannel').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('buychannel').'</th>';
              echo '<th onclick="orderby(\'charlevel\', \'desc\')" '.CommonFun::sortClass($orderby, 'charlevel').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('charlevel').'</th>';
              echo '<th onclick="orderby(\'castlelevel\', \'desc\')" '.CommonFun::sortClass($orderby, 'castlelevel').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('castlelevel').'</th>';
              echo '<th onclick="orderby(\'countryid\', \'desc\')" '.CommonFun::sortClass($orderby, 'countryid').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('countryid').'</th>';
              echo '<th onclick="orderby(\'logtime\', \'desc\')" '.CommonFun::sortClass($orderby, 'logtime').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('logtime').'</th>';
         
			?>
	
            </tr>
            </thead>
            <tbody>
            
            <?php
            foreach ($models as $model) {
                echo '<tr id="rowid_' . $model->server . '">';
                echo '  <td>' . $model->server . '</td>';
                echo '  <td>' . $model->account . '</td>';
                echo '  <td>' . $model->charname . '</td>';
                echo '  <td>' . $model->charid . '</td>';
                echo '  <td>' . $model->goodsname . '</td>';
                echo '  <td>' . $model->buycount . '</td>';
                echo '  <td>' . ($model->pricetype==1?'金币':'金币') . '</td>';	// @todo 根据游戏定
                echo '  <td>' . $model->totalprice . '</td>';
                echo '  <td>' . $model->beforeamount . '</td>';
                echo '  <td>' . $model->afteramount . '</td>';
                echo '  <td>' . ($model->buychannel==1?'商店':'商店') . '</td>';	// @todo 根据游戏定
                echo '  <td>' . $model->charlevel . '</td>';
                echo '  <td>' . $model->castlelevel . '</td>';
                echo '  <td>' . ($model->countryid==1?'女儿国':'女儿国') . '</td>';	// @todo 根据游戏定
                echo '  <td>' . $model->logtime . '</td>';
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
                <?php $form = ActiveForm::begin(["id" => "game-goods-log-form", "class"=>"form-horizontal", "action"=>Url::toRoute("game-goods-log/save")]); ?>                      
                 
          <input type="hidden" class="form-control" id="server" name="server" />

          <div id="account_div" class="form-group">
              <label for="account" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("account")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="account" name="GameGoodsLog[account]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="charname_div" class="form-group">
              <label for="charname" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("charname")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="charname" name="GameGoodsLog[charname]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="charid_div" class="form-group">
              <label for="charid" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("charid")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="charid" name="GameGoodsLog[charid]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="goodsname_div" class="form-group">
              <label for="goodsname" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("goodsname")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="goodsname" name="GameGoodsLog[goodsname]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="buycount_div" class="form-group">
              <label for="buycount" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("buycount")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="buycount" name="GameGoodsLog[buycount]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="pricetype_div" class="form-group">
              <label for="pricetype" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("pricetype")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="pricetype" name="GameGoodsLog[pricetype]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="totalprice_div" class="form-group">
              <label for="totalprice" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("totalprice")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="totalprice" name="GameGoodsLog[totalprice]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="logtime_div" class="form-group">
              <label for="logtime" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("logtime")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="logtime" name="GameGoodsLog[logtime]" placeholder="必填" />
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
		$('#game-goods-log-search-form').submit();
	}
 function viewAction(id){
		initModel(id, 'view', 'fun');
	}

 function initEditSystemModule(data, type){
	if(type == 'create'){
		$("#server").val('');
		$("#account").val('');
		$("#charname").val('');
		$("#charid").val('');
		$("#goodsname").val('');
		$("#buycount").val('');
		$("#pricetype").val('');
		$("#totalprice").val('');
		$("#logtime").val('');
		
	}
	else{
		$("#server").val(data.server);
    	$("#account").val(data.account);
    	$("#charname").val(data.charname);
    	$("#charid").val(data.charid);
    	$("#goodsname").val(data.goodsname);
    	$("#buycount").val(data.buycount);
    	$("#pricetype").val(data.pricetype);
    	$("#totalprice").val(data.totalprice);
    	$("#logtime").val(data.logtime);
    	}
	if(type == "view"){
      $("#server").attr({readonly:true,disabled:true});
      $("#account").attr({readonly:true,disabled:true});
      $("#charname").attr({readonly:true,disabled:true});
      $("#charid").attr({readonly:true,disabled:true});
      $("#goodsname").attr({readonly:true,disabled:true});
      $("#buycount").attr({readonly:true,disabled:true});
      $("#pricetype").attr({readonly:true,disabled:true});
      $("#totalprice").attr({readonly:true,disabled:true});
      $("#logtime").attr({readonly:true,disabled:true});
	$('#edit_dialog_ok').addClass('hidden');
	}
	else{
      $("#server").attr({readonly:false,disabled:false});
      $("#account").attr({readonly:false,disabled:false});
      $("#charname").attr({readonly:false,disabled:false});
      $("#charid").attr({readonly:false,disabled:false});
      $("#goodsname").attr({readonly:false,disabled:false});
      $("#buycount").attr({readonly:false,disabled:false});
      $("#pricetype").attr({readonly:false,disabled:false});
      $("#totalprice").attr({readonly:false,disabled:false});
      $("#logtime").attr({readonly:false,disabled:false});
		$('#edit_dialog_ok').removeClass('hidden');
		}
		$('#edit_dialog').modal('show');
}

function initModel(id, type, fun){
	
	$.ajax({
		   type: "GET",
		   url: "<?=Url::toRoute('game-goods-log/view')?>",
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
				   url: "<?=Url::toRoute('game-goods-log/delete')?>",
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
	$('#game-goods-log-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#game-goods-log-form').bind('submit', function(e) {
	e.preventDefault();
	var id = $("#id").val();
	var action = id == "" ? "<?=Url::toRoute('game-goods-log/create')?>" : "<?=Url::toRoute('game-goods-log/update')?>";
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