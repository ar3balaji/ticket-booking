<?php
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

// Verbindung zur Datenbank Filme

mysql_connect("localhost","root","") or die
("Keine Verbindung zur Datenbank möglich, bitte später noch einmal veruschen.");
mysql_select_db("filme") or die ("Es gibt einen Fehler mit der Datenbank. Bitte später noch einmal versuchen.");

?>
