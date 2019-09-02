<?php 
    include 'config.php';

    if(!empty($_POST)){
        $ca = $_POST['can'];
        $data = $con->query("SELECT * FROM tblcontestant WHERE name = '$ca'")->fetch_assoc();
        if(!empty($data)){
            echo $data['number'];
        }else{
            echo "";
        }
    }
?>