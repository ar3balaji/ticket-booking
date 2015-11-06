<?

include ("includes/header.php");
?>
Jetzt für einen Film eine Vorstellung festlegen:<p>

<form action=addtime.php method=post>
Film<input type=text name=filmname value="<? echo($filmname)?>"> <br>
Datum <input type=text name=datum> (bitte 01.01.2001, 22:45)<br>

zu vergebene online-Plätze <input type=text name=plaetze value=10><br>
<input type=submit value="vorstellung eintragen">
</form>

