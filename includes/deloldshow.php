<?
include ("mysql.filme.php");
$i=0;
$k=0;
while($i >=0 )
{
  $abfrage = "SELECT `datum` FROM `$filmname`";
  $ergebnis = mysql_query($abfrage);

          while ($l = mysql_fetch_assoc($ergebnis))
            {
             $daten[$k] = $l;
             $k++;
            }
$i--;
}

//aktuelles datum mit sperrstd versehen

$std = date("H");
$std--;
$rest =  date("d.m.Y, ");
$rest2 = date(":i");
$nowdate = $rest . $std . $rest2;

//nachprüfen, ob eine vorstellung vorbei ist, wenn ja, löschen
include ("mysql.filme.php");
while ($k >= 0)
{
    if ($nowdate > $daten[$k]["datum"])
     {
         $temp1 = $daten[$k]["datum"];

         $bool = "DELETE FROM `$filmname` WHERE `datum` = '$temp1'";
         $ergebnis = mysql_query($bool);

     } else {}

$k--;
}

// überprüfen, ob jetzt der film noch vorstellungen hat
include ("mysql.filme.php");
$abfrage = "SELECT datum, plaetze FROM `$filmname`";
$ergebnis = mysql_query($abfrage);


while($l = mysql_fetch_assoc($ergebnis))
{


         foreach ($l as $var)
         {
            $var;
         }

}
//falls nein, löschen
 if ($var == 0)
 {
     include ("mysql.filme.php");

     $bool = "DROP TABLE `$filmname`";
     $ergebnis = mysql_query($bool);

     include ("mysql.kino.php");

     $bool = "DELETE FROM filme WHERE namen = '$filmname'";
     $ergebnis = mysql_query($bool);

     echo "Sorry, für den Film $filmname sind gar keine Vorstellungen mehr übrig, wir haben ihn nun aus dem Programm genommen.<p><a href=order.php>... zurück</a>";
     die;
     }

?>
