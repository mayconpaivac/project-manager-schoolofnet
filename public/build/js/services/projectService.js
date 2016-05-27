(function() {
	'use strict';

	angular.module('ManagerApp.services')
	.service('ProjectService', ['$resource', 'appConfig', function($resource, appConfig){
		return $resource(appConfig.URL_API + 'projects/:id', {id: '@id'}, {
			update: {
				method: 'PUT'
			},
			get: {
				method: 'GET',
				transformResponse: function(data, headers) {
					var o = appConfig.utils.transformResponse(data, headers);

					if(angular.isObject(o) && o.hasOwnProperty('due_date')) {
						var arrayDate = o.due_date.split('-'),
							day = parseInt(arrayDate[2]),
							month = parseInt(arrayDate[1]) - 1,
							year = parseInt(arrayDate[0]);
						o.due_date = new Date(year, month, day);
					}
					return o;
				}
			}
		});
	}])

})();