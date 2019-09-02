<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Miss Batobalani 2018</title>

  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body ng-app = "displayApp" ng-controller = "displayCtrl">
<div class="image" style="background-image: url('image/batobalani.png');">
</div>
<div class="choice">
  <h4 class="text-center alert alert-info">Candidate Selection</h4>
  <div class="form-group">
    <label>Candidate: </label>
    <select id = "candidate" class="form-control">
      <option ng-repeat = "x in candidate" value="{{ x.name }}">{{ x.name }}</option>
    </select>
  </div>
  <div class="form-group">
    <label>Category: </label>
    <select id = "cat" class="form-control">
      <option ng-repeat = "cat in category" value="{{ cat.name }}">{{ cat.name }}</option>
    </select>
  </div>
  <div class="form-group">
     <button class="btn btn-success" ng-click = "shown()">Show Score</button>
  </div>
</div>
<div class="candidateimage">
  <div class="cimage">
    <img src="../admin/images/{{ indivCan.picture }}" width="100%">
  </div>
</div>
<div class="score">
  <h1> {{ indivCat }}</h1>
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
