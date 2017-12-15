<?php for($i=1;$i<11;$i++):?>
<?php if ($cmdInfo["p{$i}"]):?>
<div class="form-group">
	<label for="p<?=$i?>" class="col-sm-2 control-label"><?=$cmdInfo["p{$i}"]?>：</label>
	<div class="col-sm-10">
		<?php if ($cmdInfo["f{$i}"]=='textarea'):?>
		<textarea rows="3" id="p<?=$i?>" name="params[<?=$i?>]" class="form-control" placeHolder="<?=$cmdInfo["n{$i}"]?>"></textarea>
		<?php else: ?>
		<input type="text" id="p<?=$i?>" name="params[<?=$i?>]" class="form-control" placeHolder="<?=$cmdInfo["n{$i}"]?>" />
		<?php endif;?>
	</div>
</div>
<?php endif;?>
<?php endfor;?>