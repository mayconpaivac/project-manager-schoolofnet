(function() {
	'use strict';
	
	angular.module('ManagerApp.controllers')
	.controller('ClientDestroyController', ['$scope', 'ClientService', '$location', '$routeParams', function($scope, ClientService, $location, $routeParams) {
		
		$scope.client = ClientService.get({id: $routeParams.id});

		$scope.destroy = function() {
			$scope.client.$delete({id: $scope.client.id}).then(function() {
				$location.path('clients');
			});
		}

	}]);

})();