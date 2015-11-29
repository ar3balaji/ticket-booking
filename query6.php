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
		$res = oci_parse($conn,"select * from (select theatres.THEATREID,theatrename,location,contactperson,contactphoneno,zip,country,state,count from theatres, (select theatreid, count(*) as count from movieshow group by theatreid) a where theatres.THEATREID = a.theatreid order by a.count  desc) where rownum<=10"); 
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