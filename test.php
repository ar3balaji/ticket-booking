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

<html>

  <head>
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

  </head>

  <body onload='loadCategories()'>
    <select id='categoriesSelect'>
    </select>

    <select id='subcatsSelect'>
    </select>
    <!-- 
			<select id="cd" name="cd">
			<?php
			/*
			include ('includes/dbconn.php');
			$conn = oci_connect($dbUserName, $dbPassword, $db);
			$cdquery=oci_parse($conn,"select THEATRENAME from theatres")or die ('None'); ;
			$cdresult=oci_execute($cdquery); //or die ("Query to get data from firsttable failed: ".mysql_error());
			
			while ($cdrow=oci_fetch_array($cdquery, OCI_ASSOC+OCI_RETURN_NULLS)) {
				$cdTitle=$cdrow["THEATRENAME"];
				echo '<option value="'.$cdrow['THEATRENAME'].'">'.$cdrow['THEATRENAME'].'</option>';
			
			}*/
			?>
			</select>
			 -->
			 
			 <!-- 
			<div class='container'>
				<label for='' >Theatre*: </label><br>
			
			
			<select id="cd" name="cd">
			<?php
			/*
			include ('includes/dbconn.php');
			$conn = oci_connect($dbUserName, $dbPassword, $db);
			$cdquery=oci_parse($conn,"select THEATRENAME,LOCATION,THEATREID from theatres")or die ('None'); ;
			$cdresult=oci_execute($cdquery); //or die ("Query to get data from firsttable failed: ".mysql_error());
			
			while ($cdrow=oci_fetch_array($cdquery, OCI_ASSOC+OCI_RETURN_NULLS)) {
				$cdTitle=$cdrow["THEATRENAME"].", ".$cdrow["LOCATION"];
				echo '<option value="'.$cdrow['THEATREID'].'">'.$cdTitle.'</option>';
			
			}
			*/
			?>
			</select>
			 
				<span id='register_cd' class='error'></span>
			</div>
			
			<div class='container'>
				<label for='' >Work Type*: </label><br>
				<input type='text' name='wtype' id='wtype' maxlength="50" />
				<span id='register_wtype' class='error'></span>
			</div>
			-->
  </body>
</html>