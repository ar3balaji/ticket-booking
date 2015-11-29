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

		var moviename = document.forms["register"]["moviename"].value;
		var movielength = document.forms["register"]["movielength"].value;
		var producer = document.forms["register"]["producer"].value;
		var moviereleaseyear = document.forms["register"]["moviereleaseyear"].value;
		var boxofficecollection = document.forms["register"]["boxofficecollection"].value;
		var genre = document.forms["register"]["genre"].value;
		var director = document.forms["register"]["director"].value;
		var language = document.forms["register"]["language"].value;
		var studio = document.forms["register"]["studio"].value;
		var description = document.forms["register"]["description"].value;
		var rating = document.forms["register"]["rating"].value;
		


		
		var result = true;
		$(register_moviename).text("");
		$(register_movielength).text("");
		$(register_producer).text("");
		$(register_moviereleaseyear).text("");
		$(register_boxofficecollection).text("");
		$(register_genre).text("");
		$(register_director).text("");
		$(register_language).text("");
		$(register_studio).text("");
		$(register_description).text("");
		$(register_rating).text("");

		if (rating == null || rating == "") {
			$(register_rating).text("Enter rating");			
			result = false;				
		}
		if(rating != null && rating != "")
		{
			if(rating.match(/^[0-9]+$/) === null)
			{
			$(register_rating).text("Enter Numbers only");			
			result = false;
			}
		}
		if (description == null || description == "") {
			$(register_description).text("Enter description");			
			result = false;				
		}
		if (studio == null || studio == "") {
			$(register_studio).text("Enter studio name");			
			result = false;				
		}
		if (language == null || language == "") {
			$(register_language).text("Enter language");			
			result = false;				
		}
		if (director == null || director == "") {
			$(register_director).text("Enter the director");			
			result = false;				
		}
		if (genre == null || genre == "") {
			$(register_genre).text("Enter genre");			
			result = false;				
		}
		if (boxofficecollection == null || boxofficecollection == "") {
			$(register_boxofficecollection).text("Enter box office collection");			
			result = false;				
		}
		if (producer == null || producer == "") {
			$(register_producer).text("Enter the producer");			
			result = false;				
		}
		if (moviename == null || moviename == "") {
			$(register_moviename).text("Enter the movie name");			
			result = false;				
		}
		if (moviereleaseyear == null || moviereleaseyear == "") {
			$(register_moviereleaseyear).text("Enter the year");			
			result = false;				
		}

		if(moviereleaseyear != null && moviereleaseyear != "")
		{
			if(moviereleaseyear.match(/^[0-9]+$/) === null)
			{
			$(register_moviereleaseyear).text("Enter Numbers only");			
			result = false;
			}
		}
		if (movielength == null || movielength == "") {
			$(register_movielength).text("Enter movie length");			
			result = false;				
		}

		if(movielength != null && movielength != "")
		{
			if(movielength.match(/^[0-9]+$/) === null)
			{
			$(register_movielength).text("Enter Numbers only");			
			result = false;
			}
		}
		
		return result;
	}
	</script>
<center>
<form name="register" action="addmovies.php" onsubmit="return validateForm()" method="POST">		
		<fieldset >
			<legend>ADD MOVIES</legend>		

			<div class='container'>
				<input type='submit' name='Submit' value='Add Movie' />
			</div>
			<div class='container'>
				<label for='moviename' >Movie Name*: </label><br>
				<input type='text' name='moviename' id='moviename' maxlength="50" />
				<span id='register_moviename' class='error' style='clear:both'></span>
			</div>

			<div class='container'>
				<label for='movielength' >Movie Length*:</label><br>
				<input type='text' name='movielength' id='movielength' maxlength="50" />
				<span id='register_movielength' class='error' style='clear:both'></span>
			</div>
			
			<div class='container' style='height:60px;'>
				<label for='producer' >Producer*:</label><br>		
				<input type='text' name='producer' id='producer' maxlength="50" />				
				<span id='register_producer' class='error' style='clear:both'></span>
			</div>	
			
			<div class='container' style='height:60px;'>
				<label for='moviereleaseyear' >Movie Release Year*:</label><br>		
				<input type='text' name='moviereleaseyear' id='moviereleaseyear' maxlength="4" />				
				<span id='register_moviereleaseyear' class='error' style='clear:both'></span>
			</div>	
			
			<div class='container' style='height:60px;'>
				<label for='boxofficecollection' >Box Office Collection*:</label><br>		
				<input type='text' name='boxofficecollection' id='boxofficecollection' maxlength="10" />				
				<span id='register_boxofficecollection' class='error' style='clear:both'></span>
			</div>
			<div class='container' style='height:60px;'>
				<label for='genre' >Genre*:</label><br>		
				<input type='text' name='genre' id='genre' maxlength="10" />				
				<span id='register_genre' class='error' style='clear:both'></span>
			</div>
			<div class='container' style='height:60px;'>
				<label for='director' >Director*:</label><br>		
				<input type='text' name='director' id='director' maxlength="10" />				
				<span id='register_director' class='error' style='clear:both'></span>
			</div>
			<div class='container' style='height:60px;'>
				<label for='language' >language*:</label><br>		
				<input type='text' name='language' id='language' maxlength="10" />				
				<span id='register_language' class='error' style='clear:both'></span>
			</div>
			<div class='container' style='height:60px;'>
				<label for='studio' >Studio*:</label><br>		
				<input type='text' name='studio' id='studio' maxlength="10" />				
				<span id='register_studio' class='error' style='clear:both'></span>
			</div>
			<div class='container' style='height:60px;'>
				<label for='description' >Description*:</label><br>		
				<input type='text' name='description' id='description'  />				
				<span id='register_description' class='error' style='clear:both'></span>
			</div>
			<div class='container' style='height:60px;'>
				<label for='rating' >Rating*:</label><br>		
				<input type='text' name='rating' id='rating' maxlength="10" />				
				<span id='register_rating' class='error' style='clear:both'></span>
			</div>			
		</fieldset>
	</form>
</center>
<?php
	include('footer.php');
	oci_close($conn);
?>
