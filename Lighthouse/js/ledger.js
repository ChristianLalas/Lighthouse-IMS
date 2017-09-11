var site_url = document.getElementById("route").value;
var currentUser = document.getElementById("currentUser").value;
var itemCode = document.getElementById("itemCode").value;

var app = angular.module('ledger', ['ui.bootstrap', 'ngAnimate', 'ngSanitize']);

app.controller('ledgerCtrl', function($scope, $http, $uibModal, $log, $filter){
	$http.post(site_url + "/Inventory/getLedgerDate",{"itemCode":itemCode})
	.success(function(data,status,headers,config){
		var today = new Date();
		var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
		var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
		var dateTime = date+' '+time;

		data.push({"dates":dateTime});
		$scope.toDatesData = data;
		$scope.fromDatesData = data;
		console.log(data);
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

	$scope.toOnSelect = function($item, $model, $label, index){
		console.log($item.dates);
		$http.post(site_url + "/Inventory/nextPreviousLedgerDate",{
			"itemCode":itemCode, 
			"date":$item.dates
		}).success(function(data,status,headers,config){
			$scope.fromDate = data[0].date;
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
	}

	$scope.fromOnSelect = function($item, $model, $label, index){
		$http.post(site_url + "/Inventory/getNextLedgerDate",{
			"itemCode":itemCode, 
			"date":$item.dates
		}).success(function(data,status,headers,config){
			$scope.toDate = data[0].date;
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
	}

	function clearFromField(){
		$scope.toDate = "";
	}

	function clearToField(){
		$scope.fromDate = "";
	}
});

/*load the warning modal */
app.controller('warningCtrl', function ($scope, $http, $uibModal, $uibModalInstance, ErrorMsg) {
	$scope.ErrorMsg = ErrorMsg;
});	