var site_url = document.getElementById("route").value;
var currentUser = document.getElementById("currentUser").value;
var items = [], desc, physCnt, logCnt, itemCode, arrayCount;

var app = angular.module('endingBalance', ['ui.bootstrap', 'ngAnimate', 'ngSanitize']);

app.controller('endingBalanceCtrl', function($scope, $http, $uibModal, $log, $filter){
	
	$scope.checkInputs =  function(index, logicalCount, physicalCount){
		if(logicalCount !== physicalCount){
			document.getElementById("desc"+index).disabled = false;
		} else{
			document.getElementById("desc"+index).disabled = true;
		}	
	}

	$scope.clearArray = function(){
		items.splice(0,items.length);
	}	

	function itemVal(){
		arrayCount = parseInt(document.getElementById("arrayCount").value);
		
		for (var i = 0; i < arrayCount; i++) {
			
			itemCode = document.getElementById("itemCode"+i).value;
			physCnt = parseInt(document.getElementById("physCnt"+i).value);
			logCnt 	= parseInt(document.getElementById("logCnt"+i).value);
			desc = document.getElementById("desc"+i).value;

			if(isNaN(physCnt) == true){
				return "physCntError";
			} else if( Number.isInteger(qty) === false){
				return "qtyError";
			} else if(logCnt != physCnt){
				if(desc === "" || desc === undefined){
					return "descError";
				} else if(desc !== "" || desc !== undefined){
					if(checkItem(itemCode) !== true){
						items.push({
						"itemCode"	: itemCode,
						"logCnt"	: logCnt,
						"physCnt"	: physCnt,
						"desc"		: desc
						});
					}
					console.log(items);
				}
			} else if(logCnt == physCnt){
				if(checkItem(itemCode) !== true){
					items.push({
						"itemCode"	: itemCode,
						"logCnt"	: logCnt,
						"physCnt"	: physCnt,
						"desc"		: null
					});
				}
				console.log(items);
			}
		}	
	}

	function checkItem(itemCode){
		for (var i = 0; i <= items.length; i++) {
			if(items[i] !== undefined ){
				if(itemCode === items[i].itemCode){
					return true;
					break;
				}
			} 
		}
	}

	$scope.print = function(divName){
		var printContents = document.getElementById(divName).outerHTML;
		newWin = window.open("");	
		newWin.document.write(printContents);
		newWin.print();
	}

	$scope.save = function(){
		console.log(itemVal());

		if(items.length < 0){
			$uibModal.open({
				templateUrl: 'warning.html',
				controller: 'warningCtrl',
				size: 'md',
				resolve: {
					ErrorMsg : function () {
						return "There's Noting To Save";
					}
				}
			});
		} else if(itemVal() === "qtyError"){
			$uibModal.open({
				templateUrl: 'warning.html',
				controller: 'warningCtrl',
				size: 'md',
				resolve: {
					ErrorMsg : function () {
						return "Please Enter Proper Value It Must Be In Whole Numbers";
					}
				}
			});
		} else if(itemVal() === "physCntError"){
			$uibModal.open({
				templateUrl: 'warning.html',
				controller: 'warningCtrl',
				size: 'md',
				resolve: {
					ErrorMsg : function () {
						return "Please Enter Proper Value It Must Be Equal Or Greater Than 0";
					}
				}
			});
		} else if(itemVal() === "descError"){
			$uibModal.open({
				templateUrl: 'warning.html',
				controller: 'warningCtrl',
				size: 'md',
				resolve: {
					ErrorMsg : function () {
						return "Please Fill up The Descriptions Properly";
					}
				}
			});
		} else {
			$uibModal.open({
				templateUrl: 'confirmation.html',
				controller: 'confirmationCtrl',
				size: 'sm',
				resolve: {
					confMsg : function (){
						return "Are You Sure You Want To Record Balances?"
					},

					passData : function () {
						return data = [
							currentUser,
							items
						];
					}
				}	
			});
		}
	}
});

app.controller('warningCtrl', function ($scope, $http, $uibModal, $uibModalInstance, ErrorMsg) {
	$scope.ErrorMsg = ErrorMsg;
});

app.controller('confirmationCtrl', function ($scope, $http, $uibModal, $uibModalInstance, confMsg, passData) {
	$scope.confMsg = confMsg;

	$scope.yes = function(){
		$http.post(site_url + "/Ending_Balance/insertEndBalData", {
				"accountID" : passData[0],
				"itemData" 	: passData[1]	
		}).success(function(data,status,headers,config){
			$uibModal.open({
				templateUrl: 'success.html',
				size: 'md'
			});
			$uibModalInstance.close();
			//window.location.assign(site_url + "/Ending_Balance");
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