<?php 
	function QUERY($sql){
		$con = new mysqli('localhost','root','','pageant');
		return $con->query($sql);
	}
	if(!empty($_POST)){
		$category = str_replace("%20", ' ', $_POST['ref']);
		$data = QUERY("SELECT * FROM tblresults WHERE Cat = '$category' AND award != '' ORDER BY Score LIMIT 5")->fetch_all();
		//var_dump($data);
		if(!empty($data)){
			shuffle($data);
			$value1 ='';
			foreach ($data as $key => $value) {
				$name = $value['1'];
				$score = $value['3'];
				$candidate = QUERY("SELECT * FROM tblcontestant WHERE name = '$name'")->fetch_assoc();
				$value1[$key][] = $value;
				$value1[$key][] = $candidate; 
			}
			echo json_encode($value1,JSON_FORCE_OBJECT);
		}else
			echo "0";
	}else
		echo "0";
	

?>