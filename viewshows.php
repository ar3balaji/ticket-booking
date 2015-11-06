<?
include ("includes/header.php");

include ("includes/mysql.kino.php");

echo "Lieber Kinobetreiber, hier sehen sie die eingetragenen Filme, Vorstellungen<br>und noch verfügbaren Plätze<p>";

$abfrage = "SELECT namen FROM filme ";
$ergebnis = mysql_query($abfrage);
while($l = mysql_fetch_assoc($ergebnis))
{
 foreach ($l as $var)
 {
  echo "$var <br>";
  echo "<form action=howmany.php name=$var><input type=hidden name=filmname value=\"$var\"><input type=submit value=\"Vorstellungen anzeigen!\"></form>";
 }
}
echo "<p><a href=index_admin.php>zurück zum Admin-Bereich</a>";
?>
