<?php
    include 'config.php';
    //$ca = 'Final';
    $results = '';
    $ca =$_POST['ca'];
    $data = $con->query("SELECT * FROM tblcriteria WHERE category = '$ca'");
    if($data->num_rows > 0){
        echo $data->num_rows;
    }else{
        echo '0';
    }
?>