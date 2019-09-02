<?php 
	require 'db.php';
	header("Content-Type: application/json;charset=utf-8");

	isset($_GET['user']) ? "" : die("null");

	$user = $_GET['user'];

	$json = "{";


	$user = $DB->updateData("tbljudges",
		array(
			"Status" => "LOGOUT"
		),
		array(
			'username' => $user
		)
	);
	$user ? $json .= '"updated":' . $user . ',' : $json .= '"updated": "0",';

	$json .= '"status": "ok", "time": "' . date("m/d/y H:m:s A") . '"';
	
	echo $json .= "}";
?>