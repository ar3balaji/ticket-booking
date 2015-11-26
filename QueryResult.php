<?php 
include ('includes/dbconn.php');
$oconn = oci_connect($dbUserName, $dbPassword, $db);
$query = "select * from worktype"; 
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