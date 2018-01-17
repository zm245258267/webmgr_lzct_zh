<div class="form-group" style="margin: 5px;">
	<label>渠道ID:</label> <a id="spIdSelect"><?=($this->params['groupSpIdParams']['spName']?$this->params['groupSpIdParams']['spName']:"请选择")?></a>
	<input type="hidden" class="form-control" id="spId" name="spId"
		value="<?=($this->params['groupSpIdParams']['spId']?$this->params['groupSpIdParams']['spId']:"") ?>">
	<input type="hidden" class="form-control" id="spName"
		name="spName"
		value="<?=($this->params['groupSpIdParams']['spName']?$this->params['groupSpIdParams']['spName']:"") ?>">
</div>
<div class="form-group" style="margin: 5px;">
	<label>服务器ID:</label> <a id="serverSelect"><?=($this->params['groupServersParams']['serverName']?$this->params['groupServersParams']['serverName']:"请选择")?></a>
	<input type="hidden" class="form-control" id="serverId" name="serverId"
		value="<?=($this->params['groupServersParams']['serverId']?$this->params['groupServersParams']['serverId']:"") ?>">
	<input type="hidden" class="form-control" id="serverName"
		name="serverName"
		value="<?=($this->params['groupServersParams']['serverName']?$this->params['groupServersParams']['serverName']:"") ?>">
</div>