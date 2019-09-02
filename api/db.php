<?php 
	$con = new mysqli("localhost","root","","pageant");

	class connect
	{
		public $con;
		private $json;

		function __construct($db){
			$this->con = $db;
		}
		public function getResults($sql){
			$data = $this->con->query($sql);
			if($data->num_rows > 0){
				$data->num_rows > 1 ? $this->resultsArray($data) : $this->results($data->fetch_assoc());
				return $this->json;
			}
			else
				return false;

		}
		public function getResultsArray($sql){
			$data = $this->con->query($sql);
			if($data->num_rows > 0){
				return $this->resultsArraySp($data);
			}
			else
				return false;

		}

		public function getview($user,$cat, $option){
			$data = $this->con->query("SELECT * FROM tblcontestant ORDER BY number+0 ASC");
			if($data->num_rows > 0){
				$this->json = "[";
				while ($row = $data->fetch_assoc()) {
					$this->json != "[" ? $this->json .= ',' : '';
					$arr = "[";
					$tmp = "{";
					foreach ($row as $key => $value) {
							$tmp != "{" ? $tmp .= ',' : '';
							$tmp .= '"' . $key . '":"' . $value . '"';
							
					}
					$candidate = $row['name'];
					$tmp .= '},';
					$data2 = $this->con->query("SELECT * FROM tbllogs WHERE Judges = '$user' AND Candidate = '$candidate' AND cat = '$cat'");
					$data2 ? $tmp .= $this->resultsArraySp($data2) : $tmp .= '{"score":"false"}';
					$tmp .= ',';
					$data2 = $this->con->query("SELECT * FROM tblresults WHERE Candidate = '$candidate' AND cat = '$option' AND award != ''");
					$data2->num_rows > 0 ? $tmp .= $this->resultsArraySp($data2) : $tmp .= '{"top":"false"}';
					$arr .= $tmp;
					$this->json .= $arr .= ']';
				}
				return $this->json .= ']';
			}
			else
				return false;

		}
		public function resultsSp($data){
			$json = "{";
			foreach ($data as $key => $value) {
					$json != "{" ? $json .= ',' : '';
					$json .= '"' . $key . '":"' . $value . '"';
			}
			return $json .= '}';
		}

		public function results($data){
			$this->json = "{";
			foreach ($data as $key => $value) {
					$this->json != "{" ? $this->json .= ',' : '';
					$this->json .= '"' . $key . '":"' . $value . '"';
			}
			$this->json .= '}';
		}
		private function resultsArray($data){
			$this->json = "[";
			while ($row = $data->fetch_assoc()) {
				$this->json != "[" ? $this->json .= ',' : '';
				$tmp = "{";
				foreach ($row as $key => $value) {
						$tmp != "{" ? $tmp .= ',' : '';
						$tmp .= '"' . $key . '":"' . $value . '"';
						
				}
				$this->json .= $tmp .= '}';
			}
			$this->json .= ']';
		}

		public function resultsArraySp($data){
			$json = "[";
			while ($row = $data->fetch_assoc()) {
				$json != "[" ? $json .= ',' : '';
				$tmp = "{";
				foreach ($row as $key => $value) {
						$tmp != "{" ? $tmp .= ',' : '';
						$tmp .= '"' . $key . '":"' . $value . '"';
						
				}
				$json .= $tmp .= '}';
			}
			return $json .= ']';
		}


		public function insertData($tbl, $data,$null){
			$sql = "";
			$null ? $sql = "INSERT INTO $tbl VALUES(NULL," : $sql = "INSERT INTO $tbl VALUES(";
			
			if(is_array($data)){
				$tmp = $sql;
				foreach ($data as $key => $value) {
					$sql != $tmp ? $sql .= "," :'';
					$sql .= "'" . $value . "'";
					
				}
				$sql .= ')';
			}
			return $this->con->query($sql);
		}

		public function updateData($tbl, $data, $where){
			$sql = "UPDATE $tbl SET ";
			if(is_array($data)){
				$tmp = "";
				foreach ($data as $key => $value) {
					$tmp != "" ? $tmp .= "," :'';
					$tmp .= $key ." = '" . $value . "'" ;
					
				}
				$sql .= $tmp;
			}
			if(is_array($where)){
				$tmp = " WHERE ";
				foreach ($where as $key => $value) {
					$tmp != " WHERE " ? $tmp .= "," :'';
					$tmp .= $key ." = '" . $value . "'" ;
					
				}
				$sql .= $tmp;
			}
			if($this->con->query($sql)){ return true;}else return false;
		}

		public function display(){
			$data = $this->con->query("SELECT * FROM tblcontestant ORDER BY number+0");
			$json = "[";
			while ($row = $data->fetch_assoc()) {

				$candidate = $row['name'];

				$json != "[" ? $json .= "," : "";
				$json .= "[";
				$json .= $this->resultsSp($row);
				$json .= ",";
				$this->getResults("SELECT * FROM tblresults WHERE Candidate = '$candidate'");
				$this->json ? $json .= $this->json : $json .=  '{"score":"false"}';
				$json .= "]";
				
			}
			return $json .= "]";
		}
		public function tabulation($ca){
			$sqlr = "{";
			$cat = $this->con->query("SELECT * FROM tblcategory WHERE name != '$ca' ORDER BY oder+0 ASC");
			while ($c_row = $cat->fetch_assoc()) {
				$catname = $c_row['name'];
				$res = $this->con->query("SELECT * FROM tblresults WHERE Cat = '$catname'");

				if($res->num_rows > 0){
					$sqlr != "{" ? $sqlr .= "," : "";
					
					$candidate = $this->con->query("SELECT * FROM tblcontestant ORDER BY number+0 ASC");
					$tmp = '"' . $catname .'":';
					$sql = "["; 
					while ($canrow = $candidate->fetch_assoc()) {
						$canname = $canrow['name'];
						$score = $this->con->query("SELECT * FROM tblresults WHERE Cat = '$catname' AND Candidate = '$canname'")->fetch_assoc();
						if(!empty($score)){
							$sql != "[" ? $sql .= "," : "";
							$sql .= $this->resultsSp($score);
						}
						else{
							$sql != "[" ? $sql .= "," : "";
							$sql .=  '{"score": " "}';
						}
						
					}
					$sqlr .= $tmp .= $sql .= "]";
				}
				
			}
			return $sqlr .= "}";
		}
		public function tabulationCat($cat){
			$sqlr = "{";
			$catname = $cat;
			$res = $this->con->query("SELECT * FROM tblresults WHERE Cat = '$cat'");

			if($res->num_rows > 0){
				$sqlr != "{" ? $sqlr .= "," : "";
				
				$candidate = $this->con->query("SELECT * FROM tblcontestant ORDER BY number+0 ASC");
				$tmp = '"' . $catname .'":';
				$sql = "["; 
				while ($canrow = $candidate->fetch_assoc()) {
					$canname = $canrow['name'];
					$score = $this->con->query("SELECT * FROM tblresults WHERE Cat = '$catname' AND Candidate = '$canname'")->fetch_assoc();
					if(!empty($score)){
						$sql != "[" ? $sql .= "," : "";
						$sql .= $this->resultsSp($score);
					}
					else{
						$sql != "[" ? $sql .= "," : "";
						$sql .=  '{"score": " "}';
					}
					
				}
				$sqlr .= $tmp .= $sql .= "]";
			}
			return $sqlr .= "}";
		}

		public function resultsCategory($cat){
			$json = "[";

			$data = $this->con->query("SELECT * FROM tblcontestant ORDER BY number+0 ASC");

			while ($ca_row = $data->fetch_assoc()) {
				$json != "[" ? $json .= "," : "";
				$cname = $ca_row['name'];
				$sql = "[";

				$candidate = $this->resultsSp($ca_row);
				$candidate ? $sql .= '{"candidate": ' . $candidate . "}," : $sql .= '{"candidate": false},';

				$score = $this->getResultsArray("SELECT * FROM tbllogs WHERE cat = '$cat' AND Candidate = '$cname' ORDER BY Judges ASC");
				$score ? $sql .= '{"score": ' . $score . "}" : $sql .= '{"score": false}';

				$json .= $sql .= "]";
			}

			return $json .= "]";
		}

		public function resultshasCrit($cat){
			$json = "[";

			$data = $this->con->query("SELECT * FROM tblcontestant ORDER BY number+0 ASC");

			while ($ca_row = $data->fetch_assoc()) {
				$json != "[" ? $json .= "," : "";
				$cname = $ca_row['name'];
				$sql = "[";

				$candidate = $this->resultsSp($ca_row);
				$candidate ? $sql .= '{"candidate": ' . $candidate . "}," : $sql .= '{"candidate": false},';

				$crit = $this->con->query("SELECT * FROM tbljudges ORDER BY name ASC");
				$critdata = "[";
				$score = "";
				while ( $row = $crit->fetch_assoc()) {
					$jud = $row['name'];
					$critdata != "[" ? $critdata .= "," : "";
					$score = $this->getResultsArray("SELECT * FROM tbllogs WHERE cat = '$cat' AND Candidate = '$cname' AND Judges = '$jud' ORDER BY Judges ASC");
					$score ? $critdata .= $score : $critdata .= '{"score": false}';


				}
				$critdata .= "]";

				$critdata == "[]" ? $sql .= '{"score": false}' : $sql .= '{"score":' . $critdata . '}';

				$json .= $sql .= "]";
			}

			return $json .= "]";
		}

		public function resultsJudge($judge){
			$json = "[";

			$data = $this->con->query("SELECT * FROM tblcontestant ORDER BY number+0 ASC");

			while ($ca_row = $data->fetch_assoc()) {
				$json != "[" ? $json .= "," : "";
				$cname = $ca_row['name'];
				$sql = "[";

				$candidate = $this->resultsSp($ca_row);
				$candidate ? $sql .= '{"candidate": ' . $candidate . "}," : $sql .= '{"candidate": false},';

				$crit = $this->con->query("SELECT * FROM tblcategory WHERE oder != '0' ORDER BY oder+0 ASC");
				$critdata = "[";
				$score = "";
				while ( $row = $crit->fetch_assoc()) {
					$cat = $row['name'];
					$critdata != "[" ? $critdata .= "," : "";
					$score = $this->getResultsArray("SELECT * FROM tbllogs WHERE cat = '$cat' AND Candidate = '$cname' AND Judges = '$judge'");
					$score ? $critdata .= $score : $critdata .= '{"score": false}';
				}
				$critdata .= "]";

				$critdata == "[]" ? $sql .= '{"score": false}' : $sql .= '{"score":' . $critdata . '}';

				$json .= $sql .= "]";
			}

			return $json .= "]";
		}

		public function displayresults($judge,$cat){
			$json = "[";

			$data = $this->con->query("SELECT * FROM tblcontestant ORDER BY number+0 ASC");

			while ($ca_row = $data->fetch_assoc()) {
				$json != "[" ? $json .= "," : "";
				$cname = $ca_row['name'];
				$sql = "[";

				$candidate = $this->resultsSp($ca_row);
				$candidate ? $sql .= '{"candidate": ' . $candidate . "}," : $sql .= '{"candidate": false},';

				$score = $this->getResultsArray("SELECT * FROM tbllogs WHERE cat = '$cat' AND Candidate = '$cname' AND Judges = '$judge'");
				$score ? $sql .= $score : $sql .= '{"score": false}';

				$json .= $sql .= "]";
			}

			return $json .= "]";
		}

		public function top($cat){
			
		}
	}
	$DB = new connect($con);
?>