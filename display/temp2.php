<?php
    // $con = new mysqli("localhost",'root','','pageant');
    // include 'calculate.php';
    // include 'top.php';
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
        height: 34vh;
        display: flex;
        align-items: center;
      }
      .image h2{
        width: 100%;
        font-size: 3em;
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
  <div class="image" style="width: 100%;padding:30px 0;background-image: url('../assets/images/logo1.png');">
    <!-- <img src="image/batobalani.png" width="100%" height="100%"> -->
    <h2 class = 'text-right'>Tabulation Summary</h2>
  </div>
  <div class="panel"></div>
    <div class="table-responsive">
      <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Category</th>
          <th style="text-align: center;" ng-repeat = "(index, value) in candidate">{{ value.number }}</th>  
        </tr>
      </thead>
      <tbody id = "showtalbe">
        <tr ng-repeat = "(index, value) in results">
          <td>{{ index }}</td>
          <td class="success text-center" ng-repeat = "x in value">{{ x.Score }}</td>
        </tr>
        <tr ng-repeat = "(index, value) in Summary">
          <td>{{ index }}</td>
          <td class="success text-center" ng-repeat = "x in value">{{ x.Score }}</td>
        </tr>
      </tbody>
    </table>
    </div>
  </div>
</div>

<script type="text/javascript" src = "../assets/js/jquery.min.js"></script>
<script type="text/javascript" src = "../assets/js/angular.min.js"></script>
<script type="text/javascript" src = "temp2.js"></script>
</body>
</html>
