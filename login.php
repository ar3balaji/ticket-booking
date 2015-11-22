<?php
	session_start();
	include ('includes/dbconn.php');
	
	$username = $_POST['username'];
	$password = $_POST['user-password'];
	$conn = oci_connect($dbUserName, $dbPassword, $db);	
	$resource = oci_parse($conn, "SELECT emailId, password FROM movieuser WHERE emailId = '".$username."' AND password = '".$password."'");
	oci_execute($resource, OCI_DEFAULT);
	
	$results=array();
	$numrows = oci_fetch_all($resource, $results, null, null, OCI_FETCHSTATEMENT_BY_ROW);
	oci_close($conn);
	
	if ($numrows != 0) {
		$_SESSION['username'] = $username;
		header("Location:/ticket-booking/index.php?status=logged-in");
	} else {
		header("Location:/ticket-booking/index.php?status=login-fail");		
	}
?>