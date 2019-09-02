<?php 
	require 'db.php';
	header("Content-Type: application/json;charset=utf-8");

	$json = "{";

	$can = '';
	isset($_GET['candidate']) ? $can = $_GET['candidate'] :"";


	$candidate = $DB->getResults("SELECT * FROM tblcontestant WHERE name = '$can'");
	$candidate ? $json .= '"candidate":' . $candidate . ',' : $json .= '"candidate": "0",';

	$json .= '"body":' . json_encode($_GET) . ',';

	$json .= '"status": "ok", "time": "' . date("m/d/y H:m:s A") . '"';
	
	echo $json .= "}";
?>