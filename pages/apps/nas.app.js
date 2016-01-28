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
	
	$scope.openNasForm = function(){
		$('#overlayer').fadeIn('fast');
	}
	$scope.closeNasForm = function(){
		$('#overlayer').fadeOut('fast');
	}
});