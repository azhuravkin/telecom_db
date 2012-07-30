<?
session_start();
include "../lib.php";

init_db();

$query = "SELECT * FROM pult_d_menu ORDER BY sort";
$result = mysql_query($query);

print '<h3>Выберите Пульт:</h3>';
print '<table align="right">
<tr>
	<form action="find.php" method="get">
	<td align="center">Поиск по пультам:</td>
</tr>
<tr>
	<td align="center"><input type="text" size="12" name="search"></td>
</tr>
<tr>
	<td align="center"><input type="submit" value="Искать!"></td>
	</form>
</tr>
</table>';

print '<table>';

while ($row = mysql_fetch_array($result)) {
	$pultID = $row['pultID'];
	$sort = $row['sort'];
	$pultName = $row['name'];
	print "<tr>\n<td><b><a href=\"pult.php?pultID=$pultID\">Пульт N-$sort - $pultName</a></b></td>\n</tr>\n";
}
print '</table>';

if (isset($_SESSION['valid_user'])) {
	print '<p><form align="left" action="edit_menu.php" method="post">
<input type="submit" value="Редактировать"></form></p>';
}

print '</body>
</html>';
?>
