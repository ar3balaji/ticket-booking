<?


include ("includes/header.php");

include ("includes/mysql.kino.php");

$abfrage = "SELECT id, filmname, datum, plaetze, name, email, telefon FROM bestellungen";
$ergebnis = mysql_query($abfrage);

echo "Hier sind alle bisher eingegangenen Bestellungen aufgelistet:<p>";
echo "<table border=1><colgroup width=160 span=7></colgroup><tr><td>Nr.</td><td>Filmname</td><td>Vorstellung</td><td>Plätze</td><td>Name</td><td>eMail</td><td>Telefon:</td></tr><p>";
while($l = mysql_fetch_assoc($ergebnis))
{
         echo "<tr>";
         foreach ($l as $var)
         {
            echo "<td>$var</td>";
         }
         echo "</tr>";

}
echo "</table><p><a href=index_admin.php>zurück zum Admin-Bereich</a>";
?>
