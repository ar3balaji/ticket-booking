<?php
	include ("includes/header.php");
	include ('includes/dbconn.php');	
	$emailid   = $_POST['email'];
	$name   = $_POST['name'];
	$passwd = $_POST['password'];
	$address = $_POST['address'];
	$phoneno = $_POST['phoneno'];
	$creditcardno = $_POST['creditcardno'];
	$creditcardtype = $_POST['creditcardtype'];
	$expirydatemm = $_POST['creditcardexpmm'];
	$expirydateyyyy = $_POST['creditcardexpyyyy'];
	$insert_movieuser = mysqli_query($con, "insert into movieuser (`emailId`,`fName`,`creditPoints`,`password`,`membershipStatus`) values('".$emailid."','".$name."',0,'".$passwd."','bronze');");
	$insert_movieuseraddress = mysqli_query($con, "insert into movieuseraddress (`userId`,`address`) values('".$emailid."','".$address."');");
	$insert_movieuserphoneno = mysqli_query($con, "insert into movieuserphoneno (`userId`,`phoneNo`) values('".$emailid."','".$phoneno."');");
	$insert_card = mysqli_query($con, "insert into card (`cardNo`,`cardType`,`userId`,`expiryDate`) values('".$creditcardno."','".$creditcardtype."','".$emailid."','".$expirydateyyyy."-".$expirydatemm."-01"."');");
	
	if($insert_movieuser && $insert_movieuseraddress && $insert_movieuserphoneno && $insert_card) {
		header("Location: /ticket-booking/index.php?status=reg-success");
	}	
	else {		
		header("Location: /ticket-booking/index.php?status=reg-fail");
	}
?>