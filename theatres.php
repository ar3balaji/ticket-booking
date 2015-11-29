<?php
	include('header.php');
?>
<script>
	function validateForm() {
		var theatrename = document.forms["register"]["theatrename"].value;
		var location = document.forms["register"]["location"].value;
		var contactperson = document.forms["register"]["contactperson"].value;
		var contactphoneno = document.forms["register"]["contactphoneno"].value;
		var zip = document.forms["register"]["zip"].value;
		var country = document.forms["register"]["country"].value;
		var city = document.forms["register"]["city"].value;
		var state = document.forms["register"]["state"].value;
	
		var result = true;
		$(register_theatrename).text("");
		$(register_location).text("");
		$(register_contactperson).text("");
		$(register_contactphoneno).text("");
		$(register_zip).text("");
		$(register_country).text("");
		$(register_city).text("");
		$(register_state).text("");


		if (country == null || country == "") {
			$(register_country).text("Enter the country");			
			result = false;				
		}
		
		if (city == null || city == "") {
			$(register_city).text("Enter the city");			
			result = false;				
		}
		if (state == null || state == "") {
			$(register_state).text("Enter the state");			
			result = false;				
		}
		if (contactphoneno == null || contactphoneno == "") {
			$(register_contactphoneno).text("Enter the contact phone number");			
			result = false;				
		}
		
		if (zip == null || zip == "") {
			$(register_zip).text("Enter the zip");			
			result = false;				
		}
		
		if (theatrename == null || theatrename == "") {
			$(register_theatrename).text("Enter the theatre name");			
			result = false;				
		}
		
		if (location == null || location == "") {
			$(register_location).text("Enter the location");			
			result = false;				
		}
		if (contactperson == null || contactperson == "") {
			$(register_contactperson).text("Enter the contact person");			
			result = false;				
		}
		//^[0-9]+$/
		if(contactphoneno != null && contactphoneno != "")
		{
			if(contactphoneno.match(/^[0-9]+$/) === null)
			{
			$(register_contactphoneno).text("Enter Numbers only");			
			result = false;
			}
		}
		if(contactphoneno.length <10) {
			$(register_contactphoneno).text("You are missing few numbers");			
			result = false;
		}
		if(zip != null && zip != "")
		{
			if(zip.match(/^[0-9]+$/) === null)
			{
			$(register_zip).text("Enter Numbers only");			
			result = false;
			}
		}
		
		return result;
	}
	</script>
<form name="register" action="addtheatres.php" onsubmit="return validateForm()" method="POST">	
<center>	
		<fieldset >
			<legend>ADD THEATRES</legend>		

			<div class='container'>
				<input type='submit' name='Submit' value='Add Theatre' />
			</div>
			<div class='container'>
				<label for='theatrename' >Theatre Name*: </label><br>
				<input type='text' name='theatrename' id='theatrename' maxlength="50" />
				<span id='register_theatrename' class='error' style='clear:both'></span>
				
			</div>

			<div class='container'>
				<label for='location' >Location*:</label><br>
				<input type='text' name='location' id='location' maxlength="50" />
				<span id='register_location' class='error' style='clear:both'></span>
			</div>
			
			<div class='container' style='height:60px;'>
				<label for='contactperson' >contactperson*:</label><br>		
				<input type='text' name='contactperson' id='contactperson' maxlength="50" />				
				<span id='register_contactperson' class='error' style='clear:both'></span>
			</div>	
			
			<div class='container' style='height:60px;'>
				<label for='contactphoneno' >contactphoneno*:</label><br>		
				<input type='text' name='contactphoneno' id='contactphoneno' maxlength="10" />				
				<span id='register_contactphoneno' class='error' style='clear:both'></span>
			</div>	
			
			<div class='container' style='height:60px;'>
				<label for='zip' >zip*:</label><br>		
				<input type='text' name='zip' id='zip' maxlength="6" />				
				<span id='register_zip' class='error' style='clear:both'></span>
			</div>
			<div class='container' style='height:60px;'>
				<label for='country' >country*:</label><br>		
				<input type='text' name='country' id='country' maxlength="20" />				
				<span id='register_country' class='error' style='clear:both'></span>
			</div>
			<div class='container' style='height:60px;'>
				<label for='city' >city*:</label><br>		
				<input type='text' name='city' id='city' maxlength="20" />				
				<span id='register_city' class='error' style='clear:both'></span>
			</div>
			<div class='container' style='height:60px;'>
				<label for='state' >state*:</label><br>		
				<input type='text' name='state' id='state' maxlength="2" />				
				<span id='register_state' class='error' style='clear:both'></span>
			</div>
			</fieldset>
		</center>
	</form>


<?php
	include('footer.php');
?>