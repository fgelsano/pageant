<?php 
	require 'db.php';
	header("Content-Type: application/json;charset=utf-8");

	isset($_GET['user']) AND $_GET['user'] != "" ? "" : die("null");

	$user = $_GET['user'];
	$pass = $_GET['pass'];

	$json = "{";

	$user = $DB->getResults("SELECT * FROM tbljudges WHERE username = '$user' AND password = '$pass'");
	$user ? $json .= '"user":' . $user . ',' : $json .= '"user": "0",';

	$cat = $DB->getResults("SELECT * FROM tblcategory WHERE oder != '0' ORDER BY oder ASC");
	$cat ? $json .= '"category":' . $cat . ',' : $json .= '"category": "0",';

	$json .= '"status": "ok", "time": "' . date("m/d/y H:m:s A") . '"';
	
	echo $json .= "}";
?>