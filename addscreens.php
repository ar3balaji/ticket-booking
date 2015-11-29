<?php	
	include ('includes/dbconn.php');	
	$conn = oci_connect($dbUserName, $dbPassword, $db);	
	
	$screenname   = $_POST['screenname'];
	$theatreid = $_POST['theatreid'];
	$seatcount = $_POST['seatcount'];
	
	$insert_screens = oci_execute(oci_parse($conn, "insert into screens (screenid,screenname,theatreid,seatcount) values(screen_id_seq.nextval,'".$screenname."','".$theatreid."','".$seatcount."')"),OCI_DEFAULT);
	
	if($insert_screens) {
		oci_commit($conn);
		header("Location: /ticket-booking/index.php");
	}	
	else {		
		header("Location: /ticket-booking/index.php");
		oci_rollback($conn);
	}
	
	oci_close($conn);	
?>