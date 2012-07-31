<?php
session_start();
include "../lib.php";

init_db();

print '<h3>Выберите пульт:</h3>
<table align="right">
<form action="find.php" method="get">
<tr>
<td align="center">Поиск по фамилии:</td>
</tr>
<tr>
<td align="center"><input type="text" size="12" name="fio"></td>
</tr>
<tr>
<td align="center"><input type="submit" value="Искать!"></td>
</tr>
</form>
</table>
<table>';

$query = "SELECT * FROM pult_a_menu ORDER BY sort";
$result = mysql_query($query);

while ($row = mysql_fetch_array($result)) {
	$id = $row['id'];
	$sort = $row['sort'];
	$name = $row['name'];
	print "<tr>\n<td><b><a href=\"pult.php?id=$id\">Пульт N-$sort - $name</a></b></td>\n</tr>\n";
} // while
print '</table>';

if ($_SESSION['writable'] == 'Y') {
	print '<p><form align="left" action="edit_menu.php" method="get">
<input type="submit" value="Редактировать"></form></p>';
} // if

print '</body>
</html>';
?>
