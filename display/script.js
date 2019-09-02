var app = angular.module("displayApp", []);
app.filter("Odd", function(){
  return function(e){
    if(e%2 == "1"){
      return "display:inline;";
    }
    else{
      return "display:none;";
    }
  }
})
app.filter("Even", function(){
  return function(e){
    if(e%2 == "0"){
      return "display:inline;";
    }
    else{
      return "display:none;";
    }
  }
})
  app.controller('displayCtrl', function($scope, $http){
      var start = "";
      var start1 = "";
      var start2 = "";
      var check = "";
      var timeshown = "";
      var timeshown1 = "";
      var timeshown2 = "";
      var countJudge = 0;
      var tmp = 0;

      tmp = 0;
      countJudge = 0;

      

      function cleartime(){
          if( start != ""){ 
            clearInterval(start);
            clearInterval(start1);
            clearInterval(start2);
            start = "";
            start1 = "";
            start2 = "";
          }
          if( check != ""){clearInterval(check); check = "";}

          if( timeshown != ""){ 
            clearTimeout(timeshown);
            clearTimeout(timeshown1);
            clearTimeout(timeshown2);
            timeshown = "";
            timeshown1 = "";
            timeshown2 = "";
          }
      }

      function starttime(){
        cleartime();
        start = setInterval(function(){
          var score = Math.floor(Math.random() * 10);
          $(".score .scoredata .x:nth-child(1)").html(score);
        },90);

        start1 = setInterval(function(){
          var score = Math.floor(Math.random() * 10);
          $(".score .scoredata .x:nth-child(3)").html(score);
        },90);

        start2 = setInterval(function(){
          var score = Math.floor(Math.random() * 10);
          $(".score .scoredata .x:nth-child(4)").html(score);
        },90);
      }


      var cut = /%20/gi;


      var cat = location.search;
      cat = cat.replace("?cat=","");
      cat = cat.replace(cut," ");

      $scope.shownOdd = function(name){
        $http({
          url: "../api/candidate.php",
          method: "GET",
          params:{
            candidate: name
          }
        }).then(function(response){
            $("#candidateimage").removeClass("even");
            $("#candidateimage").addClass("odd");
            $scope.indivCan = response.data.candidate;
            $scope.indivCat = cat;
            starttime();
            
        });
      }
      $scope.shownEven = function(name){
        $http({
          url: "../api/candidate.php",
          method: "GET",
          params:{
            candidate: name
          }
        }).then(function(response){
            $("#candidateimage").removeClass("odd");
            $("#candidateimage").addClass("even");
            $scope.indivCan = response.data.candidate;
            $scope.indivCat = cat;
            starttime();

        });
      }

      $http({
        url: "../api/canlist.php",
        method: "GET"
      }).then(function(response){
          $scope.CanList = response.data.candidate;
      });
      

      var can = "";
      $scope.stop = function(){
        can = $("#candidatename").html();
        $http({
          url : "../api/scoring/showscore.php",
          method : "GET",
          params : {
              candidate: can,
              category : cat
          }
          }).then(function(response3){
            if(response3.data.score){
              if(response3.data.score.length > 0){
                clearInterval(check);
                var score = response3.data.score[0].Score;
                if(score.length != 6){
                  timeshown = setTimeout(function(){
                    clearInterval(start);
                    $(".score .scoredata .x:nth-child(1)").html(score.charAt(0));
                    timeshown1 = setTimeout(function(){
                      clearInterval(start1);
                      $(".score .scoredata .x:nth-child(3)").html(score.charAt(2));
                      timeshown2 = setTimeout(function(){
                        clearInterval(start2);
                        $(".score .scoredata .x:nth-child(4)").html(score.charAt(3));
                        clearTimeout(timeshown);
                        clearTimeout(timeshown1);
                        clearTimeout(timeshown2);
                      },800);
                    },800);
                  },800);
                }else{
                  timeshown = setTimeout(function(){
                    $(".score .scoredata .x:nth-child(1)").html(score.charAt(0) + score.charAt(1));
                    timeshown1 = setTimeout(function(){
                      $(".score .scoredata .x:nth-child(3)").html(score.charAt(3));
                      timeshown2 = setTimeout(function(){
                        $(".score .scoredata .x:nth-child(4)").html(score.charAt(4));
                        clearTimeout(timeshown);
                        clearTimeout(timeshown1);
                        clearTimeout(timeshown2);
                      },800);
                    },800);
                  },800);
                }
              }
            }   
      });
      }
  });