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
$abfrage = "SELECT `datum` FROM `$filmname` where `id` = '$datu'" ;
$ergebnis = mysql_query($abfrage);
$error = mysql_error();
echo $error;

while($l = mysql_fetch_assoc($ergebnis))
{
 foreach ($l as $var)
 {
  $var;
 }
}
$datum = $var;

include ("includes/mysql.filme.php");
$abfrage = "SELECT `plaetze` FROM `$filmname` where `datum` = '$datum'";
$ergebnis = mysql_query($abfrage);

while($l = mysql_fetch_assoc($ergebnis))
{
 foreach ($l as $var2)
 {
  $var2;
 }
}

if ($var2 < $anzahl){
    die("Es sind leider nicht genügend, bzw. Karten mehr für diese Vorstellung verfügbar.");
    }
else
 {

$var2=$var2-$anzahl;
$aendern = "UPDATE `$filmname` Set `plaetze` = '$var2' WHERE `datum` = '$datum'";
$update = mysql_query($aendern);
$error = mysql_error();
echo $error;


echo "<p>Plätze reserviert...<p>";

include ("includes/mysql.kino.php");

$eintrag = "INSERT INTO bestellungen (filmname, datum, plaetze, name, email, telefon) VALUES ('$filmname', '$datum', '$anzahl', '$uname', '$email', '$telnr')";
$eintragen = mysql_query($eintrag);
$error = mysql_error();
echo $error;


$abfrage = "SELECT `id` FROM `bestellungen` WHERE `telefon` = '$telnr'";
$ergebnis = mysql_query($abfrage);
$error = mysql_error();
echo $error;

while($l = mysql_fetch_assoc($ergebnis))
{
  foreach ($l as $var)
  {
   $var;
  }
 }

$Abholnr = $var;

$titel = "Online Kartenreservierung";
$text = "Sehr geehrter Kinogänger,\n\n wir möchten uns ganz herzlich für ihre Online Reservierung bedanken! Dies ist Ihre Abholnummer für den Film $Filmname: $Abholnr";
$header = "From:georg_knoerr@gmx.de";
$bool = mail($email, $titel, $text, $header);
if ($bool) {echo "Vielen Dank, sie haben eine Bestätigungsemail erhalten!";}

echo "<p>Ihr Abholnummer ist die <b>$Abholnr</b>. Bitte die Karten eine halbe Stunde vor Beginn abholen.";
}
?>
