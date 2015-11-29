<?php
	include('header.php');
?>


<div class="left" align="right">
        <a href="workSchedule.php">Back</a>
</div>
<body onload='loadCategories()'> 
<center>
<?php 
if ($_SERVER['REQUEST_METHOD']== "POST") {
	include ('includes/dbconn.php');
	$conn = oci_connect($dbUserName, $dbPassword, $db);
	$fname   = $_POST['fname'];
	$eid   = $_POST['eid'];
	$wtype   = $_POST['subcatsSelect'];
	$sdtm   = $_POST['sdtm'];
	$edtm  = $_POST['edtm'];
	$cd= $_POST['categoriesSelect'];
	//echo "yes";
	if($eid==null||$eid=="")
	{
		$cdquery1=oci_parse($conn,"SELECT EMPLOYEEID FROM EMPLOYEE WHERE USERID='".$fname."'");
		oci_execute($cdquery1);
		$row = oci_fetch_array($cdquery1, OCI_BOTH);
		$eid=$row['EMPLOYEEID'];		
	}
	//echo $fname+$eid+$wtype+$sdtm+$edtm;
	//echo "update workfor set worktype='".$wtype."',starttime=TO_DATE('".$sdtm."','DD-Mon-YYYY HH24:MI:SS'),endtime=TO_DATE('".$edtm."','DD-Mon-YYYY HH24:MI:SS')where EMPLOYEEID='".$eid."' or EMPLOYEEID=(SELECT EMPLOYEEID FROM MOVIEUSER M INNER JOIN EMPLOYEE E ON M.EMAILID=E.USERID WHERE LOWER(USERID)=LOWER('".$fname."'))";
	//$insert_movieuser = oci_execute(oci_parse($conn, "insert into movieuser (emailId,fName,creditPoints,password,membershipStatus) values('".$emailid."','".$name."',0,'".$passwd."','bronze')"),OCI_DEFAULT);
	$cdquery=oci_parse($conn,"Insert into WORKFOR (THEATREID,EMPLOYEEID,WORKTYPE,STARTTIME,ENDTIME) values ('".$cd."','".$eid."','".$wtype."',to_date('".$sdtm."','DD-MON-RR hh24:mi:ss'),to_date('".$edtm."','DD-MON-RR hh24:mi:ss'))");
	
	if (!$cdquery) {
		$e = oci_error($conn);  // For oci_parse errors pass the connection handle
		trigger_error(htmlentities($e['message']), E_USER_ERROR);
	}
	
	$cdquery1=oci_parse($conn,"SELECT THEATREID FROM WORKFOR WHERE EMPLOYEEID='".$eid."' AND THEATREID!='".$cd."'");
	oci_execute($cdquery1);
	oci_fetch_all($cdquery1, $array);
	$numberofrows = oci_num_rows($cdquery1);
	
	$cdquery2=oci_parse($conn,"select EMPLOYEEID  from EMPLOYEE WHERE EMPLOYEEID='".$eid."'");
	oci_execute($cdquery2);
	oci_fetch_all($cdquery2, $array2);
	$numberofrows2 = oci_num_rows($cdquery2);
	
	$cdquery3=oci_parse($conn,"SELECT EMPLOYEEID FROM workfor where theatreId='".$cd."' and worktype='".$wtype."' and starttime between TO_DATE('".$sdtm."','DD-Mon-YYYY HH24:MI:SS') and TO_DATE('".$edtm."','DD-Mon-YYYY HH24:MI:SS')");
	oci_execute($cdquery3);
	oci_fetch_all($cdquery3, $array3);
	$numberofrows3 = oci_num_rows($cdquery3);
	
	$cdquery4=oci_parse($conn,"SELECT WORKTYPE FROM WORKPREFERENCE where EMPLOYEEID='".$eid."' and LOWER(worktype)=LOWER('".$wtype."')");
	oci_execute($cdquery4);
	oci_fetch_all($cdquery4, $array4);
	$numberofrows4 = oci_num_rows($cdquery4);
	
	$cdquery5=oci_parse($conn,"SELECT WORKTYPE FROM workfor where theatreId='".$cd."' and employeeid='".$eid."' and starttime between TO_DATE('".$sdtm."','DD-Mon-YYYY HH24:MI:SS') and TO_DATE('".$edtm."','DD-Mon-YYYY HH24:MI:SS')");
	oci_execute($cdquery5);
	oci_fetch_all($cdquery5, $array5);
	$numberofrows5 = oci_num_rows($cdquery5);
	
	if($numberofrows2==0)
	{
		echo "Insert failed: Employee does not exist";
	}
	else if($numberofrows>1)
	{
		echo "here";
		if(isset($array["THEATREID"]))
		echo "Insert failed as the employee is scheduled to work for another theatre with ID:".$array["THEATREID"][0];
	}
	else if($numberofrows5>0)
	{
		echo "here1";
		if(isset($array5["WORKTYPE"]))
			echo "Insert failed as the employee is assigned with the work -".$array5["WORKTYPE"][0]." during same time in same theatre.";
	}
	else if($numberofrows3>0)
	{
		echo "here2";
		if(isset($array3["EMPLOYEEID"]))
			echo "Insert failed as another employee with ID -".$array3["EMPLOYEEID"][0]." works during same time on same work type in same theatre.";
	}
	else if($numberofrows4==0)
	{
		echo "here3";
		if(isset($array4["WORKTYPE"]))
		{
		echo "Insert failed as the workpreference for the employee don't permit to assign the task:".$wtype;			
		}
		
	}
	else if (oci_execute($cdquery,OCI_DEFAULT)) {
		oci_commit($conn);
		echo "Inserted";
	}
	else {
		echo "Insert failed as the employee entered is not present";
		//echo oci_error();
	}
	
	oci_close($conn);

}
?>
<?php
	include ('includes/dbconn.php');
	$conn = oci_connect($dbUserName, $dbPassword, $db);  
  
  $cdquery=oci_parse($conn,"SELECT theatreid FROM theatres")or die ('None');
 $cdresult=oci_execute($cdquery);
  
 $categories[] = array("id" => "none", "val" =>"none");
 while ($row=oci_fetch_array($cdquery, OCI_ASSOC+OCI_RETURN_NULLS)) 
  {
  		
  	if(isset($row["THEATREID"]))
  	{
  	
   	$categories[] = array("id" => $row["THEATREID"], "val" => $row["THEATREID"]);
  	}
  	
  }

  $query1 = "SELECT theatreid, worktype FROM worktype";
  $cdquery1=oci_parse($conn,$query1);
  $result1 = oci_execute($cdquery1);
  while($row1 = oci_fetch_array($cdquery1, OCI_ASSOC+OCI_RETURN_NULLS)){
    if(isset($row1["WORKTYPE"],$row1["THEATREID"]))
    {
    	//echo "set";
  	$subcats[$row1["THEATREID"]][] = array("id" => $row1["WORKTYPE"], "val" => $row1["WORKTYPE"]);
    }
  }

  if(isset($categories)&& isset($subcats))
  {
  $jsonCats = json_encode($categories);
  $jsonSubCats = json_encode($subcats);
  }
