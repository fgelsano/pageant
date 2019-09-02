<?php include 'php/calculate.php'; ?>
<?php include 'php/top.php'; ?>
<?php 
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
    <title>Miss Teen Mantahan 2019</title>
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
</head>

<body class="fix-header">
    <div class="container">        
        <div class="row">
            <div class = "text-center">
                <img src="../logo.jpg" style = "width:200px;">
            </div>
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="white-box">
                    <div class="col-md-3 col-sm-4 col-xs-6 pull-right">
                        <select id = "judges" class="form-control pull-right row b-none">
                        <option value="">by Judges</option>
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
                        <select id = "category" class="form-control pull-right row b-none">
                        <option value="">by Category</option>
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
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NAME</th>

                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $data = $con->query("SELECT * FROM tblresults WHERE Cat = 'Production'ORDER BY Score DESC");
                                if($data->num_rows > 0){
                                    $x = 1;
                                    while($d_row = $data->fetch_assoc()){ ?>
                                        <tr>
                                            <td><?php echo $x; ?></td>
                                            <td><?php echo $d_row['Candidate']; ?></td>
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
                <div class="white-box">
                    <div class="row">
                        <p>Judge:</p>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <div class="sign">
                                <h2></h2>
                                <p>SIGNATURE OVER PRINTED NAME</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <div class="sign">
                                <h2></h2>
                                <p>SIGNATURE OVER PRINTED NAME</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <div class="sign">
                                <h2></h2>
                                <p>SIGNATURE OVER PRINTED NAME</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    <script src = "js/angular.js"></script>
</body>

</html>
