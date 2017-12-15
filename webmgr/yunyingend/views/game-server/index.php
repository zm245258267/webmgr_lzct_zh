
<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use common\utils\CommonFun;
use yii\helpers\Url;

use backend\models\GameServer;

$modelLabel = new \backend\models\GameServer();
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
                <?php ActiveForm::begin(['id' => 'game-server-search-form', 'method'=>'get', 'options' => ['class' => 'form-inline'], 'action'=>Url::toRoute('game-server/index')]); ?>     
                
                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('serverId')?>:</label>
                      <input type="text" class="form-control" id="query[serverId]" name="query[serverId]"  value="<?=isset($query["serverId"]) ? $query["serverId"] : "" ?>">
                  </div>

                  <div class="form-group" style="margin: 5px;">
                      <label><?=$modelLabel->getAttributeLabel('serverName')?>:</label>
                      <input type="text" class="form-control" id="query[serverName]" name="query[serverName]"  value="<?=isset($query["serverName"]) ? $query["serverName"] : "" ?>">
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
              echo '<th onclick="orderby(\'serverId\', \'desc\')" '.CommonFun::sortClass($orderby, 'serverId').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('serverId').'</th>';
              echo '<th onclick="orderby(\'serverName\', \'desc\')" '.CommonFun::sortClass($orderby, 'serverName').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('serverName').'</th>';
              echo '<th onclick="orderby(\'targetId\', \'desc\')" '.CommonFun::sortClass($orderby, 'targetId').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('targetId').'</th>';
//               echo '<th onclick="orderby(\'login_server\', \'desc\')" '.CommonFun::sortClass($orderby, 'login_server').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('login_server').'</th>';
              echo '<th onclick="orderby(\'groupId\', \'desc\')" '.CommonFun::sortClass($orderby, 'groupId').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('groupId').'</th>';
//               echo '<th onclick="orderby(\'spIdSet\', \'desc\')" '.CommonFun::sortClass($orderby, 'spIdSet').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('spIdSet').'</th>';
              echo '<th onclick="orderby(\'openTime\', \'desc\')" '.CommonFun::sortClass($orderby, 'openTime').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('openTime').'</th>';
              echo '<th onclick="orderby(\'socket\', \'desc\')" '.CommonFun::sortClass($orderby, 'socket').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('socket').'</th>';
              echo '<th onclick="orderby(\'serverHost\', \'desc\')" '.CommonFun::sortClass($orderby, 'serverHost').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('serverHost').'</th>';
              echo '<th onclick="orderby(\'serverIp\', \'desc\')" '.CommonFun::sortClass($orderby, 'serverIp').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('serverIp').'</th>';
              echo '<th onclick="orderby(\'serverPort\', \'desc\')" '.CommonFun::sortClass($orderby, 'serverPort').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('serverPort').'</th>';
