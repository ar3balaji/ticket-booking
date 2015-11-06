<?php
	session_start();
	
	include ('includes/dbconn.php');
	
	$username = $_POST['username'];
	$password = $_POST['user-password'];
	
	$result = mysqli_query($con, "SELECT username, password FROM users WHERE username = '".$username."' AND password = '".$password."'");
	
	if (mysqli_num_rows($result) != 0) {
		$_SESSION['username'] = $username;
		header("Location: ".$_SERVER['HTTP_REFERER']);
	} else {
		header("Location: ".$_SERVER['HTTP_REFERER']."?status=login-fail");		
	}
?>