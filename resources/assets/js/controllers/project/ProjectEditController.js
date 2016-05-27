(function() {
	'use strict';
	
	angular.module('ManagerApp.controllers')
	.controller('ProjectEditController', ['$scope', 'ProjectService', 'ClientService', 'appConfig', '$location', '$routeParams', function($scope, ProjectService, ClientService, appConfig, $location, $routeParams) {
		
		$scope.project = ProjectService.get({id: $routeParams.id}, function(){}, function(){ window.history.back(); });
		$scope.clients = ClientService.query();
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

	}]);

})();