?>
	 <script type='text/javascript'>
      <?php
        echo "var categories = $jsonCats; \n";
        echo "var subcats = $jsonSubCats; \n";
      ?>
      function loadCategories(){
        var select = document.getElementById("categoriesSelect");
        select.onchange = updateSubCats;
        for(var i = 0; i < categories.length; i++){
          select.options[i] = new Option(categories[i].val,categories[i].id);          
        }
      }
      function updateSubCats(){
        var catSelect = this;
        var catid = this.value;
        var subcatSelect = document.getElementById("subcatsSelect");
        subcatSelect.options.length = 0; //delete all options if any present
        for(var i = 0; i < subcats[catid].length; i++){
          subcatSelect.options[i] = new Option(subcats[catid][i].val,subcats[catid][i].id);
        }
      }
    </script>
<script>
	function validateForm() {
		var fname = document.forms["register"]["fname"].value;
		var eid = document.forms["register"]["eid"].value;
		var categoriesSelect = document.forms["register"]["categoriesSelect"].value;
		var sdtm = document.forms["register"]["sdtm"].value;
		var edtm = document.forms["register"]["edtm"].value;
		var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
		var result = true;
		$(register_fname).text("");
		$(register_eid).text("");
		$(register_categoriesSelect).text("");
		$(register_sdtm).text("");
		$(register_edtm).text("");

		if ((fname == null || fname == "")&& (eid == null || eid == "")){
			$(register_fname).text("Enter either full name or employee id below.");	
			$(register_eid).text("Enter either employee id or full name above.");			
			result = false;				
		}
		if(fname!=null && fname!="")
		{
			if(!re.test(fname)) {
				$(register_fname).text("Enter Correct user Id");			
				result = false;
			}
		}
		if(eid != null && eid != "")
		{
			if(eid.match(/^[0-9]+$/) === null)
			{
			$(register_eid).text("Enter Numbers only");			
			result = false;
			}
		}
		
		
		if ((fname != null && fname != "")&& (eid != null && eid != "")){
			$(register_fname).text("Enter either full name or employee id below.");	
			$(register_eid).text("Enter either employee id or full name above.");			
			result = false;				
		}
		
		if (categoriesSelect == "none") {
			$(register_categoriesSelect).text("Select the theatreId");			
			result = false;				
		}
		
		if (sdtm == null || sdtm == "") {
			$(register_sdtm).text("Enter the start date time");			
			result = false;				
		}
		if (edtm == null || edtm == "") {
			$(register_edtm).text("Enter the end date time");			
			result = false;				
		}
		//^[0-9]+$/
		if(sdtm != null && sdtm != "") {
		if (sdtm.match(/(\d{2})-([a-zA-Z]{3})-(\d{4}) (\d{2}):(\d{2}):(\d{2})$/)===null)
		{
			$(register_sdtm).text("Enter in proper format(eg:- 12-Jan-2015 10:10:10)");			
			result = false;
			
		}
		}
		if(edtm != null && edtm != "") {
		if (edtm.match(/(\d{2})-([a-zA-Z]{3})-(\d{4}) (\d{2}):(\d{2}):(\d{2})$/)===null)
		{
			$(register_edtm).text("Enter in proper format(eg:- 12-Jan-2015 10:10:10)");			
			result = false;
			
		}
		}
		
		return result;
	}
	</script>
