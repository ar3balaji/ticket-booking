<?

include ("includes/header.php");
include ("includes/mysql.filme.php");

$aendern = "UPDATE `$filmname` SET `plaetze` = '$neuanzahl' WHERE `datum` = '$datu' ";
$update = mysql_query($aendern);
$error = mysql_error();
echo $error;

if ($error == 0) {echo "Die Anzahl der Tickets wurde ge�ndert, f�r die Vorstellung von <b>$filmname</b> am $datu sind jetzt <b>$neuanzahl</b> Tickets zu haben.";}
echo "<p><a href=index_admin.php>zur�ck zum Admin-Bereich</a>";
?>
