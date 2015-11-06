<?php
	
	function loginform() {
		echo "<form action='/ticket-booking/validatelogin.php' method='POST'>
			  <p>Username:</p>
			  <input type='text' id='usernameinput' name='username' />
				<p>Password:</p>
				<input type='password' id='passwordinput' name='user-password' />
				<input type='submit' value='Login' />
				<button type='button' onclick='location.href=\"/ticket-booking/register.html\";'>Register</button>
			</form>";
	}
?>