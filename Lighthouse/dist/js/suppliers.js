var site_url = document.getElementById("route").value;
var currentUser = document.getElementById("currentUser").value;

var app = angular.module('suppliers', ['ui.bootstrap', 'ngAnimate', 'ngSanitize']);

app.controller('suppliersCtrl', function($scope, $http, $uibModal, $log){

	$scope.editSupplier = function(supId){
		var modalInstance = $uibModal.open({
			templateUrl: 'editSupplier.html',
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

app.controller('editSupplierCtrl', function ($scope, $http, $uibModal, $uibModalInstance, supId) {
	$http.post(site_url + "/Suppliers/searchSupplier", {"id":supId})
	.success(function(data,status,headers,config){
		$scope.editCompanyName 	= data[0].supCompany;
		$scope.editAddress 		= data[0].supAd;
		$scope.editContatPer 	= data[0].supContactPer;
		$scope.editContactNo 	= data[0].supContactNo;
	});

	$scope.submitForm = function(valid){
		if(valid === true){ 
	    	$http.post(site_url + "/Suppliers/updateSupplier",{
	    		"id"		: supId, 
	    		"accountID"	: currentUser, 
	    		"company" 	: $scope.editCompanyName,
				"address" 	: $scope.editAddress,
				"contactNo"	: $scope.editContactNo,
				"personel"	: $scope.editContatPer 
	    	}).success(function(data,status,headers,config){
				$uibModalInstance.close();
				$uibModal.open({
					templateUrl: 'success.html',
					controller: 'successCtrl',
					size: 'sm',
					resolve: {
						msg : function () {
							return "Supplier Has Bean Updated";
						}
					}
				});
				window.location.assign(site_url + "/Suppliers");
			});
    	}
	};

	$scope.cancel = function () {
    	$uibModalInstance.dismiss('cancel');
	};
});