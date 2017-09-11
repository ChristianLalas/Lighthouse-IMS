var site_url = document.getElementById("route").value;
var currentUser = document.getElementById("currentUser").value;

var app = angular.module('suppliers', ['ui.bootstrap', 'ngAnimate', 'ngSanitize']);

app.controller('suppliersCtrl', function($scope, $http, $uibModal, $log){

	$scope.addSupplier = function(){
		var modalInstance = $uibModal.open({
			templateUrl: 'supplierFields.html',
			controller: 'addSupplierCtrl',
			size: 'md'
		});
	}

	$scope.editSupplier = function(supId){
		var modalInstance = $uibModal.open({
			templateUrl: 'supplierFields.html',
			controller: 'editSupplierCtrl',
			size: 'md',
			resolve: {
				supId : function () {
					return supId;
				}
			}
		});
	}
});

app.controller('addSupplierCtrl', function ($scope, $http, $uibModal, $uibModalInstance) {
	$scope.header = "Add New Supplier";

	$scope.checkCompanyName = function(){
		$http.post(site_url + "/Suppliers/checkNewSupplierName",{
			"newSupplierName"	: $scope.CompanyName
		}).success(function(data,status,headers,config){
			if(data == "TRUE"){
				$scope.supplierNameWarning = true;
			} else if(data == "FALSE"){
				$scope.supplierNameWarning = false;
			}
		}).error(function(data,status,headers,config){
			$uibModal.open({
				templateUrl: 'warning.html',
				controller: 'warningCtrl',
				size: 'md',
				resolve: {
					ErrorMsg : function () {
						return "Server Error Unable To Connect To Database";
					}
				}
			});
		});
	}

	$scope.submitForm = function(valid){
		$http.post(site_url + "/Suppliers/checkNewSupplierName",{
			"newSupplierName":$scope.CompanyName
		}).success(function(data,status,headers,config){
			if(data == "TRUE"){
				$scope.supplierNameWarning = true;
			} else if(valid === true && data == "FALSE"){ 
				$scope.supplierNameWarning = false;
		    	$http.post(site_url + "/Suppliers/insertSupplier",{
		    		"accountID"	: currentUser, 
		    		"company" 	: $scope.CompanyName,
					"address" 	: $scope.Address,
					"contactNo"	: $scope.ContactNo,
					"personel"	: $scope.ContatPer 
		    	}).success(function(data,status,headers,config){
					$uibModalInstance.close();
					$uibModal.open({
						templateUrl: 'success.html',
						controller: 'successCtrl',
						size: 'md',
						resolve: {
							msg : function () {
								return "Supplier Has Bean Added";
							}
						}
					});
					window.location.assign(site_url + "/Suppliers");
				});
			};
		});
	};

	$scope.cancel = function () {
    	$uibModalInstance.dismiss('cancel');
	};
});

app.controller('editSupplierCtrl', function ($scope, $http, $uibModal, $uibModalInstance, supId) {
	$scope.header = "Edit Supplier";
	$http.post(site_url + "/Suppliers/searchSupplier", {"id":supId})
	.success(function(data,status,headers,config){
		$scope.CompanyName 	= data[0].supCompany;
		$scope.Address 		= data[0].supAd;
		$scope.ContatPer 	= data[0].supContactPer;
		$scope.ContactNo 	= data[0].supContactNo;
	});

	$scope.checkCompanyName = function(){
		$http.post(site_url + "/Suppliers/checkEditSupplierName",{
			"suppierID"		: supId,
			"suppierName"	: $scope.CompanyName
		}).success(function(data,status,headers,config){
			if(data == "TRUE"){
				$scope.supplierNameWarning = true;
			} else if(data == "FALSE"){
				$scope.supplierNameWarning = false;
			}
		}).error(function(data,status,headers,config){
			$uibModal.open({
				templateUrl: 'warning.html',
				controller: 'warningCtrl',
				size: 'md',
				resolve: {
					ErrorMsg : function () {
						return "Server Error Unable To Connect To Database";
					}
				}
			});
		});
	}

	$scope.submitForm = function(valid){
		$http.post(site_url + "/Suppliers/checkEditSupplierName",{
			"suppierID"		: supId,
			"suppierName"	: $scope.CompanyName
		}).success(function(data,status,headers,config){
			if(data == "TRUE"){
				$scope.supplierNameWarning = true;
			} else if(valid === true && data == "FALSE"){
				$scope.supplierNameWarning = false; 
		    	$http.post(site_url + "/Suppliers/updateSupplier",{
		    		"id"		: supId, 
		    		"accountID"	: currentUser, 
		    		"company" 	: $scope.CompanyName,
					"address" 	: $scope.Address,
					"contactNo"	: $scope.ContactNo,
					"personel"	: $scope.ContatPer 
		    	}).success(function(data,status,headers,config){
					$uibModalInstance.close();
					$uibModal.open({
						templateUrl: 'success.html',
						controller: 'successCtrl',
						size: 'md',
						resolve: {
							msg : function () {
								return "Supplier Has Bean Updated";
							}
						}
					});
					window.location.assign(site_url + "/Suppliers");
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
			

	};

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