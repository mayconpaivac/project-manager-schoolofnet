(function() {
	'use strict';

	angular.module('ManagerApp.services')
	.service('ProjectTaskService', ['$resource', 'appConfig', function($resource, appConfig){
		return $resource(appConfig.URL_API + 'projects/:id/tasks/:idTask', {
			id: '@id', idTask: '@idTask'
		}, {
			update: {
				method: 'PUT'
			}
		});
	}])

})();