var app = angular.module("displayApp", []);
app.filter("percent", function(){
	return	function(e){
		return ((parseFloat(e) / 10) * 100).toFixed(2);
	}
})
app.controller('displayCtrl', function($scope, $http){
    
    setInterval(function(){
      $http.get("../api/indiv2.php").then(function(response){
        $scope.candidate = response.data.candidate;
        $scope.results = response.data.score[0];
        $scope.Summary = response.data.Summary[0];
      });
    },1000);

});