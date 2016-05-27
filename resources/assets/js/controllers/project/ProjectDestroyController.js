(function() {
	'use strict';
	
	angular.module('ManagerApp.controllers')
	.controller('ProjectDestroyController', ['$scope', 'ProjectService', '$location', '$routeParams', function($scope, ProjectService, $location, $routeParams) {
		
		$scope.project = ProjectService.get({id: $routeParams.id}, function(){}, function(){ window.history.back(); });

		$scope.destroy = function() {
			$scope.project.$delete({id: $scope.project.id}).then(function() {
				$location.path('projects');
			});
		}

	}]);

})();