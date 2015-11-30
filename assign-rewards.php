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
	function validateValues() {	
		var email = document.forms["admin-form"]["admin-emailid"].value;
		var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
		var result = true;		
		$('#register_email').text("");
		if (email == null || email == "") {
			$('#register_email').text("Enter users Email Id");			
			result = false;				
		}
		return result;
	}
</script>
<div class="movie">
	<form action="validaterewards.php" name="admin-form" onsubmit="return validateValues();" method='post'>
		<span class="title">Choose the Membership Status</span><br>
		<input type="radio" name="user-type" value="nochange" checked="checked">&nbsp;No Change<br>
		<input type="radio" name="user-type" value="bronze" >&nbsp;Bronze<br>
		<input type="radio" name="user-type" value="silver">&nbsp;Silver<br>
		<input type="radio" name="user-type" value="gold">&nbsp;Gold<br>
		<input type="radio" name="user-type" value="platinum">&nbsp;Platinum<br>		
		Email Address of the User:&nbsp;<input type='text' name='emailid' id='admin-emailid'/><span id='register_email' class='error'></span><br>
		Reward Points:&nbsp;<input type='text' name='rewardpoints' id='rewardpoints'/><span id='register_rewardpoints' class='error'></span><br>
		<input type='submit' name='Submit' value='Go' />
	</form>
</div>
<?php
		echo "<h3>All User Reviews</h3>";
		$res = oci_parse($conn,"select userid, summary,review,vote from((select review.REVIEWID,moviereview.USERID,review.SUMMARY,review.REVIEW,review.VOTE from review,moviereview where review.REVIEWID=moviereview.REVIEWID) union (select review.REVIEWID,THEATREREVIEW.USERID,review.SUMMARY,review.REVIEW,review.VOTE from review,THEATREREVIEW where review.REVIEWID=THEATREREVIEW.REVIEWID)) order by userid"); 
		usleep(100); 		
		$r = oci_execute($res);
		usleep(100); 
		print "<TABLE style='width:100%' border \"1\">"; 
		$first = 0; 
		while ($row = @oci_fetch_assoc($res)){ 
			if (!$first){ 
				$first = 1; 
				print "<TR><TH>"; 
				print implode("</TH><TH>",array_keys($row)); 
				print "</TH></TR>\n"; 
			} 
			print "<TR><TD>"; 
			print @implode("</TD><TD>",array_values($row)); 
			print "</TD></TR>\n"; 
		} 
		print "</TABLE>";
		

?>
<?php
	include('footer.php');
	oci_close($conn);
?>