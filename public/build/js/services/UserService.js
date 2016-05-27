(function() {
	'use strict';

	angular.module('ManagerApp.services')
	.service('UserService', ['$resource', 'appConfig', function($resource, appConfig){
		return $resource(appConfig.URL_API + 'user', {
			
		}, {
			authenticated: {
				url: appConfig.URL_API + 'user/authenticated',
				method: 'GET',
			}
		});
	}])

})();