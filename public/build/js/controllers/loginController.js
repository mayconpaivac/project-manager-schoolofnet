(function() {
	'use strict';

	angular.module('ManagerApp.controllers')
	.controller('LoginController', ['$scope', 'OAuth', '$location', '$cookies', 'UserService', function($scope, OAuth, $location, $cookies, UserService) {
		$scope.user = {
			username: '',
			password: ''
		};

		$scope.error = {
			error: false,
			message: ''
		};

		$scope.login = function() {
			if($scope.formLogin.$valid) {
				OAuth.getAccessToken($scope.user)
				.then(function(response) {
					UserService.authenticated(function(response) {
						$cookies.putObject('user', response);
						$location.path('home');
					});
				}, function(response) {
					$scope.error.error = true;
					$scope.error.message = response.data.error_description;
				});
			}
		};
	}]);

})();