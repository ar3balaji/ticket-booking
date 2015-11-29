<?php		
	include('header.php');
	include ('includes/dbconn.php');	
	$conn = oci_connect($dbUserName, $dbPassword, $db);
	if (!$conn) {
		$e = oci_error();
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}
?>
<h1>Discussions with Lastest 3 comments</h1>
<?php 		
	$query = "select post.postid,createspost.userid,title,content,visits from post,createspost where post.POSTID=createspost.POSTID order by post.createddate desc"; 
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
		$commentquery = "select * from (select commenttext,userid from comments,makescomment where comments.COMMENTID=makescomment.COMMENTID and comments.postid=".$postid." order by createddate desc) a where rownum<=3"; 
		$commentqueryresult = oci_parse($conn, $commentquery);
		oci_execute($commentqueryresult);	
		echo "<br>";
		echo "<br>";
		echo "<div class='comments'>";		
		while (($commentrow = oci_fetch_array($commentqueryresult, OCI_BOTH)) != false) {														
			echo "<div class='comment'>";		
			echo "<span class='title'>".$commentrow['USERID']."</span><span class='titleValue'>&nbsp;".$commentrow['COMMENTTEXT']."</span>";
			echo "</div>";
		}
		echo "</div>";
	}	
	
	
?>
<?php
	include('footer.php');
	oci_close($conn);
?>