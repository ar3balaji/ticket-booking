<?php
	include('header.php');
	include ('includes/dbconn.php');	
	$conn = oci_connect($dbUserName, $dbPassword, $db);
	if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
?>
<?php	
	include ('includes/dbconn.php');	
	$conn = oci_connect($dbUserName, $dbPassword, $db);	
	
	$screenname   = $_POST['screenname'];
	$theatreid = $_POST['theatreid'];
	$seatcount = $_POST['seatcount'];
	
	$insert_screens = oci_execute(oci_parse($conn, "insert into screens (screenid,screenname,theatreid,seatcount) values(screen_id_seq.nextval,'".$screenname."','".$theatreid."','".$seatcount."')"),OCI_DEFAULT);
	
	if($insert_screens) {
		oci_commit($conn);
		echo "<span style='color:green'>Screen added successfully";
	}	
	else {		
		echo "<span style='color:red'>Failed to add theatre";
		oci_rollback($conn);
	}
	
		
?>

<?php
	include('footer.php');
	oci_close($conn);
?>