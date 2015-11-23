<?php
	include('header.php');
	include ('includes/dbconn.php');	
	$conn = oci_connect($dbUserName, $dbPassword, $db);
	if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
?>
<div class="movie"> 	
	<center><h1>Review Your Order</h1></center>
	<?php
		echo "<form action='/ticket-booking/final-order.php' method='post'>";
		echo "<span class='title'>Theatre: </span><span class='titleValue'>".$_POST['theatrename']."</span>";
		echo "<br>";
		echo "<span class='title'>Movie: </span><span class='titleValue'>".$_POST['moviename']."</span><span class='rating'>&nbsp;&nbsp;&nbsp;<img src='includes/likes.png'/ title='Users Rating'>".$_POST['movierating']."%</span>";
		echo "<br>";
		echo "<span class='title'>Show Start Time: </span><span class='titleValue'>".$_POST['moviestarttime']."</span>";				
		echo "<br>";		
		echo "<span class='title'>Selected Tickets: </span><span class='titleValue'>".rtrim($_POST['ticketselection'],",")."</span>";		
		echo "<br>";
		echo "<span class='title'>Total Amount</span><span class='titleValue'></span>";		
		echo "<span class='movieOrder'><input type='submit' value='Order !!'></span>";						
		echo "</form>";
	?>
	
</div>
<?php
	include('footer.php');
	oci_close($conn);
?>