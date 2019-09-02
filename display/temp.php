<?php
    $con = new mysqli("localhost",'root','','pageant');
    include 'calculate.php';
    include 'top.php';
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Miss Batobalani 2018</title>

  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">

  <style type="text/css">
      body{
        background-color: #eee;
      }
      .image{
        background-repeat: no-repeat;
        background-size: contain;
      }
      .container-fluid .row .col-md-4 .res{
        width: 100%;
        padding:6px 8px;
        box-shadow: 0 0 4px #000;
        margin-bottom: 20px;
        background-color: #fff;
      }
      .container-fluid .row .col-md-4 .res .table-responsive table tbody tr:nth-child(1){
        
        background-color: #c4e3f3;
      }
      .container-fluid .row .col-md-4 .res .table-responsive table tbody tr:nth-child(2){
        background-color: #dff0d8;
      }
      container-fluid .row .col-md-4 .res .table-responsive table tbody tr:nth-child(3){
        background-color: #fcf8e3;
      }
      .container-fluid .row .col-md-4{
        display: none;
      }
      .container-fluid .row .shown{
        display: block;
      }
  </style>
</head>

<body ng-app = "displayApp" ng-controller = "displayCtrl">
<div class="container-fluid">
  <div class="image" style="width: 100%;padding:30px 0;background-image: url('image/batobalani.png');">
    <h2 class = 'text-center'>Tabulation Summary</h2>
  </div>
  <div class="row">
    <div ng-repeat = "(index, value) in results" class="col-md-4 col-lg-4 {{ value | showcurrent }}" >
      <div class="res">
        <h2 class="alert alert-info text-center"> {{ index }}</h2>
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Candidate</th>
                <th>Area</th>
                <th>Score</th>
                <th>Rank</th>
              </tr>
            </thead>
            <tbody id = "showtalbe">
              <tr ng-repeat = "x in value">
                <td>{{ x.number }}</td>
                <td>{{ x.Candidate }}</td>
                <td>{{ x.team }}</td>
                <td>{{ x.Score }}</td>
                <td>{{ x.award }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>   
    </div>
  </div> 
</div>


<script type="text/javascript" src = "../assets/js/jquery.min.js"></script>
<script type="text/javascript" src = "../assets/js/angular.min.js"></script>
<script type="text/javascript">
    var app = angular.module("displayApp", []);
    app.filter("showcurrent", function(){
       return function(e){

          if(e != "false"){
            return "shown";
          }else
            return;
       }
    })
    app.controller('displayCtrl', function($scope, $http){
      $http.get("../api/resultstemp.php").then(function(response){
        console.log(response.data);
        $scope.results = response.data;
      });
      setInterval(function(){
        $http.get("../api/resultstemp.php").then(function(response){
          $scope.results = response.data;
        });
      },800);
       
    })
    // setTimeout(function(){
    //   location.reload();
    //   },10000);
</script>
</body>
</html>
