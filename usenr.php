<?


include ("includes/header.php");
include ("includes/mysql.kino.php");

$abfrage = "SELECT id, filmname, datum, plaetze, name, email, telefon FROM bestellungen WHERE id = '$nr'";
$ergebnis = mysql_query($abfrage);

echo "Unter der Abholnr. <b>$nr</b> wurden folgende Daten gefunden:<p>";
echo "<table border=1><colgroup width=170 span=7></colgroup><tr><td>Nr.</td><td>Filmname</td><td>Vorstellung</td><td>Pl�tze</td><td>Name</td><td>eMail</td><td>Telefon:</td></tr>";
while($l = mysql_fetch_assoc($ergebnis))
{
         echo "<tr>";
         foreach ($l as $var)
         {
            echo "<td>$var</td>";
         }
         echo "</tr></table><p>";
}

echo "<p><b>Die Abholnummer $nr l�schen?</b><p><form action=delorder.php><input type=hidden name=nr value=$nr><input type=submit value=L�schen></form>";
echo "<hr>";
echo "<a href=searchnr.php>noch eine Nummer suchen</a><br>";
echo "<a href=index_admin.php>zur�ck zum Admin-Bereich</a>";
?>