//               echo '<th onclick="orderby(\'charDbIp\', \'desc\')" '.CommonFun::sortClass($orderby, 'charDbIp').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('charDbIp').'</th>';
//               echo '<th onclick="orderby(\'charDbName\', \'desc\')" '.CommonFun::sortClass($orderby, 'charDbName').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('charDbName').'</th>';
//               echo '<th onclick="orderby(\'charDbPort\', \'desc\')" '.CommonFun::sortClass($orderby, 'charDbPort').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('charDbPort').'</th>';
//               echo '<th onclick="orderby(\'eventDbIp\', \'desc\')" '.CommonFun::sortClass($orderby, 'eventDbIp').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('eventDbIp').'</th>';
//               echo '<th onclick="orderby(\'eventDbName\', \'desc\')" '.CommonFun::sortClass($orderby, 'eventDbName').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('eventDbName').'</th>';
//               echo '<th onclick="orderby(\'eventDbPort\', \'desc\')" '.CommonFun::sortClass($orderby, 'eventDbPort').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('eventDbPort').'</th>';
//               echo '<th onclick="orderby(\'onlineMax\', \'desc\')" '.CommonFun::sortClass($orderby, 'onlineMax').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('onlineMax').'</th>';
//               echo '<th onclick="orderby(\'chargeSw\', \'desc\')" '.CommonFun::sortClass($orderby, 'chargeSw').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('chargeSw').'</th>';
//               echo '<th onclick="orderby(\'serverSw\', \'desc\')" '.CommonFun::sortClass($orderby, 'serverSw').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('serverSw').'</th>';
//               echo '<th onclick="orderby(\'power\', \'desc\')" '.CommonFun::sortClass($orderby, 'power').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('power').'</th>';
//               echo '<th onclick="orderby(\'status\', \'desc\')" '.CommonFun::sortClass($orderby, 'status').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('status').'</th>';
//               echo '<th onclick="orderby(\'statusTips\', \'desc\')" '.CommonFun::sortClass($orderby, 'statusTips').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('statusTips').'</th>';
//               echo '<th onclick="orderby(\'newday\', \'desc\')" '.CommonFun::sortClass($orderby, 'newday').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('newday').'</th>';
//               echo '<th onclick="orderby(\'hotday\', \'desc\')" '.CommonFun::sortClass($orderby, 'hotday').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('hotday').'</th>';
//               echo '<th onclick="orderby(\'cversion_higher\', \'desc\')" '.CommonFun::sortClass($orderby, 'cversion_higher').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('cversion_higher').'</th>';
//               echo '<th onclick="orderby(\'cversion_lower\', \'desc\')" '.CommonFun::sortClass($orderby, 'cversion_lower').' tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.$modelLabel->getAttributeLabel('cversion_lower').'</th>';
         
			?>
	
            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >操作</th>
            </tr>
            </thead>
            <tbody>
            
            <?php
            foreach ($models as $model) {
                echo '<tr id="rowid_' . $model->serverId . '">';
                echo '  <td><label><input type="checkbox" value="' . $model->serverId . '"></label></td>';
                echo '  <td>' . $model->serverId . '</td>';
                echo '  <td>' . $model->serverName . '</td>';
                echo '  <td>' . $model->targetId . '</td>';
//                 echo '  <td>' . $model->login_server . '</td>';
                echo '  <td>' . $model->groupId . '</td>';
//                 echo '  <td>' . $model->spIdSet . '</td>';
                echo '  <td>' . $model->openTime . '</td>';
                echo '  <td>' . $model->socket . '</td>';
                echo '  <td>' . $model->serverHost . '</td>';
                echo '  <td>' . $model->serverIp . '</td>';
                echo '  <td>' . $model->serverPort . '</td>';
//                 echo '  <td>' . $model->charDbIp . '</td>';
//                 echo '  <td>' . $model->charDbName . '</td>';
//                 echo '  <td>' . $model->charDbPort . '</td>';
//                 echo '  <td>' . $model->eventDbIp . '</td>';
//                 echo '  <td>' . $model->eventDbName . '</td>';
//                 echo '  <td>' . $model->eventDbPort . '</td>';
//                 echo '  <td>' . $model->onlineMax . '</td>';
//                 echo '  <td>' . $model->chargeSw . '</td>';
//                 echo '  <td>' . $model->serverSw . '</td>';
//                 echo '  <td>' . $model->power . '</td>';
//                 echo '  <td>' . $model->status . '</td>';
//                 echo '  <td>' . $model->statusTips . '</td>';
//                 echo '  <td>' . $model->newday . '</td>';
//                 echo '  <td>' . $model->hotday . '</td>';
//                 echo '  <td>' . $model->cversion_higher . '</td>';
//                 echo '  <td>' . $model->cversion_lower . '</td>';
                echo '  <td class="center">';
                echo '      <a id="view_btn" onclick="viewAction(' . $model->serverId . ')" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-zoom-in icon-white"></i>查看</a>';
                echo '      <a id="edit_btn" onclick="editAction(' . $model->serverId . ')" class="btn btn-primary btn-sm" href="#"> <i class="glyphicon glyphicon-edit icon-white"></i>修改</a>';
                echo '      <a id="delete_btn" onclick="deleteAction(' . $model->serverId . ')" class="btn btn-danger btn-sm" href="#"> <i class="glyphicon glyphicon-trash icon-white"></i>删除</a>';
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
                <?php $form = ActiveForm::begin(["id" => "game-server-form", "class"=>"form-horizontal", "action"=>Url::toRoute("game-server/save")]); ?>                      
                 
          <div id="serverId_div" class="form-group">
              <label for="serverId" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("serverId")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="serverId" name="GameServer[serverId]" placeholder="必填" />
                  <input type="hidden" id="id" name="id" value="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="serverName_div" class="form-group">
              <label for="serverName" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("serverName")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="serverName" name="GameServer[serverName]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="targetId_div" class="form-group">
              <label for="targetId" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("targetId")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="targetId" name="GameServer[targetId]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="login_server_div" class="form-group">
              <label for="login_server" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("login_server")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="login_server" name="GameServer[login_server]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="groupId_div" class="form-group">
              <label for="groupId" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("groupId")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="groupId" name="GameServer[groupId]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="spIdSet_div" class="form-group">
              <label for="spIdSet" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("spIdSet")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="spIdSet" name="GameServer[spIdSet]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="openTime_div" class="form-group">
              <label for="openTime" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("openTime")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="openTime" name="GameServer[openTime]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="socket_div" class="form-group">
              <label for="socket" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("socket")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="socket" name="GameServer[socket]" placeholder="tcp://192.168.0.1:8001" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="serverHost_div" class="form-group">
              <label for="serverHost" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("serverHost")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="serverHost" name="GameServer[serverHost]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="serverIp_div" class="form-group">
              <label for="serverIp" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("serverIp")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="serverIp" name="GameServer[serverIp]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="serverPort_div" class="form-group">
              <label for="serverPort" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("serverPort")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="serverPort" name="GameServer[serverPort]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="charDbIp_div" class="form-group">
              <label for="charDbIp" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("charDbIp")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="charDbIp" name="GameServer[charDbIp]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="charDbName_div" class="form-group">
              <label for="charDbName" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("charDbName")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="charDbName" name="GameServer[charDbName]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="charDbPort_div" class="form-group">
              <label for="charDbPort" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("charDbPort")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="charDbPort" name="GameServer[charDbPort]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="eventDbIp_div" class="form-group">
              <label for="eventDbIp" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("eventDbIp")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="eventDbIp" name="GameServer[eventDbIp]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="eventDbName_div" class="form-group">
              <label for="eventDbName" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("eventDbName")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="eventDbName" name="GameServer[eventDbName]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="eventDbPort_div" class="form-group">
              <label for="eventDbPort" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("eventDbPort")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="eventDbPort" name="GameServer[eventDbPort]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="onlineMax_div" class="form-group">
              <label for="onlineMax" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("onlineMax")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="onlineMax" name="GameServer[onlineMax]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="chargeSw_div" class="form-group">
              <label for="chargeSw" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("chargeSw")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="chargeSw" name="GameServer[chargeSw]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="serverSw_div" class="form-group">
              <label for="serverSw" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("serverSw")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="serverSw" name="GameServer[serverSw]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="power_div" class="form-group">
              <label for="power" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("power")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="power" name="GameServer[power]" placeholder="必填" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="status_div" class="form-group">
              <label for="status" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("status")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="status" name="GameServer[status]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="statusTips_div" class="form-group">
              <label for="statusTips" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("statusTips")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="statusTips" name="GameServer[statusTips]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="newday_div" class="form-group">
              <label for="newday" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("newday")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="newday" name="GameServer[newday]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="hotday_div" class="form-group">
              <label for="hotday" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("hotday")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="hotday" name="GameServer[hotday]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="cversion_higher_div" class="form-group">
              <label for="cversion_higher" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("cversion_higher")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="cversion_higher" name="GameServer[cversion_higher]" placeholder="" />
              </div>
              <div class="clearfix"></div>
          </div>

          <div id="cversion_lower_div" class="form-group">
              <label for="cversion_lower" class="col-sm-2 control-label"><?php echo $modelLabel->getAttributeLabel("cversion_lower")?></label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="cversion_lower" name="GameServer[cversion_lower]" placeholder="" />
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
		$('#game-server-search-form').submit();
	}
 function viewAction(id){
		initModel(id, 'view', 'fun');
	}

 function initEditSystemModule(data, type){
	if(type == 'create'){
		$("#serverId").val('');
		$("#serverName").val('');
		$("#targetId").val('');
		$("#login_server").val('');
		$("#groupId").val('');
		$("#spIdSet").val('');
		$("#openTime").val('');
		$("#socket").val('');
		$("#serverHost").val('');
		$("#serverIp").val('');
		$("#serverPort").val('');
		$("#charDbIp").val('');
		$("#charDbName").val('');
		$("#charDbPort").val('');
		$("#eventDbIp").val('');
		$("#eventDbName").val('');
		$("#eventDbPort").val('');
		$("#onlineMax").val('');
		$("#chargeSw").val('');
		$("#serverSw").val('');
		$("#power").val('');
		$("#status").val('');
		$("#statusTips").val('');
		$("#newday").val('');
		$("#hotday").val('');
		$("#cversion_higher").val('');
		$("#cversion_lower").val('');
		$("#id").val('');
		
	}
	else{
		$("#serverId").val(data.serverId);
		$("#id").val(data.serverId);
    	$("#serverName").val(data.serverName);
    	$("#targetId").val(data.targetId);
    	$("#login_server").val(data.login_server);
    	$("#groupId").val(data.groupId);
    	$("#spIdSet").val(data.spIdSet);
    	$("#openTime").val(data.openTime);
    	$("#socket").val(data.socket);
    	$("#serverHost").val(data.serverHost);
    	$("#serverIp").val(data.serverIp);
    	$("#serverPort").val(data.serverPort);
    	$("#charDbIp").val(data.charDbIp);
    	$("#charDbName").val(data.charDbName);
    	$("#charDbPort").val(data.charDbPort);
    	$("#eventDbIp").val(data.eventDbIp);
    	$("#eventDbName").val(data.eventDbName);
    	$("#eventDbPort").val(data.eventDbPort);
    	$("#onlineMax").val(data.onlineMax);
    	$("#chargeSw").val(data.chargeSw);
    	$("#serverSw").val(data.serverSw);
    	$("#power").val(data.power);
    	$("#status").val(data.status);
    	$("#statusTips").val(data.statusTips);
    	$("#newday").val(data.newday);
    	$("#hotday").val(data.hotday);
    	$("#cversion_higher").val(data.cversion_higher);
    	$("#cversion_lower").val(data.cversion_lower);
    	}
	if(type == "view"){
      $("#serverId").attr({readonly:true,disabled:true});
      $("#serverName").attr({readonly:true,disabled:true});
      $("#targetId").attr({readonly:true,disabled:true});
      $("#login_server").attr({readonly:true,disabled:true});
      $("#groupId").attr({readonly:true,disabled:true});
      $("#spIdSet").attr({readonly:true,disabled:true});
      $("#openTime").attr({readonly:true,disabled:true});
      $("#socket").attr({readonly:true,disabled:true});
      $("#serverHost").attr({readonly:true,disabled:true});
      $("#serverIp").attr({readonly:true,disabled:true});
      $("#serverPort").attr({readonly:true,disabled:true});
      $("#charDbIp").attr({readonly:true,disabled:true});
      $("#charDbName").attr({readonly:true,disabled:true});
      $("#charDbPort").attr({readonly:true,disabled:true});
      $("#eventDbIp").attr({readonly:true,disabled:true});
      $("#eventDbName").attr({readonly:true,disabled:true});
      $("#eventDbPort").attr({readonly:true,disabled:true});
      $("#onlineMax").attr({readonly:true,disabled:true});
      $("#chargeSw").attr({readonly:true,disabled:true});
      $("#serverSw").attr({readonly:true,disabled:true});
      $("#power").attr({readonly:true,disabled:true});
      $("#status").attr({readonly:true,disabled:true});
      $("#statusTips").attr({readonly:true,disabled:true});
      $("#newday").attr({readonly:true,disabled:true});
      $("#hotday").attr({readonly:true,disabled:true});
      $("#cversion_higher").attr({readonly:true,disabled:true});
      $("#cversion_lower").attr({readonly:true,disabled:true});
	$('#edit_dialog_ok').addClass('hidden');
	}
	else{
      $("#serverId").attr({readonly:false,disabled:false});
      $("#serverName").attr({readonly:false,disabled:false});
      $("#targetId").attr({readonly:false,disabled:false});
      $("#login_server").attr({readonly:false,disabled:false});
      $("#groupId").attr({readonly:false,disabled:false});
      $("#spIdSet").attr({readonly:false,disabled:false});
      $("#openTime").attr({readonly:false,disabled:false});
      $("#socket").attr({readonly:false,disabled:false});
      $("#serverHost").attr({readonly:false,disabled:false});
      $("#serverIp").attr({readonly:false,disabled:false});
      $("#serverPort").attr({readonly:false,disabled:false});
      $("#charDbIp").attr({readonly:false,disabled:false});
      $("#charDbName").attr({readonly:false,disabled:false});
      $("#charDbPort").attr({readonly:false,disabled:false});
      $("#eventDbIp").attr({readonly:false,disabled:false});
      $("#eventDbName").attr({readonly:false,disabled:false});
      $("#eventDbPort").attr({readonly:false,disabled:false});
      $("#onlineMax").attr({readonly:false,disabled:false});
      $("#chargeSw").attr({readonly:false,disabled:false});
      $("#serverSw").attr({readonly:false,disabled:false});
      $("#power").attr({readonly:false,disabled:false});
      $("#status").attr({readonly:false,disabled:false});
      $("#statusTips").attr({readonly:false,disabled:false});
      $("#newday").attr({readonly:false,disabled:false});
      $("#hotday").attr({readonly:false,disabled:false});
      $("#cversion_higher").attr({readonly:false,disabled:false});
      $("#cversion_lower").attr({readonly:false,disabled:false});
		$('#edit_dialog_ok').removeClass('hidden');
		}
		$('#edit_dialog').modal('show');
}

function initModel(id, type, fun){
	
	$.ajax({
		   type: "GET",
		   url: "<?=Url::toRoute('game-server/view')?>",
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
				   url: "<?=Url::toRoute('game-server/delete')?>",
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
	$('#game-server-form').submit();
});

$('#create_btn').click(function (e) {
    e.preventDefault();
    initEditSystemModule({}, 'create');
});

$('#delete_btn').click(function (e) {
    e.preventDefault();
    deleteAction('');
});

$('#game-server-form').bind('submit', function(e) {
	e.preventDefault();
	var id = $("#id").val();
	var action = id == "" ? "<?=Url::toRoute('game-server/create')?>" : "<?=Url::toRoute('game-server/update')?>";
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