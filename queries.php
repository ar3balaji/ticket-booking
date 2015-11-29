<?php		
	include('header.php');
	include ('includes/dbconn.php');	
	$conn = oci_connect($dbUserName, $dbPassword, $db);
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
?>
<a href="/ticket-booking/query5.php">Registered Guest with most comments</a><br>
<a href="/ticket-booking/query6.php">Theatres with most number of movies</a><br>
<a href="/ticket-booking/query7.php">Theatres with most number of tickets</a><br>
<?php
	include('footer.php');
	oci_close($conn);
?>