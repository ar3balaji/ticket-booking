<?
include ("includes/header.php");
?>

<h1>Nachtr�glich eine Vorstellung hinzuf�gen</h2><p>

<?php
include ("includes/mysql.kino.php");

  echo "Lieber Kinobetreiber, hier sehen sie die eingetragenen Filme,<br>
  w�hlen sie einen aus, um noch eine Vorstellung hinzuzuf�gen:<p>";


    $abfrage = "SELECT namen FROM filme ";
  $ergebnis = mysql_query($abfrage);


while($l = mysql_fetch_assoc($ergebnis))
{

         foreach ($l as $var)
         {
            echo "<b>$var</b> <br>";
            echo "<form action=addtime1.php><input type=hidden name=\"filmname\" value=\"$var\"><input type=submit value=\"Vorstellung hinzuf�gen\"></form>";
         }

}
?>
<p><a href=index_admin.php>zur�ck zum Admin-Bereich</a>
