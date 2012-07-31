<?php
session_start();
include "../lib.php";

if ($_SESSION['writable'] == 'Y') {
	init_db();

	print "<h3>Редактирование разделов справки:</h3>\n";
	print "<table class='small' cellspacing='1'>\n";
	print "<th>Название раздела:</th>\n";
	print "<th>Удалить:</th>\n";
	print "<form action='update_razdel_menu.php' method='post'>\n";

	$query = "SELECT * FROM razdel ORDER BY name";
	$result = mysql_query($query);

	$i = 0;
	while ($row = mysql_fetch_assoc($result)) {
		print "\n<tr>\n<td>";
		print "<input type='text' name=\"razdelName[$i]\" size='40' value='";
		print $row['name'];
		print "'>\n<input type='hidden' name=\"razdelID[$i]\" value='";
		print $row['razdelID'];
		print "'></td>\n";
		print "<td align='center'>\n";
		print "<input type='checkbox' name=\"del_razdelID[$i]\" value='";
		print $row['razdelID'];
		print "'>\n</td>";
		print "</tr>";
		$i++;
	}

	print '</table><p>
<table width="1%">
<tr>
<td><input type="submit" value="Сохранить"></form></td>
<form align="left" action="add_razdel.php" method="post">
<td><input type="submit" value="Добавить раздел"></td>
</form>
</tr>
</table></p>';

} else {
	goHome();
}
?>
</body>
</html>
