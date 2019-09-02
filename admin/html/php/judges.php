<?php
    include 'config.php';
    //$ca = 'Ranking'; 
    if(empty($_POST)){
        header("Location:../");
    }
    $ca =$_POST['ca'];
    $final = '';
    
    $data = $con->query("SELECT * FROM tblcontestant ORDER by number ASC");
    $x =0;
    while($r_data = $data->fetch_assoc()){
        $name = $r_data['name'];
        $final['number'][] = $r_data;
        $can = preg_replace('/[^A-Za-z0-9\-]/', "", $name);
        $cat = $con->query("SELECT * FROM tblcategory ORDER BY oder ASC");
        while($r_cat = $cat->fetch_assoc()){
            $cat_name = $r_cat['name'];
            $result = $con->query("SELECT * FROM tbllogs WHERE Candidate = '$name' AND cat = '$cat_name' AND Judges = '$ca'")->fetch_assoc();
            if(!empty($result)){
                $final[$x][] = $result;
            }
        }
        $x++;
    }
    if($final != ''){
        echo json_encode($final,JSON_FORCE_OBJECT);
    }else{
        echo "0";
    }
    
?>