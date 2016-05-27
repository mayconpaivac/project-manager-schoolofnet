(function() {
	'use strict';
	
	angular.module('ManagerApp.controllers')
	.controller('ClientIndexController', ['$scope', 'ClientService', function($scope, ClientService) {
		$scope.clients = ClientService.query();

	}]);

})();