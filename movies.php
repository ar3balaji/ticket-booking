<?php		
	include('header.php');
	include ('includes/dbconn.php');	
	$conn = oci_connect($dbUserName, $dbPassword, $db);
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
?>

<form name="movies" action="addmovies.php"  method="POST">		
		<fieldset >
			<legend>ADD MOVIES</legend>		

			<div class='container'>
				<input type='submit' name='Submit' value='Register' />
			</div>
			<div class='container'>
				<label for='moviename' >Movie Name*: </label><br>
				<input type='text' name='moviename' id='moviename' maxlength="50" />
				
			</div>

			<div class='container'>
				<label for='movielength' >Movie Length*:</label><br>
				<input type='text' name='movielength' id='movielength' maxlength="50" />
			</div>
			
			<div class='container' style='height:60px;'>
				<label for='producer' >Producer*:</label><br>		
				<input type='text' name='producer' id='producer' maxlength="50" />				
				<span id='register_password' class='error' style='clear:both'></span>
			</div>	
			
			<div class='container' style='height:60px;'>
				<label for='moviereleaseyear' >Movie Release Year*:</label><br>		
				<input type='text' name='moviereleaseyear' id='moviereleaseyear' maxlength="100" />				
				<span id='register_address' class='error' style='clear:both'></span>
			</div>	
			
			<div class='container' style='height:60px;'>
				<label for='boxofficecollection' >Box Office Collection*:</label><br>		
				<input type='text' name='boxofficecollection' id='boxofficecollection' maxlength="10" />				
				<span id='register_phoneno' class='error' style='clear:both'></span>
			</div>
			<div class='container' style='height:60px;'>
				<label for='genre' >Genre*:</label><br>		
				<input type='text' name='genre' id='genre' maxlength="10" />				
				<span id='register_phoneno' class='error' style='clear:both'></span>
			</div>
			<div class='container' style='height:60px;'>
				<label for='director' >Director*:</label><br>		
				<input type='text' name='director' id='director' maxlength="10" />				
				<span id='register_phoneno' class='error' style='clear:both'></span>
			</div>
			<div class='container' style='height:60px;'>
				<label for='language' >language*:</label><br>		
				<input type='text' name='language' id='language' maxlength="10" />				
				<span id='register_phoneno' class='error' style='clear:both'></span>
			</div>
			<div class='container' style='height:60px;'>
				<label for='studio' >Studio*:</label><br>		
				<input type='text' name='studio' id='studio' maxlength="10" />				
				<span id='register_phoneno' class='error' style='clear:both'></span>
			</div>
			<div class='container' style='height:60px;'>
				<label for='description' >Description*:</label><br>		
				<input type='text' name='description' id='description' maxlength="10" />				
				<span id='register_phoneno' class='error' style='clear:both'></span>
			</div>
			<div class='container' style='height:60px;'>
				<label for='rating' >Rating*:</label><br>		
				<input type='text' name='rating' id='rating' maxlength="10" />				
				<span id='register_phoneno' class='error' style='clear:both'></span>
			</div>
			
			
			
		</fieldset>
	</form>

<?php
	include('footer.php');
	oci_close($conn);
?>