<?

include ("includes/header.php");
?>
<h1>die Zeit/das Datum einer Vorstellung ändern</h1><p>
<?php
include ("includes/mysql.kino.php");
echo "Lieber Kinobetreiber, hier sehen sie die eingetragenen Filme, <br>
bitte den auswählen, bei dem die Zeit geändert werden soll:<p>";

$abfrage = "SELECT namen FROM filme ";
$ergebnis = mysql_query($abfrage);

while($l = mysql_fetch_assoc($ergebnis))
{
         foreach ($l as $var)
         {
            echo "<b>$var</b> <br>";
            echo "<form action=changetime2.php name=$var><input type=hidden name=\"filmname\" value=\"$var\"><input type=submit value=\"Zeit/Datum ändern\"></form>";
         }
}
?>

