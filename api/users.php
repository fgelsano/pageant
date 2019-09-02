<?php 
	require 'db.php';
	header("Content-Type: application/json;charset=utf-8");

	isset($_POST['user']) AND $_POST['user'] != "" ? "" : die("null");

	$user = $_POST['user'];

	$json = "{";

	$user = $DB->updateData("tbljudges", 
		array(
			'Status' => "LOGIN"
		),
		array(
			'username' => $_POST['user']
		)
	);

	$user ? $json .= '"user": "' . $user . '",' : $json .= '"user": "0",';

	$json .= '"status": "ok", "time": "' . date("m/d/y H:m:s A") . '"';
	
	echo $json .= "}";
?>