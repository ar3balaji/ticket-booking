<?php		
	include('header.php');
	include ('includes/dbconn.php');	
	$conn = oci_connect($dbUserName, $dbPassword, $db);
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
?>
<script>
		function validateForm() {
			var vote = document.forms["register"]["vote"].value;
			var summary = document.forms["register"]["summary"].value;
			var review = document.forms["register"]["review"].value;
			var result = true;
			$("#register_vote").text("");			
			$("#register_review").text("");			
			$('#register_summary').text("");								
			if (vote == null || vote == "") {
				$('#register_vote').text("Enter your vote");			
				result = false;				
			}
			if (vote !== null && vote !== "" &&parseInt(vote) > 10 ) {
				$('#register_vote').text("Vote value should be between 1-10");			
				result = false;				
			}
			if (summary == null || summary == "") {
				$("#register_summary").text("Enter Summary");			
				result = false;
			}		
			if (review == null ||  review== "") {
				$("#register_review").text("Enter Review");			
				result = false;				
			}			
			return result;
		}
	</script>
<div class="theatres-selection">
	<center>
	<form name="register" action="/ticket-booking/createreview.php" onsubmit="return validateForm()" method="post">	
		<fieldset >
			<legend>Create Review</legend>					
			<div class='container'>
				<input type='submit' name='submit' value='Create Review' />
			</div>
			
			<div class='container'>
				<label for='vote' >vote:(values from 1 to 10)</label><br>
				<input type='text' name='vote' id='vote' maxlength="2" />
				<span id='register_vote' class='error'></span>
			</div>
			
			<div class='container'>
				<label for='summary' >Summary: </label><br>
				<input type='text' name='summary' id='summary' maxlength="250" />
				<span id='register_summary' class='error'></span>
			</div>

			<div class='container'>
				<label for='review' >Review:(maximum of 1,000 words)</label><br>
				<textarea rows='15' cols='22' type='text' style="width:60%;height:20%" name='review' id='review' maxlength="1000" ></textarea>
				<span id='register_review' class='error'></span>
			</div>
			<?php 
			$type = $_GET['type'];
			if($type=='movie') {
				echo "<input type=hidden name='type' value=\"".$type."\">";
				echo "<input type=hidden name='movieid' value=\"".$_GET['movieid']."\">";							
			} else {
				echo "<input type=hidden name='type' value=\"".$type."\">";
				echo "<input type=hidden name='theatreid' value=\"".$_GET['theatreid']."\">";							
			}
			?>
		</fieldset>
	</form>	
	</center>	
</div>					

<?php
	include('footer.php');
	oci_close($conn);
?>