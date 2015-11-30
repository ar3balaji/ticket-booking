<?php
	include('header.php');
?>
<center>
<?php 
if ($_SERVER['REQUEST_METHOD']== "POST") {
	include ('includes/dbconn.php');
	$conn = oci_connect($dbUserName, $dbPassword, $db);
	$email       = $_POST['email'];
	$workpref1   = $_POST['workpref1'];
	$workpref2   = $_POST['workpref2'];
	$workpref3   = $_POST['workpref3'];
	
		$cdquery1=oci_parse($conn,"SELECT EMPLOYEEID FROM EMPLOYEE WHERE USERID='".$email."'");
		oci_execute($cdquery1);
		oci_fetch_all($cdquery1, $array);
	    $numberofrows = oci_num_rows($cdquery1);
	    
	    if($numberofrows!=0)
	    {
	    	echo "<span style='color:red'>User already added as an employee with id:</span>".$array["EMPLOYEEID"][0];
	    }
	    else 
	    {
	    	$cdquery1=oci_parse($conn,"INSERT INTO EMPLOYEE(USERID) VALUES('".$email."')");
	    	$insert_employee=oci_execute($cdquery1,OCI_DEFAULT);
	    	$cdquery3=oci_parse($conn,"SELECT EMPLOYEEID FROM EMPLOYEE where USERID='".$email."'");
	    	oci_execute($cdquery3);
	    	oci_fetch_all($cdquery3, $array3);
	    	$numberofrows3 = oci_num_rows($cdquery3);
	    	$eid="";
	    	if(isset($array3["EMPLOYEEID"]))
	    	$eid=$array3["EMPLOYEEID"][0];
	    	
	    	
	    	$query="INSERT ALL";
	    	$query=$query." into WORKPREFERENCE(EMPLOYEEID,WORKTYPE) values ('".$eid."','".$workpref1."')";
	    	if(isset($workpref2)&& trim($workpref2)!='')
	    	{
	    		$query=$query." into WORKPREFERENCE(EMPLOYEEID,WORKTYPE) values ('".$eid."','".$workpref2."')";
	    	}
	    	if(isset($workpref3) && trim($workpref3)!='')
	    	{
	    		$query=$query." into WORKPREFERENCE(EMPLOYEEID,WORKTYPE) values ('".$eid."','".$workpref3."')";
	    	}
	    	$query=$query." SELECT 1 FROM DUAL";
	    	$cdquery2=oci_parse($conn,$query);
	    	$numberofrows2=oci_execute($cdquery2);
	    	//echo $query;
	    	if($numberofrows3 && $numberofrows2)
	    	{
	    		echo "<span style='color:green'>Added</span>";
	    	}
	    	
	}
	
	oci_close($conn);

}
?>


	<script>
		function validateForm() {
			
			var email = document.forms["register"]["email"].value;
			var workpref1 = document.forms["register"]["workpref1"].value;
			var workpref2 = document.forms["register"]["workpref2"].value;
			var workpref3 = document.forms["register"]["workpref3"].value;			
			var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
			var result = true;			
			$(register_email).text("");			
			$(register_workpref1).text("");			
			$(register_workpref2).text("");			
			$(register_workpref3).text("");			
			
			
			if (workpref1 == null || workpref1 == "") {
				$(register_workpref1).text("Primary work preference cannot be blank.");			
				result = false;
			}											
			if(!re.test(email)) {
				$(register_email).text("Enter Correct Email Id");			
				result = false;
			}
			if (email == null || email == "") {
				$(register_email).text("Enter your Email Id");			
				result = false;				
			}			
			return result;
		}
	</script>
	<form name="register" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" onsubmit="return validateForm()" method="POST">		
		<fieldset >
			<legend>Add Employee</legend>		

			<div class='short_explanation'>* required fields. User should be already registered to be added as an employee</div>
			<div class='container'>
				<input type='submit' name='Submit' value='Register' />
			</div>
			<div class='container'>
				<label for='email' >Email Address*:</label><br>
				<input type='text' name='email' id='email' maxlength="50" />
				<span id='register_email' class='error'></span>
			</div>			
			<div class='container' style='height:60px;'>
				<label for='workpref1' >Work Preference Primary*:</label><br>		
				<input type='text' name='workpref1' id='workpref1' maxlength="100" />				
				<span id='register_workpref1' class='error' style='clear:both'></span>
			</div>	
			<div class='container' style='height:60px;'>
				<label for='workpref2' >Work Preference Secondary:</label><br>		
				<input type='text' name='workpref2' id='workpref2' maxlength="100" />				
				<span id='register_workpref2' class='error' style='clear:both'></span>
			</div>
			<div class='container' style='height:60px;'>
				<label for='workpref3' >Work Preference Secondary:</label><br>		
				<input type='text' name='workpref3' id='workpref3' maxlength="100" />				
				<span id='register_workpref3' class='error' style='clear:both'></span>
			</div>			
		</fieldset>
	</form>
</center>

<?php
	include('footer.php');
?>