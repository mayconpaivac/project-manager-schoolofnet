(function() {
	'use strict';
	
	angular.module('ManagerApp.controllers')
	.controller('ProjectFileDestroyController', ['$scope', 'ProjectFileService', '$location', '$routeParams', function($scope, ProjectFileService, $location, $routeParams) {
		
		$scope.projectFile = ProjectFileService.get({id: $routeParams.id, idFile: $routeParams.idFile});

		$scope.destroy = function() {
			$scope.projectFile.$delete({id: $scope.projectFile.project_id, idFile: $scope.projectFile.id}).then(function() {
				$location.path('projects/' + $routeParams.id + '/files');
			});
		}

	}]);

})();