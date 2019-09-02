<?php 
    function isCurrent($current, $page){
        if($current == $page){
            return "active";
        }else
            return "page";
    }
    $currentpage = str_replace("/admin/html/", "", $_SERVER['REQUEST_URI']);
    $currentpage = str_replace(".php", "", $currentpage);
?>

<nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    <!-- Logo -->
                    <a style = "padding:0"class="logo" href="index.php">
                        <!-- Logo icon image, you can use font-icon also --><b>
                        <!--This is dark logo icon--><!--This is light logo icon--><img style = "width:70%;height: 140px;" src="../../assets/images/logo1.png" alt="home" class="light-logo" />
                    </a>
                </div>
                <!-- /Logo -->
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li>
                        <a id = "navigation" href="#">Menu</a>
                    </li>
                    <!-- <li>
                        <form role="search" class="app-search hidden-sm hidden-xs m-r-10">
                            <input type="text" placeholder="Search..." class="form-control"> <a href=""><i class="fa fa-search"></i></a> </form>
                    </li> -->
                    <li>
                        <a class="profile-pic" href="#"> <img src="../plugins/images/users/varun.jpg" alt="user-img" width="36" class="img-circle"><b class="hidden-xs">Steave</b></a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <!-- <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3>
                </div> -->
                <ul class="nav" id="side-menu">
                    <li style="padding: 160px 0 0;" class="<?php echo isCurrent($currentpage,'top')?>">
                        <a href="top.php" class="waves-effect"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>Top (tie breaker)</a>
                    </li>
                    <li  class="<?php echo isCurrent($currentpage,'Talent')?>">
                        <a href="Talent.php" class="waves-effect"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>Manual Score</a>
                    </li>
                    <li>
                        <a href="../../display/temp2.php" target="_blank" class="waves-effect"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>Tabulation</a>
                    </li>
                    <li class="<?php echo isCurrent($currentpage,'topwinner.php')?>">
                        <a href="topwinner.php" class="waves-effect"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>Top Winner</a>
                    </li>
                    <li class="<?php echo isCurrent($currentpage,'individual.php')?>">
                        <a href="individual.php" class="waves-effect"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>Individual Score</a>
                    </li>
                    <li class="<?php echo isCurrent($currentpage,'index.php')?>">
                        <a href="index.php" class="waves-effect"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>Results</a>
                    </li>
                    <li class="<?php echo isCurrent($currentpage,'candidate.php')?>">
                        <a href="candidate.php" class="waves-effect"><i class="fa fa-table fa-fw" aria-hidden="true"></i>Candidates</a>
                    </li>
                    <li class="<?php echo isCurrent($currentpage,'judges.php')?>">
                        <a href="judges.php" class="waves-effect"><i class="fa fa-user fa-fw" aria-hidden="true"></i>Judges</a>
                    </li>
                    <li class="<?php echo isCurrent($currentpage,'category.php')?>">
                        <a href="category.php" class="waves-effect"><i class="fa fa-user fa-fw" aria-hidden="true"></i>Category</a>
                    </li>
                    <li class="<?php echo isCurrent($currentpage,'criteria.php')?>">
                        <a href="criteria.php" class="waves-effect"><i class="fa fa-user fa-fw" aria-hidden="true"></i>Criteria</a>
                    </li>
                    <li class="<?php echo isCurrent($currentpage,'settings.php')?>">
                        <a href="settings.php" class="waves-effect"><i class="fa fa-cog fa-fw" aria-hidden="true"></i>System Settings</a>
                    </li>
                </ul>
            </div>
            
        </div>