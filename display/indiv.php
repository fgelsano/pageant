<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Miss Teen Mantahan 2019</title>

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
<div class="clickreveal">
  <button ng-click = "stop()" class="btn btn-danger">Reveal</button>
</div>
<div class="candidatelist">
  <div class="col-md-6">
      <div class="odd">
        <button ng-repeat = "x in CanList" ng-click = "shownOdd(x.name)" style="{{ x.number | Odd}}">{{ x.number }}</button>
      </div>
  </div>
  <div class="col-md-6">
      <div class="even">
        <button ng-repeat = "x in CanList" ng-click = "shownEven(x.name)" style="{{ x.number | Even}}">{{ x.number }}</button>
      </div>
  </div>
</div>
<div class="image" style="background-image: url('image/batobalani.png');">
</div>
<div id="candidateimage">
  <div class="cimage">
    <img src="../assets/images/logo2.png" width="300px">
  </div>
</div>
<div class="score">
  <h1> {{ indivCat }} CATEGORY</h1>
  <h1 id = "candidatename">{{ indivCan.name }}</h1>
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
