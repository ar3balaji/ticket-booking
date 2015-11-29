<?php		
	include('header.php');
	include ('includes/dbconn.php');	
	$conn = oci_connect($dbUserName, $dbPassword, $db);
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
?>
<script>
	function validateForm() {

		var screenname = document.forms["register"]["screenname"].value;
		var seatcount = document.forms["register"]["seatcount"].value;
		var result = true;
		$(register_screenname).text("");
		$(register_seatcount).text("");

		if (screenname == null || screenname == "") {
			$(register_screenname).text("Enter the screen name");			
			result = false;				
		}
		if (seatcount == null || seatcount == "") {
			$(register_seatcount).text("Enter the seating capacity");			
			result = false;				
		}

		if(seatcount != null && seatcount != "")
		{
			if(seatcount.match(/^[0-9]+$/) === null)
			{
			$(register_seatcount).text("Enter Numbers only");			
			result = false;
			}
		}
		
		return result;
	}
	</script>
<form name="register" action="addscreens.php" onsubmit="return validateForm()" method="POST">		
	<center>
		<fieldset >
			<legend>ADD SCREENS</legend>		

			<div class='container'>
				<input type='submit' name='Submit' value='Add Screens' />
			</div>
			<div class='container'>
				<label for='screenname' >Sreen Name*: </label><br>
				<input type='text' name='screenname' id='screenname' maxlength="50" />
				<span id='register_screenname' class='error' style='clear:both'></span>
			</div>
			<div class='container'>
				<label for='theatreid' >Theatre*: </label><br>
			<select id="theatreid" name="theatreid">
			<?php
			
			include ('includes/dbconn.php');
			$conn = oci_connect($dbUserName, $dbPassword, $db);
			$cdquery=oci_parse($conn,"select THEATREID,THEATRENAME||','||LOCATION AS THEATRENAME from THEATRES")or die ('None'); ;
			$cdresult=oci_execute($cdquery); //or die ("Query to get data from firsttable failed: ".mysql_error());
			while ($cdrow=oci_fetch_array($cdquery, OCI_ASSOC+OCI_RETURN_NULLS)) {
				echo '<option value="'.$cdrow['THEATREID'].'">'.$cdrow['THEATRENAME'].'</option>';
			
			}
			?>
			</select>
			</div>
			<div class='container'>
				<label for='seatcount' >Seat Count*: </label><br>
				<input type='text' name='seatcount' id='seatcount' maxlength="50" />
				<span id='register_seatcount' class='error' style='clear:both'></span>
			</div>
		</fieldset>
	</center>
	</form>
<?php
	include('footer.php');
	oci_close($conn);
?>