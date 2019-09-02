<?php
    include 'config.php';
    if(!empty($_POST)){
        if(isset($_POST['judge'])){
            $r = $_POST['rec'];
            
            $n = $_POST['name'];
            $u = $_POST['user'];
            $p = $_POST['pass'];

            $data = cl_connect("SELECT * FROM tbljudges WHERE record = '$rec'")->fetch_assoc();
            $user = $data['name'];
            $con->query("UPDATE tbljudgeevent SET Name = '$n' WHERE Name = '$name'");
            $con->query("UPDATE tbljudges SET name = '$n', username = '$u', password = '$p' WHERE record = '$r'");
            header("location:../judges.php");
        }else if(isset($_POST['category'])){
            $r = $_POST['rec'];
            $n = $_POST['name'];
            $d = $_POST['desc'];
            $per = $_POST['percent'];
            $m = $_POST['max'];
            $s = $_POST['seq'];

            $con->query("UPDATE tblcategory SET name = '$n', description = '$d', oder = '$s', percent = '$per', max_score = '$m' WHERE record = '$r'");
            header('location:../category.php');
        }else{
            $r = $_POST['rec'];
            $n = $_POST['Candidate'];
            $p = $_POST['place'];
            $se = $_POST['sequence'];
            $d = $_POST['desc'];

            $img = $_FILES['file_img']['name'];
            $tmp = $_FILES['file_img']['tmp_name'];
            
            if($img == ''){
                $con->query("UPDATE tblcontestant SET name = '$n', team = '$p', number = '$se', descript = '$d' WHERE record = '$r'");
            }else{
                $data = $con->query("UPDATE tblcontestant SET name = '$n', team = '$p', number = '$se', descript = '$d', picture = '$img' WHERE record = '$r'");
                if($data == true){
                    move_uploaded_file($tmp,"../../images/". $img);
                }
            }
            header('location:../candidate.php');
        }
    }else{
        header('location:../candidate.php');
    }
?>