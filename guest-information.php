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
		var email = document.forms["admin-form"]["emailid"].value;
		var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
		var result = true;		
		$('#user_email').text("");
		if (email == null || email == "") {
			$('#user_email').text("Enter your email Id");			
			result = false;				
		}
		if(!re.test(email)) {
				$('#user_email').text("Enter Correct Email Id");			
				result = false;
		}
		return result;
	}
</script>

<div class="movie">
	<form action="get-guest-user-info.php" name="admin-form" onsubmit="return validateValues();" method='post'>		
		Email Your Email Address:&nbsp;<input type='text' name='emailid' id='emailid'/><span id='user_email' class='error'></span><br>
		<input type='submit' name='Submit' value='Get My Information' />
	</form>
</div>

<?php
	include('footer.php');
	oci_close($conn);	
?>