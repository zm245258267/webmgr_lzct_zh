<?php if ($cmdInfo["settings"]):?>
<?php foreach (json_decode($cmdInfo["settings"],true) as $settings):?>
<div class="form-group">
	<label for="<?=$settings['key']?>" class="col-sm-2 control-label"><?=$settings['name']?>：</label>
	<div class="col-sm-10">
		<?php if ($settings["value"]=='textarea'):?>
		<textarea rows="3" id="<?=$settings['key']?>" name="params[<?=$settings['key']?>]" class="form-control" placeHolder="<?=$settings['desc']?>"></textarea>
		<?php else: ?>
		<input type="text" id="<?=$settings['key']?>" name="params[<?=$settings['key']?>]" class="form-control" placeHolder="<?=$settings["desc"]?>" />
		<?php endif;?>
	</div>
</div>
<?php endforeach;?>
<?php endif;?>
