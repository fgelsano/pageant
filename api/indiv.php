<?php 
	require 'db.php';
	header("Content-Type: application/json;charset=utf-8");

	$json = "{";

	$can = '';
	isset($_GET['candidate']) ? $can = $_GET['candidate'] :"";

	$category = $DB->getResults("SELECT * FROM tblcategory WHERE oder != '0'");
	$category ? $json .= '"category":' . $category . ',' : $json .= '"category": "0",';

	$candidate = $DB->getResults("SELECT * FROM tblcontestant ORDER BY number+0 ASC");
	$candidate ? $json .= '"candidate":' . $candidate . ',' : $json .= '"candidate": "0",';

	$results = $DB->getResults("SELECT * FROM tblcontestant WHERE name = '$can'");
	$results ? $json .= '"results":' . $results . ',' : $json .= '"results": "0",';

	// $results = $DB->getResults("SELECT * FROM tbljudges");
	// $results ? $json .= '"judges":' . $results . ',' : $json .= '"judges": "0",';

	$json .= '"body":' . json_encode($_GET) . ',';

	$json .= '"status": "ok", "time": "' . date("m/d/y H:m:s A") . '"';
	
	echo $json .= "}";
?>