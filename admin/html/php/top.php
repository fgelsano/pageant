<?php
//include 'config.php';
    $candi = $con->query("SELECT * FROM tblcontestant ORDER BY number ASC");
    while($c_row = $candi->fetch_assoc()){
        $c_name = $c_row['name'];
        $score = 0;
        $cat = $con->query("SELECT DISTINCT Cat FROM tblresults");
        if($cat->num_rows >= 6){
            $cat1 = $con->query("SELECT * FROM tblcategory ORDER BY oder ASC");
            $sc = 0;
            while($ca_row = $cat1->fetch_assoc()){
                $ca_name = $ca_row['name'];
                $data = $con->query("SELECT * FROM tblresults WHERE Candidate = '$c_name' AND Cat = '$ca_name'")->fetch_assoc();
                //var_dump($data);
                if($ca_name != 'Final'){
                    $sc += floatval($data['Score']);
                }
            }
            $data1 = $con->query("SELECT * FROM tblresults WHERE Candidate = '$c_name' AND Cat = 'Talent'")->fetch_assoc();
            $sc += floatval($data1['Score']);
            $score = number_format(($sc / 6),3);
            //var_dump($score);
            $check = $con->query("SELECT * FROM tblresults WHERE Candidate = '$c_name' AND Cat = 'Summary'");
            if($check->num_rows > 0){
                $con->query("UPDATE tblresults SET Score = '$score' WHERE Candidate = '$c_name' AND Cat = 'Summary'");
            }else{
                $con->query("INSERT INTO tblresults VALUES(NULL,'$c_name','Summary','$score',NOW(),'')");
            }
        } 
    }
?>