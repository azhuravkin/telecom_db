<?php
session_start();
include "../lib.php";

if ($_SESSION['writable'] == 'Y') {
	init_db();

	print "<h3>Редактирование списка аналоговых пультов:</h3>\n";
	print "<table class='small' cellspacing='1'>\n";
	print "<th colspan='3'>Название пульта:</th>\n";
	print "<th>Удалить:</th>\n";
	print "<form action='update_pult_menu.php' method='post'>\n";

	$query = "SELECT * FROM pult_a_menu ORDER BY sort";
	$result = mysql_query($query);

	$i = 0;
	while ($row = mysql_fetch_assoc($result)) {
		print "\n<tr>\n\t<td>Пульт N-</td>\n\t";
		print "<td><input type='text' name='sort[$i]' size='3' value='";
		print $row['sort'];
		print "'></td>\n<td><input type='text' name='pultName[$i]' size='50' value='";
		print $row['name'];
		print "'>\n<input type='hidden' name='pultID[$i]' value='";
		print $row['id'];
		print "'></td>\n";
		print "\n<td align='center'><input type='checkbox' name='del_pult[$i]' value='";
		print $row['id'];
		print "'>\n</td>";
		print "</tr>\n";
		$i++;
	}
	print '</table>
	<p><table width="1%"><tr><td><input type="submit" value="Сохранить"></form></td>
	<form align="left" action="add_pult.php" method="get">
	<td><input type="submit" value="Добавить пульт">
	</form></td></tr></table></p>';
} else {
	goHome();
}
?>
</body>
</html>
