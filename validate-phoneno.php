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
	$resource = oci_parse($conn, "SELECT * FROM movieuser WHERE emailid = '".$_SESSION['username']."'");
	oci_execute($resource, OCI_DEFAULT);
	
	$results=array();
	$numrows = oci_fetch_all($resource, $results, null, null, OCI_FETCHSTATEMENT_BY_ROW);
	if($numrows !=0){
		$updatephoeno = oci_execute(oci_parse($conn, "update movieuserphoneno set phoneno='".$_POST['phoneno']."' where userid='".$_SESSION['username']."'"),OCI_DEFAULT);
		if($updatephoeno) {
			echo "<span style='color:green'>User Phone no updated successfully!!";
			oci_commit($conn);
		} else {
			echo "<span style='color:red'>Updation Failed Try Later!!";
			oci_rollback($conn);
		}				
	} else {
		echo "<span style='color:red'>User Doesnot exist</span>";
	}
	
?>

<?php
	include('footer.php');
	oci_close($conn);
?>