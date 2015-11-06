<?
include ("includes/header.php");
include ("includes/mysql.kino.php");

$bool = "DELETE FROM bestellungen WHERE id = '$nr'";
$ergebnis = mysql_query($bool);

if ($error == 0) {echo "Die Abholnr $nr ist gelöscht!";}

echo "<hr><p><a href=searchnr.php>weitere Abholnr. abarbeiten</a><p>" ;
echo "<p><a href=index_admin.php>zurück zum Admin-Bereich</a>";

?>
