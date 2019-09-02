<?php
include 'config.php';
    //var_dump($_POST);
    if(!empty($_POST)){
        $cat = $_POST['category'];
        if($cat != ""){
            foreach ($_POST['name'] as $key => $value) {
                $score = "";
                if($_POST['score'][$key] != ""){
                    $score = floatval(number_format($_POST['score'][$key],3));
                }
                $data = $con->query("SELECT * FROM tbllogs WHERE cat = '$cat' AND Candidate = '$value'")->fetch_assoc();
                if(empty($data)){
                    $con->query("INSERT INTO tbllogs VALUES(NULL,'Committee','MissBatobalani2018','$cat','','$value','','$score',NOW())");
                    $con->query("INSERT INTO tblresults VALUES(NULL,'$value','$cat','$score',NOW(),'')");
                }else{
                    $con->query("UPDATE tbllogs SET score ='$score' WHERE Candidate = '$value' AND cat = '$cat'");
                    $con->query("UPDATE tblresults SET Score ='$score' WHERE Candidate = '$value' AND Cat = '$cat'");
                }
            }
        }
        header("Location:../Talent.php?cat=" . $cat);
    }
    
?>