<?php		
	include('header.php');
	include ('includes/dbconn.php');	
	$conn = oci_connect($dbUserName, $dbPassword, $db);
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
?>
<a href="/ticket-booking/viewpost.php">View All Discussion Threads</a><br>
<a href="/ticket-booking/all-discussions-3-comments.php">All Discussions with latest 3 comments</a><br>
<a href="/ticket-booking/least-pop-thread-visits.php">Least Popular Threads based on Visits</a><br>
<a href="/ticket-booking/least-pop-thread-comments.php">Least Popular Threads based on Comments</a><br>
<script>
		function validateForm() {
			var movie = document.forms["register"]["movie"].value;
			var theatre = document.forms["register"]["theatre"].value;
			var content = document.forms["register"]["content"].value;
			var result = true;
			$(register_movie).text("");			
			$(register_theatre).text("");			
			$('#error-content').text("");								
			if (content == null || content == "") {
				$('#error-content').text("Enter the content");			
				result = false;				
			}
			if ((movie !="NONE")&&(theatre !="NONE")) {
				$(register_movie).text("Select atmost one value (movie or theatre)");			
				result = false;
			}		
			if (movie == "NONE" && theatre == "NONE") {
				$(register_movie).text("Select either movie or theatre");			
				result = false;				
			}			
			return result;
		}
	</script>
<div class="theatres-selection">
	<form name="register" action="/ticket-booking/createPost.php" onsubmit="return validateForm()" method="post">	
	<?php if (isset($_SESSION['username'])){
		echo "<h1>Select either Movie or a Theatre to start the Discussion Thread</h1>";
		echo "<label for='movie'>Select Movie : </label>"; 
		echo "<select name='movie' id='movie'>";
		$movieQuery = 'select MOVIENAME from movies';
		$stid = oci_parse($conn, $movieQuery);
		$success = oci_execute($stid);
		if($success){
			echo "<option value=\"NONE\">NONE</option>";
			while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS + OCI_ASSOC))
			{
				echo "<option value=\"".$row['MOVIENAME']."\">" . $row['MOVIENAME'] . "</option>";
			}
		} else {
				echo "<option value=\"NONE\">NONE</option>";
		}		
		echo "</select>";
		echo "<span id='register_movie' class='error'></span>";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<label for='theatre'>Select Theatre : </label>"; 
		echo "<select name='theatre' id='theatre'>";				  
		$theatreQuery = 'select THEATRENAME from THEATRES';
		$tid = oci_parse($conn, $theatreQuery);
		$success = oci_execute($tid);
		if($success){
			echo "<option value=\"NONE\">NONE</option>";
			while ($row = oci_fetch_array($tid, OCI_RETURN_NULLS + OCI_ASSOC))
			{
				echo "<option value=\"".$row['THEATRENAME']."\">" . $row['THEATRENAME'] . "</option>";
			}
		} else {
			echo "<option value=\"NONE\">NONE</option>";
		}		
		echo "</select>";
		echo "<span id='register_theatre' class='error'></span>";
		echo "<br>";
		echo "<br>";
		echo "<label for='content' >Discussion Thread Content: </label><br>";		
		echo "<input type='text' name='content' id='content' style='width:80%;height:10%;' maxlength='255' />";
		echo "<span id='error-content' class='error'></span>";
		echo "<center><input type='submit' name='submit' value='Create Thread' class='button' /></center>";
	 }
	?>
	</form>
		
</div>					

<?php
	include('footer.php');
	oci_close($conn);
?>