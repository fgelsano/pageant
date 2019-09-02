<?php
	function WP_QUERY($sql){
      $con = new mysqli("localhost",'root','','pageant');
      return $con->query($sql);
    }
    $str = '';
    $candidate = WP_QUERY("SELECT * FROM tblcontestant ORDER BY number+0 ASC");
    while ($row = $candidate->fetch_assoc()) { 
         $cname = $row['name'];  
         $str .= "<tr><td>" .$row['number'] . "</td>";
         $str .= "<td>" .$row['name'] . "</td>";
         $str .= "<td>" .$row['team'] . "</td>";
         $str .= "<td>" .$row['descript'] . "</td>";
         $data1 = WP_QUERY("SELECT * FROM tblresults WHERE Cat = 'Talent' AND Candidate = '$cname'")->fetch_assoc();
         $str .= "<td class='text-center'>" . $data1['Score'] . "</td>";
          $cat = WP_QUERY("SELECT * FROM tblcategory WHERE name != 'Final' ORDER BY oder ASC");
          while ($cat_row = $cat->fetch_assoc()) {
              
              $ca_name = $cat_row['name'];
              $data = WP_QUERY("SELECT * FROM tblresults WHERE Cat = '$ca_name' AND Candidate = '$cname'")->fetch_assoc();
              
              
              $str .= "<td class='text-center'>" . $data['Score'] . "</td>";

          }
          $data2 = WP_QUERY("SELECT * FROM tblresults WHERE Cat = 'Summary' AND Candidate = '$cname'")->fetch_assoc();
          $str .= "<td class='text-center'>" . $data2['Score'] . "</td>";
          $data2 = WP_QUERY("SELECT * FROM tblresults WHERE Cat = 'Final' AND Candidate = '$cname'")->fetch_assoc();
          $str .= "<td class='text-center'>" . $data2['Score'] . "</td>";
          $str .= "</tr>";
    }
    echo $str;
?>