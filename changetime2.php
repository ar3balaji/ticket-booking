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
include ("includes/header.php");
include ("includes/mysql.filme.php");

$abfrage = "SELECT datum, plaetze FROM `$filmname`";
$ergebnis = mysql_query($abfrage);

echo "F�r den Film $filmname sind folgende Vorstellung noch offen: <p><table border=1 ><colgroup width=200 span=2> </colgroup> <tr><td>Datum und Zeit</td><td>freie online Pl�tze</td></tr></table>";
while($l = mysql_fetch_assoc($ergebnis))
{
         echo "<table border=0 ><colgroup width=200 span=2> </colgroup> <tr>";

         foreach ($l as $var)
         {
            echo "<td>$var</td>";
         }
         echo "</tr></table><p>";

}

echo "<p><form name=change method=post action=changetime3.php>";

echo "f�r die Vorstellung am <select name=datu>";
$abfrage = "SELECT datum FROM `$filmname`";
$ergebnis = mysql_query($abfrage);
$k = 1;
while($l = mysql_fetch_assoc($ergebnis))
  {
         foreach ($l as $var)
         {
             $var;
             echo "<option value=\"$var\">$var</option>";
         }

 }

echo "</select><br>";

echo "neues Datum/Zeit f�r die Vorstellung: <input type=text name=neudatum> (bitte 01.01.2002, 20:00 ) <br>";
echo "<input type=hidden name=\"filmname\" value=\"$filmname\">";
echo "<input type=submit value=aendern!>";

?>
