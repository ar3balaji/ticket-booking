<?
include ("includes/header.php");
include ("includes/mysql.filme.php");


$aendern = "UPDATE `$filmname` SET `datum` = '$neudatum' WHERE `datum` = '$datu' ";
$update = mysql_query($aendern);
$error = mysql_error();
echo $error;

if ($error == 0) {echo "Das Datum f�r den Film $filmname, wurde ge�ndert, die ge�nderte Vorstellung ist jetzt diese: <b>$neudatum</b>";}
echo "<p><a href=index_admin.php>zur�ck zum Admin-Bereich</a>";
?>
