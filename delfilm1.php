<?

include ("includes/header.php");
?>

<h1>Film l�schen</h1>
<p>
Hier k�nnen sie einen Film mitsamt seiner Vorstellungen aus dem Programm nehmen!

<?php
include ("includes/mysql.kino.php");

  echo "Bitte einen Film ausw�hlen! <br><b>Achtung</b>, diese Aktion kann <u>nicht</u> r�ckg�ngig gemacht werden!!<p>";


    $abfrage = "SELECT namen FROM filme ";
  $ergebnis = mysql_query($abfrage);


while($l = mysql_fetch_assoc($ergebnis))
{

         foreach ($l as $var)
         {
            echo "<b>$var</b> <br>";
            echo "<form action=delfilm.php name=$var><input type=hidden name=\"name\" value=\"$var\"><input type=submit value=L�schen!></form>";
         }

}
?>

</body>
</html>
