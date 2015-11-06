<?

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
