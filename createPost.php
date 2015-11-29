<?php	
session_start();
	include ('includes/dbconn.php');	
	$conn = oci_connect($dbUserName, $dbPassword, $db);	
	$username=isset($_SESSION['username']) ? $_SESSION['username'] : "no" ;
	$movie   = $_POST['movie'];
	$theatre   = $_POST['theatre'];
	$content = $_POST['content'];
	$title=$movie;
	if(!isset($movie) || trim($movie)=='NONE')
	{$title=$theatre;}
	
	echo "BEGIN INSERTPOST('".$username."','".$title."','".$content."'); END;";	
	$insert_post = oci_execute(oci_parse($conn, "BEGIN INSERTPOST('".$username."','".$title."','".$content."'); END;"),OCI_DEFAULT);
	
	
	
	if($insert_post) {
		oci_commit($conn);
		header("Location: /ticket-booking/viewpost.php");
	}	
	else {		
		header("Location: /ticket-booking/viewpost.php");
		oci_rollback($conn);
	}
	
	oci_close($conn);	
?>