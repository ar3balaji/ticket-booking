
<?php		
	include('header.php');
	include ('includes/dbconn.php');	
	$conn = oci_connect($dbUserName, $dbPassword, $db);
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	
?>
<center>
	".............Discussion Threads will be viewed here............"
</center>
<br>
<br>
<?php 
include ('includes/dbconn.php');
$oconn = oci_connect($dbUserName, $dbPassword, $db);
$query = "select * from post order by createddate desc"; 
$res = oci_parse($oconn,$query); 
usleep(100); 
if (oci_execute($res)){ 
       usleep(100); 
       print "<TABLE style='width:100%' border \"1\">"; 
       $first = 0; 
       while ($row = @oci_fetch_assoc($res)){ 
               if (!$first){ 
                       $first = 1; 
                       print "<TR><TH>"; 
                       print implode("</TH><TH>",array_keys($row)); 
                       print "</TH></TR>"; 
               } 
               print "<TR><TD>"; 
               print @implode("</TD><TD>",array_values($row)); 
               print "</TD><TD><a href='/ticket-booking/visit.php?postid=".$row['POSTID']."'>visit</a></TD>";
			   print "<TD><a href='/ticket-booking/three-comments.php?postid=".$row['POSTID']."'>Get recent 3 comments</a></TD></TR>"; 
       } 
       print "</TABLE>"; 
} 
?>

<?php
	include('footer.php');
	oci_close($conn);
?>
