<?php		
	include('header.php');
	include ('includes/dbconn.php');	
	$conn = oci_connect($dbUserName, $dbPassword, $db);
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
?>
<h1>Discussions with Least number of visits</h1>
<?php 		
	$query = "select post.postid,createspost.userid,title,content,visits from post,createspost where post.POSTID=createspost.POSTID and visits =0 order by post.createddate desc"; 
	$users = oci_parse($conn, $query);
	oci_execute($users);	
	while (($row = oci_fetch_array($users, OCI_BOTH)) != false) {
		$postid = $row['POSTID']; 	
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