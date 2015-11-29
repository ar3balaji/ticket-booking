<?php		
	session_start();
	include ('includes/dbconn.php');	
	$conn = oci_connect($dbUserName, $dbPassword, $db);	
	$username = $_SESSION['username'];
	$postid   = $_POST['postid'];	
	$content = $_POST['comment'];		
	echo "BEGIN INSERTCOMMENT('".$username."',".$postid.",'".$content."'); END;";
	$insert_comment = oci_execute(oci_parse($conn, "BEGIN INSERTCOMMENT('".$username."',".$postid.",'".$content."'); END;"),OCI_DEFAULT);
	
	
	if($insert_comment) {
		oci_commit($conn);
		header("Location: /ticket-booking/visit.php?postid=".$postid);
	}	
	else {		
		header("Location: /ticket-booking/visit.php?postid=".$postid);
		oci_rollback($conn);
	}
	
	oci_close($conn);	
?>