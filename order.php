<?php
	include('header.php');
	include ('includes/dbconn.php');	
	$conn = oci_connect($dbUserName, $dbPassword, $db);
	if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
?>
<script type="text/javascript">
	function validate() {	
		var result = true;
		if($('#usertype').val()==="guestuser"){			
			var email = document.forms["register"]["email"].value;			
			var creditcardno = document.forms["register"]["creditcardno"].value;
			var creditcardtype = document.forms["register"]["creditcardtype"].value;
			var creditcardexpmm = document.forms["register"]["creditcardexpmm"].value;
			var creditcardexpyyyy = document.forms["register"]["creditcardexpyyyy"].value;			
			var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;			
			$(register_email).text("");						
			$(register_creditcardno).text("");
			$(register_creditcardtype).text("");			
			$(register_creditcardexp).text("");	
			if (email == null || email == "") {
				$(register_email).text("Enter your Email Id");			
				result = false;				
			}			
			if (creditcardno == null || creditcardno == "") {
				$(register_creditcardno).text("Enter your Credit/Debit Card Number");			
				result = false;								
			}			
			if (creditcardno.length<16) {				
				$(register_creditcardno).text("You are missing few numbers for your Credit/Debit Card Number");			
				result = false;				
			}
			if (creditcardexpmm == null || creditcardexpmm == "" || creditcardexpYYYY == null || creditcardexpYYYY == "") {
				$(register_creditcardexp).text("Enter your Credit/Debit Card Expiry details");			
				result = false;
			}					
			if (Number(creditcardexpmm)>12) {
				$(register_creditcardexp).text("Enter Correct Credit/Debit Card Expiry details");			
				result = false;
			}								
			if(!re.test(email)) {
				$(register_email).text("Enter Correct Email Id");			
				result = false;
			}			
		}		
		return result;
	}
</script>
<div class="movie"> 	
	<center><h1>Review Your Order</h1></center>
	<?php
		$tickets=explode(",", rtrim($_POST['ticketselection'],","));		
		echo "<form action='/ticket-booking/final-order.php' name='register' onsubmit='return validate();' method='post'>";
		echo "<span class='title'>Theatre: </span><span class='titleValue'>".$_POST['theatrename']."</span>";
		echo "<br>";
		echo "<span class='title'>Movie: </span><span class='titleValue'>".$_POST['moviename']."</span><span class='rating'>&nbsp;&nbsp;&nbsp;<img src='includes/likes.png'/ title='Users Rating'>".$_POST['movierating']."%</span>";
		echo "<br>";
		echo "<span class='title'>Show Start Time: </span><span class='titleValue'>".$_POST['moviestarttime']."</span>";				
		echo "<br>";		
		echo "<span class='title'>Selected Tickets: </span><span class='titleValue'>".rtrim($_POST['ticketselection'],",")."</span>";		
		echo "<br>";
		echo "<span class='title'>Each Ticket Price: </span><span class='titleValue'> ".$_POST['ticketprice']."</span>";	
		echo "<br>";
		echo "<span class='title'>Total Amount</span><span class='titleValue'> ".count($tickets) *$_POST['ticketprice']."</span>";	
		if (!isset($_SESSION['username'])){						
			echo "<div id='guest-data'>";
			echo "<span style='color:green'>User dint login. You can proceed booking the ticket as a Guest User !!</span>";
			echo "<div class='container'>";
			echo "<label for='email' >Email Address*:</label><br>";
			echo "<input type='text' name='email' id='email' maxlength='50' />";
			echo "<span id='register_email' class='error'></span>";
			echo "</div>";
			echo "<div class='container' style='height:60px;'>";
			echo "<label for='creditcardno' >Credit/Debit Card Number*:</label><br>";
			echo "<input type='text' name='creditcardno' id='creditcardno' maxlength='16' />";
			echo "<span id='register_creditcardno' class='error' style='clear:both'></span>";
			echo "</div>";			
			echo "<div class='container' style='height:60px;'>";
			echo "<label for='creditcardtype' >Credit/Debit Card Type*:</label><br>";
			echo "<select name='creditcardtype' id='creditcardtype'>";
			echo "<option value='visa'>Visa</option>";
			echo "<option value='mastercard'>Mastercard</option>";
			echo "<option value='maestro'>Maestro</option>";
			echo "</select>";
			echo "<span id='register_creditcardtype' class='error' style='clear:both'></span>";
			echo "</div>";
			echo "<div class='container' style='height:60px;'>";
			echo "<label for='cardexp' >Credit/Debit Card Expiry Month and Year in MM/YYYY Format*:</label><br>";
			echo "<input type='text' name='creditcardexpmm' id='creditcardexpmm' maxlength='2' />&nbsp;/&nbsp;";
			echo "<input type='text' name='creditcardexpyyyy' id='creditcardexpYYYY' maxlength='4' />";
			echo "<span id='register_creditcardexp' class='error' style='clear:both'></span>";
			echo "</div>";
			echo "</div>";
			echo "<input type=hidden name='usertype' id = 'usertype' value='guestuser'>";
		} else {
			echo "<input type=hidden name='usertype' id = 'usertype' value='reguser'>";
		}
		echo "<span class='movieOrder'><input type='submit' value='Order !!'></span>";	
		echo "<input type=hidden name='showid' value=\"".$_POST['showid']."\">";
		echo "<input type=hidden name='theatreid' value=\"".$_POST['theatreid']."\">";
		echo "<input type=hidden name='movieid' value=\"".$_POST['movieid']."\">";
		echo "<input type=hidden name='screenid' value=\"".$_POST['screenid']."\">";	
		echo "<input type=hidden name='theatrename' value=\"".$_POST['theatrename']."\">";
		echo "<input type=hidden name='moviename' value=\"".$_POST['moviename']."\">";				
		echo "<input type=hidden name='movierating' value=\"".$_POST['movierating']."\">";	
		echo "<input type=hidden name='moviestarttime' value=\"".$_POST['moviestarttime']."\">";
		echo "<input type=hidden name='ticketprice' value=\"".$_POST['ticketprice']."\">";
		echo "<input type=hidden name='tickets' value=\"".rtrim($_POST['ticketselection'],",")."\">";		
		echo "</form>";
	?>
	
</div>
<?php
	include('footer.php');
	oci_close($conn);
?>