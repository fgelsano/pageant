<?php 
	require 'db.php';
	header("Content-Type: application/json;charset=utf-8");

	$json = "{";

	$results = $DB->display();
	$results ? $json .= '"results":' . $results . ',' : $json .= '"results": "0",';

	$json .= '"status": "ok", "time": "' . date("m/d/y H:m:s A") . '"';
	
	echo $json .= "}";
?>