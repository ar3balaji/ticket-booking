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
	$userType = $_POST['usertype'];		
	if($userType=="reguser"){
		$username = $_SESSION['username'];
		$showid = $_POST['showid'];
		$tickets = explode("," , $_POST['tickets']);
		$ticketPrice = $_POST['ticketprice'];
		$balanceQuery = oci_parse($conn, "SELECT balance from card where userid='".$username."'");
		oci_execute($balanceQuery);
		$nrows = oci_fetch_all($balanceQuery, $balance);
		if($nrows == 1) {
			$totalAmount = $ticketPrice * count($tickets);
			if($totalAmount < $balance['BALANCE'][0]) {
				$updateBalance = oci_execute(oci_parse($conn, "update card set balance=".($balance['BALANCE'][0] - $totalAmount)." where userid ='".$username."'"),OCI_DEFAULT);
				$insertStatus = "";
				for($i=0; $i<count($tickets);$i++) {
					$insert_ticket = oci_execute(oci_parse($conn, "insert into tickets values(ticket_id_seq.nextval,'".$username."',SYSDATE,".$showid.",".$tickets[$i].")"),OCI_DEFAULT);
					$insertStatus=$insertStatus.$insert_ticket.",";					
				}
				if(strpos($insertStatus,"false") == false) {
					echo "<span style='color:green'>Tickets Booked Scuccessfully. Tickets can be found in MyAccount Secion !!</span>";				
					oci_commit($conn);
				} else {
					oci_rollback($conn);
					echo "<span style='color:red'>Tickets Booking Failed. Please Retry</span>";
				}
				
			} else {
				echo "<span style='color:red'>User doesnot have a sufficient fund to book a ticket!!</span>";
			}
			
		}
	}
	
?>

<?php
	include('footer.php');
	oci_close($conn);
?>