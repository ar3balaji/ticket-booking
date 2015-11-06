<?

include ("includes/header.php");
include ("includes/mysql.kino.php");
echo "<h1>Vorstellung löschen</h1>";
echo "Wählen sie aus, von welchem Film sie eine Vorstellung löschen wollen:<p>";

$abfrage = "SELECT namen FROM filme ";
$ergebnis = mysql_query($abfrage);
while($l = mysql_fetch_assoc($ergebnis))
{
 foreach ($l as $var)
 {
  echo "$var <br>";
  echo "<form action=del1show2.php name=$var><input type=hidden name=filmname value=\"$var\"><input type=submit value=vorstellungsuchen></form>";
 }
}
echo "<p><a href=index_admin.php>zurück zum Admin-Bereich</a>";
?>


