<?php
	include ("includes/header.php");
	include ('includes/dbconn.php');	
	$conn = oci_connect($dbUserName, $dbPassword, $db);	
	$emailid   = $_POST['email'];
	$name   = $_POST['name'];
	$passwd = $_POST['password'];
	$address = $_POST['address'];
	$phoneno = $_POST['phoneno'];
	$creditcardno = $_POST['creditcardno'];
	$creditcardtype = $_POST['creditcardtype'];
	$expirydatemm = $_POST['creditcardexpmm'];
	$expirydateyyyy = $_POST['creditcardexpyyyy'];	
	$insert_movieuser = oci_execute(oci_parse($conn, "insert into movieuser (emailId,fName,creditPoints,password,membershipStatus) values('".$emailid."','".$name."',0,'".$passwd."','bronze')"));
	$insert_movieuseraddress = oci_execute(oci_parse($conn, "insert into movieuseraddress (userId,address) values('".$emailid."','".$address."')"));
	$insert_movieuserphoneno = oci_execute(oci_parse($conn, "insert into movieuserphoneno (userId,phoneNo) values('".$emailid."','".$phoneno."')"));
	$insert_card = oci_execute(oci_parse($conn, "insert into card (cardNo,cardType,userId,expiryDate,balance) values('".$creditcardno."','".$creditcardtype."','".$emailid."',to_date('".$expirydateyyyy."-".$expirydatemm."-01"." 23:59:59','RRRR-MM-DD hh24:mi:ss'),0)"));
	oci_close($conn);
	
	if($insert_movieuser && $insert_movieuseraddress && $insert_movieuserphoneno && $insert_card) {
		header("Location: /ticket-booking/index.php?status=reg-success");
	}	
	else {		
		header("Location: /ticket-booking/index.php?status=reg-fail");
	}
	
?>