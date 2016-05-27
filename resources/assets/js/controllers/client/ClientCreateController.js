(function() {
	'use strict';
	
	angular.module('ManagerApp.controllers')
	.controller('ClientCreateController', ['$scope', 'ClientService', '$location', function($scope, ClientService, $location) {
		
		$scope.client = new ClientService();

		$scope.store = function() {
			if($scope.form.$valid) {
				$scope.client.$save()
				.then(function() {
					$location.path('clients');
				});
			}
		}

	}]);

})();