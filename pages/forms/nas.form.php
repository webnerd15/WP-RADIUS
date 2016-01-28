<div id="form-container">
	<h4 id="form-title"></h4>
	<hr/>
	<form role="form">
		<div class="form-group">
			<label for="shortname">Name:</label>
			<input type="text" class="form-control" id="shortname" ng-model="shortname">
		</div>
		<div class="form-group">
			<label for="host">IP/Hostname</label>
			<input type="host" class="form-control" id="host" ng-model="host">
		</div>
		<div class="form-group">
			<label for="secret">Secret</label>
			<input type="secret" class="form-control" id="secret" ng-model="secret">
		</div>
		<div class="form-group">
			<label for="type">Type</label>
			<input type="type" class="form-control" id="type" ng-model="type">
		</div>
		<div class="form-group">
			<label for="description">Description</label>
			<input type="description" class="form-control" id="description" ng-model="description">
		</div>
		<button class="btn btn-default" id="add-btn"><i class="fa fa-plus"></i> Add</button> 
		<button class="btn btn-default" id="save-btn"><i class="fa fa-save"></i> Save</button>
		<button class="btn btn-default" ng-click="closeNasForm()"><i class="fa fa-close"></i> Close</button>
	</form>
</div>