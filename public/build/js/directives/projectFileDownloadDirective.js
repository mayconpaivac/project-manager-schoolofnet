(function() {
	'use strict';

	angular.module('ManagerApp.directives')
	.directive('projectFileDownloadDirective', ['$timeout', 'appConfig', 'ProjectFileService',
		function($timeout, appConfig, ProjectFileService) {
		return {
			restrict: 'E',
			templateUrl: appConfig.URL_BASE + 'build/views/templates/projectFileDownload.html',
			link: function(scope, element, attr) {
				var anchor = element.children()[0];

				scope.$on('saveFile', function(event, data) {
					$(anchor).removeClass('disabled');
					$(anchor).text('Salvar arquivo');
					$(anchor).attr({
						href: 'data:application-octet-stream;base64,' + data.file,
						download: data.name,
					});
					$timeout(function() {
						scope.downloadFile = function() {};
						$(anchor)[0].click();
					});
				});
			},
			controller: ['$scope', '$element', '$attrs', function($scope, $element, $attrs) {
				$scope.downloadFile = function() {
					var anchor = $element.children()[0];
					$(anchor).addClass('disabled');
					$(anchor).text('Fazendo download...');

					ProjectFileService.download({id: $attrs.idProject, idFile: $attrs.idFile}, function(response) {
						$scope.$emit('saveFile', response);
					});
				};
			}]
		};
	}]);

})();