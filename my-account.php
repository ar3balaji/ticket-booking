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
	$searchQuery = "select userid,address,phoneno,name,creditpoints,membershipstatus from movieuseraddress,(select userid as moviephoneuserid, phoneno, name, creditpoints,membershipstatus from movieuserphoneno, (select emailid as movieuserid, fname as name, creditpoints, membershipstatus from movieuser where emailid='".$_SESSION['username']."') where userid=movieuserid) where userid=moviephoneuserid";
	$users = oci_parse($conn, $searchQuery);
	oci_execute($users);
	echo "<a id='edit-phonenoid' href='/ticket-booking/edit-phoneno.php'>Edit Phone Number</a>&nbsp;&nbsp;";
	echo "<a id='notifications'href='/ticket-booking/notifications.php'>Notifications</a>&nbsp;&nbsp;";
	while (($row = oci_fetch_array($users, OCI_BOTH)) != false) {												
		echo "<br>";
		echo "<div class='movie'>";		
		echo "<span class='title'>Username\EmailID: </span><span class='titleValue'>".$row['USERID']."</span>";
		echo "<br>";
		echo "<span class='title'>Name: </span><span class='titleValue'>".$row['NAME']."</span>";
		echo "<br>";
		echo "<span class='title'>Address: </span><span class='titleValue'>".$row['ADDRESS']."</span>";			
		echo "<br>";
		echo "<span class='title'>Phone Number: </span> <span class='titleValue'>".$row['PHONENO']."</span>";
		echo "<br>";
		echo "<span class='title'>Credit Points: </span> <span class='titleValue'>".$row['CREDITPOINTS']."</span>";
		echo "<br>";
		echo "<span class='title'>Membership Status: </span> <span class='titleValue'>".$row['MEMBERSHIPSTATUS']."</span>";			
		echo "</div>";
	}
?>
<?php
	include('footer.php');
	oci_close($conn);
?>