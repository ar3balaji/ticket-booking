<?php
	include('header.php');
	include ('includes/dbconn.php');	
	$conn = oci_connect($dbUserName, $dbPassword, $db);
	if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
?>
<?php
	$searchQuery = "select userid,address,phoneno,name,creditpoints,membershipstatus from movieuseraddress,(select userid as moviephoneuserid, phoneno, name, creditpoints,membershipstatus from movieuserphoneno, (select emailid as movieuserid, fname as name, creditpoints, membershipstatus from movieuser where emailid='".$_SESSION['username']."') where userid=movieuserid) where userid=moviephoneuserid";
	$users = oci_parse($conn, $searchQuery);
	oci_execute($users);
	echo "<a id='edit-phonenoid' href='/ticket-booking/edit-phoneno.php'>Edit Phone Number</a>&nbsp;&nbsp;";	
	while (($row = oci_fetch_array($users, OCI_BOTH)) != false) {												
		echo "<br>";
		echo "<div class='movie'>";		
		echo "<span class='title'>Username\EmailID: </span><span class='titleValue'>".$row['USERID']."</span>";
		echo "<br>";
		echo "<span class='title'>Name: </span><span class='titleValue'>".$row['NAME']."</span>";
		echo "<br>";
		echo "<span class='title'>Address: </span><span class='titleValue'>".$row['ADDRESS']."</span>";			
		echo "<br>";
		echo "<span class='title'>Phone Number: </span> <span class='titleValue'>".$row['PHONENO']."</span>";
		echo "<br>";
		echo "<span class='title'>Credit Points: </span> <span class='titleValue'>".$row['CREDITPOINTS']."</span>";
		echo "<br>";
		echo "<span class='title'>Membership Status: </span> <span class='titleValue'>".$row['MEMBERSHIPSTATUS']."</span>";			
		echo "</div>";
	}
	echo "<br>";
	$resource = oci_parse($conn, "SELECT description as Notifications FROM notify WHERE entrydt >= trunc(sysdate) and userid = '".$_SESSION['username']."'");
	oci_execute($resource, OCI_DEFAULT);
	
	$results=array();
	$numrows = oci_fetch_all($resource, $results, null, null, OCI_FETCHSTATEMENT_BY_ROW);
	if($numrows != 0) {
		$res = oci_parse($conn,"select description as Notifications from NOTIFY WHERE entrydt >= trunc(sysdate) and userid='".$_SESSION['username']."'"); 
		usleep(100); 		
		$r = oci_execute($res);
		usleep(100); 
		print "<TABLE style='width:100%' border \"1\">"; 
		$first = 0; 
		while ($row = @oci_fetch_assoc($res)){ 
			if (!$first){ 
				$first = 1; 
				print "<TR><TH>"; 
				print implode("</TH><TH>",array_keys($row)); 
				print "</TH></TR>\n"; 
			} 
			print "<TR><TD>"; 
			print @implode("</TD><TD>",array_values($row)); 
			print "</TD></TR>\n"; 
		} 
		print "</TABLE>";
		} else {
			echo "<span style='color:green'> No Notifications Found</span>";
		}
?>
<?php
	include('footer.php');
	oci_close($conn);
?>