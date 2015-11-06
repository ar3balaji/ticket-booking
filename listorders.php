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

include ("includes/mysql.kino.php");

$abfrage = "SELECT id, filmname, datum, plaetze, name, email, telefon FROM bestellungen";
$ergebnis = mysql_query($abfrage);

echo "Hier sind alle bisher eingegangenen Bestellungen aufgelistet:<p>";
echo "<table border=1><colgroup width=160 span=7></colgroup><tr><td>Nr.</td><td>Filmname</td><td>Vorstellung</td><td>Plätze</td><td>Name</td><td>eMail</td><td>Telefon:</td></tr><p>";
while($l = mysql_fetch_assoc($ergebnis))
{
         echo "<tr>";
         foreach ($l as $var)
         {
            echo "<td>$var</td>";
         }
         echo "</tr>";

}
echo "</table><p><a href=index_admin.php>zurück zum Admin-Bereich</a>";
?>
