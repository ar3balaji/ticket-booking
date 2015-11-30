<?php
	include('header.php');
	include ('includes/dbconn.php');	
	$conn = oci_connect($dbUserName, $dbPassword, $db);
	if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	error_reporting(0);
?>
<?php
	
		$res = oci_parse($conn,"select userid, cardno, cardtype, expirydate, balance from card where USERID in  (select emailid as userid from movieuser where usertype='guest' and userid='".$_POST['emailid']."')"); 
		usleep(100); 		
		$r = oci_execute($res);
		if (!$r){ 
			$e = oci_error($res);  // For oci_execute errors pass the statement handle
			print htmlentities($e['message']);
			print "\n<pre style='color:red'>\n";
			print htmlentities($e['sqltext']);
			printf("\n%".($e['offset']+1)."s", "^");
			print  "\n</pre>\n";			   
		} 
		else {
			$results=array();
			$numrows = oci_fetch_all($res, $results, null, null, OCI_FETCHSTATEMENT_BY_ROW);			
			if($numrows == 0) {
				echo "Guest User not available";
			} else {
				oci_execute($res);
				usleep(100); 
				print "<TABLE border \"1\">"; 
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
			}
		}
?>
<?php
	include('footer.php');
	oci_close($conn);
	ExceptionThrower::Stop();
?>