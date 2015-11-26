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
	$adminType = $_POST['admin-type'];
	$emailid = $_POST['emailid'];
	if($adminType == 'creation') {
		$resource = oci_parse($conn, "SELECT * FROM userrole WHERE userid = '".$emailid."' AND role = 'admin'");
		oci_execute($resource, OCI_DEFAULT);		
		$numrows = oci_fetch_all($resource, $results, null, null, OCI_FETCHSTATEMENT_BY_ROW);
		if($numrows == 0) {
			$insertAdmin = oci_execute(oci_parse($conn, "insert into userrole (userid,role) values('".$emailid."','admin')"),OCI_DEFAULT);
			if($insertAdmin) {
				echo "<span style='color:green'>User ".$emailid." is admin now!!";
				oci_commit($conn);
			} else {
				echo "<span style='color:red'>Making User ".$emailid." Failed Try Later!!";
				oci_rollback($conn);
			}
		}		
	} else {
		$removeAdmin = oci_execute(oci_parse($conn, "delete from userrole where userid='".$emailid."'"),OCI_DEFAULT);
		if($removeAdmin) {
			echo "<span style='color:green'>User ".$emailid." is not admin now!!";
			oci_commit($conn);
		} else {
			echo "<span style='color:red'>Removing User ".$emailid." as admin Failed Try Later!!";
			oci_rollback($conn);
		}
	}
?>

<?php
	include('footer.php');
	oci_close($conn);
?>