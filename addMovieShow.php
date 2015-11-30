<body onload='loadCategories()'>
<center>
<?php		
	include('header.php');
	include ('includes/dbconn.php');	
	$conn = oci_connect($dbUserName, $dbPassword, $db);
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
?>
<?php 
if ($_SERVER['REQUEST_METHOD']== "POST") {
	include ('includes/dbconn.php');
	$conn = oci_connect($dbUserName, $dbPassword, $db);
	$movie   = $_POST['movie'];
	$tid   = $_POST['categoriesSelect'];
	$sid   = $_POST['subcatsSelect'];
	$sdtm   = $_POST['sdtm'];
	$edtm  = $_POST['edtm'];
	$price= $_POST['price'];
	
	$cdquery=oci_parse($conn,"INSERT INTO MOVIESHOW(MOVIEID,THEATREID,SCREENID,STARTTIME,ENDTIME,PRICE) VALUES('".$movie."','".$tid."','".$sid."',TO_DATE('".$sdtm."','DD-Mon-YYYY HH24:MI:SS'),TO_DATE('".$edtm."','DD-Mon-YYYY HH24:MI:SS'),'".$price."')");
	
	if(oci_execute($cdquery))
	{
		echo "<span style='color:green'>Inserted</span>";
		
	}
	else 
	{
		echo "<span style='color:red'>Failed Insert</span>";
	}
}
?>


<?php
	include ('includes/dbconn.php');
	$conn = oci_connect($dbUserName, $dbPassword, $db);  
  
  $cdquery=oci_parse($conn,"SELECT theatreid,THEATRENAME||','||location as THEATRENAME FROM theatres")or die ('None');
 $cdresult=oci_execute($cdquery);
  
 $categories[] = array("id" => "NONE", "val" =>"NONE");
 while ($row=oci_fetch_array($cdquery, OCI_ASSOC+OCI_RETURN_NULLS)) 
  {
  		
  	if(isset($row["THEATREID"],$row["THEATRENAME"]))
  	{
  	
   	$categories[] = array("id" => $row["THEATREID"], "val" => $row["THEATRENAME"]);
  	}
  	
  }

  $query1 = "select THEATREID,SCREENID,SCREENNAME from screens";
  $cdquery1=oci_parse($conn,$query1);
  $result1 = oci_execute($cdquery1);
  while($row1 = oci_fetch_array($cdquery1, OCI_ASSOC+OCI_RETURN_NULLS)){
    if(isset($row1["SCREENID"],$row1["THEATREID"],$row1["SCREENNAME"]))
    {
    	//echo "set";
  	$subcats[$row1["THEATREID"]][] = array("id" => $row1["SCREENID"], "val" => $row1["SCREENNAME"]);
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
		var movie = document.forms["register"]["movie"].value;
		var categoriesSelect = document.forms["register"]["categoriesSelect"].value;
		var sdtm = document.forms["register"]["sdtm"].value;
		var edtm = document.forms["register"]["edtm"].value;
		var price = document.forms["register"]["price"].value;
		
		var result = true;
		$(register_movie).text("");
		$(register_categoriesSelect).text("");
		$(register_sdtm).text("");
		$(register_edtm).text("");
		$(register_price).text("");

		if (price == null || price == "") {
			$(register_price).text("Enter the price");			
			result = false;				
		}
		if(price != null && price != "")
		{
			if(price.match(/^[0-9]+$/) === null)
			{
			$(register_price).text("Enter Numbers only");			
			result = false;
			}
		}
		if (movie == "NONE") {
			$(register_movie).text("Select the movie");			
			result = false;				
		}
		if (categoriesSelect == "NONE") {
			$(register_categoriesSelect).text("Select the theatre");			
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
		
			<legend align="top">Add Movie Show</legend>
			<div class='short_explanation'>* required fields.</div>
			
        
			<div class='container'>
				<label for='movie' >Movie:*: </label><br>
				<select id="movie" name="movie">
			<?php
			
			include ('includes/dbconn.php');
			$conn = oci_connect($dbUserName, $dbPassword, $db);
			$cdquery=oci_parse($conn,"select MOVIEID,MOVIENAME||','||MOVIERELEASEYEAR AS MNAME from MOVIES")or die ('None'); ;
			$cdresult=oci_execute($cdquery); //or die ("Query to get data from firsttable failed: ".mysql_error());
			echo '<option value="'."NONE".'">'."NONE".'</option>';
			while ($cdrow=oci_fetch_array($cdquery, OCI_ASSOC+OCI_RETURN_NULLS)) {
				echo '<option value="'.$cdrow['MOVIEID'].'">'.$cdrow['MNAME'].'</option>';
			
			}
			?>
			</select>
				<span id='register_movie' class='error'></span>
			</div>
						
			<div class='container'>
				<label for='categoriesSelect' >Theatre*: </label><br>
				<select id='categoriesSelect' name='categoriesSelect'>
    </select>
    <span id='register_categoriesSelect' class='error'></span>
			</div>
			<div class='container'>
				<label for='subcatsSelect' >Screen*: </label><br>
				 <select id='subcatsSelect' name='subcatsSelect'>
    </select>
    <span id='register_subcatsSelect' class='error'></span>
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
				<label for='price' >Ticket Price*: </label><br>
				<input type='text' name='price' id='price' maxlength="50" />
				<span id='register_price' class='error'></span>
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
	oci_close($conn);
?>