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
	$usertype = $_POST['usertype'];
	$emailid = $_POST['emailid'];
	$rewardpoints = $_POST['rewardpoints'];
	
	$resource = oci_parse($conn, "SELECT * FROM movieuser WHERE usertype='reguser' and emailid = '".$emailid."'");
	oci_execute($resource, OCI_DEFAULT);
	
	$results=array();
	$numrows = oci_fetch_all($resource, $results, null, null, OCI_FETCHSTATEMENT_BY_ROW);
	if($numrows !=0){
		$update_movieuser;
		if($usertype !="nochange") {			
			$update_movieuser = oci_execute(oci_parse($conn, "update movieuser set membershipstatus='".$usertype."',creditpoints=creditpoints+".$rewardpoints),OCI_DEFAULT);
			$insert_notify = oci_execute(oci_parse($conn, "insert into notify values('".$emailid."',sysdate,'Membership status Changed to ".$usertype."',0)"),OCI_DEFAULT);
		} else {
			$update_movieuser = oci_execute(oci_parse($conn, "update movieuser set creditpoints=creditpoints+".$rewardpoints),OCI_DEFAULT);
		}
		if($update_movieuser) {
			oci_commit($conn);
			echo "<span style='color:green'>User Updation done successfully!!</span>";
		}	
		else {		
			echo "<span style='color:red'>User Updation Failed!!</span>";
			oci_rollback($conn);
		}
	} else {
		echo "<span style='color:red'>User Doesnot exist or not registered user</span>";
	}
	
?>

<?php
	include('footer.php');
	oci_close($conn);
?>