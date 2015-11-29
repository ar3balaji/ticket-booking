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
	
	$theatrename   = $_POST['theatrename'];
	$location = $_POST['location'];
	$contactperson = $_POST['contactperson'];
	$contactphoneno = $_POST['contactphoneno'];
	$zip = $_POST['zip'];
	$country = $_POST['country'];
	$city = $_POST['city'];
	$state = $_POST['state'];		
	$insert_theatres = oci_execute(oci_parse($conn, "insert into theatres (theatreid,theatrename,location,contactperson,contactphoneno,zip,country,city,state) values(theatre_id_sequence.nextval,'".$theatrename."','".$location."','".$contactperson."','".$contactphoneno."',".$zip.",'".$country."','".$city."','".$state."')"),OCI_DEFAULT);
	
	if($insert_theatres) {
		oci_commit($conn);
		echo "<span style='color:green'>Theatre added successfully";
	}	
	else {		
		echo "<span style='color:green'>Failed to add theatre";
		oci_rollback($conn);
	}
	
		
?>
<?php
	include('footer.php');
	oci_close($conn);
?>