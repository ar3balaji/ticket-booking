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
	$username=$_SESSION['username'];
	$vote   = $_POST['vote'];
	$type   = $_POST['type'];
	$summary = $_POST['summary'];
	$review = $_POST['review'];
	if($type=="movie") {
		$movieid=$_POST['movieid'];		
		$insert_moviereview = oci_execute(oci_parse($conn, "BEGIN INSERTMOVIEREVIEW(".$vote.",'".$summary."','".$review."','".$username."',".$movieid."); END;"),OCI_DEFAULT);
		if($insert_moviereview) {		 
			echo "<span style='color:green'>Review Created</span>";
		}	
		else {		
			echo "<span style='color:red'>Review Creation failed</span>";		
		}
	}
	else {
		$theatreid=$_POST['theatreid'];		
		$insert_theatrereview = oci_execute(oci_parse($conn, "BEGIN INSERTTHEATREREVIEW(".$vote.",'".$summary."','".$review."','".$username."',".$theatreid."); END;"),OCI_DEFAULT);
		if($insert_theatrereview) {		 
			echo "<span style='color:green'>Review Created</span>";
		}	
		else {		
			echo "<span style='color:red'>Review Creation failed</span>";		
		}
	}		
?>

<?php
	include('footer.php');
	oci_close($conn);
?>