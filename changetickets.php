<?
include ("includes/header.php");
?>
<h1>Ticketanzahl zu einer Vorstellung ändern</h1><p>
Hier können die das Kontingent für Onlinetickets, die zu einer Vorstellung<br>
verkauft werden sollen, ändern:<p>
<?php
include ("includes/mysql.kino.php");
echo "Einfach einen Film auswählen und die Anzahl ändern:<p>";

$abfrage = "SELECT namen FROM filme ";
$ergebnis = mysql_query($abfrage);

while($l = mysql_fetch_assoc($ergebnis))
{
         foreach ($l as $var)
         {
            echo "<b>$var</b> <br>";
            echo "<form action=changetickets2.php name=$var><input type=hidden name=\"filmname\" value=\"$var\"><input type=submit value=\"Ticketanzahl ändern\"></form>";
         }
}
?>

