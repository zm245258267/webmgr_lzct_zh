
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
          <h3 class="box-title">通用GM操作</h3>
        </div>
        <!-- /.box-header -->
        
        <div class="box-body">
        	<form class="form-horizontal" name="data-form">
          		
          		<div class="form-group">
					<label for="serverSelect" class="col-sm-2 control-label">服务器:</label>
					<div class="col-sm-10"><a id="serverSelect" href="javascript:void(0)">请选择</a></div>
					<input type="hidden" class="form-control" id="serverId" name="serverId" value="" />
					<input type="hidden" class="form-control" id="serverName" name="serverName" value="">
				</div>
          		
          		<div class="form-group">
          			<label for="cmd" class="col-sm-2 control-label">指令：</label>
          			<div class="col-sm-10">
          			<input type="text" id="cmd" name="cmd" class="form-control" placeHolder="AddItem2UID 552601 19 100" />
          			</div>	
          		</div>
          		
          		<div class="form-group">
          			<label for="reason" class="col-sm-2 control-label">原因：</label>
          			<div class="col-sm-10">
          				<input id="reason" type="text" class="form-control" name="reason" value="" />
          			</div>	
          		</div>
          		
          		<div class="form-group">
          			<label class="col-sm-2 control-label"></label>
          			<div class="col-sm-10">
          				<input type="buttom" class="btn btn-primary btn-sm" id="submit" value="执行" />
          				<input type="hidden" name="_csrf" value="<?=Yii::$app->request->csrfToken?>" />
          			</div>	
          		</div>
          		
          	</form>
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

<?php $this->beginBlock('footer');  ?>
<!-- <body></body>后代码块 -->
<script>
$(function(){
	
	// 执行
    var url='<?=Url::toRoute('game-cmd-operator/common-operator')?>';
	$("#submit").bind("click",function(){
		admin_tool.confirm("确认执行？",function(){
			var res=http_post(url,$("form[name=data-form]").serialize());
		    admin_tool.alert('msg_info',res.msg,(res.errno?'danger':'success'));
		});
		return false;
	});
	
});

</script>
<?php $this->endBlock(); ?>