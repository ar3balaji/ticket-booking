<?php		
	include('header.php');
	include ('includes/dbconn.php');	
	$conn = oci_connect($dbUserName, $dbPassword, $db);
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
?>
<a href="/ticket-booking/viewpost.php">View Post</a>
<script>
		function validateForm() {
			var movie = document.forms["register"]["movie"].value;
			var theatre = document.forms["register"]["theatre"].value;
			var result = true;
			$(register_movie).text("");			
			$(register_theatre).text("");			
					
			
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
		<form name="register" action="/ticket-booking/post.php" onsubmit="return validateForm()" method="post">
			<label for="movie">Select Movie : </label> 
			<select name="movie" id="movie">
				<?php 				  
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
				?>
			</select>
			<span id='register_movie' class='error'></span>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<label for="theatre">Select Theatre : </label> 
			<select name="theatre" id="theatre">
				<?php 				  
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
					
				?>	
	</select>
		<span id='register_theatre' class='error'></span>			
			<center><input type="submit" name="submit" value="Post" class="button" /></center>						
		</form>
		
	</div>					

<?php
	include('footer.php');
	oci_close($conn);
?>