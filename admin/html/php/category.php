<?php
    include 'config.php';
    //$ca = 'Summary'; 
    if(empty($_POST)){
        //header("Location:../");
    }
    $ca =$_POST['ca'];
    $final = '';
    
    if($ca == 'Summary'){
        $data = $con->query("SELECT * FROM tblresults WHERE Cat = '$ca' ORDER by Score DESC");
        while($r_data = $data->fetch_assoc()){
            $name = $r_data['Candidate'];
            $can = preg_replace('/[^A-Za-z0-9\-]/', "", $name);
            $cat = $con->query("SELECT * FROM tblcategory ORDER BY oder ASC");
            $result = $con->query("SELECT * FROM tblresults WHERE Candidate = '$name' AND Cat = 'Summary'")->fetch_assoc();
            $number = $con->query("SELECT * FROM tblcontestant WHERE name = '$name'")->fetch_assoc();
            $final[$can][] = $number;
            $final[$can][] = $result;
            $data1 = $con->query("SELECT * FROM tblresults WHERE Candidate = '$name' AND Cat = 'Talent'")->fetch_assoc();
            $final[$can][] = $data1;
            while($r_cat = $cat->fetch_assoc()){
                $cat_name = $r_cat['name'];
                if($cat_name != 'Final'){
                    $result = $con->query("SELECT * FROM tblresults WHERE Candidate = '$name' AND Cat = '$cat_name'")->fetch_assoc();
                    $final[$can][] = $result;
                }
            }
        }

        // $data = $con->query("SELECT * FROM tblcontestant ORDER by number ASC");
        // while($r_data = $data->fetch_assoc()){
        //     $name = $r_data['name'];
        //     $can = preg_replace('/[^A-Za-z0-9\-]/', "", $name);
        //     $cat = $con->query("SELECT * FROM tblcategory ORDER BY oder ASC");
        //     $result = $con->query("SELECT * FROM tblresults WHERE Candidate = '$name' AND Cat = 'Ranking'")->fetch_assoc();
        //     $final[$can][] = $result;
        //     while($r_cat = $cat->fetch_assoc()){
        //         $cat_name = $r_cat['name'];
        //         if($cat_name != 'Final'){
        //             $result = $con->query("SELECT * FROM tblresults WHERE Candidate = '$name' AND Cat = '$cat_name'")->fetch_assoc();
        //             $final[$can][] = $result;
        //         }
        //     }
        // }
        echo json_encode($final,JSON_FORCE_OBJECT);
    }else{
        $str = '';
        //$table = '';

        $criteria = $con->query("SELECT * FROM tblcriteria WHERE category = '$ca'");
        if($criteria->num_rows > 0){
            $score = $con->query("SELECT * FROM tblresults WHERE Cat = '$ca' ORDER BY Score DESC");
            while($row = $score->fetch_assoc()){
                $c_name  = $row['Candidate'];
                
                $num = $con->query("SELECT * FROM tblcontestant WHERE name = '$c_name'")->fetch_assoc();
                //$final[$num['number']]['raw'] = $row;
                $str .= "<tr><td>". $num['number'] ."</td>\n";
                $str .= "<td>". $c_name ."</td>\n";
                $str .= "<td>". $num['team'] ."</td>\n";
                $str .= "<td>". $num['descript'] ."</td>\n";
                //$table .= "<tr><th>#</th><th>NAME</th>";
                $can_cat = cl_connect("SELECT * FROM tblcategory ORDER BY oder ASC");
                while ($can_catrow = $can_cat->fetch_assoc()) {
                    $can_catname = $can_catrow['name'];
                    //$table .= "<th>" . $can_catname . "</th>";
                    
                    if($can_catname == "Final"){
                        $can_jud = cl_connect("SELECT * FROM tbllogs WHERE cat = '$can_catname' AND Candidate = '$c_name' AND crit = 'Beauty' ORDER BY Judges ASC");
                        $str .= "<td>";
                        while ($can_judrow = $can_jud->fetch_assoc()) {
                            $str .= "<i>" . $can_judrow['Judges'] . " = " . $can_judrow['score'] ."</i><br>";
                        }
                        $str .= "</td>";
                        $can_jud1 = cl_connect("SELECT * FROM tbllogs WHERE cat = '$can_catname' AND Candidate = '$c_name' AND crit = 'Intelligence'  ORDER BY Judges ASC");
                        $str .= "<td>";
                        while ($can_judrow = $can_jud1->fetch_assoc()) {
                            $str .= "<i>" . $can_judrow['Judges'] . " = " . $can_judrow['score'] ."</i><br>";
                        }
                        $str .= "</td>";
                    }else{
                        // $str .= "<td>";
                        // $can_jud = cl_connect("SELECT * FROM tbllogs WHERE cat = '$can_catname' AND Candidate = '$c_name' ORDER BY Judges ASC");
                        // while ($can_judrow = $can_jud->fetch_assoc()) {
                        //     $str .= $can_judrow['Judges'] . " = " . $can_judrow['score'] ." \n";
                        // }
                        // $str .= "</td>";
                    }
                    
                    //$final[$num['number']]['cat'][] = $can_jud;
                }
                // $can = preg_replace('/[^A-Za-z0-9\-]/', "", $c_name);
                // $final['score'][$can] = $row;
                // $criteria = $con->query("SELECT * FROM tblcriteria WHERE category = '$ca'");
                // while($c_row = $criteria->fetch_assoc()){
                //     $cr_name = $c_row['name'];
                //     $cand = preg_replace('/[^A-Za-z0-9\-]/', "", $c_name);
                //     $raw_judges = $con->query("SELECT * FROM tbllogs WHERE cat = '$ca' AND crit = '$cr_name' AND Candidate = '$c_name' ORDER BY Judges ASC")->fetch_all();
                //     $final['judges']['count'][$cr_name] = $raw_judges;
                //     $judges = $con->query("SELECT * FROM tbllogs WHERE cat = '$ca' AND crit = '$cr_name' AND Candidate = '$c_name' ORDER BY Judges ASC");
                //     while($r_jud = $judges->fetch_assoc()){
                //         $judg = $r_jud['Judges'];
                //         $final['judges'][$cr_name][] = $r_jud;
                //     }
                    
                // }
                $str .= "<td>" . $row['Score'] . "<td>";
                $str .= "</tr>";
                //$table .= "</tr>";
            }
           // echo  "<thead>";
            //echo $table;
            //echo  "</thead>";
            // $result['table'] = $str;
            //$result['head'] = $table;
            //echo $result;
            //echo json_encode($result,JSON_FORCE_OBJECT);
            //echo  "</tbody>";
            echo $str;
            //echo  "</tbody>";
            
        }else{
            $score1 = $con->query("SELECT * FROM tblresults WHERE Cat = '$ca' ORDER BY Score DESC");
            while($row = $score1->fetch_assoc()){
                $c_name  = $row['Candidate'];
                $number = $con->query("SELECT * FROM tblcontestant WHERE name = '$c_name'")->fetch_assoc();
                $final['number'][] = $number;
                $can = preg_replace('/[^A-Za-z0-9\-]/', "", $c_name);
                $final['score'][$can] = $row;
                $raw_judges = $con->query("SELECT * FROM tbllogs WHERE cat = '$ca' AND Candidate = '$c_name' ORDER BY Judges ASC")->fetch_all();
                $final['judges']['count'] = $raw_judges;
                $judges = $con->query("SELECT * FROM tbllogs WHERE cat = '$ca' AND Candidate = '$c_name' ORDER BY Judges ASC");
                while($r_jud = $judges->fetch_assoc()){
                    $final['judges']['jud'][] = $r_jud;
                }
                
            }
            echo json_encode($final,JSON_FORCE_OBJECT);
        }
    }
    //
?>