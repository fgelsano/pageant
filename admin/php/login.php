<?php
    session_start();
    include '../html/php/config.php';
    // $final = '';
    if(!empty($_POST)){
        $u = $_POST['user'];
        $p = $_POST['pass'];
        $data = $con->query("SELECT * FROM tbladmin WHERE Username = '$u' AND Password = '$p'")->fetch_assoc();
        if(!empty($data)){
            $_SESSION['user'] = $data['Username'];
            $_SESSION['pass'] = $data['Password'];
            $final = $data;
            echo '1';
        }else{
            echo '0';
        }
    }
    // if($final != ''){
    //     echo json_encode($final);
    // }else{
    //     echo '0';
    // }
?>