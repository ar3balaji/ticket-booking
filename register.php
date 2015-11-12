<?php
	include('header.php');
?>
<center>
	<script>
		function validateForm() {
			var name = document.forms["register"]["name"].value;
			var email = document.forms["register"]["email"].value;
			var password = document.forms["register"]["password"].value;
			var address = document.forms["register"]["address"].value;
			var phoneno = document.forms["register"]["phoneno"].value;
			var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
			result = true;
			$(register_name).text("");			
			$(register_email).text("");			
			$(register_password).text("");			
			$(register_address).text("");			
			$(register_phoneno).text("");			
			if (name == null || name == "") {
				$(register_name).text("Enter your full name");			
				result = false;
			}
			if (email == null || email == "") {
				$(register_email).text("Enter your Email Id");			
				result = false;
			}
			if (password == null || password == "") {
				$(register_password).text("Enter your Password");			
				result = false;
			}
			if (address == null || address == "") {
				$(register_address).text("Enter your Address");			
				result = false;
			}
			if (phoneno == null || phoneno == "") {
				$(register_phoneno).text("Enter your Phone Number");			
				result = false;
			}
			if(!re.test(email)) {
				$(register_email).text("Enter Correct Email Id");			
				result = false;
			}
			if(phoneno.match(/^[0-9]+$/) === null) {
				$(register_phoneno).text("Enter Numbers only");			
				result = false;
			}
			return result;
		}
	</script>
	<form name="register" action="addnewuser.php" onsubmit="return validateForm()" method="POST">		
		<fieldset >
			<legend>Register</legend>		

			<div class='short_explanation'>* required fields. Email Id will be your username</div>
			
			<div class='container'>
				<label for='name' >Your Full Name*: </label><br>
				<input type='text' name='name' id='name' maxlength="50" />
				<span id='register_name' class='error'></span>
			</div>

			<div class='container'>
				<label for='email' >Email Address*:</label><br>
				<input type='text' name='email' id='email' maxlength="50" />
				<span id='register_email' class='error'></span>
			</div>
			
			<div class='container' style='height:80px;'>
				<label for='password' >Password*:</label><br>		
				<input type='password' name='password' id='password' maxlength="50" />				
				<span id='register_password' class='error' style='clear:both'></span>
			</div>	
			
			<div class='container' style='height:80px;'>
				<label for='address' >Address*:</label><br>		
				<input type='text' name='address' id='address' maxlength="100" />				
				<span id='register_address' class='error' style='clear:both'></span>
			</div>	
			
			<div class='container' style='height:80px;'>
				<label for='phoneno' >Phone Number*:</label><br>		
				<input type='text' name='phoneno' id='phoneno' maxlength="50" />				
				<span id='register_phoneno' class='error' style='clear:both'></span>
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