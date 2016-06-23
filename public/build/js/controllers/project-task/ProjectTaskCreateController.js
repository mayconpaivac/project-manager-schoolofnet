(function() {
	'use strict';
	
	angular.module('ManagerApp.controllers')
	.controller('ProjectTaskCreateController', ['$scope', 'ProjectTaskService', '$routeParams', '$location', 'appConfig',
		function($scope, ProjectTaskService, $routeParams, $location, appConfig) {
		
		$scope.projectTask = new ProjectTaskService();
		$scope.status = appConfig.projectTask.status;
		$scope.projectTask.project_id = $routeParams.id;

		$scope.start_date = {
			status: {
				opened: false,
			}
		};
		$scope.due_date = {
			status: {
				opened: false,
			}
		};

		$scope.openStartDatePicker = function($event) {
			$scope.start_date.status.opened = true;
		}
		$scope.openDueDatePicker = function($event) {
			$scope.due_date.status.opened = true;
		}

		$scope.store = function() {
			if($scope.form.$valid) {
				$scope.projectTask.$save({id: $routeParams.id})
				.then(function() {
					$location.path('projects/' + $routeParams.id + '/tasks');
				});
			}
		}

	}]);

})();