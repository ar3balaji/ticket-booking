<?php
	include('header.php');
?>
<center>
<form name="register" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">		
		<fieldset >
		
			<legend align="top">Display Schedule</legend>
			<div class='container'>
				<label for='tid' >Theatre*: </label><br>
			<select id="tid" name="tid">
			<?php
			
			include ('includes/dbconn.php');
			$conn = oci_connect($dbUserName, $dbPassword, $db);
			$cdquery=oci_parse($conn,"select THEATREID,THEATRENAME||','||LOCATION AS THEATRENAME from THEATRES")or die ('None'); ;
			$cdresult=oci_execute($cdquery); //or die ("Query to get data from firsttable failed: ".mysql_error());
			while ($cdrow=oci_fetch_array($cdquery, OCI_ASSOC+OCI_RETURN_NULLS)) {
				echo '<option value="'.$cdrow['THEATREID'].'">'.$cdrow['THEATRENAME'].'</option>';
			
			}
			?>
			</select>
			</div>
			
			<div class='container'>
				<label for='day' >Day*: </label><br>
				<select id=day name=day>
			<option value=Mon>Monday</option>
			<option value=Tue>Tuesday</option>
			<option value=Wed>Wednesday</option>
			<option value=Thu>Thursday</option>
			<option value=Fri>Friday</option>
			<option value=Sat>Saturday</option>
			<option value=Sun>Sunday</option>
			</select>
			</div>
			<div class='container'>
				<input type='submit' name='Submit' value='Display' />
			</div>
		</fieldset>
	</form>
<?php 
if ($_SERVER['REQUEST_METHOD']== "POST") {
include ('includes/dbconn.php');
$oconn = oci_connect($dbUserName, $dbPassword, $db);
$tid   = $_POST['tid'];
$day   = $_POST['day'];
$query = "select t.THEATRENAME||t.LOCATION as Theatre,m.FNAME as Employee_Name,w.WORKTYPE as Work_Assigned,w.STARTTIME as Schedule_start, w.ENDTIME as Schedule_end from workfor w 
inner join theatres t on t.THEATREID=w.THEATREID
inner join employee e on e.EMPLOYEEID=w.EMPLOYEEID
inner join MOVIEUSER m on m.EMAILID=e.USERID
WHERE to_char(STARTTIME, 'Dy')='".$day."' AND STARTTIME>SYSDATE and t.THEATREID='".$tid."'"; 
$res = oci_parse($oconn,$query); 
usleep(100); 
$i=1;
if (oci_execute($res)){ 
        usleep(100); 
        print "<br><br><br>";
        print "<TABLE border \"1\">"; 
        $first = 0; 
        while ($row = @oci_fetch_assoc($res)){ 
        	
                if (!$first){ 
                	$i=0;
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
if($i==1)
{
	echo "No data available";
}
}
?>
</center>
<?php
	include('footer.php');
?>