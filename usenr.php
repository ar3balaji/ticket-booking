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

$abfrage = "SELECT id, filmname, datum, plaetze, name, email, telefon FROM bestellungen WHERE id = '$nr'";
$ergebnis = mysql_query($abfrage);

echo "Unter der Abholnr. <b>$nr</b> wurden folgende Daten gefunden:<p>";
echo "<table border=1><colgroup width=170 span=7></colgroup><tr><td>Nr.</td><td>Filmname</td><td>Vorstellung</td><td>Plätze</td><td>Name</td><td>eMail</td><td>Telefon:</td></tr>";
while($l = mysql_fetch_assoc($ergebnis))
{
         echo "<tr>";
         foreach ($l as $var)
         {
            echo "<td>$var</td>";
         }
         echo "</tr></table><p>";
}

echo "<p><b>Die Abholnummer $nr löschen?</b><p><form action=delorder.php><input type=hidden name=nr value=$nr><input type=submit value=Löschen></form>";
echo "<hr>";
echo "<a href=searchnr.php>noch eine Nummer suchen</a><br>";
echo "<a href=index_admin.php>zurück zum Admin-Bereich</a>";
?>
