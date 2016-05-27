(function() {
	'use strict';
	
	angular.module('ManagerApp.controllers')
	.controller('ClientEditController', ['$scope', 'ClientService', '$location', '$routeParams', function($scope, ClientService, $location, $routeParams) {
		
		$scope.client = ClientService.get({id: $routeParams.id});

		$scope.update = function() {
			if($scope.form.$valid) {
				ClientService.update({id: $scope.client.id}, $scope.client, function() {
					$location.path('clients');
				}, function(response) {
					
						$.each( response.data.message, function( key, value ) {
				            alert(value[0]);
				        });
				});
			}
		}

	}]);

})();