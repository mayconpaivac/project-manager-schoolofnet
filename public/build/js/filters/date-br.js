(function() {
	'use strict';

	angular.module('ManagerApp.filters')
	.filter('dateBr', ['$filter', function($filter) {
		return function(input) {
			return $filter('date')(input, 'dd/MM/yyyy');
		};
	}]);

})();