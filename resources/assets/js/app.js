(function() {
	'use strict';

	var app = angular.module('ManagerApp', [
            'ngRoute',
            'angular-oauth2', 
            'ngMessages',
            'ManagerApp.controllers', 
            'ManagerApp.factories', 
            'ManagerApp.services', 
            'ManagerApp.filters', 
            'ManagerApp.directives', 
            'ui.bootstrap',
            'ngFileUpload',
        ]);

	angular.module('ManagerApp.controllers', ['ngMessages', 'angular-oauth2']);
	angular.module('ManagerApp.factories', ['ngMessages', 'angular-oauth2']);
	angular.module('ManagerApp.services', ['ngResource']);
	angular.module('ManagerApp.filters', []);
	angular.module('ManagerApp.directives', []);

	app.provider('appConfig', ['$httpParamSerializerProvider', function($httpParamSerializerProvider) {
		var config = {
			URL_API: 'http://project.dev/api/',
			URL_BASE: 'http://project.dev/',
			project: {
				status: [
					{value: 1, label: 'Não iniciado'},
					{value: 2, label: 'Iniciado'},
					{value: 3, label: 'Concluído'},
				],
			},
			projectTask: {
				status: [
					{value: 1, label: 'Incompleta'},
					{value: 2, label: 'Completa'},
				]
			},
			urls: {
				projectFile: 'projects/{{id}}/files/{{idFile}}',
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





    angular.module('ManagerApp.factories')
    .factory('redirectWhenLoggedOut', ['$q', '$location', '$cookies', '$rootScope',
    	function ($q, $location, $cookies, $rootScope) {
        return {
            'responseError': function (rejection) {
                if (rejection.status == 403) {
                    return;
                }

                if(rejection.data.error == 'access_denied' && rejection.status == 401) {
                	//OAuth.getRefreshToken();
                }

                var rejectionReasons = ['token_invalid'];

                angular.forEach(rejectionReasons, function(value, key) {

                    if(rejection.data.error === value) {
                        $location.path('/auth/login');
                        $rootScope.currentUser = null;

                        $cookies.remove('token');
                        $cookies.remove('currentUser');

                        window.console.log(value);
                    }
                });
                return $q.reject(rejection);
            }
        };
    }]);
	app.config(function ($httpProvider) {
        $httpProvider.interceptors.push('redirectWhenLoggedOut');
    });






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
		 * Route projects Files
		 */
		.when('/projects/:id/files', {
			templateUrl: 'build/views/project-file/index.html',
			controller: 'ProjectFileIndexController'
		})
		.when('/projects/:id/files/create', {
			templateUrl: 'build/views/project-file/create.html',
			controller: 'ProjectFileCreateController'
		})
		.when('/projects/:id/files/:idFile', {
			templateUrl: 'build/views/project-file/show.html',
			controller: 'ProjectFileShowController'
		})
		.when('/projects/:id/files/:idFile/edit', {
			templateUrl: 'build/views/project-file/edit.html',
			controller: 'ProjectFileEditController'
		})
		.when('/projects/:id/files/:idFile/destroy', {
			templateUrl: 'build/views/project-file/destroy.html',
			controller: 'ProjectFileDestroyController'
		})
		/*
		 * End Route projects Files
		 */
		/*
		 * Route projects Tasks
		 */
		.when('/projects/:id/tasks', {
			templateUrl: 'build/views/project-task/index.html',
			controller: 'ProjectTaskIndexController'
		})
		.when('/projects/:id/tasks/create', {
			templateUrl: 'build/views/project-task/create.html',
			controller: 'ProjectTaskCreateController'
		})
		.when('/projects/:id/tasks/:idTask', {
			templateUrl: 'build/views/project-task/show.html',
			controller: 'ProjectTaskhowController'
		})
		.when('/projects/:id/tasks/:idTask/edit', {
			templateUrl: 'build/views/project-task/edit.html',
			controller: 'ProjectTaskEditController'
		})
		.when('/projects/:id/tasks/:idTask/destroy', {
			templateUrl: 'build/views/project-task/destroy.html',
			controller: 'ProjectTaskDestroyController'
		})
		/*
		 * End Route projects Files
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