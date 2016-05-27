(function() {
	'use strict';

	angular.module('ManagerApp.services')
	.service('ProjectNoteService', ['$resource', 'appConfig', function($resource, appConfig){
		return $resource(appConfig.URL_API + 'projects/:id/notes/:idNote', {
			id: '@id', idNote: '@idNote'
		}, {
			update: {
				method: 'PUT'
			}
		});
	}])

})();