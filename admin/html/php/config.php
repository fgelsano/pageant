<?php
    $con = new mysqli('localhost','root','','pageant');

    function cl_connect($sql){
		$con = new mysqli('localhost', 'root','', 'pageant');
		$data = $con->query($sql);

		return $data;
	}
?>
