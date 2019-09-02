<?php
include 'config.php';
    var_dump($_POST);
    if(!empty($_POST)){
        //$top = $_POST['top'];
        if(isset($_POST['category'])){
            foreach ($_POST as $key => $value) {
                if($key != 'category'){
                    $cat = $_POST['category'];
                    if($value != ''){
                        $con->query("UPDATE tblresults SET award = '$value' WHERE Cat = '$cat' AND record = '$key'");
                    }
                    
                }
            }
            header("Location:../top.php?cat=$cat");
        }else{
            foreach ($_POST as $key => $value) {
                if($key != 'category'){
                    //$cat = $_POST['category'];
                    if($value != ''){
                        $con->query("UPDATE tblresults SET award = '$value' WHERE Cat = 'Summary' AND record = '$key'");
                    }
                    
                }
            }
            header("Location:../top.php");
        }
        // $con->query("UPDATE tblresults SET award = '' WHERE Cat = 'Ranking'");
        // for($x =0;$x < COUNT($top);$x++){
        //     $selected = $top[$x];
        //     $num = $x+1;
        //     $con->query("UPDATE tblresults SET award = '$num'  WHERE Candidate = '$selected' AND Cat = 'Ranking'");
        // }
    }
    
?>