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
<?php
	include('footer.php');
	oci_close($conn);
?>