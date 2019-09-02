<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Miss Teen Mantahan 2019</title>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <style type="text/css">
    @font-face{
      font-family: charles;
      src: url("assets/fonts/CharlemagneStd-Bold.otf");
    }
    @font-face{
        font-family: "monserat";
        src: url("assets/fonts/Montserrat/Montserrat-Black.ttf");
    }
    *{
      font-family: monserat;
    }
  </style>
  <link rel="stylesheet" href="assets/css/view.css">
  <link rel="stylesheet" href="assets/css/media.css">
  <script type="text/javascript" src="assets/js/angular.min.js"></script>
  <script type="text/javascript">
    if(localStorage.token == ""){
      location.href = "/";
    }
  </script>
</head>
<body ng-app = "viewApp" ng-controller = "viewCtrl">
  
<div id="wrapper">
  <div class="topbar">
    <h3 class="text-center">Judge {{ token.name }}</h3>
  </div>
   <div class="sidebar bar">
      <div class="navilink">
        <img src="assets/images/logo1.png">
        <ul>
          <li ng-repeat = "category in categories" class = "{{ category.name | activelinks }}"><a href="?cat={{ category.name}}">{{ category.name}}</a></li>
          <li><a href="#" ng-click = "logout()" >Logout</a></li>
        </ul>
      </div>
   </div>
   <div class="contentbar bar">
     <section id="content">
       <form>
          <section ng-repeat = "candidate in candidates" class="candidate " id="can{{ candidate[0].record }}" style="{{ candidate[2] | include}}">
            <div class="overlay" style="{{ candidate[1] | submitted }}">
              <div class="overlay-cover"></div>
                 <div class="edit_container">
                  <h3 class="alert alert-danger">Rating : {{ candidate[1][0] | hasScore }} {{ candidate[1][1] | hasScore }} </h3>
                   <h2 class="alert alert-info">Scroll Down for the Next Candidate</h2>
                 </div>  
            </div>
            <div class="containe">
              <div class="row">
                <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                  <div class="panel-body text-center">
                    <div class="ca-image" style="background-image:url('admin/images/{{ candidate[0].picture }}')">
                      <h3 class="tablet">#{{ candidate[0].number }}</h3>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7"> 
                  <h3 class="desk">Candidate # {{ candidate[0].number }}</h3>
                  <h3>{{ candidate[0].name }}</h3>
                  <h3>( {{ candidate[0].team }} )</h3>                  
                    <div ng-repeat = "x in criteria" class="form-group {{ x.name | hasCriteria }} " >
                      <div class="overlayCrit form{{ x.name }}"></div>
                      <h2 id="category" class="text-center alert alert-info " style="padding: 0;">
                        {{ x.name }}

                        <div class="scorelist">
                          <div>
                            <input type="text" class="form-control scoredata scoredata{{ x.name }}" name="" value="0" >
                          </div>
                        </div>
                        <div class="okbutton">
                          <div>
                            <h2 ng-click = "submit(this, x.name)">OK</h2>
                          </div>
                        </div>
                      </h2>
                      <div class="col-xs-3 col-sm-4 col-md-3 col-lg-3" ng-repeat = "score in scoring">
                        <div class="btn btn-info " ng-click = "getScore(this,candidate[0].record,'',x.name)">
                          <input type="radio" name="" value="{{ score }}" ><h1 class="text-center">{{ score }}</h1>
                        </div>
                      </div>
                      <div class="col-xs-3 col-sm-4 col-md-3 col-lg-3">
                        <div class="btn btn-info" ng-click = "getScore(this,candidate[0].record,'.',x.name)">
                        <h1 class="text-center">.</h1>
                        </div>
                      </div>
                      <div class="col-xs-3 col-sm-4 col-md-3 col-lg-3">
                        <div class="clear btn btn-warning " ng-click = "clear(candidate[0].record,x.name)">
                          <h1 class="text-center cleartext">Clear</h1>
                        </div>
                      </div>
                    </div>               
                  </div>
              </div>
            </div>
          </section>
       </form>
     </section>
   </div>
</div>
  
  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/js/sweetalert2.all.js"></script>
  <script type="text/javascript" src="assets/js/view.js"></script>
</body>
</html>