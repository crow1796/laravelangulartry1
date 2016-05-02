"use strict";

(function(window, document, angular, $){

	let AppControllers = {};
	(function(AppControllers){
		AppControllers.UploadController = function($scope, fileUpload){
			$scope.fileUploading = false;

			$scope.processUpload = function(event){
				event.preventDefault();
				$scope.fileUploading = true;
				let file = $scope.file_upload;
				let uploadUrl = window.location.origin + '/api/upload/process';
				fileUpload.uploadData(file, uploadUrl)
							.then(function(response){
								if(response.data.toLowerCase() == 'uploaded successfully!'){
									$scope.fileUploading = false;
								}else {
									$scope.fileUploading = true;
								}
							});
				return false;
			}
		};

		AppControllers.FileManagerController = function($scope, $http, filesFactory){
			filesFactory.getFiles().then(function(response){
				$scope.files = response;
			});

			$scope.viewFile = function(index){
				$scope.currentFileIndex = index;
			};
		};
		return AppControllers;
	})(AppControllers || {});

	let AppProviders = {};
	(function(AppProviders) {

		return AppProviders;
	})(AppProviders || {});

	let AppFactories = {};
	(function(AppFactories) {
		AppFactories.FileFactory = function($http, $q){
			return {
				getFiles: function(){
					return $http({
						'url': window.location.origin + '/api/files',
						'method': 'GET'
					})
					.then(function(response){
						return response.data;
					});
				}
			};
		}
		return AppFactories;
	})(AppFactories || {});

	let AppServices = {};
	(function(AppServices){
		AppServices.FileUpload = function($http){
			this.uploadData = function(file, uploadUrl){
				let fd = new FormData();
				fd.append('file_upload', file);

				return $http.post(uploadUrl, fd, {
					transformRequest: angular.identity,
					headers: {'Content-type': undefined}
				})
				.success(function(data){
					if(data.toLowerCase() == 'uploaded successfully!'){
						return 'Uploaded Successfully!';
					}else {
						return 'Uploading Failed!';
					}
				});
			};
		};

		return AppServices;
	})(AppServices || {});

	let AppDirectives = {};
	(function(AppDirectives) {
		AppDirectives.FileModel = function($parse){
			return {
				restrict: 'A',
				link: function(scope, element, attrs){
					let model = $parse(attrs.fileModel);
					let modelSetter = model.assign;

					element.bind('change', function(){
						scope.$apply(function(){
							modelSetter(scope, element[0].files[0]);
						});
					});
				}
			}
		};

		return AppDirectives;
	})(AppDirectives || {});

	let app = angular.module('fileUploader', ['ngRoute']);

	app.factory('filesFactory', AppFactories.FileFactory);

	app.service('fileUpload', ['$http', AppServices.FileUpload]);

	app.directive('fileModel', ['$parse', AppDirectives.FileModel]);

	app.controller('uploadController', ['$scope', 'fileUpload', AppControllers.UploadController]);
	app.controller('fileManagerController', ['$scope', '$http', 'filesFactory', AppControllers.FileManagerController]);

})(window, document, window.angular, window.jQuery);