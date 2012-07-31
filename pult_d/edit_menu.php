<?php
session_start();
include "../lib.php";

if ($_SESSION['writable'] == 'Y') {
	print "<h3>Редактирование списка цифровых пультов:</h3>
<table class='small' cellspacing='1'>
<th colspan='3'>Название пульта:</th>
<th>Удалить:</th>
<form action='update_pult_menu.php' method='post'>";

	$query = "SELECT * FROM pult_d_menu ORDER BY sort";
	$result = mysql_query($query);

	$i = 0;
	while ($row = mysql_fetch_assoc($result)) {
		print "\n<tr>\n\t<td>Пульт N-</td>\n\t<td>";
		print "<input type=\"text\" name=\"sort[$i]\" size=\"3\" value='";
		print $row['sort'];
		print "'></td>\n\t<td><input type=\"text\" name=\"pultName[$i]\" size=\"50\" value='";
		print $row['name'];
		print "'>\n\t<input type=\"hidden\" name=\"pultID[$i]\" value='";
		print $row['pultID'];
		print "'></td>\n";
		print "\t<td align='center'>";
		print "<input type='checkbox' name=\"del_pult[$i]\" value='";
		print $row['pultID'];
		print "'></td>\n";
		print "</tr>";
		$i++;
	}
	print '</table><p>
<table width="1%">
<tr>
<td><input type="submit" value="Сохранить"></form></td>
<form align="left" action="add_pult.php" method="post">
<td><input type="submit" value="Добавить пульт"></td>
</form>
</tr>
</table></p>';

} else {
	goHome();
}
?>
</body>
</html>
