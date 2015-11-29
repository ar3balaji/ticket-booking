<?php		
	include('header.php');
	include ('includes/dbconn.php');	
	$conn = oci_connect($dbUserName, $dbPassword, $db);
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
?>
<form name="screens" action="addscreens.php"  method="POST">		
	<center>
		<fieldset >
			<legend>ADD SCREENS</legend>		

			<div class='container'>
				<input type='submit' name='Submit' value='Add Screens' />
			</div>
			<div class='container'>
				<label for='screenname' >Sreen Name*: </label><br>
				<input type='text' name='screenname' id='screenname' maxlength="50" />
				
			</div>
			<div class='container'>
				<label for='theatreid' >Theatre Id*: </label><br>
				<input type='text' name='theatreid' id='theatreid' maxlength="50" />
				
			</div>
			<div class='container'>
				<label for='seatcount' >Seat Count*: </label><br>
				<input type='text' name='seatcount' id='seatcount' maxlength="50" />
				
			</div>
		</fieldset>
	</center>
	</form>
<?php
	include('footer.php');
	oci_close($conn);
?>