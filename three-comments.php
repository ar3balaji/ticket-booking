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
	$postid = $_GET['postid']; 	
	oci_execute(oci_parse($conn,"update post set visits = visits + 1 where postid =".$postid));
	$query = "select post.postid,createspost.userid,title,content,visits from post,createspost where post.POSTID=createspost.POSTID and post.postid=".$postid; 
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
	
	$query = "select * from (select commenttext,userid from comments,makescomment where comments.COMMENTID=makescomment.COMMENTID and comments.postid=".$postid." order by createddate desc) a where rownum<=3"; 
	$users = oci_parse($conn, $query);
	oci_execute($users);	
	echo "<br>";
	echo "<br>";
	echo "<div class='comments'>";		
	while (($row = oci_fetch_array($users, OCI_BOTH)) != false) {														
		echo "<div class='comment'>";		
		echo "<span class='title'>".$row['USERID']."</span><span class='titleValue'>&nbsp;".$row['COMMENTTEXT']."</span>";
		echo "</div>";
	}
	echo "</div>";
?>
<?php
	include('footer.php');
	oci_close($conn);
?>