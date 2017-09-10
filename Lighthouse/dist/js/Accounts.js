var site_url = document.getElementById("route").value;
var app = angular.module('accounts', ['ui.bootstrap', 'ngAnimate', 'ngSanitize']);

app.controller('accountsCtrl', function($scope, $http, $uibModal, $log	){
	$scope.showAuthPassWarnning = false;

	$scope.editUserBotton = function(id){
		var modalInstance = $uibModal.open({
			templateUrl: 'editUser.html',
			controller: 'editUserCtrl',
			size: 'md',
			resolve: {
				accID : function () {
					return id;
				}
			}
		});
	}

	$scope.showAddUserBtn = function(){
		var modalInstance = $uibModal.open({
			templateUrl: 'showAddUser.html',
			controller: 'showAddUserCtrl',
			size: 'sm'
		});
	}

	$scope.changeUserStatus = function(accID, userStatus){
		console.log(userStatus);
		if(userStatus === "ENABLED"){
			userStatus = "DISABLED";
		} else if(userStatus === "DISABLED"){
			userStatus = "ENABLED";
		}

		$http.post(site_url + "/Accounts/changeUserStatus", {"id": accID, "status": userStatus})
		.success(function(data,status,headers,config){
			$uibModal.open({
				templateUrl: 'success.html',
				controller: 'successCtrl',
				size: 'sm',
				resolve: {
					msg : function () {
						return "Successfully " + userStatus + " User ";
					}
				}
			});
		}).error(function(data,status,headers,config){
			$uibModal.open({
				templateUrl: 'warning.html',
				size: 'sm'
			});
		});
	};

	$scope.showPass = function(id){
		var modalInstance = $uibModal.open({
			templateUrl: 'showPassword.html',
			controller: 'showPasswordCtrl',
			size: 'sm',
			resolve: {
				accID : function () {
					return id;
				}
			}
		});
	};
});

app.controller('showPasswordCtrl', function ($scope, $http, $uibModal, $uibModalInstance, accID) {
	$scope.confirmPassBtn = function (inUsername, InPassword) {
		$http({
	  		method : 'POST',		
	        url : site_url + '/Accounts/passwordAut',
	        headers: {'Content-Type': 'application/json'},
        	data : JSON.stringify({username: inUsername, password: InPassword})
	  	})
		.success(function(data,status,headers,config){
			console.log(data);
			if(data == "TRUE"){
				$scope.showAuthPassWarnning = false;
				var modalInstance = $uibModal.open({
					templateUrl: 'showAuthPass.html',
					controller: 'showAuthPassCtrl',
					size: 'sm',
					resolve: {
						accID : function () {
							return accID;
						}
					}
				});
				$uibModalInstance.close();
			} else {
				$scope.showAuthPassWarnning = true;
				$scope.authWarnning = "Please Enter Correct Password";
			}
		}).error(function(data,status,headers,config){
			openWarning();
		});

	};

	$scope.cancel = function () {
		$uibModalInstance.dismiss('cancel');
	};
});

app.controller('showAuthPassCtrl', function ($scope, $http, $uibModal, $uibModalInstance, accID) {

	$http.post(site_url + "/Accounts/getUserPass",{"id": accID})
	.success(function(data,status,headers,config){
		$scope.currentPass = JSON.parse(data[0]).password;
	}).error(function(data,status,headers,config){
		$uibModal.open({
			templateUrl: 'warning.html',
			size: 'sm'
		});
	});

	$scope.close = function () {
    	$uibModalInstance.dismiss('cancel');
	};
});

app.controller('successCtrl', function ($scope, $http, $uibModal, $uibModalInstance, msg) {
	$scope.msg = msg;

	$scope.ok = function () {
    	$uibModalInstance.dismiss('cancel');
	};
});

app.controller('editUserCtrl', function ($scope, $http, $uibModal, $uibModalInstance, accID) {
	$http.post(site_url + "/Accounts/getUserInfo", {"id": accID})
	.success(function(data,status,headers,config){
		var userdata  =  JSON.parse(data[0]);
		$scope.userID		 	= userdata.id;
		$scope.editLastName	 	= userdata.lname;
		$scope.editFirstName 	= userdata.fname;
		$scope.editContactNo 	= parseInt(userdata.contactNo);
		$scope.editAddress	 	= userdata.address;	
		$scope.editAccountType	= userdata.type;	
	}).error(function(data,status,headers,config){
		$uibModal.open({
			templateUrl: 'warning.html',
			size: 'sm'
		});
	});

	$scope.submitForm = function(valid){
		if(valid === true){ 
			$http.post(site_url + "/Accounts/updateUser", {
				"id"		: accID, 
				"lastName"	: $scope.editLastName, 
				"firstName"	: $scope.editFirstName, 
				"contactNo"	: $scope.editContactNo, 
				"address"	: $scope.editAddress,
				"type"		: $scope.editAccountType
			}).success(function(data,status,headers,config){
				$uibModal.open({
					templateUrl: 'success.html',
					controller: 'successCtrl',
					size: 'sm',
					resolve: {
						msg : function () {
							return "User Info Has Bean Updated";
						}
					}
				});
				$uibModalInstance.close();
				window.location.assign(site_url + "/Accounts");
			}).error(function(data,status,headers,config){
				$uibModal.open({
					templateUrl: 'warning.html',
					size: 'sm'
				});
			});
		}

	};
});

