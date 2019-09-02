<?php 
	require 'db.php';
	header("Content-Type: application/json;charset=utf-8");

	$json = "{";

	$candidate = $DB->getResults("SELECT * FROM tblcontestant ORDER BY number+0");
	$candidate ? $json .= '"candidate":' . $candidate . ',' : $json .= '"candidate": "0",';

	$json .= '"body":' . json_encode($_GET) . ',';

	$json .= '"status": "ok", "time": "' . date("m/d/y H:m:s A") . '"';
	
	echo $json .= "}";
?>