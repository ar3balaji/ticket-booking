<?php
	session_start(); 
	include ('layout-manager.php');
	echo "test";
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
					<li><a href="">Write new Post</a></li> |
					<li><a href="">Write new Page</a></li> |
					<li><a href="/ticket-booking/logout.php">Logout</a></li></ul>
				</div><!--loginform ends-->
			<?php } else { ?>
				<h2>Login</h2>
				<div class="loginform">
					<div class="formdetails">
						<form action="/ticket-booking/validatelogin.php" method="post">
							<label for="log">Username : </label><input type="text" name="username" id="log" size="20" />&nbsp;&nbsp;&nbsp;&nbsp;
							<label for="pwd">Password : </label><input type="password" name="user-password" id="pwd" size="20" />
							<input type="submit" name="submit" value="Login" class="button" />&nbsp;&nbsp;<a href="/ticket-booking/register.html">Register</a>
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
			<script type="text/javascript" src="includes/js/jquery-1.10.2-min.js"></script>
			<script type="text/javascript" src="includes/js/alphabet.js"></script>	
			<center>
				<canvas id="myCanvas"></canvas>
			</center>
			<script type="text/javascript" src="includes/js/bubbles.js"></script>
			<script type="text/javascript" src="includes/js/main.js"></script>
		</div>		
		<div class="content">	
			<?php								
					if (isset($_GET['status'])) {
						if ($_GET['status'] == 'reg-success') {
							echo "<h1 style='color: green;'>new user registered successfully!</h1>";
						} else if ($_GET['status'] == 'login-fail') {
							echo "<h1 style='color: red;'>invalid username and/or password!</h1>";
						}
					}									
			?>
			<p>Welcome to BookMyTicket.com...Coolest way to book a ticket !!</p>
		</div>
	</div>
</body>
</html>