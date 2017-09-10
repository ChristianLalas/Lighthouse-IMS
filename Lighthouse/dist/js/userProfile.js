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
	
	$scope.submitForm = function(valid){

		password = verifyPass();

		if(valid === true){
			if($scope.email == undefined){
				email = null;
			} else {
				email = $scope.email;
			}
			if(password == false){
				$uibModal.open({
					templateUrl: 'warning.html',
					controller: 'warningCtrl',
					size: 'md',
					resolve: {
						ErrorMsg : function () {
							return "Password Did Not Match";
						}
					}
				});
			} else {
				$uibModal.open({
					templateUrl: 'confirmation.html',
					controller: 'confirmationCtrl',
					size: 'sm',
					resolve: {
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
	};

	

});

/*load the warning modal */
app.controller('warningCtrl', function ($scope, $http, $uibModal, $uibModalInstance, ErrorMsg) {
	$scope.ErrorMsg = ErrorMsg;
});

/*load the warning modal */
app.controller('confirmationCtrl', function ($scope, $http, $uibModal, $uibModalInstance, passData) {
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
				size: 'md'
			});
			$uibModalInstance.close();
			//window.location.assign(site_url + "/User_Profile");
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