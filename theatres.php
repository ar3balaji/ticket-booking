<?php
	include('header.php');
?>
<form name="theatres" action="addtheatres.php"  method="POST">		
		<fieldset >
			<legend>ADD THEATRES</legend>		

			<div class='container'>
				<input type='submit' name='Submit' value='Register' />
			</div>
			<div class='container'>
				<label for='theatrename' >Theatre Name*: </label><br>
				<input type='text' name='theatrename' id='theatrename' maxlength="50" />
				
			</div>

			<div class='container'>
				<label for='location' >Location*:</label><br>
				<input type='text' name='location' id='location' maxlength="50" />
			</div>
			
			<div class='container' style='height:60px;'>
				<label for='contactperson' >contactperson*:</label><br>		
				<input type='text' name='contactperson' id='contactperson' maxlength="50" />				
				<span id='register_password' class='error' style='clear:both'></span>
			</div>	
			
			<div class='container' style='height:60px;'>
				<label for='contactphoneno' >contactphoneno*:</label><br>		
				<input type='text' name='contactphoneno' id='contactphoneno' maxlength="100" />				
				<span id='register_address' class='error' style='clear:both'></span>
			</div>	
			
			<div class='container' style='height:60px;'>
				<label for='zip' >zip*:</label><br>		
				<input type='text' name='zip' id='zip' maxlength="10" />				
				<span id='register_phoneno' class='error' style='clear:both'></span>
			</div>
			<div class='container' style='height:60px;'>
				<label for='country' >country*:</label><br>		
				<input type='text' name='country' id='country' maxlength="10" />				
				<span id='register_phoneno' class='error' style='clear:both'></span>
			</div>
			<div class='container' style='height:60px;'>
				<label for='city' >city*:</label><br>		
				<input type='text' name='city' id='city' maxlength="10" />				
				<span id='register_phoneno' class='error' style='clear:both'></span>
			</div>
			<div class='container' style='height:60px;'>
				<label for='state' >state*:</label><br>		
				<input type='text' name='state' id='state' maxlength="10" />				
				<span id='register_phoneno' class='error' style='clear:both'></span>
			</div>
			
			
			
			
		</fieldset>
	</form>


<?php
	include('footer.php');
?>