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
	function validateSelection() {	
		var query = document.forms["admin-form"]["query"].value;		
		var result = true;		
		$('#query').text("");
		if (query == null || query == "") {
			$('#query_error').text("Enter the query Statement");			
			result = false;				
		}
		return result;
	}
</script>
<div class="movie">
	<form action="query-output.php" name="admin-form" onsubmit="return validateSelection();" method='post'>
		<span class="title">Choose the desired Option</span><br>
		<input type="radio" name="query-type" value="select" checked="checked">&nbsp;SELECT<br>
		<input type="radio" name="query-type" value="insert">&nbsp;INSERT<br>
		<input type="radio" name="query-type" value="update">&nbsp;UPDATE<br>
		<input type="radio" name="query-type" value="delete">&nbsp;DELETE<br>
		Query Statement:&nbsp;<input type='text' style="width:80%;height:10%;" name='query' id='query'/><br><br><span id='query_error' class='error'></span><br>
		<input type='submit' name='Submit' value='Get Results!!' />
	</form>
</div>
<?php
	include('footer.php');
	oci_close($conn);
?>