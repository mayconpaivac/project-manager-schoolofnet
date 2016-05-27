(function() {
	'use strict';
	
	angular.module('ManagerApp.controllers')
	.controller('ProjectNoteIndexController', ['$scope', '$routeParams', 'ProjectNoteService', function($scope, $routeParams, ProjectNoteService) {
		$scope.projectNotes = ProjectNoteService.query({id: $routeParams.id},
			function() {},
			//error
			function() {
				window.history.back();
		});
		$scope.project_id = $routeParams.id;
	}]);

})();