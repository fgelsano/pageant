<?php
    include 'config.php';
    session_start();
    if(!empty($_POST)){
        if(isset($_POST['add'])){
            $n = $_POST['name'];
            $p = $_POST['place'];
            $seq = $_POST['sequence'];
            $d = $_POST['desc'];
            $img = $_FILES['file_image']['name'];
            $tmp_img = $_FILES['file_image']['tmp_name'];
            
            $ev = $_SESSION['cat']['events'];
            $data = $con->query("INSERT INTO tblcontestant VALUES(NULL,'$n','$ev','$p','$img','$d','$seq','0')");
            if($data == true){
                move_uploaded_file($tmp_img,"../../../images/".$img);
                // header("location:../candidate.php");
            }
        }
        if(isset($_POST['judges'])){
            $n = $_POST['name'];
            $u = $_POST['user'];
            $p = $_POST['pass'];
            $data = $con->query("INSERT INTO tbljudges VALUES(NULL,'$n','$u','$p','LOGOUT')");
            $data1 = $con->query("INSERT INTO tbljudgeevent VALUES(NULL,'$n','MissBatobalani2018','MissBatobalani2018','top.jpg')");
            header("location:../judges.php");
        }
        if(isset($_POST['category'])){
            $n = $_POST['name'];
            $d = $_POST['desc'];
            $max = $_POST['max'];
            $per = $_POST['percent'];
            $seq = $_POST['sequence'];
            $ev = $_SESSION['cat']['events'];

            $data = $con->query("INSERT INTO tblcategory VALUES(NULL,'$ev','$n','$d','$seq','$per','$max')");
            header("location:../category.php");
        }
    }else if(!empty($_GET)){
        if(isset($_GET['rec'])){
            $val = $_GET['rec'];
            $con->query("DELETE FROM tblcontestant WHERE record = '$val'");
            header("location:../candidate.php");
        }
        if(isset($_GET['judgerec'])){
            $val = $_GET['judgerec'];
            $jud = cl_connect("SELECT * FROM tbljudges WHERE record = '$val'")->fetch_assoc();
            $name = $jud['name'];
            $con->query("DELETE FROM tbljudgeevent WHERE Name = '$name'");
            $con->query("DELETE FROM tbljudges WHERE record = '$val'");
            header("location:../judges.php");
        }
        if(isset($_GET['catrec'])){
            $val = $_GET['catrec'];
            $con->query("DELETE FROM tblcategory WHERE record = '$val'");
            header("location:../category.php");
        }
        
    }else{
        header("location:../candidate.php");
    }
    
?>