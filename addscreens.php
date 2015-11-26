<?php	
	include ('includes/dbconn.php');	
	$conn = oci_connect($dbUserName, $dbPassword, $db);	
	
	$screenname   = $_POST['screenname'];
	$theatreid = $_POST['theatreid'];
	$seatcount = $_POST['seatcount'];
	
	$insert_screens = oci_execute(oci_parse($conn, "insert into screens (screenname,theatreid,seatcount) values('".$screenname."','".$theatreid."','".$seatcount."')"),OCI_DEFAULT);
	
	if($insert_screens) {
		oci_commit($conn);
		header("Location: /ticket-booking/index.php?status=reg-success");
	}	
	else {		
		header("Location: /ticket-booking/index.php?status=reg-fail");
		oci_rollback($conn);
	}
	
	oci_close($conn);	
?>