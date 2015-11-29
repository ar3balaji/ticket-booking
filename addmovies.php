<?php
	include('header.php');
	include ('includes/dbconn.php');	
	$conn = oci_connect($dbUserName, $dbPassword, $db);
	if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
?>
<?php	
	include ('includes/dbconn.php');	
	$conn = oci_connect($dbUserName, $dbPassword, $db);	
	
	$moviename   = $_POST['moviename'];
	$movielength = $_POST['movielength'];
	$producer = $_POST['producer'];
	$moviereleaseyear = $_POST['moviereleaseyear'];
	$boxofficecollection = $_POST['boxofficecollection'];
	$genre = $_POST['genre'];
	$director = $_POST['director'];
	$language = $_POST['language'];	
	$studio = $_POST['studio'];	
	$description = $_POST['description'];	
	$rating = $_POST['rating'];	
	$insert_movies = oci_execute(oci_parse($conn, "insert into movies (movieid,moviename,movielength,producer,moviereleaseyear,boxofficecollection,genre,director,language,studio,description,rating) values(movie_id_seq.nextval,'".$moviename."','".$movielength."','".$producer."','".$moviereleaseyear."','".$boxofficecollection."','".$genre."','".$director."','".$language."','".$studio."','".$description."','".$rating."')"),OCI_DEFAULT);
	
	if($insert_movies) {
		oci_commit($conn);
		echo "<span style='color:green'>Movie added successfully";
	}	
	else {		
		echo "<span style='color:red'>Failed to add movie";
		oci_rollback($conn);
	}
	
	
?>
<?php
	include('footer.php');
	oci_close($conn);
?>