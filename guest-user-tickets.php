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
	
		$res = oci_parse($conn,"select moviename,theatrename,location,zip,country, city, state, screenid, starttime as moviestarttime,price,ticketid, createddate as ticketcreationdate from theatres,(select moviename,screenid,theatreid as theatreselectionid,starttime,price,ticketid,createddate,seatno from movies,(select movieid as movieselectionid,screenid,theatreid,starttime,price,ticketid,createddate,seatno from movieshow,(select ticketid, to_char(createddate, 'yyyy-mm-dd hh24:mi:ss') as createddate, showid as ticketshowid,seatno from tickets where USERID in (select emailid from movieuser where emailid='".$_POST['emailid']."')) where movieshow.showid = ticketshowid)  where movies.movieid = movieselectionid) where theatres.theatreid=theatreselectionid order by ticketcreationdate desc"); 
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
				echo "Tickets Not available!!";
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