<form name="register" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" onsubmit="return validateForm()" method="POST">		
		<fieldset >		
			<legend align="top">Add Schedule</legend>
			<div class='short_explanation'>* required fields.</div>
			
			<div class='container'>
				<label for='fname' >User ID:*: </label><br>
				<input type='text' name='fname' id='fname' maxlength="50" />
				<span id='register_fname' class='error'></span>
			</div>
			         <p align="center">OR<p>
			<div class='container'>
				<label for='' >Employee ID*: </label><br>
				<input type='text' name='eid' id='eid' maxlength="50" />
				<span id='register_eid' class='error'></span>
			</div>
						
			<div class='container'>
			<label for='categoriesSelect' >Theatre ID*: </label><br>
			 <select id='categoriesSelect' name='categoriesSelect'>
    		 </select>
    		 <span id='register_categoriesSelect' class='error'></span>
    		</div>
			
			<div class='container'>
			<label for='subcatsSelect' >Work Type*: </label><br>
    		<select id='subcatsSelect' name='subcatsSelect'>
    		</select>
    		</div>
	
			 <div class='container'>
				<label for='sdtm' >Start Date and Time(DD-Mon-YYYY HH:MI:SS)*: </label><br>
				<input type='text' name='sdtm' id='sdtm' maxlength="50" />
				<span id='register_sdtm' class='error'></span>
			</div>
			
			<div class='container'>
				<label for='edtm' >End Date and Time(DD-Mon-YYYY HH:MI:SS)*: </label><br>
				<input type='text' name='edtm' id='edtm' maxlength="50" />
				<span id='register_edtm' class='error'></span>
			</div>
			<div class='container'>
				<input type='submit' name='Submit' value='Add' />
			</div>
		</fieldset>
	</form>
	</center>
</body>
<?php
	include('footer.php');
?>