(function() {
	'use strict';
	
	angular.module('ManagerApp.controllers')
	.controller('ProjectFileEditController', ['$scope', 'ProjectFileService', '$location', '$routeParams', function($scope, ProjectFileService, $location, $routeParams) {
		
		$scope.projectFile = ProjectFileService.get({id: $routeParams.id, idFile: $routeParams.idFile});

		$scope.update = function() {
			if($scope.form.$valid) {
				ProjectFileService.update({id: $scope.projectFile.project_id, idFile: $scope.projectFile.id}, $scope.projectFile, function() {
					$location.path('projects/' + $scope.projectFile.project_id + '/files');
				}, function(response) {
					
					$.each( response.data.message, function( key, value ) {
			            alert(value[0]);
			        });
				});
			}
		}

	}]);

})();