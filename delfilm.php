<?

include ("includes/header.php");
include ("includes/mysql.filme.php");

$bool = "DROP TABLE `$name`";
$ergebnis = mysql_query($bool);

include ("includes/mysql.kino.php");

$bool = "DELETE FROM filme WHERE namen = '$name'";
$ergebnis = mysql_query($bool);
$error = mysql_error();
echo $error;

if ($error == 0) {echo "Der Film <b>$name</b> wurde gel�scht!";}

echo "<p><a href=index_admin.php>zur�ck zum Admin-Bereich</a>";




?>



