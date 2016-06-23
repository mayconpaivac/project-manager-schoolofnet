(function() {
	'use strict';
	
	angular.module('ManagerApp.controllers')
	.controller('ProjectNoteEditController', ['$scope', 'ProjectNoteService', '$location', '$routeParams', function($scope, ProjectNoteService, $location, $routeParams) {
		
		$scope.projectNote = ProjectNoteService.get({id: $routeParams.id, idNote: $routeParams.idNote});

		$scope.update = function() {
			if($scope.form.$valid) {
				ProjectNoteService.update({id: $scope.projectNote.project_id, idNote: $scope.projectNote.id}, $scope.projectNote, function() {
					$location.path('projects/' + $scope.projectNote.project_id + '/notes');
				}, function(response) {
					
					$.each( response.data.message, function( key, value ) {
			            alert(value[0]);
			        });
				});
			}
		}

	}]);

})();