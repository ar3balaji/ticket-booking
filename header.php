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
			<?php if (isset($_SESSION['username'])){?>
				<div class="loginform">
				
					<h2>User Navigation</h2>
					<ul>
						<li><a href="/ticket-booking/">Home</a></li> |
						<li><a href="/ticket-booking/my-account.php">My Account</a></li> |
						<li><a href="/ticket-booking/movies.php">Movies</a></li> |
						<li><a href="/ticket-booking/discussion-forum.php">Discussion Forum</a></li> |
						<li><a href="/ticket-booking/get-tickets.php">Get Booked Tickets</a></li> |							
						<li><a href="/ticket-booking/queries.php">Queries</a></li> |
						<?php
							include ('includes/dbconn.php');	
							$con = oci_connect($dbUserName, $dbPassword, $db);
							$resource = oci_parse($con, "SELECT * FROM userrole WHERE userid = '".$_SESSION['username']."' AND upper(role) ='ADMIN'");
							oci_execute($resource, OCI_DEFAULT);	
							$results=array();
							$numrows = oci_fetch_all($resource, $results, null, null, OCI_FETCHSTATEMENT_BY_ROW);
							oci_close($con);
							if($numrows>0) {
						?>
						<li><a href="/ticket-booking/theatres.php">Add Theatres</a></li> |	
                        <li><a href="/ticket-booking/screens.php">Add Screens</a></li> |						
						<li><a href="/ticket-booking/add-movies.php">Add Movies</a></li> |	
						<li><a href="/ticket-booking/addMovieShow.php">Add Show</a></li> |		
						<li><a href="/ticket-booking/workSchedule.php">Work Schedule</a></li> |			
						<li><a href="/ticket-booking/addEmployee.php">Add Employee</a></li> |			
						<li><a href="/ticket-booking/make-admin.php">Make Admin</a></li> |			
						<li><a href="/ticket-booking/guest-users.php">Guest Users</a></li> |
						<li><a href="/ticket-booking/addStars.php">Add Stars</a></li> |	
						<li><a href="/ticket-booking/displaySchedule.php">Display Schedule</a></li> |		
						<li><a href="/ticket-booking/query-interface.php">Query Interface</a></li> |
						<li><a href="/ticket-booking/assign-rewards.php">Assign Rewards</a></li> |						
						<?php } ?>						
						<li><a href="/ticket-booking/logout.php">Logout</a></li>						
					</ul>
				</div><!--loginform ends-->
			<?php } else { ?>
				<h2> 
					Login
					<span style="float:right">
						<a style='font-size:16px' href="/ticket-booking/index.php">Home</a>
						&nbsp;&nbsp;<a style='font-size:16px' href="/ticket-booking/register.php">Register</a>
						&nbsp;&nbsp;<a style='font-size:16px' href="/ticket-booking/movies.php">Movies</a>	
						&nbsp;&nbsp;<a style='font-size:16px' href="/ticket-booking/discussion-forum.php">Discussion Forum</a>											
						&nbsp;&nbsp;<a style='font-size:16px' href="/ticket-booking/get-tickets.php">Get Booked Tickets</a>
						&nbsp;&nbsp;<a style='font-size:16px' href="/ticket-booking/queries.php">Queries</a>
						&nbsp;&nbsp;<a style='font-size:16px' href="/ticket-booking/guest-information.php">Guest Info</a>
					</span>
				</h2>
				<div class="loginform">
					<div class="formdetails">
						<form action="/ticket-booking/login.php" method="post">
							<label for="log">Username : </label><input type="text" name="username" id="log" size="20" />&nbsp;&nbsp;&nbsp;&nbsp;
							<label for="pwd">Password : </label><input type="password" name="user-password" id="pwd" size="20" />
							<input type="submit" name="submit" value="Login" class="button" />						
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
							} else if ($_GET['status'] == 'reg-fail') {
								echo "<h1 style='color: red;'>New user registration Failed!</h1>";
							}
						}									
				?>
			</div>