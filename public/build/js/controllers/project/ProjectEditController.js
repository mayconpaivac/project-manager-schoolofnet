(function() {
	'use strict';
	
	angular.module('ManagerApp.controllers')
	.controller('ProjectEditController', ['$scope', 'ProjectService', 'ClientService', 'appConfig', '$location', '$routeParams', function($scope, ProjectService, ClientService, appConfig, $location, $routeParams) {
		
		ProjectService.get({id: $routeParams.id},
			function(response){
				$scope.project = response;
				// ClientService.get({id: response.client_id}, function(response) {
				// 	$scope.clientSelected = response;
				// });
				$scope.clientSelected = response.client.data;
			},
			function(){ window.history.back(); });
		// $scope.clients = ClientService.query({id: $scope.project.client_id});
		$scope.status = appConfig.project.status;

		$scope.update = function() {
			if($scope.form.$valid) {
				ProjectService.update({id: $scope.project.id}, $scope.project, function() {
					$location.path('projects/');
				}, function(response) {
					$.each(response.data.message, function( key, value ) {
			            alert(value[0]);
			        });
				});
			}
		}

		$scope.getClients = function(name) {
			$scope.clients = ClientService.query({
				search: name,
				searchFields: 'name:like' 
			});
			return $scope.clients.$promise;
		};

		$scope.formatName = function(model) {
			if(model) {
				return model.name;
			}
			return null;
		};

		$scope.selectClient = function(item) {
			$scope.project.client_id = item.id;
		};

	}]);

})();