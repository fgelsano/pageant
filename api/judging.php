<?php 
	require 'db.php';
	// header("Content-Type: application/json;charset=utf-8");

	$json = "{";

	$cat = $_GET['cat'];
	$judge = $_GET['judge'];

	$data = $con->query("SELECT * FROM tblcategory WHERE oder != '0'");

	$category = $DB->getResults("SELECT * FROM tblcategory WHERE oder != '0' ORDER BY oder+0");
	$category ? $json .= '"category":' . $category . ',' : $json .= '"category": "0",';

	$criteria = $DB->getResults("SELECT name FROM tblcriteria WHERE category = '$cat'");
	$criteria ? $json .= '"criteria":' . $criteria . ',' : $json .= '"criteria": [{"name": ""}],';

	$candidate = $DB->getview($judge, $cat, "Summary");;
	$candidate ? $json .= '"candidate":' . $candidate . ',' : $json .= '"candidate": "0",';

	$scoring = $DB->getResults("SELECT * FROM tblcategory WHERE name = '$cat'");
	$scoring ? $json .= '"scoring":' . $scoring . ',' : $json .= '"scoring": "0",';

	$json .= '"status": "ok", "time": "' . date("m/d/y H:m:s A") . '"';
	
	echo $json .= "}";
?>