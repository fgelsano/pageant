<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Miss Batobalani 2018</title>

  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
  <style type="text/css">
    @font-face{
      font-family: charles;
      src: url("../assets/fonts/CharlemagneStd-Bold.otf");
    }
  </style>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body ng-app = "displayApp" ng-controller = "displayCtrl">
<div class="image" style="background-image: url('image/batobalani.png');">
</div>
<div class="candidateimage">
  <div class="cimage">
    <img src="../assets/images/logo.jpeg" width="100%">
  </div>
</div>
<div class="score">
  <h1> {{ indivCat }} CATEGORY</h1>
  <h1> {{ indivCan.name }}</h1>
  <h2> {{ indivCan.team }}</h2>
  <h3> {{ indivCan.descript }}</h3>
  <div class="scoredata">
    <i class="x">0</i>
    <i>.</i>
    <i class="x">0</i>
    <i class="x">0</i>
  </div>
  <div class="status">
    <div ng-repeat = "jdg in judge"></div>
  </div>
</div>

<script type="text/javascript" src = "../assets/js/jquery.min.js"></script>
<script type="text/javascript" src = "../assets/js/angular.min.js"></script>
<script type="text/javascript" src = "script.js"></script>
</body>
</html>
