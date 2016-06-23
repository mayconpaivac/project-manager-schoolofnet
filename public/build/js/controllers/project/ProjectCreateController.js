(function() {
	'use strict';
	
	angular.module('ManagerApp.controllers')
	.controller('ProjectCreateController', ['$scope', '$cookies', 'ProjectService', 'ClientService', 'appConfig', '$location', function($scope, $cookies, ProjectService, ClientService, appConfig, $location) {
		
		$scope.project = new ProjectService();
		$scope.status = appConfig.project.status;
		$scope.project.progress = 0;

		$scope.due_date = {
			status: {
				opened: false
			}
		};

		$scope.open = function($event) {
			$scope.due_date.status.opened = true;
		};

		$scope.store = function() {
			if($scope.form.$valid) {
				$scope.project.$save()
				.then(function() {
					$location.path('projects');
				},
				//Error
				function(response) {
					$.each( response.data.message, function( key, value ) {
			            alert(value[0]);
			        });
				});
			}
		};

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