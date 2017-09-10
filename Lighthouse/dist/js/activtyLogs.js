var i;
var sumData = [];
var site_url = document.getElementById("route").value;
var currentUser = document.getElementById("currentUser").value;

var app = angular.module('activityLogs', ['ui.bootstrap', 'ngAnimate', 'ngSanitize']);

app.controller('activityLogsCtrl', function($scope, $http, $uibModal, $log){

	$scope.viewSummaryBtn = function(id, activity){
		if(activity == "Deliveries"){
			var modalInstance = $uibModal.open({
			templateUrl: 'viewDelSummary.html',
			controller: 'viewDelSummaryCtrl',
			size: 'lg',
			resolve: {
					alID : function () {
						return id;
					},
					activity : function () {
						return activity;
					}
				}
			});
		} else if(activity == "Giving Returns"){
			var modalInstance = $uibModal.open({
			templateUrl: 'viewGRSummary.html',
			controller: 'viewGRSummaryCtrl',
			size: 'lg',
			resolve: {
					alID : function () {
						return id;
					},
					activity : function () {
						return activity;
					}
				}
			});
		} else if(activity == "Issuance") {
			var modalInstance = $uibModal.open({
				templateUrl: 'viewSummary.html',
				controller: 'viewSummaryCtrl',
				size: 'lg',
				resolve: {
					alID : function () {
						return id;
					},
					activity : function () {
						return activity;
					}
				}
			});
		} else if(activity == "Receiving Returns") {
			var modalInstance = $uibModal.open({
				templateUrl: 'viewSummary.html',
				controller: 'viewSummaryCtrl',
				size: 'lg',
				resolve: {
					alID : function () {
						return id;
					},
					activity : function () {
						return activity;
					}
				}
			});
		} else if(activity == "Spoilage") {
			var modalInstance = $uibModal.open({
				templateUrl: 'viewSummary.html',
				controller: 'viewSummaryCtrl',
				size: 'lg',
				resolve: {
					alID : function () {
						return id;
					},
					activity : function () {
						return activity;
					}
				}
			});
		} else if(activity == "Stock Adjustments"){
			var modalInstance = $uibModal.open({
				templateUrl: 'viewStkAdjSummaryCtrl.html',
				controller: 'viewStkAdjSummaryCtrl',
				size: 'lg',
				resolve: {
					alID : function () {
						return id;
					},
					activity : function () {
						return activity;
					}
				}
			});
		} else {
			var modalInstance = $uibModal.open({
				templateUrl: 'nothing.html',
				size: 'sm'
			});
		}
		
	}

});

app.controller('viewSummaryCtrl', function($scope, $http, $uibModal, $uibModalInstance, alID, activity){
	sumData.splice(0,sumData.length);
	$http({
  		method : 'POST',	
        url : site_url + '/ActivityLogs/getActitySum',
        headers: {'Content-Type': 'application/json'},
    	data : JSON.stringify({id: alID, activity: activity})
  	})
	.success(function(data,status,headers,config){
		for(i = 0; i <= data.length + 1; i++){
			if(data[i] !== undefined){
				sumData.push(JSON.parse(data[i]));
			}
		}
		
		$scope.dataSum 	= sumData;
		$scope.trkNo	= sumData[0].trackID;
		$scope.checker	= sumData[0].checker;
		$scope.tAD 		= sumData[0].dateNTime;
	}); 

	$scope.x = function () {
		$uibModalInstance.dismiss('cancel');
	};
});

app.controller('viewStkAdjSummaryCtrl', function($scope, $http, $uibModal, $uibModalInstance, alID, activity){
	sumData.splice(0,sumData.length);
	$http({
  		method : 'POST',	
        url : site_url + '/ActivityLogs/getActitySum',
        headers: {'Content-Type': 'application/json'},
    	data : JSON.stringify({id: alID, activity: activity})
  	})
	.success(function(data,status,headers,config){
		for(i = 0; i <= data.length + 1; i++){
			if(data[i] !== undefined){
				sumData.push(JSON.parse(data[i]));
			}
		}

		$scope.dataSum 	= sumData;
	}); 

	$scope.x = function () {
		$uibModalInstance.dismiss('cancel');
	};
});

app.controller('viewDelSummaryCtrl', function($scope, $http, $uibModal, $uibModalInstance, alID, activity){

	$http({
  		method : 'POST',	
        url : site_url + '/ActivityLogs/getActitySum',
        headers: {'Content-Type': 'application/json'},
    	data : JSON.stringify({id: alID, activity: activity})
  	})
	.success(function(data,status,headers,config){
		sumData.splice(0,sumData.length);

		for(i = 0; i <= data.length + 1; i++){
			if(data[i] !== undefined){
				sumData.push(JSON.parse(data[i]));
			}
		}

		$scope.dataSum 	= sumData;
		$scope.supplier = sumData[0].company;
		$scope.rctNo	= sumData[0].trackID;
		$scope.checker	= sumData[0].checker;
		$scope.tAD 		= sumData[0].dateNTime;
	});

	$scope.x = function () {
		$uibModalInstance.dismiss('cancel');
	};
});

app.controller('viewGRSummaryCtrl', function($scope, $http, $uibModal, $uibModalInstance, alID, activity){

	$http({
  		method : 'POST',	
        url : site_url + '/ActivityLogs/getActitySum',
        headers: {'Content-Type': 'application/json'},
    	data : JSON.stringify({id: alID, activity: activity})
  	})
	.success(function(data,status,headers,config){
		sumData.splice(0,sumData.length);

		for(i = 0; i <= data.length + 1; i++){
			if(data[i] !== undefined){
				sumData.push(JSON.parse(data[i]));
			}
		}

		$scope.dataSum 	= sumData;
		$scope.supplier = sumData[0].company;
		$scope.rctNo	= sumData[0].trackID;
		$scope.checker	= sumData[0].checker;
		$scope.tAD 		= sumData[0].dateNTime;
	});

	$scope.x = function () {
		$uibModalInstance.dismiss('cancel');
	};
});