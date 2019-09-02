<?php 
	require '../db.php';
	header("Content-Type: application/json;charset=utf-8");

	$json = "{";

	$can = '';
	$cat = '';
	isset($_GET['candidate']) ? $can = $_GET['candidate'] :"";
	isset($_GET['category']) ? $cat = $_GET['category'] :"";

	$judge = $DB->getResults("SELECT * FROM tblresults WHERE Candidate = '$can' AND Cat = '$cat'");
	$judge ? $json .= '"score":[' . $judge . '],' : $json .= '"score": false,';

	$json .= '"body":' . json_encode($_GET) . ',';

	$json .= '"status": "ok", "time": "' . date("m/d/y H:m:s A") . '"';
	
	echo $json .= "}";
?>