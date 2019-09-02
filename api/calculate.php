<?php
// include 'config.php';
    $ca_data = $con->query("SELECT * FROM tblcategory ORDER BY oder ASC");
    while($ca_row = $ca_data->fetch_assoc()){
        $ca = $ca_row['name'];
        $crit = $con->query("SELECT * FROM tblcriteria WHERE category = '$ca'");
        if($crit->num_rows > 0){
            $candi = $con->query('SELECT * FROM tblcontestant Order by name Asc');
            while($row_ca = $candi->fetch_assoc()){
                $c_name = $row_ca['name'];
                $f_score = 0;
                $crit1 = $con->query("SELECT * FROM tblcriteria WHERE category = '$ca'");
                while($r_crit = $crit1->fetch_assoc()){
                    $crit_name = $r_crit['name'];
                    $data = $con->query("SELECT * FROM tbllogs Where cat = '$ca' AND crit = '$crit_name' AND Candidate = '$c_name'");
                    $record = 0;
                    if($data->num_rows > 0){
                        $score = 0;
                        while($d_row =$data->fetch_assoc()){
                            $sc = (float)$d_row['score'];
                            $score = $score + $sc;
                            $record++;
                        }
                        if($record != 0){
                            $fscore = $score / $record;
                        }
                        $f_score += $fscore;
                        
                    }
                    
                }
                
                $final_score = floatval(number_format($f_score,3));
                //echo $ca . ' ->' . $c_name . ' -> ' . $final_score . '<br>';
                //echo $ca . ' -> ' . $crit_name . ' -> ' . $c_name . ' => '. $score . ' -> '. $final_score .'<br>';
                $logs = $con->query("SELECT * FROM tbllogs Where cat = '$ca' AND Candidate = '$c_name'")->fetch_assoc();
                if(!empty($logs)){
                    $verify = $con->query("SELECT * FROM tblresults WHERE Candidate = '$c_name' AND Cat = '$ca'")->fetch_assoc();
                    if(!empty($verify)){
                        //echo '1';
                        $con->query("UPDATE tblresults SET Score = $final_score WHERE Candidate = '$c_name' AND cat = '$ca'");
                    }else{
                        //echo "0";
                        $f_results = $con->query("INSERT INTO tblresults VALUES(NULL,'$c_name','$ca',$final_score,NOW(),'')");
                        //var_dump($f_results);
                    }
                }
            }
        }else{
            $candi = $con->query('SELECT * FROM tblcontestant Order by name Asc');
            while($row_ca = $candi->fetch_assoc()){
                $c_name = $row_ca['name'];
                $data = $con->query("SELECT * FROM tbllogs Where cat = '$ca' AND Candidate = '$c_name'");
                $score = 0;
                $record = 0;
                if($data->num_rows > 0){
                    while($d_row =$data->fetch_assoc()){
                        $score += $d_row['score'];
                        $record++;
                    }
                    if($record != 0){
                        $score = $score / $record;
                    }
                    $final_score = floatval(number_format($score,3));
                    $verify = $con->query("SELECT * FROM tblresults WHERE Candidate = '$c_name' AND Cat = '$ca'")->fetch_assoc();
                    if(!empty($verify)){
                        //echo '1';
                        $con->query("UPDATE tblresults SET Score = $final_score WHERE Candidate = '$c_name' AND cat = '$ca'");
                    }else{
                        //echo "0";
                        $f_results = $con->query("INSERT INTO tblresults VALUES(NULL,'$c_name','$ca',$final_score,NOW(),'')");
                        //var_dump($f_results);
                    }
                }
            }
        }
        
    }
?>