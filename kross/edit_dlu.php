<?
session_start();

$dluID = $_GET['dluID'];
include "../lib.php";

if (isset($_SESSION['valid_user'])) {
	init_db();

	// Сохраняем временную метку момента начала редактирования
	$timestamp = time();
	$query = "UPDATE `dlu` SET `timestamp` = '$timestamp' WHERE `dluID` = '$dluID'";
	$result = mysql_query($query);

	$query = "SELECT * FROM dlu WHERE dluID = '$dluID'";
	$result = mysql_query($query);
	$row = mysql_fetch_assoc($result);

	print "<h3>DLU N-";
	print $row['sort'];
	print " - ";
	print $row['name'];
	print "</h3>";

	print "<table class='small' cellspacing='1' width='100%'>\n";
	print "<th>Пара</th>\n";
	print "<th>Тел.</th>\n";
	print "<th>Пульт</th>\n";
	print "<th>Сигн.</th>\n";
	print "<th>Pen</th>\n";
	print "<th>Кросс</th>\n";
	print "<th>Абонент</th>\n";

	$query = "SELECT * FROM para WHERE dluID = '$dluID' ORDER BY para";
	$result = mysql_query($query);

	print "<form action='update_dlu.php' method='post'>\n";
	print "<input type='hidden' name='dluID' value='$dluID'>\n";
	print "<input type='hidden' name='timestamp' value='$timestamp'>\n";

	for ($i = 0; $row = mysql_fetch_assoc($result); $i++) {
		print "<tr>\n";
		print "\t<input type='hidden' name='paraID[$i]' value='";
		print $row['paraID'];
		print "'>\n\t<td align='center' width='5%'>";
		print $row['para'];
		print "</td>\n\t<td width='5%'>";
		print "<input type='text' class='text' name='tel[$i]' value='";
		print $row['telephone'];
		print "'></td>\n\t<td width='7%'>";
		print "<input type='text' class='text' name='pult[$i]' value='";
		print $row['pult'];
		print "'></td>\n\t<td width='7%'>";
		print "<input type='text' class='text' name='sign[$i]' value='";
		print $row['sign'];
		print "'></td>\n\t<td width='7%'>";
		print "<input type='text' class='text' name='pen[$i]' value='";
		print $row['pen'];
		print "'></td>\n\t<td width='7%'>";
		print "<input type='text' class='text' name='kross[$i]' value='";
		print $row['kross'];
		print "'></td>\n\t<td width='62%'>";
		print "<input type='text' class='text' name='abonent[$i]' value='";
		print $row['abonent'];
		print "'></td>\n</tr>";
	}
	print "</table><p><input type='submit' value='Сохранить'></p>\n</form>";
} else {
	goHome();
}
?>
</body>
</html>
