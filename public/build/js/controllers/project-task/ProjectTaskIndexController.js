(function() {
	'use strict';
	
	angular.module('ManagerApp.controllers')
	.controller('ProjectTaskIndexController', 
		['$scope', '$routeParams', 'ProjectTaskService', 'appConfig',
		function($scope, $routeParams, ProjectTaskService, appConfig) {

		$scope.projectTask = new ProjectTaskService();
		$scope.project_id = $routeParams.id;

		$scope.store = function() {
			if($scope.form.$valid) {
				$scope.projectTask.status = appConfig.projectTask.status[0].value;
				$scope.projectTask.$save({id: $scope.project_id}).then(function() {
					$scope.projectTask = new ProjectTaskService();
					$scope.loadTask();
				});
			}
		};

		$scope.loadTask = function() {
			$scope.projectTasks = ProjectTaskService.query({
				id: $scope.project_id,
				orderBy: 'id',
				sortedBy: 'desc',
			});
		};

		$scope.loadTask();

	}]);

})();