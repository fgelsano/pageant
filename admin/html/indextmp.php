<?php include 'php/calculate.php'; ?>
<?php include 'php/top.php'; 
    session_start();
    if(isset($_SESSION['user'])){
        
    }else{
        header('location:../');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title>Miss Batobalani 2018</title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- toast CSS -->
    <link href="../plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="../plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="../plugins/bower_components/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="../plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/default.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <script type="text/javascript">
        // setTimeout(function(){
        //    window.location.reload(1);
        // }, 5000);
    </script>
</head>

<body class="fix-header" ng-app = "resultsApp" ng-controller = "resultsCtrl">
    <?php //include 'php/config.php'; ?>
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php include 'header.php' ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Dashboard</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                
                <!-- ============================================================== -->
                <!-- table -->
                <!-- ============================================================== -->
                <div class="row">
                <div id="header" style = "display:none">
                    <div class = "text-center">
                        <img src="../../assets/images/logo.jpeg" style = "width:40px;">
                    </div>
                </div>
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box">
                            <div class="col-md-3 col-sm-4 col-xs-6 pull-right">
                                <select id = "judges" class="form-control pull-right row b-none">
                                <option value="">Select by Judges</option>
                                <?php
                                    $cat = $con->query("SELECT * FROM tbljudges");
                                    while($row = $cat->fetch_assoc()){ ?>
                                        <option value="<?php echo $row['username']; ?>"><?php echo $row['name']; ?></option>
                                    <?php
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-6 pull-right">
                                <select  id = "category" class="form-control pull-right row b-none">
                                <option value="">Select by Category</option>
                                <?php
                                    $cat = $con->query("SELECT DISTINCT Cat FROM tblresults");
                                    while($row = $cat->fetch_assoc()){ ?>
                                        <option value="<?php echo $row['Cat']; ?>"><?php echo $row['Cat']; ?></option>
                                    <?php
                                    }
                                ?>
                                </select>
                            </div>
                            <h3 class="box-title">Results</h3>
                            <!-- <a href="print.php" class = "btn btn-link">Preview Print</a> -->
                            <button onclick = "print()" class = "btn btn-link"><span class = "fa fa-print"></span>Preview Print</button>
                            <div id = "tableprint" class="table-responsive">
                                <?php 
                                    $ca_data = cl_connect("SELECT * FROM tblcategory ORDER BY oder ASC")->fetch_assoc();
                                    $cdata = $ca_data['name'];
                                ?>
                                <h3 id = "title" class="box-title text-right" style = "font-family:mega_fresh;"><?php echo $cdata; ?></h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>NAME</th>
                                            <th>Score</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                        $data = $con->query("SELECT * FROM tblresults WHERE Cat = '$cdata'ORDER BY Score DESC");
                                        if($data->num_rows > 0){
                                            $x = 1;
                                            while($d_row = $data->fetch_assoc()){ ?>
                                                <tr>
                                                    <td><?php echo $x; ?></td>
                                                    <td><?php echo $d_row['Candidate']; ?></td>
                                                    <td><?php echo $d_row['Score']; ?></td>
                                                </tr>
                                            <?php
                                            $x++;
                                            }
                                        }else{ ?>
                                            <tr>
                                                <td>No Data at the Moment</td>
                                            </tr>
                                        <?php
                                        }
                                    ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="judgesign" style = "display:none">
                            <div class="white-box" style = "padding:5px;">
                                <div class="row">
                                    <!-- <p>Judge:</p> -->
                                    <?php 
                                        $jd = $con->query("SELECT * FROM tbljudges ORDER BY name ASC");
                                        while($r_jd = $jd->fetch_assoc()){ ?>
                                                <div class="col-md-4 col-sm-4 col-xs-4">
                                                    <div class="sign">
                                                        <h2></h2>
                                                        <p><?php echo $r_jd['name']; ?></p>
                                                    </div>
                                                </div>
                                        <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2017 &copy; Creative Dev Labs </footer>
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
    </div>

    
    <script src = "../plugins/js/angular.min.js"></script>
    <script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Counter js -->
    <script src="../plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
    <script src="../plugins/bower_components/counterup/jquery.counterup.min.js"></script>
    <!-- chartist chart -->
    <script src="../plugins/bower_components/chartist-js/dist/chartist.min.js"></script>
    <script src="../plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
    <!-- Sparkline chart JavaScript -->
    <script src="../plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.js"></script>
    <script src="js/dashboard1.js"></script>
    <script src="../plugins/bower_components/toast-master/js/jquery.toast.js"></script>
    <script src = "js/angulardata.js"></script>
    <!-- <script src = "js/angular.js"></script> -->
    <script>
        function print(){
            var print = document.getElementById('tableprint');
            var head = $("#header").html();
            var judges = $("#judgesign").html();
            var doc = $("head").html();
            var main = "<!DOCTYPE HTML><html>" + doc + "<body style = 'padding:0 20px'>" + head + "<h2>Results</h2>" +print.outerHTML + judges + "</body></html>"
            var wme = window.open("","","width = 1100,height = 800");
            wme.document.write(main);
            wme.document.close();
            wme.focus();
            // setInterval(1000);
            // wme.print();
            
            // wme.close();
        }
    </script>
</body>

</html>
