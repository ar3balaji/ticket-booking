<?

include ("includes/header.php");
?>
<h1>die Zeit/das Datum einer Vorstellung �ndern</h1><p>
<?php
include ("includes/mysql.kino.php");
echo "Lieber Kinobetreiber, hier sehen sie die eingetragenen Filme, <br>
bitte den ausw�hlen, bei dem die Zeit ge�ndert werden soll:<p>";

$abfrage = "SELECT namen FROM filme ";
$ergebnis = mysql_query($abfrage);

while($l = mysql_fetch_assoc($ergebnis))
{
         foreach ($l as $var)
         {
            echo "<b>$var</b> <br>";
            echo "<form action=changetime2.php name=$var><input type=hidden name=\"filmname\" value=\"$var\"><input type=submit value=\"Zeit/Datum �ndern\"></form>";
         }
}
?>

