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
				
				if(strpos($insertStatus,"0") == false && $updateBalance == true) {
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
	} else {
		$username = $_POST['email'];
		$showid = $_POST['showid'];
		$tickets = explode("," , $_POST['tickets']);
		$ticketPrice = $_POST['ticketprice'];
		$creditcardno = $_POST['creditcardno'];
		$creditcardtype = $_POST['creditcardtype'];
		$expirydatemm = $_POST['creditcardexpmm'];
		$expirydateyyyy = $_POST['creditcardexpyyyy'];
		$cardbalance = 50 ;
		$totalAmount = $ticketPrice * count($tickets);
		if($totalAmount < $cardbalance) {
			$resource = oci_parse($conn, "SELECT * FROM movieuser WHERE emailId = '".$username."'");
			oci_execute($resource, OCI_DEFAULT);
			$results=array();
			$numrows = oci_fetch_all($resource, $results, null, null, OCI_FETCHSTATEMENT_BY_ROW);
			$insert_movieuser = true;
			if($numrows == 0) {
				$insert_movieuser = oci_execute(oci_parse($conn, "insert into movieuser (emailId,fName,creditPoints,password,membershipStatus,usertype) values('".$username."',null,null,null,null,'guest')"),OCI_DEFAULT);
			}
			
			$resource = oci_parse($conn, "SELECT * FROM card WHERE userid = '".$username."' and cardno=".$creditcardno);
			oci_execute($resource, OCI_DEFAULT);
			$results=array();
			$numrows = oci_fetch_all($resource, $results, null, null, OCI_FETCHSTATEMENT_BY_ROW);
			$insert_card=true;
			if($numrows==0) {
				$insert_card = oci_execute(oci_parse($conn, "insert into card (cardNo,cardType,userId,expiryDate,balance) values('".$creditcardno."','".$creditcardtype."','".$username."',to_date('".$expirydateyyyy."-".$expirydatemm."-01"." 23:59:59','RRRR-MM-DD hh24:mi:ss'),".($cardbalance-$totalAmount).")"),OCI_DEFAULT);
			}
			$insertStatus = "";
			
			for($i=0; $i<count($tickets);$i++) {
				$insert_ticket = oci_execute(oci_parse($conn, "insert into tickets values(ticket_id_seq.nextval,'".$username."',SYSDATE,".$showid.",".$tickets[$i].")"),OCI_DEFAULT);				
				$insertStatus=$insertStatus.$insert_ticket.",";					
			}			
			if(strpos($insertStatus,"0") == false) {
				echo "<span style='color:green'>Tickets Booked Scuccessfully.!!</span>";				
				oci_commit($conn);				
			} else {
				oci_rollback($conn);
				echo "<span style='color:red'>Tickets Booking Failed. Please Retry</span>";
			}				
		} else {
			echo "<span style='color:red'>User doesnot have a sufficient fund to book a ticket!!</span>";
		}		
	}
	
?>

<?php
	include('footer.php');
	oci_close($conn);
?>