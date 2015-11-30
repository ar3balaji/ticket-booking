<?php
	include('header.php');
?>
<div class="left" align="right">
        <a href="addStars.php">back</a>
    </div>
<center>

<?php 
if ($_SERVER['REQUEST_METHOD']== "POST") {
	include ('includes/dbconn.php');
	$conn = oci_connect($dbUserName, $dbPassword, $db);
	$actor   = $_POST['actor'];
	$movie   = $_POST['movie'];
	$role   = $_POST['role'];
	
	$cdquery2=oci_parse($conn,"select *  from STARTSIN WHERE ACTORID='".$actor."' AND MOVIEID='".$movie."'");
	oci_execute($cdquery2);
	oci_fetch_all($cdquery2, $array2);
	$numberofrows2 = oci_num_rows($cdquery2);
	
	if($numberofrows2>0)
	{
		echo "<span style='color:red'>The actor already linked to movie with role:</span>".$array2["ROLE"][0];
	}
	
	else 
	{
	$cdquery=oci_parse($conn,"INSERT INTO STARTSIN(ACTORID,MOVIEID,ROLE) VALUES ('".$actor."','".$movie."','".$role."')");
	$insert_actor = oci_execute($cdquery);
	
	if($insert_actor)
	{
		oci_commit($conn);
		echo "<span style='color:green'>Linked</span>";
	}
	}
	oci_close($conn);
}
?>

<script>
	function validateForm() {
		var actor = document.forms["register"]["actor"].value;
		var movie = document.forms["register"]["movie"].value;
		var role = document.forms["register"]["role"].value;
		
		var result = true;
		$(register_fname).text("");
		$(register_mname).text("");
		$(register_role).text("");

		
		if (actor == null ||actor == ""||actor=="NONE") {
			$(register_fname).text("Select the actor");			
			result = false;				
		}
		if (movie == null ||movie == ""||movie=="NONE") {
			$(register_mname).text("Select the movie");			
			result = false;				
		}
		if (role == null || role == "") {
			$(register_role).text("Enter the role");			
			result = false;				
		}	
		return result;
	}
	
	</script>

<form name="register" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" onsubmit="return validateForm()" method="POST">		
		<fieldset >
		
			<legend align="top">Link Actor to Movie</legend>
			<div class='short_explanation'>* required fields.</div>
			
			<div class='container'>
				<label for='actor' >Actor:*: </label><br>
				<select id="actor" name="actor">
			<?php
			
			include ('includes/dbconn.php');
			$conn = oci_connect($dbUserName, $dbPassword, $db);
			$cdquery=oci_parse($conn,"select ACTORID,FIRSTNAME||','||LASTNAME AS FNAME from ACTOR")or die ('None'); ;
			$cdresult=oci_execute($cdquery); //or die ("Query to get data from firsttable failed: ".mysql_error());
			echo '<option value="'."NONE".'">'."NONE".'</option>';
			while ($cdrow=oci_fetch_array($cdquery, OCI_ASSOC+OCI_RETURN_NULLS)) {
				echo '<option value="'.$cdrow['ACTORID'].'">'.$cdrow['FNAME'].'</option>';
			
			}
			?>
			</select>
				<span id='register_fname' class='error'></span>
			</div>
			        
			<div class='container'>
				<label for='movie' >Movie:*: </label><br>
				<select id="movie" name="movie">
			<?php
			
			include ('includes/dbconn.php');
			$conn = oci_connect($dbUserName, $dbPassword, $db);
			$cdquery=oci_parse($conn,"select MOVIEID,MOVIENAME||','||MOVIERELEASEYEAR AS MNAME from MOVIES")or die ('None'); ;
			$cdresult=oci_execute($cdquery); //or die ("Query to get data from firsttable failed: ".mysql_error());
			echo '<option value="'."NONE".'">'."NONE".'</option>';
			while ($cdrow=oci_fetch_array($cdquery, OCI_ASSOC+OCI_RETURN_NULLS)) {
				echo '<option value="'.$cdrow['MOVIEID'].'">'.$cdrow['MNAME'].'</option>';
			
			}
			?>
			</select>
				<span id='register_mname' class='error'></span>
			</div>
						
			<div class='container'>
				<label for='role' >Role*: </label><br>
				<input type='text' name='role' id='role' maxlength="50" />
				<span id='register_role' class='error'></span>
			</div>
			<div class='container'>
				<input type='submit' name='Submit' value='Link' />
			</div>
		</fieldset>
	</form>
	</center>	
<?php
	include('footer.php');
?>