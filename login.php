<?php
	session_start();
	
	include ('includes/dbconn.php');
	
	$username = $_POST['username'];
	$password = $_POST['user-password'];
	
	$result = mysqli_query($con, "SELECT emailId, password FROM movieuser WHERE emailId = '".$username."' AND password = '".$password."'");
	
	if (mysqli_num_rows($result) != 0) {
		$_SESSION['username'] = $username;
		header("Location:/ticket-booking/index.php?status=logged-in");
	} else {
		header("Location:/ticket-booking/index.php?status=login-fail");		
	}
?>