var email;
var site_url = document.getElementById("route").value;
var currentUser = document.getElementById("currentUser").value;
var app = angular.module('accounts', ['ui.bootstrap', 'ngAnimate', 'ngSanitize']);
app.controller('accountsCtrl', function($scope, $http, $uibModal, $log	){
	$scope.showAuthPassWarnning = false;

	$scope.editUserButton = function(id){
		var modalInstance = $uibModal.open({
			templateUrl: 'userFields.html',
			controller: 'editUserCtrl',
			size: 'md',
			resolve: {
				accID : function () {
					return id;
				}
			}
		});
	}

	$scope.addUserButton = function(){
		var modalInstance = $uibModal.open({
			templateUrl: 'userFields.html',
			controller: 'addUserCtrl',
			size: 'md'
		});
	}

	$scope.changeUserStatus = function(accID, userStatus){
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
				size: 'md',
				resolve: {
					msg : function () {
						return "Successfully " + userStatus + " User ";
					}
				}
			});
		}).error(function(data,status,headers,config){
			$uibModal.open({
				templateUrl: 'warning.html',
				controller: 'warningCtrl',
				size: 'md',
				resolve: {
					ErrorMsg : function () {
						return "Unable To Change Status";
					}
				}
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
			controller: 'warningCtrl',
			size: 'md',
			resolve: {
				ErrorMsg : function () {
					return "Unable To Connect To Database";
				}
			}
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

app.controller('addUserCtrl', function ($scope, $http, $uibModal, $uibModalInstance) {
	$scope.header = "Add New User";
	$scope.showUsernameAndPass = true;
	$scope.AccountType = "NULL";


	$scope.checkUsername = function(){
		$http.post(site_url + "/Accounts/checkUserName", {
			"userName":$scope.username
		}).success(function(data,status,headers,config){
			if(data === "TRUE"){
				$scope.usernameWarning = true;
			}else if(data === "FALSE"){
				$scope.usernameWarning = false;
			}
		}).error(function(data,status,headers,config){
			$uibModal.open({
				templateUrl: 'warning.html',
				controller: 'warningCtrl',
				size: 'md',
				resolve: {
					ErrorMsg : function () {
						return "Unable To Unable To Connect To Database";
					}
				}
			});
		});
	};
	$scope.submitForm = function(valid){
		$http.post(site_url + "/Accounts/checkUserName", {
			"userName":$scope.username
		}).success(function(data,status,headers,config){
			if($scope.AccountType == "NULL" || data === "TRUE" || $scope.confPassword !== $scope.newPassword){
				
				if($scope.AccountType == "NULL"){
					$scope.accTypeWarning = true;
				} else if($scope.AccountType != "NULL"){
					$scope.accTypeWarning = false;
				}

				if(data === "TRUE"){
					$scope.usernameWarning = true;
				}else if(data === "FALSE"){
					$scope.usernameWarning = false;
				}

				if($scope.confPassword !== $scope.newPassword){
					$scope.passWarning = true;
				}else if($scope.confPassword === $scope.newPassword){
					$scope.passWarning = false;
				}
				
			} else if(valid === true && $scope.confPassword === $scope.newPassword && $scope.AccountType != "NULL" && data == "FALSE") { 
			 	$scope.usernameWarning = false;
				$scope.passWarning = false;
				$scope.accTypeWarning = false;

				if($scope.email == undefined || $scope.email == null){
					email = null;
				} else {
					email = $scope.email;
				} 
				$http.post(site_url + "/Accounts/addUser", {
					"lastName"	: $scope.LastName, 
					"firstName"	: $scope.FirstName, 
					"contactNo"	: $scope.ContactNo, 
					"address"	: $scope.Address,
					"email"		: email,
					"type"		: $scope.AccountType,
					"username"	: $scope.username,
					"password"	: $scope.confPassword
				}).success(function(data,status,headers,config){
					$uibModal.open({
						templateUrl: 'success.html',
						controller: 'successCtrl',
						size: 'md',
						resolve: {
							msg : function () {
								return "User Info Has Bean Save";
							}
						}
					});
					$uibModalInstance.close();
					window.location.assign(site_url + "/Accounts");
				}).error(function(data,status,headers,config){
					$uibModal.open({
						templateUrl: 'warning.html',
						controller: 'warningCtrl',
						size: 'md',
						resolve: {
							ErrorMsg : function () {
								return "Unable To Save Data";
							}
						}
					});
				});
			}
		});	
	};

	$scope.cancel = function () {
    	$uibModalInstance.dismiss('cancel');
	};
});

app.controller('editUserCtrl', function ($scope, $http, $uibModal, $uibModalInstance, accID) {
	$scope.header = "Edit User";
	$scope.showUsernameAndPass = false;
	$http.post(site_url + "/Accounts/getUserInfo", {"id": accID})
	.success(function(data,status,headers,config){
		var userdata  =  JSON.parse(data[0]);
		$scope.userID		= userdata.id;
		$scope.LastName	 	= userdata.lname;
		$scope.FirstName 	= userdata.fname;
		$scope.ContactNo 	= userdata.contactNo;
		$scope.Address	 	= userdata.address;	
		$scope.email	 	= userdata.accEAd;	
		$scope.AccountType	= userdata.type;	
		$scope.username		= userdata.username;	
		$scope.newPassword	= userdata.password;	
		$scope.confPassword	= userdata.password;	
	}).error(function(data,status,headers,config){
		$uibModal.open({
			templateUrl: 'warning.html',
			controller: 'warningCtrl',
			size: 'md',
			resolve: {
				ErrorMsg : function () {
					return "Unable To Connect To Database";
				}
			}
		});
	});

	$scope.submitForm = function(valid){
			if($scope.AccountType == "NULL"){
				$scope.accTypeWarning = true;
			} else if(valid === true && $scope.AccountType != "NULL") { 
			 	$scope.usernameWarning = false;
				$scope.accTypeWarning = false;
				if($scope.email == undefined){
					email = null;
				} else {
					email = $scope.email;
				} 
				$http.post(site_url + "/Accounts/updateUser", {
					"id"		: accID, 
					"lastName"	: $scope.LastName, 
					"firstName"	: $scope.FirstName, 
					"contactNo"	: $scope.ContactNo, 
					"address"	: $scope.Address,
					"email"		: email,
					"type"		: $scope.AccountType
				}).success(function(data,status,headers,config){
					$uibModal.open({
						templateUrl: 'success.html',
						controller: 'successCtrl',
						size: 'md',
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
						controller: 'warningCtrl',
						size: 'md',
						resolve: {
							ErrorMsg : function () {
								return "Unable To Save Data";
							}
						}
					});
				});
			}
	};

	$scope.cancel = function () {
    	$uibModalInstance.dismiss('cancel');
	};
});

