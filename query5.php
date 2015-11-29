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
		$res = oci_parse($conn,"select emailid, b.count as commentcount from (select movieuser.EMAILID,a.count from movieuser,(select userid, count(*) as count from comments,makescomment where comments.COMMENTID=makescomment.COMMENTID group by userid)a where movieuser.EMAILID=a.userid order by a.count desc) b  where rownum<=10"); 
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
?>
<?php
	include('footer.php');
	oci_close($conn);
?>