<?php
	include('header.php');
	include ('includes/dbconn.php');	
	$conn = oci_connect($dbUserName, $dbPassword, $db);
	if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
?>
<p>Welcome to BookMyTicket.com...Coolest way to book a ticket !!</p>

<div class="theatres-selection">
	<form action="/ticket-booking/list-theatres.php" method="post">
		<label for="theatre-city">Select City : </label> 
		<select name="theatre-city" id="theatre-city">
			<?php 				  
				$theatreCityQuery = 'select unique  upper(city) as CITY from theatres order by city';
				$stid = oci_parse($conn, $theatreCityQuery);
				$success = oci_execute($stid);
				if($success){
					while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS + OCI_ASSOC))
					{
						echo "<option value=\"".$row['CITY']."\">" . $row['CITY'] . "</option>";
					}
				} else {
					echo "<option value=\"NONE\">NONE</option>";
				}
			?>
		</select>&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" name="theatre-search-content" id="theatre-search-content" placeholder="enter pincode\ theatre name \ movie name to search movies..." />					
		<center><input type="submit" name="submit" value="Search" class="button" /></center>						
	</form>
</div>					

<?php
	include('footer.php');
	oci_close($conn);
?>