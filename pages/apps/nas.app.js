var nasApp = angular.module('nasApp',[]);

nasApp.controller('nasController', function($scope,$http){
	
	$scope.openNewNasForm = function(){
		$('#form-title').html('Add new Network Access Server');
		$('#save-btn').hide();
		$scope.shortname = ""
		$scope.host = "";
		$scope.secret = "";
		$scope.type = "";
		$scope.description = "";
		$scope.openNasForm();
		$('#shortname').focus();
	}
	
	$scope.addNas = function(){
		$http.post("wp-content/themes/wp_radius/inc/add.nas.php",{
			'shortname' : $scope.shortname,
			'host': $scope.host,
			'secret' : $scope.secret,
			'type' : $scope.type,
			'description' : $scope.description
		}).success(function(data,status,headers,config){
			$('#informer').html(data);
			$('#informer').fadeIn('fast');
			$scope.closeNasForm();
			location.reload();
		}).error(function(data,status,headers,config){
			alert("Error: Operation could not be done!");
		});
	}
	
	$scope.getOneNas = function(nas_id){
		$('#informer').html('<div class="alert alert-info">Please wait...</div>');
		$('#informer').fadeIn('fast');
		$http.post("wp-content/themes/wp_radius/inc/get.nas.php",{
			'nas_id' : nas_id
		}).success(function(data,status,headers,config){
			$scope.nas_id = data[0]["nas_id"];
			$scope.shortname = data[0]["shortname"];
			$scope.host = data[0]["host"];
			$scope.secret = data[0]["secret"];
			$scope.type = data[0]["type"];
			$scope.description = data[0]["description"];
			
			$('#save-btn').show();
			$('#add-btn').hide();
			$('#form-title').html('Edit NAS');
			$('#informer').hide();
			$scope.openNasForm();
			
		}).error(function(data,status,headers,config){
			
		})
	}
	
	$scope.updateNas = function(){
		$http.post("wp-content/themes/wp_radius/inc/update.nas.php",{
			'nas_id' : $scope.nas_id,
			'shortname' : $scope.shortname,
			'host': $scope.host,
			'secret' : $scope.secret,
			'type' : $scope.type,
			'description' : $scope.description
		}).success(function(data,status,headers,config){
			$('#informer').html(data);
			$('#informer').fadeIn('fast');
			$scope.closeNasForm();
			location.reload();
		}).error(function(data,status,headers,config){
			alert("Error: Operation could not be done!");
		});
	}
	
	$scope.openNasForm = function(){
		$('#overlayer').fadeIn('fast');
	}
	$scope.closeNasForm = function(){
		$('#overlayer').fadeOut('fast');
	}
});