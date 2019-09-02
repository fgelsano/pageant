<?php
    include 'config.php';
    
    session_start();
    if(!empty($_POST)){

        $cat = $_POST['category'];
        $name = $_POST['name'];
        $desc = $_POST['description'];
        $percent = $_POST['percent'];
        $max = $_POST['max-score'];

        cl_connect("INSERT INTO tblcriteria VALUES(NULL,'MissBatobalani2018','$cat','$name','$desc','$percent','$max')");
    }else if(isset($_GET['critrec'])){
        $rec = $_GET['critrec'];

        cl_connect("DELETE FROM tblcriteria WHERE record = '$rec'");
        header("location:../criteria.php");
    }else
        header("location:../criteria.php");
    
?>