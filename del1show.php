<?

include ("includes/header.php");
include ("includes/mysql.kino.php");
echo "<h1>Vorstellung l�schen</h1>";
echo "W�hlen sie aus, von welchem Film sie eine Vorstellung l�schen wollen:<p>";

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
echo "<p><a href=index_admin.php>zur�ck zum Admin-Bereich</a>";
?>


