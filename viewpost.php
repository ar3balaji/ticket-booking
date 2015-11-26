<?php		
	include('header.php');
	include ('includes/dbconn.php');	
	$conn = oci_connect($dbUserName, $dbPassword, $db);
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	
?>
".............Recent Top 10 posts will be viewed here............"

<?php 
include ('includes/dbconn.php');
$oconn = oci_connect($dbUserName, $dbPassword, $db);
$query = "select title,content from (select * from post order by postid desc) where ROWNUM <= 10"; 
$res = oci_parse($oconn,$query); 
usleep(100); 
if (oci_execute($res)){ 
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
?>

<?php
	include('footer.php');
	oci_close($conn);
?>