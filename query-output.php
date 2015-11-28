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
	$querytype = $_POST['query-type'];
	$query = $_POST['query'];
	
	if($querytype == 'select') {
		$res = oci_parse($conn,$query); 
		usleep(100); 		
		$r = oci_execute($res);
		if (!$r){ 
			$e = oci_error($res);  // For oci_execute errors pass the statement handle
			print htmlentities($e['message']);
			print "\n<pre>\n";
			print htmlentities($e['sqltext']);
			printf("\n%".($e['offset']+1)."s", "^");
			print  "\n</pre>\n";			   
		} 
		else {
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
	else {
		echo "Still In Development";
	}
?>
<?php
	include('footer.php');
	oci_close($conn);
	ExceptionThrower::Stop();
?>