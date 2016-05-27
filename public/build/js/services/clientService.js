(function() {
	'use strict';

	angular.module('ManagerApp.services')
	.service('ClientService', ['$resource', 'appConfig', function($resource, appConfig){
		return $resource(appConfig.URL_API + 'clients/:id', {id: '@id'}, {
			update: {
				method: 'PUT'
			}
		});
	}])

})();