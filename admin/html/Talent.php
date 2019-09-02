<?php include 'php/calculate.php'; ?>
<?php 
    session_start();
    if(isset($_SESSION['user'])){
        
    }else{
        header('location:../');
    }
    $cat = "";

    isset($_GET['cat']) ? $cat = $_GET['cat'] : "";
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
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box">
                            <form action = "php/talent.php" method = "POST">
                            <input type="hidden" name="category" value="<?php echo $cat ?>">
                            <h3 class="box-title"> <?php echo $cat ?> Category</h3>
                            <button type="submit" class = "btn btn-success">Apply</button>
                            <div class="shown" style="float: right;">
                                
                                <?php 
                                $cate = $con->query("SELECT * FROM tblcategory WHERE oder = '0'");
                                if($cate->num_rows > 0){
                                    while ($row = $cate->fetch_assoc()) {
                                        $link = "info"; 
                                        $row['name'] == $cat ? $link = "danger" : ""; 
                                        ?>
                                        <a href="?cat=<?php echo $row['name'] ?>" class="btn btn-<?php echo $link ?>"><?php echo $row['name'] ?></a>
                                    <?php
                                    }
                                }
                                
                            ?>
                            </div>
                            <!-- <label>Enter Category Name:</label> -->
                            <!-- <input type="text" name="category" required> -->
                            <!-- <select name = "category">
                                <option value="">Select Category Type</option>
                            
                            </select> -->
                            <!-- <select name = "Category">
                                <option value="">Select Category Type</option>
                                <option value="">Street Jeans</option>
                            </select> -->
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Raw Score</th>
                                            <th>Final Score</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $data = $con->query("SELECT * FROM  tblcontestant ORDER BY number+0 ASC");
                                        if($data->num_rows > 0){
                                            while($d_row = $data->fetch_assoc()){ 
                                                $c_name = $d_row['name'];
                                                $cat = "";
                                                isset($_GET['cat']) ? $cat = $_GET['cat'] : "";
                                                $results = $con->query("SELECT * FROM tblresults WHERE Candidate = '$c_name' AND cat = '$cat'")->fetch_assoc();
                                                ?>
                                                <tr>
                                                    <td><?php echo $d_row['number']; ?></td>
                                                    <td>
                                                    <?php echo $d_row['name']; ?>
                                                    <input type="hidden" name="name[]" value = '<?php echo $d_row['name']; ?>'>
                                                    </td>
                                                    <td style = "width:200px;">
                                                        <input type="text" name="score[]" style = "width:70px;text-align: center;">
                                                    </td>
                                                    <td><?php echo $results['Score']; ?></td>
                                                    
                                                    
                                                </tr>
                                            <?php
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
                            </form>
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
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
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
