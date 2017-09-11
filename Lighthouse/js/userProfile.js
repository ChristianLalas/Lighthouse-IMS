var site_url = document.getElementById("route").value;
var email, password;
var app = angular.module('userProfile', ['ui.bootstrap', 'ngAnimate', 'ngSanitize']);

app.controller('userProfileCtrl', function($scope, $http, $uibModal, $log){
	$scope.pass = "password";

	$scope.edit = function(){
		$scope.pass = "text";
		document.getElementById("fName").disabled = false;
		document.getElementById("lName").disabled = false;
		document.getElementById("email").disabled = false;
		document.getElementById("contact").disabled = false;
		document.getElementById("address").disabled = false;
		document.getElementById("username").disabled = false;		
		document.getElementById("newPassword").disabled = false;	
		document.getElementById("confPassword").disabled = false;	
		document.getElementById("save").disabled = false;	
	}
	
	function verifyPass(){
		if($scope.editProfile.newPassword.$dirty || $scope.editProfile.newPassword.$touched || $scope.editProfile.confPassword.$dirty || $scope.editProfile.confPassword.$touched){
			if($scope.newPassword == $scope.confPassword){
				return $scope.newPassword;
			} else {
				return false;
			}
		} else {
			return $scope.password;
		}
	}
	
	$scope.confirmPassword = function(){
		if($scope.editProfile.newPassword.$dirty || $scope.editProfile.newPassword.$touched || $scope.editProfile.confPassword.$dirty || $scope.editProfile.confPassword.$touched){
			if($scope.newPassword == $scope.confPassword){
				$scope.passWarning = false;
			} else {
				$scope.passWarning = true;
			}
		} 
	}

	$scope.checkUsername = function(){
		$http.post(site_url + "/User_Profile/checkNewUserName", {
			"accountID"	: $scope.accountID,
			"username"	: $scope.username
		}).success(function(data,status,headers,config){
			if(data == "TRUE"){
				$scope.usernameWarning = true;
			}else if(data == "FALSE"){
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

		password = verifyPass();
		$http.post(site_url + "/User_Profile/checkNewUserName", {
			"accountID":$scope.accountID,
			"username":$scope.username
		}).success(function(data,status,headers,config){
			if(data === "TRUE"){
				$scope.usernameWarning = true;
			} else if(valid === true && data === "FALSE"){
				if($scope.email == undefined){
					email = null;
				} else {
					email = $scope.email;
				}
				if(password == false){
					$scope.passWarning = true;
				} else {
					$uibModal.open({
						templateUrl: 'confirmation.html',
						controller: 'confirmationCtrl',
						size: 'md',
						resolve: {
							confMsg : function (){
								return "Are You Sure Want You To Update Your Profile?"
							},
							passData : function () {
								return data = [
									$scope.accountID,
									$scope.lName,
									$scope.fName,
									email,
									$scope.contact,
									$scope.address,
									$scope.username,
									password
								];
							}
						}	
					});
				}	
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

	

});

/*load the warning modal */
app.controller('warningCtrl', function ($scope, $http, $uibModal, $uibModalInstance, ErrorMsg) {
	$scope.ErrorMsg = ErrorMsg;
});

/*load the warning modal */
app.controller('confirmationCtrl', function ($scope, $http, $uibModal, $uibModalInstance,confMsg, passData) {
	$scope.confMsg = confMsg;

	$scope.yes = function(){
		$http.post(site_url + "/User_Profile/updateUser", {
			"accountID"	: passData[0],
			"lastName"	: passData[1],
			"firstName"	: passData[2],
			"email"		: passData[3],
			"contactNo"	: passData[4],
			"address"	: passData[5],
			"username"	: passData[6],
			"password"	: passData[7]		
		}).success(function(data,status,headers,config){
			$uibModal.open({
				templateUrl: 'success.html',
				size: 'md',
				resolve: {
					msg : function () {
						return "Your Profile Has Been Updated";
					}
				}

			});
			$uibModalInstance.close();
			window.location.assign(site_url + "/User_Profile");
		}).error(function(data,status,headers,config){
			$uibModal.open({
				templateUrl: 'warning.html',
				controller: 'warningCtrl',
				size: 'md',
				resolve: {
					ErrorMsg : function () {
						return "Server Error Unable To Save Data";
					}
				}
			});
		});
	}
	$scope.cancel = function () {
    	$uibModalInstance.dismiss('cancel');
	};
});

app.controller('successCtrl', function ($scope, $http, $uibModal, $uibModalInstance, msg) {
	$scope.msg = msg;

	$scope.ok = function () {
		$uibModalInstance.dismiss('cancel');
	};
});