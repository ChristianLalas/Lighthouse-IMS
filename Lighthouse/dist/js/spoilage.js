var items = [], units = [];
var actLogID, SelItemName, previousDate,nextDate, newDate, intDate, intTime, tzoffset, dateReceived, newQty;
var site_url = document.getElementById("route").value;
var currentUser = document.getElementById("currentUser").value;
var trackID = document.getElementById("trackID").value;

var app = angular.module('spoilage', ['ui.bootstrap', 'ngAnimate', 'ngSanitize']);

app.controller('spoilageCtrl', function($scope, $http, $uibModal, $log, $filter){

	/*sets the SUPPLIER to default*/
	$scope.selectedSupplier = "null";

	/*sets the RECIEVER to default*/
	$scope.selectedUser = "null";

	/*date and time picker*/
	$scope.ismeridian = true;
	$scope.dt = new Date();
	$scope.time = new Date();

	$scope.hstep = 1;
	$scope.mstep = 1;

	$scope.options = {
		hstep: [1, 2, 3],
		mstep: [1]
	};

	$scope.update = function() {
		var d = new Date();
		d.setHours( 14 );
		d.setMinutes( 0 );
		$scope.time = d;
	};

	$scope.inlineOptions = {
		customClass: getDayClass,
		minDate: new Date(2000, 01, 01),
		showWeeks: 'false'
	};

	$scope.dateOptions = {
		formatYear: 'yyyy',
		maxDate: new Date(),
		minDate: new Date(2000, 01, 01),
		startingDay: 0,
		showWeeks:  false
	};

	$scope.open = function() {
		$scope.popup.opened = true;
	};

	$scope.setDate = function(year, month, day) {
		$scope.dt = new Date(year, month, day);
	};

	$scope.popup = {
		opened: false
	};

	$scope.previous = function(){
		previousDate = $scope.dt.getDate() - 1;
		newDate = $scope.dt.setDate(previousDate);
		$scope.dt = new Date(newDate);
	}

	$scope.next = function(){
		nextDate = $scope.dt.getDate() + 1;
		newDate = $scope.dt.setDate(nextDate);
		$scope.dt = new Date(newDate);
	}

	function getDayClass(data) {
		var date = data.date,
		mode = data.mode;
		if (mode === 'day') {
			var dayToCheck = new Date(date).setHours(0,0,0,0);

			for (var i = 0; i < $scope.events.length; i++) {
				var currentDay = new Date($scope.events[i].date).setHours(0,0,0,0);

				if (dayToCheck === currentDay) {
					return $scope.events[i].status;
				}
			}
		}

		return '';
	}
	/*end date and time picker*/

	/*main javaScript*/
	/*get ite from the database*/
	$http.get(site_url + "/Deliveries/getItems")
	.success(function(data,status,headers,config){
		$scope.dataItems = data;
	})
	.error(function(data,status,headers,config){
		$uibModal.open({
			templateUrl: 'warning.html',
			controller: 'warningCtrl',
			size: 'md',
			resolve: {
				ErrorMsg : function () {
					return "Server Error Unable To Connet The DataBase";
				}
			}	
		});
	});

	/*fill's up the input flieds*/
	$scope.onSelect = function($item, $model, $label){
		$scope.proType 		= $item.itemTypeName;
		$scope.itemCode 	= $item.itemCode;
		units.splice(0, units.length);
		units.push({"unitID":$item.unitID, "unitName" : $item.unitName});
		if($item.convUnitName !== $item.unitName){
			units.push({"unitID":$item.convUnitID, "unitName" : $item.convUnitName});
		}
		$scope.units = units; 
		$scope.unit = JSON.stringify(units[0]);
	}

	/*add item/s to the ITEM ARRAY*/
	$scope.addItem = function(itemCode, itemName, qty, unit, desc){
		if(itemName === undefined || itemName == ""){
			$uibModal.open({
				templateUrl: 'warning.html',
				controller: 'warningCtrl',
				size: 'md',
				resolve: {
					ErrorMsg : function () {
						return "Please Select An Item";
					}
				}
			});
		} else if(itemCode === undefined || itemCode == ""){
			$uibModal.open({
				templateUrl: 'warning.html',
				controller: 'warningCtrl',
				size: 'md',
				resolve: {
					ErrorMsg : function () {
						return "Item Not Found Or Not Yet In The Database";
					}
				}
			});
		} else if(desc === undefined || desc == ""){
			$uibModal.open({
				templateUrl: 'warning.html',
				controller: 'warningCtrl',
				size: 'md',
				resolve: {
					ErrorMsg : function () {
						return "Please Fill-up The DESCRIPTION Properly";
					}
				}
			});
		} else if( qty <= 0){
			$uibModal.open({
				templateUrl: 'warning.html',
				controller: 'warningCtrl',
				size: 'md',
				resolve: {
					ErrorMsg : function () {
						return "Please Enter Right Quantity That Is Less Than 1";
					}
				}
			});
		} else if( Number.isInteger(qty) === false){
			$uibModal.open({
				templateUrl: 'warning.html',
				controller: 'warningCtrl',
				size: 'md',
				resolve: {
					ErrorMsg : function () {
						return "Quantity Should Be In Whole Numbers";
					}
				}
			});
		
		} else if( qty === undefined || qty == null){
			$uibModal.open({
				templateUrl: 'warning.html',
				controller: 'warningCtrl',
				size: 'md',
				resolve: {
					ErrorMsg : function () {
						return "Please Enter Quantity";
					}
				}
			});
		}  else {
			if(itemName.itemName === undefined){
				SelItemName = itemName;
			} else {
				SelItemName = itemName.itemName;
			}

			if(items.length != 0){
				if (checkItem(SelItemName) == true){
					$uibModal.open({
						templateUrl: 'warning.html',
						controller: 'warningCtrl',
						size: 'md',
						resolve: {
							ErrorMsg : function () {
								return "Item Is Already In The Table";
							}
						}
					});
				} else {
					items.push({	
						"itemCode"	: itemCode, 
						"name"		: SelItemName, 
						"qty"		: qty, 
						"unit"		: [JSON.parse(unit)], 
						"desc"		: desc
					});	
					$scope.items = items;
				}
			} else {
				items.push({
					"itemCode"	: itemCode, 
					"name"		: SelItemName, 
					"qty"		: qty, 
					"unit"		: [JSON.parse(unit)], 
					"desc"		: desc
				});	
				$scope.items = items;
			}

			$scope.itemCode 	= "";
			$scope.itemName 	= "";
			$scope.unit 		= "";
			$scope.qty 			= null;	
			$scope.desc 		= "";	
			units.splice(0, units.length);
		}
	}

	/*Check if item already in the ITEMS ARRAY*/
	function checkItem(item){
		for (var i = 0; i <= items.length; i++) {
			if(items[i] !== undefined ){
				if(item === items[i].name){
					return true;
					break;
				}
			} 
		}
	}

	/*edit the selected Item in the table*/
	$scope.edit = function(index){
		$scope.itemName 	= items[index].name;
		$scope.itemCode		= items[index].itemCode;
		$scope.qty			= parseInt(items[index].qty);
		$scope.units		= items[index].unit;
		$scope.unit 		= JSON.stringify(items[index].unit[0]);
		$scope.desc 		= items[index].desc;
		items.splice(index, 1);
	}

	/*Removes the selected Item from the table and ITEMS ARRAY*/
	$scope.remove = function(index){
		items.splice(index, 1);
	}

	/*Removes all data*/
	function clearData(){
		$scope.itemName 	= "";
		$scope.itemCode 	= "";
		$scope.unit 		= "";
		$scope.qty 			= null;
		$scope.currentQty	= "";
		$scope.proType 		= "";
		$scope.selectedSupplier = "null";
		$scope.desc 		="";
		items.splice(0,items.length);

		$scope.dt = new Date();
		$scope.time = new Date();
	}

	$scope.clearFlieds = function(){
		$scope.itemCode 	= "";
		$scope.qty 			= null;
		$scope.unit 		= "";
		$scope.currentQty	= "";
		$scope.proType 		= "";
		$scope.desc 		= "";
	}

	/*calls the clearData() function*/
	$scope.clear = function(){
		clearData();
	}

	/*insert data to the database*/
	$scope.save = function(){
		
		intDate = $filter('date')($scope.dt, "yyyy-MM-dd");
		intTime = $filter('date')($scope.time, "HH:mm:ss");

		tzoffset = (new Date()).getTimezoneOffset() * 60000;
		dateIssued = new Date(new Date(intDate +" "+ intTime) - tzoffset);

		if(items.length === 0){
			$uibModal.open({
				templateUrl: 'warning.html',
				controller: 'warningCtrl',
				size: 'md',
				resolve: {
					ErrorMsg : function () {
						return "You Have Not Yet Entered Any Data";
					}
				}
			});
		} else if ($scope.selectedUser == "null") {
			$uibModal.open({
				templateUrl: 'warning.html',
				controller: 'warningCtrl',
				size: 'md',
				resolve: {
					ErrorMsg : function () {
						return "Please Select Reviever";
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
					return "Are You Sure You Want To Save Spoilage?"
				},
				passData : function() {
					return data = [
							currentUser,
							items,
							trackID,
							$scope.selectedUser,
							dateIssued	
						]
					}	
				}
			});
			
		}
	}
});

/*load the warning modal */
app.controller('warningCtrl', function ($scope, $http, $uibModal, $uibModalInstance, ErrorMsg) {
	$scope.ErrorMsg = ErrorMsg;
});
/*end main javaScript*/

app.controller('confirmationCtrl', function($scope, $http, $uibModal, $uibModalInstance, confMsg, passData) {
	
	$scope.confMsg = confMsg;	

	$scope.yes = function(){
		$http.post(site_url + "/Spoilage/insertCorrectionData", {
			"accoutID" 		: passData[0],
			"itemData" 		: passData[1],
			"trackID"		: passData[2],
			"issuer"		: passData[3],
			"dateTime"		: passData[4]
		}).success(function(data,status,headers,config){
			$uibModal.open({
				templateUrl: 'success.html',
				size: 'md'
			});
			window.location.assign(site_url + "/Spoilage");
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
		})
	}
	$scope.cancel =function(){
		$uibModalInstance.dismiss('cancel');

	};
});