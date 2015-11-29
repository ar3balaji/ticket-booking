<?php
	include('header.php');
	include ('includes/dbconn.php');	
	$conn = oci_connect($dbUserName, $dbPassword, $db);
	if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
?>
<script type="text/javascript">
	function validateValues() {	
		var phoneno = document.forms["admin-form"]["edit_phoneno"].value;		
		var result = true;		
		$('#register_phoneno').text("");
		if (phoneno == null || phoneno == "") {
			$('#register_phoneno').text("Enter your Phone Number");			
			result = false;
		}			
		if(phoneno.match(/^[0-9]+$/) === null) {
			$('#register_phoneno').text("Enter Numbers only");			
			result = false;
		}			
		if(phoneno.length <10) {
			$('#register_phoneno').text("You are missing few numbers");			
			result = false;
		}			
		return result;
	}
</script>
<div class="movie">
	<form action="validate-phoneno.php" name="admin-form" onsubmit="return validateValues();" method='post'>		
		Enter new phoneno:&nbsp;<input type='text' name='phoneno' id='edit_phoneno' maxlength="10" />				
				<span id='register_phoneno' class='error' style='clear:both'></span><br>
		<input type='submit' name='Submit' value='Go' />
	</form>
</div>
<?php
	include('footer.php');
	oci_close($conn);
?>