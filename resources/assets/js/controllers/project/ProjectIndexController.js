(function() {
	'use strict';
	
	angular.module('ManagerApp.controllers')
	.controller('ProjectIndexController', ['$scope', '$routeParams', 'ProjectService', function($scope, $routeParams, ProjectService) {
		$scope.projects = ProjectService.query({id: $routeParams.id});
	}]);

})();