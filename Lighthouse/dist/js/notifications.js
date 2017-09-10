var site_url = document.getElementById("route").value;
var currentUser = "1";
//var currentUser = document.getElementById("currentUser").value;

var app = angular.module('notifications', ['ui.bootstrap', 'ngAnimate', 'ngSanitize']);

app.controller('notificationsCtrl', function($scope, $http, $uibModal, $log, $filter){
	$scope.accept = function(id){
		$uibModal.open({
			templateUrl: 'confirmation.html',
			controller: 'confirmationCtrl',
			size: 'md',
			resolve: {
				confMsg : function (){
					return "Are You Sure You Want To {{status}} Request?"
				},
				status: function() {
					return "APPROVE"
				},
				id: function() {
					return id
				}
			}

		});

	}

	$scope.decline = function(id){
		$uibModal.open({
			templateUrl: 'confirmation.html',
			controller: 'confirmationCtrl',
			size: 'md',
			resolve: {
				confMsg : function (){
					return "Are You Sure You Want To {{status}} Request?"
				},
				status: function() {
					return "DECLINE"
				},
				id: function() {
					return id
				}
			}

		});
	}
});

app.controller('confirmationCtrl', function ($scope, $http, $uibModal, $uibModalInstance, confMsg, status, id) {
	
	$scope.confMsg = confMsg;
	$scope.status = status;
	$scope.yes = function() {
		$http.post(site_url + "/Notification/updateStatus", {
			'accountID' :currentUser,
			'status' : status+"D",
			'id' 	 : id
		}).success(function(data,status,headers,config){
			$uibModal.open({
				templateUrl: 'success.html',
				size: 'md'
			});
			$uibModalInstance.close();
			window.location.assign(site_url + "/Notification");
		}).error(function(data,status,headers,config){
			$uibModal.open({
				templateUrl: 'warning.html',
				controller: 'warningCtrl',
				size: 'md',
				resolve: {
					ErrorMsg : function () {
						return "Server Error Unable To Process Request";
					}
				}
			});
		});	
	}
	$scope.cancel = function() {
		$uibModalInstance.dismiss('cancel');
	}
});