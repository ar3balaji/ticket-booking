<?
include ("includes/header.php");

include ("includes/mysql.filme.php");

$bool = "DELETE FROM `$filmname` WHERE `datum` = '$datum'";
$ergebnis = mysql_query($bool);
$error = mysql_error();
echo $error;

if ($error == 0) {echo "Die Vorstellung von $filmname am <b> $datum </b> ist gel�scht!";}


echo "<p><a href=index_admin.php>zur�ck zum Admin-Bereich</a>";

?>
