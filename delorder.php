<?
include ("includes/header.php");
include ("includes/mysql.kino.php");

$bool = "DELETE FROM bestellungen WHERE id = '$nr'";
$ergebnis = mysql_query($bool);

if ($error == 0) {echo "Die Abholnr $nr ist gel�scht!";}

echo "<hr><p><a href=searchnr.php>weitere Abholnr. abarbeiten</a><p>" ;
echo "<p><a href=index_admin.php>zur�ck zum Admin-Bereich</a>";

?>
