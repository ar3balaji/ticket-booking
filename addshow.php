<?

include ("includes/header.php");
include ("includes/mysql.filme.php");

$bool = "CREATE TABLE `$filmname` (`id` INT( 5 ) NOT NULL AUTO_INCREMENT ,`datum` VARCHAR( 20 ) NOT NULL ,`plaetze` VARCHAR( 5 ) NOT NULL ,PRIMARY KEY ( `id` ))";
$ergebnis = mysql_query($bool);

include ("includes/mysql.kino.php");

$eintrag = "INSERT INTO filme (namen) VALUES ('$filmname')";
$eintragen = mysql_query($eintrag);

$error = mysql_error();
echo "$error";
echo "Sie haben den Film $filmname eingetragen, ";
?>

noch eine Vorstellung eintragen?<br>
<form action=addtime.php method=post>
<input type=hidden name=filmname value="<? echo($filmname)?>">
Datum <input type=text name=datum> (bitte 01.01.2001, 22.45)<br>
zu vergebene online-Plätze <input type=text name=plaetze value=10><br>
<input type=submit value="Vorstellung eintragen">
</form>



