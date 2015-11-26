<<<<<<< HEAD
<?php		
=======
<?php
>>>>>>> origin/master
	include('header.php');
	include ('includes/dbconn.php');	
	$conn = oci_connect($dbUserName, $dbPassword, $db);
	if (!$conn) {
<<<<<<< HEAD
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

=======
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
?>
<script type="text/javascript">	
	$(document).ready(function(){		
		$("div.more-details-div").hide();
		$("div.more-details-div").addClass("hidden");
		$(".more-details").click(function(){
			var parentdiv=$(this).parent();
			$(parentdiv).find("div.more-details-div").each(function (i, el) {
				if($(this).hasClass("hidden")) {
					$(this).removeClass("hidden");					
					$(this).show();
				} else {					
					$(this).addClass("hidden");
					$(this).hide();
				}
			});
		});
	});
</script>

<h1>Movies...</h1>
<div id= "movieList">
<?php
	function searchForMovieId($id, $array) {
	   foreach ($array as $key => $val) {
		   if ($val['MOVIEID'] === $id) {			   
			   return $key;
		   }
	   }
	   return null;
	}
		
	$theatreSearchContent ="";
	function getMovies($searchText,$conn) {
		$searchQuery = "select * from movies order by MOVIERELEASEYEAR desc";
		if(!is_null($searchText)) {
			$searchQuery ="";
		}	
						
		$movies = oci_parse($conn, $searchQuery);
		oci_execute($movies);
		while (($row = oci_fetch_array($movies, OCI_BOTH)) != false) {												
			echo "<br>";
			echo "<div class='movie'>";			
			echo "<span class='title'>Movie: </span><span class='titleValue'>".$row['MOVIENAME']."</span><span class='more-details'>&nbsp;&nbsp;&nbsp;<img src='includes/more.png'/ title='More Details'></span>";
			echo "<br>";
			echo "<span class='title'>Movie Length: </span><span class='titleValue'>".$row['MOVIELENGTH']."</span><span class='rating'>&nbsp;&nbsp;&nbsp;<img src='includes/likes.png'/ title='Users Rating'>".number_format( ($row['RATING'] / 10) * 100, 0)."%</span>";
			echo "<br>";
			echo "<span class='title'>Movie Release Year: </span><span class='titleValue'>".$row['MOVIERELEASEYEAR']."</span>";
			echo "<div class='more-details-div'>";			
			echo "<span class='title'>Producer: </span> <span class='titleValue'>".$row['PRODUCER']."</span>&nbsp;&nbsp;";
			echo "<span class='title'>Genre: </span> <span class='titleValue'>".$row['GENRE']."</span>";
			echo "<br>";
			echo "<span class='title'>Director: </span> <span class='titleValue'>".$row['DIRECTOR']."</span>&nbsp;&nbsp;";
			echo "<span class='title'>Language: </span> <span class='titleValue'>".$row['LANGUAGE']."</span>";			
			echo "<br>";
			echo "<span class='title'>Movie Studio: </span> <span class='titleValue'>".$row['STUDIO']."</span>&nbsp;&nbsp;";
			echo "<span class='title'>Description: </span> <span class='titleValue'>".$row['DESCRIPTION']."</span>";			
			echo "</div>";
			echo "</div>";
		}
	}
	getMovies(null, $conn);	
?>
</div>
>>>>>>> origin/master
<?php
	include('footer.php');
	oci_close($conn);
?>