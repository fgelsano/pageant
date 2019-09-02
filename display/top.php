<?php
//include 'config.php';
    $candi = $con->query("SELECT * FROM tblcontestant ORDER BY number ASC");
    $total = $con->query("SELECT COUNT(*) 'count' FROM tblcategory")->fetch_assoc();
    $total = $total['count'] - 1;
    while($c_row = $candi->fetch_assoc()){
        $c_name = $c_row['name'];
        $score = 0;
        $cat = $con->query("SELECT DISTINCT Cat FROM tblresults WHERE Cat != 'Summary' AND Cat != 'Final Q and A'");
        if($cat->num_rows >= $total){
            $cat1 = $con->query("SELECT * FROM tblcategory ORDER BY oder ASC");
            $sc = 0;
            while($ca_row = $cat1->fetch_assoc()){
                $ca_name = $ca_row['name'];
                $data = $con->query("SELECT * FROM tblresults WHERE Candidate = '$c_name' AND Cat = '$ca_name'")->fetch_assoc();
                if($ca_name != 'Final Q and A'){
                    $sc += floatval($data['Score']);
                }
            }
            $all = intval($total);
            $score = number_format(($sc / $all),3);
            $check = $con->query("SELECT * FROM tblresults WHERE Candidate = '$c_name' AND Cat = 'Summary'");
            if($check->num_rows > 0){
                $con->query("UPDATE tblresults SET Score = '$score' WHERE Candidate = '$c_name' AND Cat = 'Summary'");
            }else{
                $con->query("INSERT INTO tblresults VALUES(NULL,'$c_name','Summary','$score',NOW(),'')");
            }
        }
        
        
    }
?>