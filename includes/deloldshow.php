<?
// ----------------------------------------------------------------------
// CinRes - Cinema Reservatin
// Copyright (C) 2003 by Georg Knoerr
// georg-knoerr@gmx.de
// ----------------------------------------------------------------------
// LICENSE
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License (GPL)
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// To read the license please visit http://www.gnu.org/copyleft/gpl.html


// die daten aus der db holen
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

//nachpr�fen, ob eine vorstellung vorbei ist, wenn ja, l�schen
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

// �berpr�fen, ob jetzt der film noch vorstellungen hat
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
//falls nein, l�schen
 if ($var == 0)
 {
     include ("mysql.filme.php");

     $bool = "DROP TABLE `$filmname`";
     $ergebnis = mysql_query($bool);

     include ("mysql.kino.php");

     $bool = "DELETE FROM filme WHERE namen = '$filmname'";
     $ergebnis = mysql_query($bool);

     echo "Sorry, f�r den Film $filmname sind gar keine Vorstellungen mehr �brig, wir haben ihn nun aus dem Programm genommen.<p><a href=order.php>... zur�ck</a>";
     die;
     }

?>
