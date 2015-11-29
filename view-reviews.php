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
	$type=$_GET['type'];
	if($type=="movie") {
		$movieid=$_GET['movieid'];	
		$res = oci_parse($conn,"SELECT review.REVIEWID,moviereview.USERID,review.CREATEDDATE,review.SUMMARY,review.REVIEW,review.VOTE FROM review,moviereview where review.REVIEWID = moviereview.REVIEWID and moviereview.movieid=".$movieid); 
		usleep(100); 		
		$r = oci_execute($res);		
		$results=array();
			$numrows = oci_fetch_all($res, $results, null, null, OCI_FETCHSTATEMENT_BY_ROW);			
			if($numrows == 0) {
				echo "Reviews Not available!!";
			} else {
				oci_execute($res);
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
			}
	}
	else {
		$theatreid=$_GET['theatreid'];		
		$res = oci_parse($conn,"SELECT review.REVIEWID,theatrereview.USERID,review.CREATEDDATE,review.SUMMARY,review.REVIEW,review.VOTE FROM review,theatrereview where review.REVIEWID = theatrereview.REVIEWID and theatrereview.theatreid=".$theatreid); 
		usleep(100); 		
		$r = oci_execute($res);		
		$results=array();
			$numrows = oci_fetch_all($res, $results, null, null, OCI_FETCHSTATEMENT_BY_ROW);			
			if($numrows == 0) {
				echo "Reviews Not available!!";
			} else {
				oci_execute($res);
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
			}		
	}		
?>

<?php
	include('footer.php');
	oci_close($conn);
?>