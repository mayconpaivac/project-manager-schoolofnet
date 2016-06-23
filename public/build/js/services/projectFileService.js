(function() {
	'use strict';

	angular.module('ManagerApp.services')
	.service('ProjectFileService', ['$resource', 'appConfig', function($resource, appConfig){
		return $resource(appConfig.URL_API + 'projects/:id/files/:idFile', {
			id: '@id', idFile: '@idFile'
		}, {
			update: {
				method: 'PUT'
			},
			download: {
				url: appConfig.URL_API + 'projects/:id/files/:idFile/download',
				method: 'GET',
			},
		});
	}])

})();