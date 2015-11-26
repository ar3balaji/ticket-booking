<?php		
	include('header.php');
	include ('includes/dbconn.php');	
	$conn = oci_connect($dbUserName, $dbPassword, $db);
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
	
?>


<form name="register" action="createPost.php"   method="POST">		
		<fieldset >
			<legend>CreatePost</legend>	
<input type="hidden" name="movie" value="<?=htmlspecialchars($_POST['movie']);?>"/>			
<input type="hidden" name="theatre" value="<?=htmlspecialchars($_POST['theatre']);?>"/>		

			<div class='container'>
				<label for='content' >Content*: </label><br>
				<input type='text' name='content' id='content' maxlength="255" />
				
			</div>
			<div class='container'>
				<input type='submit' name='submit' value='register' />
			</div>
			
		</fieldset>
	</form>


<?php
	include('footer.php');
	oci_close($conn);
?>