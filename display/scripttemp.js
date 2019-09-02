var app = angular.module("displayApp", []);
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

      var cut = /%20/gi;

      var can = location.search.substr(location.search.indexOf("&"),location.search.length);
      can = can.replace("&can=","");
      can = can.replace(cut," ");

      var cat = location.search.substr(0,location.search.indexOf("&"));
      cat = cat.replace("?cat=","");
      cat = cat.replace(cut," ");

      console.log(cat+can);

      $http({
        url: "../api/candidate.php",
        method: "GET",
        params:{
          candidate: can
        }
      }).then(function(response){
          $scope.candidate = response.data.candidate;
      });
      $scope.shown = function(){
        tmp = 0;
        countJudge = 0;

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

        var can = $(".choice .form-group #candidate").val();
        var cat = $(".choice .form-group #cat").val();

        $http({
            url : "../api/indiv.php",
            method : "GET",
            params : {
                candidate: can
            }
            }).then(function(response1){
            $scope.indivCat = cat;
            $scope.indivCan = response1.data.results;

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



            check = setInterval(function(){
              $http({
                  url : "../api/scoring/submission.php",
                  method : "GET",
                  params : {
                      candidate: can,
                      category : cat
                  }
                  }).then(function(response2){
                    $scope.judge = null;
                    $scope.judge = response2.data.judge;
                    countJudge = response2.data.judges.length;

                    if(response2.data.crit){
                      tmp = countJudge * response2.data.crit.length;
                      countJudge = tmp;
                    }
                    if(!response2.data.judge){}
                    else{
                      if(response2.data.judge.length == countJudge){
                        // clearInterval(start);
                        // clearInterval(start1);
                        // clearInterval(start2);
                        // $(".score .scoredata .x").html("-");
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
                                        },1000);
                                      },1000);
                                    },1000);
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
                                        },2000);
                                      },2000);
                                    },2000);
                                  }
                                }
                              }   
                        });
                      }
                    }
              });
            },800);
        })
      }
      // var loop = setInterval(function(), 100)
  });