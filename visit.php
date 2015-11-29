<?php		
	include('header.php');
	include ('includes/dbconn.php');	
	$conn = oci_connect($dbUserName, $dbPassword, $db);
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
?>
visit page
<?php 
$postid = $_GET['postid'];
$query = "select post.postid,createspost.userid,title,content,visits from post,createspost where post.POSTID=createspost.POSTID and post.postid=".$postid; 
$users = oci_parse($conn, $query);
	oci_execute($users);
	
	while (($row = oci_fetch_array($users, OCI_BOTH)) != false) {												
		echo "<br>";
		echo "<div class='movie'>";		
		echo "<span class='title'>POSTID: </span><span class='titleValue'>".$row['POSTID']."</span>";
		echo "<br>";
		echo "<span class='title'>title: </span><span class='titleValue'>".$row['TITLE']."</span>";
		echo "<br>";
		echo "<span class='content'>CONTENTS: </span><span class='titleValue'>".$row['CONTENT']."</span>";			
		echo "<br>";
			
		echo "</div>";
	}
?>
<form><input type="text" name="comment" value="comment">&nbsp;UPDATE<br></form>
<?php
	include('footer.php');
	oci_close($conn);
?>