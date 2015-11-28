<?php
	include('header.php');
?>
<div class="left" align="right">
        <a href="actorToMovie.php">Link actor to Movies</a>
    </div>
<center>
<?php 
if ($_SERVER['REQUEST_METHOD']== "POST") {
	include ('includes/dbconn.php');
	$conn = oci_connect($dbUserName, $dbPassword, $db);
	$fname   = $_POST['fname'];
	$lname   = $_POST['lname'];
	$sex   = $_POST['sex'];
	$sdtm   = $_POST['sdtm'];
	$add  = $_POST['add'];
	
	$cdquery=oci_parse($conn,"INSERT INTO ACTOR(FIRSTNAME,LASTNAME,DATEOFBIRTH,GENDER,ADDRESS) VALUES ('".$fname."','".$lname."',TO_DATE('".$sdtm."','DD-MON-YYYY'),'".$sex."','".$add."')");
	$insert_actor = oci_execute($cdquery);
	
	if($insert_actor)
	{
		oci_commit($conn);
		echo "Inserted";
	}
	oci_close($conn);
}
?>

<script>
	function validateForm() {
		var fname = document.forms["register"]["fname"].value;
		var lname = document.forms["register"]["lname"].value;
		var sdtm = document.forms["register"]["sdtm"].value;
		var sex = document.forms["register"]["sex"].value;
		var add = document.forms["register"]["add"].value;
		var result = true;
		$(register_fname).text("");
		$(register_lname).text("");
		$(register_sex).text("");
		$(register_sdtm).text("");
		$(register_add).text("");

		
		if (fname == null || fname == "") {
			$(register_fname).text("Enter the first name");			
			result = false;				
		}
		if (lname == null || lname == "") {
			$(register_lname).text("Enter the last name");			
			result = false;				
		}
		if (sex == null || sex == "") {
			$(register_sex).text("Enter the gender");			
			result = false;				
		}

		if (add == null || add == "") {
			$(register_add).text("Enter the address");			
			result = false;				
		}
		
		if (sdtm == null || sdtm == "") {
			$(register_sdtm).text("Enter the date of birth");			
			result = false;				
		}

		if(sdtm != null && sdtm != "") {
		if (sdtm.match(/(\d{2})-([a-zA-Z]{3})-(\d{4})$/)===null)
		{
			$(register_sdtm).text("Enter in proper format(eg:- 12-Jan-2015)");			
			result = false;	
		}
		}		
		return result;
	}
	
	</script>
<form name="register" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" onsubmit="return validateForm()" method="POST">		
		<fieldset >
		
			<legend align="top">Add Actor</legend>
			<div class='short_explanation'>* required fields.</div>
			
			<div class='container'>
				<label for='fname' >First Name:*: </label><br>
				<input type='text' name='fname' id='fname' maxlength="50" />
				<span id='register_fname' class='error'></span>
			</div>
			        
			<div class='container'>
				<label for='lname' >Last Name:*: </label><br>
				<input type='text' name='lname' id='lname' maxlength="50" />
				<span id='register_lname' class='error'></span>
			</div>
			
			<div class='container'>
				<label for='sex' >Gender:*: </label><br>
				<select id=sex name=sex>
				<option value=Male>Male</option>
				<option value=Female>Female</option>
				</select>
				<span id='register_sex' class='error'></span>
			</div>
	
			 <div class='container'>
				<label for='sdtm' >DOB(DD-Mon-YYYY)*: </label><br>
				<input type='text' name='sdtm' id='sdtm' maxlength="50" />
				<span id='register_sdtm' class='error'></span>
			</div>
			
			<div class='container'>
				<label for='add' >Address*: </label><br>
				<input type='text' name='add' id='add' maxlength="50" />
				<span id='register_add' class='error'></span>
			</div>
			<div class='container'>
				<input type='submit' name='Submit' value='Register' />
			</div>
		</fieldset>
	</form>
	</center>	
<?php
	include('footer.php');
?>