<?
include ("includes/header.php");

include ("includes/mysql.filme.php");

$abfrage = "SELECT datum, plaetze FROM `$filmname`";
$ergebnis = mysql_query($abfrage);

echo "Für den Film <b>$filmname</b> sind folgende Vorstellung noch offen und Tickets zu haben:<p> <table border=1 ><colgroup width=200 span=2> </colgroup> <tr><td>Datum und Zeit</td><td>freie online Plätze</td></tr></table>";
while($l = mysql_fetch_assoc($ergebnis))
{
  echo "<table border=0 ><colgroup width=200 span=2> </colgroup> <tr>";
  foreach ($l as $var)
   {
    echo "<td>$var</td>";
   }
  echo "</tr></table><p>";
}

echo "<a href=index_admin.php>zurück zum Admin-Bereich</a>";
?>
