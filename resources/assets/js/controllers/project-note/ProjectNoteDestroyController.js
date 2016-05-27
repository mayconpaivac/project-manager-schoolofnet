(function() {
	'use strict';
	
	angular.module('ManagerApp.controllers')
	.controller('ProjectNoteDestroyController', ['$scope', 'ProjectNoteService', '$location', '$routeParams', function($scope, ProjectNoteService, $location, $routeParams) {
		
		$scope.projectNote = ProjectNoteService.get({id: $routeParams.id, idNote: $routeParams.idNote});

		$scope.destroy = function() {
			$scope.projectNote.$delete({id: $scope.projectNote.project_id, idNote: $scope.projectNote.id}).then(function() {
				$location.path('projects/' + $routeParams.id + '/notes');
			});
		}

	}]);

})();