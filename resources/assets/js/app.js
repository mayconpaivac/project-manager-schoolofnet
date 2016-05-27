(function() {
	'use strict';

	var app = angular.module('ManagerApp', ['ngRoute', 'angular-oauth2', 'ngMessages', 'ManagerApp.controllers', 'ManagerApp.services', 'ManagerApp.filters']);

	angular.module('ManagerApp.controllers', ['ngMessages', 'angular-oauth2']);
	angular.module('ManagerApp.services', ['ngResource']);
	angular.module('ManagerApp.filters', []);

	app.provider('appConfig', ['$httpParamSerializerProvider', function($httpParamSerializerProvider) {
		var config = {
			URL_API: 'http://project.dev/api/',
			project: {
				status: [
					{value: 1, label: 'Não iniciado'},
					{value: 2, label: 'Iniciado'},
					{value: 3, label: 'Concluído'},
				]
			},
			utils: {
				transformRequest: function(data) {
					if(angular.isObject(data)) {
						return $httpParamSerializerProvider.$get()(data);
					}
					return data;
				},
				transformResponse: function(data, headers) {
					var headersGetter = headers();
					if(headersGetter['content-type'] == 'application/json' || headersGetter['content-type'] == 'text/json') {
						var dataJson = JSON.parse(data);
						if(dataJson.hasOwnProperty('data')) {
							dataJson = dataJson.data;
						}
						return dataJson;
					}
					return data;
				}
			}
		};
		return {
			config: config,
			$get: function() {
				return config;
			}
		};
	}]);

	//Routes
	app.config(['$routeProvider', '$httpProvider', 'OAuthProvider', 'OAuthTokenProvider', 'appConfigProvider', function($routeProvider, $httpProvider, OAuthProvider, OAuthTokenProvider, appConfigProvider) {
		$httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
		$httpProvider.defaults.headers.put['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';

		$httpProvider.defaults.transformRequest = appConfigProvider.config.utils.transformRequest;
		$httpProvider.defaults.transformResponse = appConfigProvider.config.utils.transformResponse;

		$routeProvider
		.when('/login', {
			templateUrl: 'build/views/login.html',
			controller: 'LoginController'
		})
		.when('/home', {
			templateUrl: 'build/views/home.html',
			controller: 'HomeController'
		})
		/*
		 * Route clients
		 */
		.when('/clients', {
			templateUrl: 'build/views/client/index.html',
			controller: 'ClientIndexController'
		})
		.when('/clients/create', {
			templateUrl: 'build/views/client/create.html',
			controller: 'ClientCreateController'
		})
		.when('/clients/:id/edit', {
			templateUrl: 'build/views/client/edit.html',
			controller: 'ClientEditController'
		})
		.when('/clients/:id/destroy', {
			templateUrl: 'build/views/client/destroy.html',
			controller: 'ClientDestroyController'
		})
		/*
		 * End Route Clients
		 */
		
		/*
		 * Route Projects
		 */
		.when('/projects', {
			templateUrl: 'build/views/project/index.html',
			controller: 'ProjectIndexController'
		})
		.when('/projects/create', {
			templateUrl: 'build/views/project/create.html',
			controller: 'ProjectCreateController'
		})
		.when('/projects/:id', {
			templateUrl: 'build/views/project/show.html',
			controller: 'ProjectShowController'
		})
		.when('/projects/:id/edit', {
			templateUrl: 'build/views/project/edit.html',
			controller: 'ProjectEditController'
		})
		.when('/projects/:id/destroy', {
			templateUrl: 'build/views/project/destroy.html',
			controller: 'ProjectDestroyController'
		})
		/*
		 * End Route Projects
		 */
		/*
		 * Route projects Notes
		 */
		.when('/projects/:id/notes', {
			templateUrl: 'build/views/project-note/index.html',
			controller: 'ProjectNoteIndexController'
		})
		.when('/projects/:id/notes/create', {
			templateUrl: 'build/views/project-note/create.html',
			controller: 'ProjectNoteCreateController'
		})
		.when('/projects/:id/notes/:idNote', {
			templateUrl: 'build/views/project-note/show.html',
			controller: 'ProjectNoteShowController'
		})
		.when('/projects/:id/notes/:idNote/edit', {
			templateUrl: 'build/views/project-note/edit.html',
			controller: 'ProjectNoteEditController'
		})
		.when('/projects/:id/notes/:idNote/destroy', {
			templateUrl: 'build/views/project-note/destroy.html',
			controller: 'ProjectNoteDestroyController'
		})
		/*
		 * End Route projects Notes
		 */
		/*
		 * Route login oauth
		 */
		OAuthProvider.configure({
	      baseUrl: appConfigProvider.config.URL_API,
	      clientId: '1',
	      clientSecret: 'secret',
	      grantPath: 'oauth/access_token'
	    });

		OAuthTokenProvider.configure({
			name: 'token',
			options: {
				secure: false
			}
		});

	}]);

	app.run(['$rootScope', '$window', 'OAuth', function($rootScope, $window, OAuth) {
	    $rootScope.$on('oauth:error', function(event, rejection) {
	      // Ignore `invalid_grant` error - should be catched on `LoginController`.
	      if ('invalid_grant' === rejection.data.error) {
	        return;
	      }

	      // Refresh token when a `invalid_token` error occurs.
	      if ('invalid_token' === rejection.data.error) {
	        return OAuth.getRefreshToken();
	      }

	      // Redirect to `/login` with the `error_reason`.
	      return $window.location.href = '#/login?error_reason=' + rejection.data.error;
	    });
	 }]);
})();