<?php
session_start();
include "../lib.php";

init_db();

$fio = trim($_GET['fio']);

if (empty($fio)) {
	print "<meta http-equiv=\"Refresh\" content=\"1; URL=/db/pult_a/\">";
	print '&nbsp;<div align="center"><h4><font color="red">Не указан параметр для поиска!</font></h4>';
} else {
	// Запрос принадлежности фамилии к пульту
	$query1 = "SELECT pult_a_menu.sort, pult_a_menu.name
	FROM pult_a_menu, pult_a_data
	WHERE pult_a_data.pult_a_menu_id = pult_a_menu.id AND
	pult_a_data.abonent LIKE '$fio%'
	ORDER BY pult_a_menu.sort";

	// Полный запрос
	$query2 = "SELECT pult_a_data.abonent, pult_a_data.dlu_pult,
	pult_a_data.kross_pult, pult_a_data.dlu_abonent,
	pult_a_data.kross_abonent, pult_a_data.comment,
	pult_a_data.pult_a_menu_id
	FROM pult_a_data, pult_a_menu
	WHERE pult_a_data.abonent LIKE '$fio%'
	ORDER BY pult_a_menu.sort";

	$result1 = mysql_query($query1);
	$result2 = mysql_query($query2);
	$rows = mysql_num_rows($result2);

	if ((!$rows) || ($rows < 1)) {
		print "&nbsp;<div align=\"center\"><h4><font color=\"red\">Фамилия $fio в базе данных отсутствует...</font></h4></div>\n";
	} else {
		$oldID = 0;
		while (($row1 = mysql_fetch_assoc($result1)) and ($row2 = mysql_fetch_assoc($result2))) {
			$newID = $row2['pult_a_menu_id'];
			if ($newID != $oldID) {
				print "</td>\n</tr>\n</table>\n<h3>Пульт N-";
				print $row1['sort'];
				print " - ";
				print $row1['name'];
				print "</h3>\n";
				print "<table class='small' width='100%' cellspacing='1'>\n";
				print "<tr><th rowspan='2'>Ф.И.О.</th>";
				print "<th colspan='2'>Сторона пульта</th>";
				print "<th colspan='2'>Сторона абонента</th>";
				print "<th rowspan='2'>Примечание</th></tr>";
				print "<tr><th>DLU</th>";
				print "<th>Кросс</th>";
				print "<th>DLU</th>";
				print "<th>Кросс</th></tr>";
				print "<tr><td width='25%'>";
				print $row2['abonent'] ? $row2['abonent'] : "&nbsp;";
				print "</td>\n<td width='10%'>";
				print $row2['dlu_pult'] ? $row2['dlu_pult'] : "&nbsp;";
				print "</td>\n<td width='10%'>";
				print $row2['kross_pult'] ? $row2['kross_pult'] : "&nbsp;";
				print "</td>\n<td width='10%'>";
				print $row2['dlu_abonent'] ? $row2['dlu_abonent'] : "&nbsp;";
				print "</td>\n<td width='10%'>";
				print $row2['kross_abonent'] ? $row2['kross_abonent'] : "&nbsp;";
				print "</td>\n<td width='35%'>";
				print $row2['comment'] ? $row2['comment'] : "&nbsp;";
				print "</td>\n</tr>";

				$oldID = $newID;
			} else {
				print "<tr><td>";
				print $row2['abonent'] ? $row2['abonent'] : "&nbsp;";
				print "</td><td>";
				print $row2['dlu_pult'] ? $row2['dlu_pult'] : "&nbsp;";
				print "</td>\n<td>";
				print $row2['kross_pult'] ? $row2['kross_pult'] : "&nbsp;";
				print "</td>\n<td>";
				print $row2['dlu_abonent'] ? $row2['dlu_abonent'] : "&nbsp;";
				print "</td>\n<td>";
				print $row2['kross_abonent'] ? $row2['kross_abonent'] : "&nbsp;";
				print "</td>\n<td>";
				print $row2['comment'] ? $row2['comment'] : "&nbsp;";
				print "</td>\n</tr>";
			}
		}
		print "</table>\n";
	}
}
?>
</body>
</html>
