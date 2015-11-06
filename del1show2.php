<?

include ("includes/header.php");
include ("includes/mysql.filme.php");

$abfrage = "SELECT datum, plaetze FROM `$filmname`";
$ergebnis = mysql_query($abfrage);

echo "Für den Film $filmname sind folgende Vorstellungen offen: <table border=0 ><colgroup width=200 span=2> </colgroup> <tr><td>Datum und Zeit</td><td>freie online Plätze</td></tr></table>";
while($l = mysql_fetch_assoc($ergebnis))
{
         echo "<table border=1 ><colgroup width=200 span=2> </colgroup> <tr>";
         foreach ($l as $var)
         {
            echo "<td>$var</td>";
         }
         echo "</tr></table><p>";

}

echo "<p><form name=del1show2 method=post action=del1show3.php>";
echo "Vorstellung auswählen, die gelöscht werden soll: ";
echo "<select name=datum>";
$abfrage = "SELECT datum FROM `$filmname`";
$ergebnis = mysql_query($abfrage);
$k = 1;
while($l = mysql_fetch_assoc($ergebnis))
  {
         foreach ($l as $var)
         {
             $var;
             echo "<option value=\"$var\">$var</option>";
         }

 }

echo "</select><br>";
echo "<input type=hidden name=\"filmname\" value=\"$filmname\">";
echo "<input type=submit value=löschen!>";
?>
