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
	$resource = oci_parse($conn, "SELECT * FROM notify WHERE entrydt >= trunc(sysdate) and userid = '".$_SESSION['username']."'");
	oci_execute($resource, OCI_DEFAULT);
	
	$results=array();
	$numrows = oci_fetch_all($resource, $results, null, null, OCI_FETCHSTATEMENT_BY_ROW);
	if($numrows != 0) {
		$res = oci_parse($conn,"select * from NOTIFY where userid='".$_SESSION['username']."'"); 
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