var app = angular.module("displayApp", []);
app.controller('displayCtrl', function($scope, $http){
	$http.get("../../api/indiv.php").then(function(response){
	  $scope.candidate = response.data.candidate;
	  $scope.category = response.data.category;
	});
});
