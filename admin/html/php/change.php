<?php 

include 'config.php';

 $rec = $_POST['record'];

 
 if(cl_connect("UPDATE tbljudges SET Status = 'LOGOUT' WHERE record = '$rec'")){
 	echo "1";
 }else
 	echo "0";