(function() {
	'use strict';
	
	angular.module('ManagerApp.controllers')
	.controller('ProjectFileCreateController', ['$scope', 'ProjectFileService', '$routeParams', '$location', 'Upload', 'UrlService', 'appConfig',
		function($scope, ProjectFileService, $routeParams, $location, Upload, UrlService, appConfig) {
		
		$scope.projectFile = {};
		$scope.projectFile.project_id = $routeParams.id;
		$scope.projectFile.fileProgressbar = 0;

		$scope.store = function() {
			if($scope.form.$valid) {

				Upload.upload({
		            url: appConfig.URL_API + UrlService.getUrlFromUrlSymbol(appConfig.urls.projectFile, {id: $routeParams.id, idFile: ''}),
		            fields: {
		            	name: $scope.projectFile.name,
		            	description: $scope.projectFile.description,
		            	project_id: $routeParams.id,
		            },
		            file: $scope.projectFile.file,
		        }).then(function (resp) {
		            console.log('Success ' + resp.data.name + 'uploaded. Response: ' + resp);
		            $location.path('projects/' + $routeParams.id + '/files');
		        }, function (resp) {
		            console.log('Error status: ' + resp.status);
		        }, function (evt) {
		            var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
					$scope.projectFile.fileProgressbar = progressPercentage;
		        });

				/*$scope.projectFile.$save({id: $routeParams.id})
				.then(function() {
					$location.path('projects/' + $routeParams.id + '/files');
				});*/
			}
		}

	}]);

})();