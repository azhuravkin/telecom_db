<?
session_start();
include "../lib.php";

init_db();

$query = "SELECT * FROM dlu ORDER BY sort";
$result = mysql_query($query);

print '<h3>Выберите DLU:</h3>';
print '<table align="right">
<tr>
	<td align="center">Поиск по кроссу:</td>
</tr>
<tr>
	<form action="find.php" method="get">
	<td align="center"><input type="text" size="11" name="search"></td>
</tr>
<tr>
	<td align="center"><input type="submit" value="Искать!"></td>
	</form>
</tr>
</table>';

print '<table>';

while ($row = mysql_fetch_array($result)) {
	$dluID = $row['dluID'];
	$sort = $row['sort'];
	$dluName = $row['name'];
	print "<tr>\n<td><b><a href=\"dlu.php?dluID=$dluID\">DLU N-$sort - $dluName</a></b></td>\n</tr>\n";
}
print '</table>';

if (isset($_SESSION['valid_user'])) {
	print '<p><form align="left" action="edit_menu.php" method="post">
<input type="submit" value="Редактировать"></form></p>';
}

print '</body>
</html>';
?>
