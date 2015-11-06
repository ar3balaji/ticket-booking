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

$error = mysql_error();
echo "$error";


$eintrag = "INSERT INTO `$filmname` (datum, plaetze) VALUES ('$datum', '$plaetze')";
$eintragen = mysql_query($eintrag);
  $error = mysql_error();
echo "$error";
echo "Die Vorstellung wurde in die Datenbank eingegeben.";
?>

<p><a href=index_admin.php>zurück zum Admin-Bereich</a>
