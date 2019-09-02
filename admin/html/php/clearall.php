<?php 

	include 'config.php';
	if(!empty($_GET)){

		if(isset($_GET['record'])){
			cl_connect("DELETE FROM tblresults WHERE 1");

			header("location:../resultsrecord.php");
		}
		if(isset($_GET['logs'])){
			cl_connect("DELETE FROM tbllogs WHERE 1");

			header("location:../settings.php");
		}
		
	}else{
		header("location:../");
	}
	// 
	