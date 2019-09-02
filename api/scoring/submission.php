<?php 
	require '../db.php';
	require '../calculate.php';
	require '../top.php';

	header("Content-Type: application/json;charset=utf-8");

	$json = "{";

	$can = '';
	$cat = '';
	isset($_GET['candidate']) ? $can = $_GET['candidate'] :"";
	isset($_GET['category']) ? $cat = $_GET['category'] :"";

	$crit = $DB->resultsArraySp($con->query("SELECT * FROM tblcriteria WHERE  category = '$cat'"));
	$crit != "[]" ? $json .= '"crit":' . $crit . ',' : $json .= '"crit": false,';

	$results = $DB->getResults("SELECT * FROM tbljudges");
	$results ? $json .= '"judges":' . $results . ',' : $json .= '"judges": "0",';

	$judge = $DB->resultsArraySp($con->query("SELECT * FROM tbllogs WHERE Candidate = '$can' AND cat = '$cat'"));
	$judge != "[]" ? $json .= '"judge":' . $judge . ',' : $json .= '"judge": false,';

	$json .= '"body":' . json_encode($_GET) . ',';

	$json .= '"status": "ok", "time": "' . date("m/d/y H:m:s A") . '"';
	
	echo $json .= "}";
?>