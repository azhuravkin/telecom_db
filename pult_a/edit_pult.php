<?php
session_start();

$id = $_GET['id'];
include "../lib.php";

if (isset($_SESSION['valid_user'])) {
	init_db();

	$query = "SELECT * FROM pult_a_menu WHERE id = '$id'";
	$result = mysql_query($query);
	$row = mysql_fetch_assoc($result);

	print "<h3>Пульт N-";
	print $row['sort'];
	print " - ";
	print $row['name'];
	print "</h3>";

	print '<table class="small" width="100%" cellspacing="1">
<tr>
<th rowspan="2">Ф.И.О.</th>
<th colspan="2">Сторона пульта</th>
<th colspan="2">Сторона абонента</th>
<th rowspan="2">Примечание</th>
<th rowspan="2">Удалить</th>
</tr>
<tr>
<th>DLU</th>
<th>Кросс</th>
<th>DLU</th>
<th>Кросс</th>
</tr>';

	$query = "SELECT * FROM pult_a_data WHERE pult_a_menu_id = '$id' ORDER BY abonent";
	$result = mysql_query($query);

	print '<form action="update_pult_data.php" method="post">';
	print "\n<input type=\"hidden\" name=\"id\" value=\"$id\">";

	$i = 0;
	while ($row = mysql_fetch_assoc($result)) {
		print "\n<tr>\n\t";
		print "<input type='hidden' name='pultID[$i]' value='";
		print $row['id'];
		print "'>\n<td width='25%'>";
		print "<input type='text' class='text' name='abonent[$i]' value='";
		print $row['abonent'];
		print "'></td>\n<td width='10%'>";
		print "<input type='text' class='text' name='dlu_pult[$i]' value='";
		print $row['dlu_pult'];
		print "'></td>\n<td width='10%'>";
		print "<input type='text' class='text' name='kross_pult[$i]' value='";
		print $row['kross_pult'];
		print "'></td>\n<td width='10%'>";
		print "<input type='text' class='text' name='dlu_abonent[$i]' value='";
		print $row['dlu_abonent'];
		print "'></td>\n<td width='10%'>";
		print "<input type='text' class='text' name='kross_abonent[$i]' value='";
		print $row['kross_abonent'];
		print "'></td>\n<td width='30%'>";
		print "<input type='text' class='text' name='comment[$i]' value='";
		print $row['comment'];
		print "'></td>\n";
		print "<td align='center' width='5%'>";
		print "<input type='checkbox' name='del_pult_data[$i]' value='";
		print $row['id'];
		print "'>\n</td></tr>";
		$i++;
	}
	print "</table>
<p><table width='1%'><tr><td><input type='submit' value='Сохранить'>
</td></form><form action='add_pult_data.php' method='get'>
<td><input type='hidden' name='id' value='$id'>
<input type='submit' value='Добавить запись'>
</form></td></tr></table></p>\n";
} else {
	goHome();
}
?>
</body>
</html>
