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
		var email = document.forms["admin-form"]["admin-emailid"].value;
		var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
		var result = true;		
		$('#register_email').text("");
		if (email == null || email == "") {
			$('#register_email').text("Enter users Email Id");			
			result = false;				
		}
		if(!re.test(email)) {
			$('#register_email').text("Enter users Email Id");			
			result = false;
		}
		return result;
	}
</script>
<div class="movie">
	<form action="validate-admin.php" name="admin-form" onsubmit="return validateValues();" method='post'>
		<span class="title">Choose the desired Option</span><br>
		<input type="radio" name="admin-type" value="creation" checked="checked">Make Admin<br>
		<input type="radio" name="admin-type" value="removal">Drop as Admin<br>
		Email Address of the User:&nbsp;<input type='text' name='emailid' id='admin-emailid'/><span id='register_email' class='error'></span><br>
		<input type='submit' name='Submit' value='Go' />
	</form>
</div>
<?php
	include('footer.php');
	oci_close($conn);
?>