<?
include ("includes/header.php");
echo "F�r den Film <b>$filmname</b> eine Vorstellung nachtr�glich eintragen:";
?>
<br>
<form action=addtime.php method=post>
<input type=hidden name=filmname value="<? echo($filmname)?>">
Datum: <input type=text name=datum> (bitte 01.01.2001, 22.45)<br>
zu vergebene online-Pl�tze: <input type=text name=plaetze value=10><br>
<input type=submit value="Vorstellung eintragen">
</form>

<p><a href=index_admin.php>zur�ck zum Admin-Bereich</a>
