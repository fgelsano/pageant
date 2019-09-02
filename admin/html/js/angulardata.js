var app = angular.module("resultsApp", []);
app.controller("resultsCtrl", function($scope, $http){
	$scope.category = function(e){
		console.log(e);
	}
})