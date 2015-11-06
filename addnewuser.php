<?php
	include ("includes/header.php");
	include ('includes/dbconn.php');
	
	$newuser   = $_POST['username'];
	$newpasswd = $_POST['user-password'];
	$insert = mysqli_query($con, "insert into users (`username`,`password`) values('".$newuser."','".$newpasswd."');");
	
	if($insert) {
		header("Location: /ticket-booking/index.php?status=reg-success");
	}	
	else {
		echo "not success";
	}
?>