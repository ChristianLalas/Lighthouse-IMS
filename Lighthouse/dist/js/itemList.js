var site_url = document.getElementById("route").value;

var app = angular.module('itemList', ['ui.bootstrap', 'ngAnimate', 'ngSanitize']);

app.controller('itemListCtrl', function($scope, $http, $uibModal, $log){
	$scope.edit = function(code){
		var modalInstance = $uibModal.open({
			templateUrl: 'editItem.html',
			controller: 'editItemCtrl',
			size: 'md',
			resolve: {
				code : function () {
					return code;
				}
			}
		});
	}
});

app.controller('editItemCtrl', function ($scope, $http, $uibModal, $uibModalInstance, code) {
	
	$http.post(site_url + "/Item_List/getUnits",{})
	.success(function(data,status,headers,config){
		$scope.units = data;
		$scope.convUnits = data;
	});

	$http.post(site_url + "/Item_List/getItemType",{})
	.success(function(data,status,headers,config){
		$scope.type = data;
	});

	$http.post(site_url + "/Item_List/searchItem", {
		"code":code
	}).success(function(data,status,headers,config){
		$scope.editName 		= data[0].itemName;
		$scope.selectedUnit		= data[0].baseUnit;
		$scope.editReorderLvl	= parseInt(data[0].itemRLvl);
		$scope.selectedItemType	= data[0].itemTypeID;
		$scope.selectConvUnit	= data[0].convUnitID;
		$scope.editBCValue		= parseInt(data[0].bCValue);
	});

	$scope.submitForm = function(valid){
		if(valid === true){ 
			$http.post(site_url + "/Item_List/updateItem", {
				"id"			: code, 
				"name" 			: $scope.editName,
				"baseUnit" 		: $scope.selectedUnit,
				"reorderLvl" 	: $scope.editReorderLvl,
				"type"			: $scope.selectedItemType,
				"convUnit"		: $scope.selectConvUnit,
				"bCValue"		: $scope.editBCValue 
			}).success(function(data,status,headers,config){
				$uibModal.open({
					templateUrl: 'success.html',
					size: 'sm',
				});
				$uibModalInstance.close();
				window.location.assign(site_url + "/Item_List");
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
	}

	$scope.cancel = function () {
    	$uibModalInstance.dismiss('cancel');
	};
});

/*load the warning modal */
app.controller('warningCtrl', function ($scope, $http, $uibModal, $uibModalInstance, ErrorMsg) {
	$scope.ErrorMsg = ErrorMsg;
});