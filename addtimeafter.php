<?
include ("includes/header.php");
?>

<h1>Nachträglich eine Vorstellung hinzufügen</h2><p>

<?php
include ("includes/mysql.kino.php");

  echo "Lieber Kinobetreiber, hier sehen sie die eingetragenen Filme,<br>
  wählen sie einen aus, um noch eine Vorstellung hinzuzufügen:<p>";


    $abfrage = "SELECT namen FROM filme ";
  $ergebnis = mysql_query($abfrage);


while($l = mysql_fetch_assoc($ergebnis))
{

         foreach ($l as $var)
         {
            echo "<b>$var</b> <br>";
            echo "<form action=addtime1.php><input type=hidden name=\"filmname\" value=\"$var\"><input type=submit value=\"Vorstellung hinzufügen\"></form>";
         }

}
?>
<p><a href=index_admin.php>zurück zum Admin-Bereich</a>
