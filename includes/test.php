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

$std = date("H");
$std--;
$rest =  date("d.m.Y, ");
$rest2 = date(":i");
$nowdate = $rest . $std . $rest2;

echo $nowdate ."<p>";

$kuh = "12.06.2003, 20:00";
//nachprüfen, ob eine vorstellung vorbei ist, wenn ja, löschen

    if ($nowdate > $kuh)
     {
         echo "yes<p>";
     }
     
     if ($nowdate < $kuh)
     {
         echo "no<p>";
 }
 
 echo $kuh;

