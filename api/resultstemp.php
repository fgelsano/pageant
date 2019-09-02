<?php 
	require 'db.php';
	require 'calculate.php';
	require 'top.php';

	header("Content-Type: application/json;charset=utf-8");

	function resultsView($DB, $json)
	{
		$cat = $DB->getResults("SELECT * FROM tblcategory ORDER BY oder ASC");
		if(!$cat){ return $json;}
		$catOB = json_decode($cat);
		foreach ($catOB as $key => $value) {
			$category = $value->name;
			if($category == "Final Q and A"){ break;}
			$json != "{" ? $json .= "," : "";

			
			$cat = $DB->getResults("SELECT * FROM tblresults INNER JOIN tblcontestant ON tblcontestant.name = tblresults.Candidate WHERE tblresults.Cat = '$category' ORDER BY tblresults.Score DESC");
			$cat ? $json .= '"' . $category . '":' . $cat : $json .= '"' . $category . '": "false"';
		}

		$json .= ",";
		$cat = $DB->getResults("SELECT * FROM tblresults INNER JOIN tblcontestant ON tblcontestant.name = tblresults.Candidate WHERE tblresults.Cat = 'Summary' ORDER BY tblresults.Score DESC");
		$cat ? $json .= '"Rank Score":' . $cat : $json .= '"Rank Score": "false"';

		$json .= ",";
		$cat = $DB->getResults("SELECT * FROM tblresults INNER JOIN tblcontestant ON tblcontestant.name = tblresults.Candidate WHERE tblresults.Cat = 'Final Q and A' ORDER BY tblresults.Score DESC");
		$cat ? $json .= '"Final Q and A":' . $cat : $json .= '"Final Q and A": "false"';

		return $json;
	}
	
	 $json = resultsView($DB, "{");
	echo $json .= "}";
?>