(function() {
	'use strict';
	
	angular.module('ManagerApp.controllers')
	.controller('ProjectNoteCreateController', ['$scope', 'ProjectNoteService', '$routeParams', '$location', function($scope, ProjectNoteService, $routeParams, $location) {
		
		$scope.projectNote = new ProjectNoteService();
		$scope.projectNote.project_id = $routeParams.id;

		$scope.store = function() {
			if($scope.form.$valid) {
				$scope.projectNote.$save({id: $routeParams.id})
				.then(function() {
					$location.path('projects/' + $routeParams.id + '/notes');
				});
			}
		}

	}]);

})();