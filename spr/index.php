<?php
session_start();
include "../lib.php";

print '<h3>Выберите раздел справки:</h3>';
print '<table align="right"><tr><td>';
print '<table align="center">
<tr>
	<form action="find_number.php" method="get">
	<td align="center">Поиск по номеру:</td>
</tr>
<tr>
	<td align="center"><input type="text" size="12" name="number"></td>
</tr>
<tr>
	<td align="center"><input type="submit" value="Искать!"></td>
	</form>
</tr>
<tr>
	<form action="find_comment.php" method="get">
	<td align="center">Поиск по фамилии:</td>
</tr>
<tr>
	<td align="center"><input type="text" size="12" name="comment"></td>
</tr>
<tr>
	<td align="center"><input type="submit" value="Искать!"></td>
	</form>
</tr>
</table>
</td></tr>
<tr><td>
<table width="100%">
<tbody align="center" valign="middle">
<tr><td align="left">Всего номеров:</td><td>';

// Сколько всего уникальных номеров в базе
$query = "SELECT count(DISTINCT telephone) AS count FROM number";
$result = mysql_query($query);

while ($row = mysql_fetch_array($result)) {
	$all = $row['count'];
	print $all;
}
print '</td></tr><tr><td align="left">Чисто-городских:</td><td>';

// Сколько чисто-городских номеров в базе
$query = "SELECT count(DISTINCT telephone) AS count FROM number
WHERE telephone LIKE '2__-__-__'";
$result = mysql_query($query);

while ($row = mysql_fetch_array($result)) {
	$onlyGorod = $row['count'];
	print $onlyGorod;
}

print '</td></tr><tr><td align="left">Городских:</td><td>';

// Сколько номеров в базе на 2
$query = "SELECT count(DISTINCT telephone) AS count FROM number
WHERE telephone LIKE '2_-__'";
$result = mysql_query($query);

while ($row = mysql_fetch_array($result)) {
	$gorod2 = $row['count'];
}

// Сколько номеров в базе на 9
$query = "SELECT count(DISTINCT telephone) AS count FROM number
WHERE telephone LIKE '9_-__'";
$result = mysql_query($query);

while ($row = mysql_fetch_array($result)) {
	$gorod9 = $row['count'];
}

// Городских номеров:
print $gorod2 + $gorod9;

print '</td></tr><tr><td align="left">Внутренних:</td><td>';

// Сколько остальных (внутренних)
print $all - ($onlyGorod + $gorod2 + $gorod9);

print '</td></tr></table></td></tr><table>';

$query = "SELECT * FROM razdel ORDER BY name";
$result = mysql_query($query);

while ($row = mysql_fetch_assoc($result)) {
	$razdelID = $row['razdelID'];
	$name = $row['name'];
	
	print "<tr>\n<td><b><a href=\"razdel.php?razdelID=$razdelID\">$name</a></b></td>\n</tr>\n";
}
print '</table>';

if ($_SESSION['writable'] == 'Y') {
	print '<p><form align="left" action="edit_menu.php" method="post">
<input type="submit" value="Редактировать"></form></p>';
} // if
?>
</body>
</html>
