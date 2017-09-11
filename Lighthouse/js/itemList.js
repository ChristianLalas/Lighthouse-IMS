var site_url = document.getElementById("route").value;
var newItemName = "";
var app = angular.module('itemList', ['ui.bootstrap', 'ngAnimate', 'ngSanitize']);

app.controller('itemListCtrl', function($scope, $http, $uibModal, $log){
	$scope.addItem = function(){
		var modalInstance = $uibModal.open({
			templateUrl: 'itemFlieds.html',
			controller: 'addItemCtrl',
			size: 'md'
		});
	}

	$scope.addUnit = function(){
		var modalInstance = $uibModal.open({
			templateUrl: 'unitFlieds.html',
			controller: 'addUnitCtrl',
			size: 'sm'
		});
	}

	$scope.editItem = function(code){
		var modalInstance = $uibModal.open({
			templateUrl: 'itemFlieds.html',
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

app.controller('addUnitCtrl', function ($scope, $http, $uibModal, $uibModalInstance) {
	$scope.header = "Add New Description";
	$scope.unitWarning = false;
	$scope.submitForm = function(valid){
		$http.post(site_url + "/Item_List/checkNewUnitName",{
			"unitName": $scope.name
		}).success(function(data,status,headers,config){
			if(data == "TRUE"){
				$scope.unitWarning = true;
			}else if(valid == true && data == "FALSE"){
				$http.post(site_url + "/Item_List/insertUnit",{
					"unitName": $scope.name
				}).success(function(data,status,headers,config){
					$uibModal.open({
						templateUrl: 'success.html',
						controller: 'successCtrl',
						size: 'md',
						resolve: {
							msg : function () {
								return "Description Has Been Added";
							}
						}
					});
					$uibModalInstance.close();
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

app.controller('addItemCtrl', function ($scope, $http, $uibModal, $uibModalInstance) {
	$scope.selectedUnit 	= "NULL";
	$scope.selectedItemType = "NULL";
	$scope.selectConvUnit = "NULL";
	
	$scope.header = "Add New Item";

	$http.post(site_url + "/Item_List/getUnits",{})
	.success(function(data,status,headers,config){
		$scope.units = data;
		$scope.convUnits = data;
	});

	$http.post(site_url + "/Item_List/getItemType",{})
	.success(function(data,status,headers,config){
		$scope.type = data;
	});

	$scope.checkItemName = function(){
		$http.post(site_url + "/Item_List/checkNewItem", {
			"newItemName":$scope.Name
		}).success(function(data,status,headers,config){
			if(data == "TRUE"){
				$scope.itemWarning = true;
			} else if(data == "FALSE"){
				$scope.itemWarning = false;
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

		$http.post(site_url + "/Item_List/checkNewItem", {
			"newItemName":$scope.Name
		}).success(function(data,status,headers,config){
			if( $scope.selectedUnit == "NULL" || $scope.selectedItemType == "NULL" || $scope.selectConvUnit == "NULL" || data == "TRUE"){
				if($scope.selectedUnit != "NULL"){
					$scope.unitWarning = false;
				} else {
					$scope.unitWarning = true;
				}

				if($scope.selectConvUnit != "NULL"){
					$scope.convUnitWarning = false;
				} else {
					$scope.convUnitWarning = true;
				}

				if($scope.selectedItemType != "NULL") {
					$scope.itemTypeWarnning = false;
				} else {
					$scope.itemTypeWarnning = true;
				}

				if(data == "TRUE"){
					$scope.itemWarning = true;
				} else if(data == "FALSE"){
					$scope.itemWarning = false;
				}

			} else if(valid === true && $scope.selectedUnit != "NULL" && $scope.selectedItemType != "NULL" && $scope.selectConvUnit != "NULL" && data == "FALSE"){ 
				$scope.unitWarning 		= false;
				$scope.convUnitWarning 	= false;
				$scope.itemTypeWarnning = false;
				$http.post(site_url + "/Item_List/insertItem", {
					"name" 			: $scope.Name,
					"baseUnit" 		: $scope.selectedUnit,
					"reorderLvl" 	: $scope.ReorderLvl,
					"type"			: $scope.selectedItemType,
					"convUnit"		: $scope.selectConvUnit,
					"bCValue"		: $scope.BCValue 
				}).success(function(data,status,headers,config){
					$uibModal.open({
						templateUrl: 'success.html',
						controller: 'successCtrl',
						size: 'md',
						resolve: {
							msg : function () {
								return "Item Has Been Added";
							}
						}
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
		});
	}

	$scope.cancel = function () {
    	$uibModalInstance.dismiss('cancel');
	};

});

app.controller('editItemCtrl', function ($scope, $http, $uibModal, $uibModalInstance, code) {
	$scope.header = "Edit Item";

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
		$scope.Name 			= data[0].itemName;
		$scope.selectedUnit		= data[0].baseUnit;
		$scope.ReorderLvl		= parseInt(data[0].itemRLvl);
		$scope.selectedItemType	= data[0].itemTypeID;
		$scope.selectConvUnit	= data[0].convUnitID;
		$scope.BCValue			= parseInt(data[0].bCValue);
	});

	$scope.checkItemName = function(){
		$http.post(site_url + "/Item_List/checkEditItemName", {
			"itemCode":code,
			"itemName":$scope.Name
		}).success(function(data,status,headers,config){
			if(data === "TRUE"){
				$scope.itemWarning = true;
			} else if(data === "FALSE"){
				$scope.itemWarning = false;
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
		$http.post(site_url + "/Item_List/checkEditItemName", {
			"itemCode":code,
			"itemName":$scope.Name
		}).success(function(data,status,headers,config){
			if( $scope.selectedUnit == "NULL" || $scope.selectedItemType == "NULL" || $scope.selectConvUnit == "NULL" || data === "TRUE"){
				if($scope.selectedUnit != "NULL"){
					$scope.unitWarning = false;
				} else {
					$scope.unitWarning = true;
				}

				if(data === "TRUE"){
					$scope.itemWarning = true;
				} else if(data === "FALSE"){
					$scope.itemWarning = false;
				}

				if($scope.selectConvUnit != "NULL"){
					$scope.convUnitWarning = false;
				} else {
					$scope.convUnitWarning = true;
				}

				if($scope.selectedItemType != "NULL") {
					$scope.itemTypeWarnning = false;
				} else {
					$scope.itemTypeWarnning = true;
				}

			} else if(valid === true && $scope.selectedUnit != "NULL" && $scope.selectedItemType != "NULL" && $scope.selectConvUnit != "NULL" && data == "FALSE"){ 
				$scope.unitWarning 		= false;
				$scope.convUnitWarning 	= false;
				$scope.itemTypeWarnning = false;
				$http.post(site_url + "/Item_List/updateItem", {
					"id"			: code, 
					"name" 			: $scope.Name,
					"baseUnit" 		: $scope.selectedUnit,
					"reorderLvl" 	: $scope.ReorderLvl,
					"type"			: $scope.selectedItemType,
					"convUnit"		: $scope.selectConvUnit,
					"bCValue"		: $scope.BCValue 
				}).success(function(data,status,headers,config){
					$uibModal.open({
						templateUrl: 'success.html',
						size: 'md',
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

/*load the warning modal */
app.controller('warningCtrl', function ($scope, $http, $uibModal, $uibModalInstance, ErrorMsg) {
	$scope.ErrorMsg = ErrorMsg;
});

app.controller('successCtrl', function ($scope, $http, $uibModal, $uibModalInstance, msg) {
	$scope.msg = msg;

	$scope.ok = function () {
		$uibModalInstance.dismiss('cancel');
	};
});