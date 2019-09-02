<?php
	require 'db.php';
	header("Content-Type: application/json;charset=utf-8");
	
	echo $DB->getview("user", "Swimsuit");

?>