<?php
mysql_connect("localhost","root","") or die
("Keine Verbindung zur Datenbank möglich, bitte später noch einmal veruschen.");
mysql_select_db("filme") or die ("Es gibt einen Fehler mit der Datenbank. Bitte später noch einmal versuchen.");

?>
