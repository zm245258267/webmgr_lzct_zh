<div class="form-group" style="margin: 5px;">
	<label>服务器ID:</label> <a id="serverSelect"><?=($this->params['groupServersParams']['serverName']?$this->params['groupServersParams']['serverName']:"请选择")?></a>
	<input type="hidden" class="form-control" id="serverId" name="serverId"
		value="<?=($this->params['groupServersParams']['serverId']?$this->params['groupServersParams']['serverId']:"") ?>">
	<input type="hidden" class="form-control" id="serverName"
		name="serverName"
		value="<?=($this->params['groupServersParams']['serverName']?$this->params['groupServersParams']['serverName']:"") ?>">
</div>