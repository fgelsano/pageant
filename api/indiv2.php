<?php 
	require 'db.php';
	require 'calculate.php';
	require 'top.php';
	
	header("Content-Type: application/json;charset=utf-8");

	$json = "{";

	$candidate = $DB->getResults("SELECT * FROM tblcontestant ORDER BY number+0 ASC");
	$candidate ? $json .= '"candidate":' . $candidate . ',' : $json .= '"candidate": "0",';

	$score = $DB->tabulation("Final Q and A");
	$score ? $json .= '"score":[' . $score . '],' : $json .= '"score": "0",';
	$Summary = $DB->tabulationCat("Summary");
	$Summary ? $json .= '"Summary":[' . $Summary . '],' : $json .= '"Summary": "0",';
	// $Final = $DB->tabulationCat("Final Q and A");
	// $Final ? $json .= '"Final":[' . $Final . '],' : $json .= '"Final": "0",';

	$json .= '"body":' . json_encode($_GET) . ',';

	$json .= '"status": "ok", "time": "' . date("m/d/y H:m:s A") . '"';
	
	echo $json .= "}";
?>