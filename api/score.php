<?php 
	require 'db.php';
	header("Content-Type: application/json;charset=utf-8");

	isset($_GET['user']) AND $_GET['user'] != "" ? "" : die("null");

	$json = "{";

	$judge = $_GET['judge'];
	$cat = $_GET['category'];
	$can = $_GET['candidate'];
	$crit = $_GET['crit'];

	$check = $DB->getresults("SELECT * FROM tbllogs WHERE Judges = '$judge' AND cat = '$cat' AND Candidate = '$can' AND crit = '$crit'");

	$score = "";
	if($check){}else{
		$score = $DB->insertData("tbllogs", array(
			'Judges' => $_GET['judge'],
			'events' => $_GET['events'],
			'cat' => $_GET['category'],
			'crit' => $_GET['crit'],
			'Candidate' => $_GET['candidate'],
			'Region' => $_GET['region'],
			'score' => $_GET['score'],
			'time' => date("m/d/Y h:m:s A")
		),true);
	}

	

	

	$score ? $json .= '"created":"' . $score . '",' : $json .= '"created": "0",';

	$json .= '"status": "ok", "time": "' . date("m/d/y H:m:s A") . '"';
	
	echo $json .= "}";
?>