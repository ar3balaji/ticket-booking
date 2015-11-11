<?php
	session_start();
?>
<html>
<head>
	<title>BookMyTicket</title>
	<script type="text/javascript" src="includes/js/jquery-1.10.2-min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$(".btn-slide").click(function(){
		$("#slide-panel").slideToggle("slow");
		});
	});
</script>
</head>
<link href="/ticket-booking/includes/styles.css" type="text/css" rel="stylesheet" />
<body>
	<div class="pane">
		<div id="slide-panel"><!--SLIDE PANEL STARTS-->
			<?php if (isset($_SESSION['username'])){ ?>
				<div class="loginform">
					<h2>User Navigation</h2><ul>
					<li><a href="/ticket-booking/">Home</a></li> |					
					<li><a href="/ticket-booking/logout.php">Logout</a></li></ul>
				</div><!--loginform ends-->
			<?php } else { ?>
				<h2>Login</h2>
				<div class="loginform">
					<div class="formdetails">
						<form action="/ticket-booking/validatelogin.php" method="post">
							<label for="log">Username : </label><input type="text" name="username" id="log" size="20" />&nbsp;&nbsp;&nbsp;&nbsp;
							<label for="pwd">Password : </label><input type="password" name="user-password" id="pwd" size="20" />
							<input type="submit" name="submit" value="Login" class="button" />&nbsp;&nbsp;<a href="/ticket-booking/register.php">Register</a>
							&nbsp;&nbsp;<a href="/ticket-booking/index.php">Home</a>
						</form>
					</div>					
				</div><!--loginform ends-->			
			<?php }?>
		</div><!--SLIDE PANEL ENDS-->
		<div class="slide">
			<a href="#" class="btn-slide">
				<?php if (isset($_SESSION['username']) ){ ?>
					Logout
				<?php } else { ?>
					Login
				<?php }?>
			</a>
		</div><!--LOGIN BUTTON TEXT-->
		
		<div class="header">
			<img src="includes/title.png" alt="Smiley face">
		</div>	
		
		<div class="content">	
			<div class="content-status">
				<?php								
						if (isset($_GET['status'])) {
							if ($_GET['status'] == 'reg-success') {
								echo "<h1 style='color: green;'>New user registered successfully!</h1>";
							} else if ($_GET['status'] == 'login-fail') {
								echo "<h1 style='color: red;'>Invalid username and/or password!</h1>";
							}
						}									
				?>
			</div>