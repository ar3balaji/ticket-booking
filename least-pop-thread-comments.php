<?php		
	include('header.php');
	include ('includes/dbconn.php');	
	$conn = oci_connect($dbUserName, $dbPassword, $db);
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
?>
<h1>Discussions with Least number of Comments</h1>
<?php 		
	$query = "select createspost.userid,a.postid,title,content,createddate,visits from createspost,(select * from post where POSTID not in (select postid from comments)) a where createspost.postid=a.postid order by a.createddate desc"; 
	$users = oci_parse($conn, $query);
	oci_execute($users);	
	while (($row = oci_fetch_array($users, OCI_BOTH)) != false) {		
		echo "<br>";
		echo "<div class='post'>";		
		echo "<span class='title'>Discussion Thread Id: </span><span class='titleValue'>".$row['POSTID']."</span>";
		echo "<br>";
		echo "<span class='title'>Thread Title: </span><span class='titleValue'>".$row['TITLE']."</span>";
		echo "<br>";
		echo "<span class='title'>Thread Contents: </span><span class='titleValue'>".$row['CONTENT']."</span>";			
		echo "<br>";
		echo "<span class='title'>Visits: </span><span class='titleValue'>".$row['VISITS']."</span>";			
		echo "<br>";
		echo "<span class='title'>Created By: </span><span class='titleValue'>".$row['USERID']."</span>";
		echo "<br>";
		echo "</div>";				
	}	
	
	
?>
<?php
	include('footer.php');
	oci_close($conn);
?>