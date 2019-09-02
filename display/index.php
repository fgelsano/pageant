<?php
    $con = new mysqli("localhost",'root','','pageant');
    include 'calculate.php';
    include 'top.php';
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Miss Teen Mantahan 2019</title>

  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">

  <style type="text/css">
      .fullscreen-bg {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        overflow: hidden;
        z-index: -100;
      }

      .fullscreen-bg__video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
      }

      @media (min-aspect-ratio: 16/9) {
        .fullscreen-bg__video {
          height: 300%;
          top: -100%;
        }
      }

      @media (max-aspect-ratio: 16/9) {
        .fullscreen-bg__video {
          width: 300%;
          left: -100%;
        }
      }

      @media (max-width: 767px) {
        .fullscreen-bg {
          background: url('../img/videoframe.jpg') center center / cover no-repeat;
        }

        .fullscreen-bg__video {
          display: none;
        }
      }
      .image{
        background-repeat: no-repeat;
        background-size: contain;
      }
  </style>
</head>

<body ng-app = "displayApp" ng-controller = "displayCtrl">
<!-- <div class="fullscreen-bg">
  <video loop muted autoplay class="fullscreen-bg__video">
      <source src="video/gold.mp4" type="video/mp4">
  </video>
</div> -->

<div class="container-fluid">
  <div class="image" style="width: 100%;padding:30px 0;background-image: url('image/batobalani.png');">
    <!-- <img src="image/batobalani.png" width="100%" height="100%"> -->
    <h2 class = 'text-center'>Tabulation Summary</h2>
  </div>
  <div class="panel"></div>
    <div class="table-responsive">
      <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Candidate</th>
          <th>City</th>
          <th>Festival</th>
          <th ng-repeat = "(index, value) in cat">{{ value.Cat | summary }}</th>
          <th>Rank Score</th>
        </tr>
      </thead>
      <tbody id = "showtalbe">
        <tr ng-repeat = "x in results">
          <td>{{ x[0].number }}</td>
          <td>{{ x[0].name }}</td>
          <td>{{ x[0].team }}</td>
          <td>{{ x[0].descript }}</td>
          <td ng-repeat = "(index, value) in x[1]">{{ value | Score }}</td>
          <th>{{ x[1][6].Score }}</th>
        </tr>
      </tbody>
    </table>
    </div>
  </div>
</div>

<script type="text/javascript" src = "../assets/js/jquery.min.js"></script>
<script type="text/javascript" src = "../assets/js/angular.min.js"></script>
<script type="text/javascript">
    var app = angular.module("displayApp", []);
    app.filter("summary", function(){
      return function(e){
        if(e != "Summary"){
          return e;
        }
        else
          return;
      }
    });
    app.filter("Score", function(){
      return function(e){
        if(e.Cat != "Summary"){
          return e.Score;
        }
        else
          return;
      }
    });
    app.controller('displayCtrl', function($scope, $http){
      $http.get("../api/results.php").then(function(response){
        $scope.results = response.data.results;
        $scope.cat = response.data.results[0][1];
      });
      // setInterval(function(){
      // },10000);
       
    })
    setTimeout(function(){
      location.reload();
      },10000);
</script>
</body>
</html>
