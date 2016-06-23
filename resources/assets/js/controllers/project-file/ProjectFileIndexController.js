(function() {
	'use strict';
	
	angular.module('ManagerApp.controllers')
	.controller('ProjectFileIndexController', ['$scope', '$routeParams', 'ProjectFileService',
		function($scope, $routeParams, ProjectFileService) {
		$scope.projectFiles = ProjectFileService.query({id: $routeParams.id, idFile: $routeParams.idFile},
			function() {},
			//error
			function() {
				window.history.back();
		});
		$scope.project_id = $routeParams.id;
	}]);

})();