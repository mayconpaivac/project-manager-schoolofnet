(function() {
	'use strict';
	
	angular.module('ManagerApp.controllers')
	.controller('ProjectCreateController', ['$scope', '$cookies', 'ProjectService', 'ClientService', 'appConfig', '$location', function($scope, $cookies, ProjectService, ClientService, appConfig, $location) {
		
		$scope.project = new ProjectService();
		$scope.clients = ClientService.query(
			function(){},
			//Error
			function() {
			alert('Erro ao carregar clientes, atualize a página.');
		});
		$scope.status = appConfig.project.status;
		$scope.project.progress = 0;

		$scope.store = function() {
			if($scope.form.$valid) {
				$scope.project.$save()
				.then(function() {
					$location.path('projects');
				},
				//Error
				function(response) {
					$.each( response.data.message, function( key, value ) {
			            alert(value[0]);
			        });
				});
			}
		}

	}]);

})();