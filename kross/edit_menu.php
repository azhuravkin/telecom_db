<?php
session_start();
include "../lib.php";

if ($_SESSION['writable'] == 'Y') {
	init_db();

	print "<h3>Редактирование списка DLU:</h3>
<table class='small' cellspacing='1'>
<th colspan='3'>Название DLU:</th>
<th>Удалить:</th>
<form action='update_dlu_menu.php' method='post'>";

	$query = "SELECT * FROM dlu ORDER BY sort";
	$result = mysql_query($query);

	$i = 0;
	while ($row = mysql_fetch_assoc($result)) {
		print "\n<tr>\n\t<td>DLU N-</td>\n\t<td>";
		print "<input type='text' name='sort[$i]' size='2' value='";
		print $row['sort'];
		print "'></td>\n\t<td><input type='text' name='dluName[$i]' size='50' value='";
		print $row['name'];
		print "'>\n\t<input type='hidden' name='dluID[$i]' value='";
		print $row['dluID'];
		print "'></td>\n";
		print "\t<td align='center'>";
		print "<input type='checkbox' name='del_dlu[$i]' value='";
		print $row['dluID'];
		print "'></td>\n";
		print "</tr>";
		$i++;
	}
	print '</table><p>
<table width="1%">
<tr>
<td><input type="submit" value="Сохранить"></form></td>
<form align="left" action="add_dlu.php" method="post">
<td><input type="submit" value="Добавить DLU"></td>
</form>
</tr>
</table></p>';

} else {
	goHome();
}
?>
</body>
</html>
