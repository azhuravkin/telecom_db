<?php
session_start();
include "../lib.php";

$value = trim($_GET['search']);

if (empty($value)) {
	print '<meta http-equiv="Refresh" content="1; URL=/db/kross/">&nbsp;
<div align="center"><h4><font color="red">Не указан параметр поиска!</font></h4>';
} else {

	// Запрос принадлежности поискового параметра к dlu
	$query1 = "SELECT dlu.dluID, dlu.sort, dlu.name
	FROM dlu, para
	WHERE para.dluID = dlu.dluID
	AND para.telephone = '$value'
	OR para.pult = '$value'
	OR para.sign = '$value'
	OR para.pen = '$value'
	OR para.kross = '$value'
	ORDER BY dlu.dluID";

	// Полный запрос
	$query2 = "SELECT * FROM para
	WHERE telephone = '$value'
	OR pult = '$value'
	OR sign = '$value'
	OR pen = '$value'
	OR kross = '$value'
	ORDER BY dluID";

	$result1 = mysql_query($query1);
	$result2 = mysql_query($query2);
	$rows = mysql_num_rows($result2);

	if ((!$rows) || ($rows < 1)) {
		print '<meta http-equiv="Refresh" content="1; URL=/db/kross/">&nbsp;
<div align="center"><h4><font color="red">Объект ' . $value . ' не найден...</font></h4>';
	} else {
		$oldID = 0;
		while (($row1 = mysql_fetch_assoc($result1)) and ($row2 = mysql_fetch_assoc($result2))) {
			$newID = $row1['dluID'];
			if ($newID != $oldID) {
				print "</table>\n<h3>DLU N-";
				print $row1['sort'];
				print " - ";
				print $row1['name'];
				print "</h3>\n";
				print "<table class='small' width='100%' cellspacing='1'>\n";
				print "<th>Пара</th>\n";
				print "<th>Тел.</th>\n";
				print "<th>Пульт</th>\n";
				print "<th>Сигн.</th>\n";
				print "<th>Pen</th>\n";
				print "<th>Кросс</th>\n";
				print "<th>Абонент</th>\n";
				$oldID = $newID;
			}
			print "<tr>\n\t<td width='5%'>";
			print $row2['para'] ? $row2['para'] : "&nbsp;";
			print "</td>\n\t<td width='7%'>";
			print $row2['telephone'] ? $row2['telephone'] : "&nbsp;";
			print "</td>\n\t<td width='7%'>";
			print $row2['pult'] ? $row2['pult'] : "&nbsp;";
			print "</td>\n\t<td width='7%'>";
			print $row2['sign'] ? $row2['sign'] : "&nbsp;";
			print "</td>\n\t<td width='7%'>";
			print $row2['pen'] ? $row2['pen'] : "&nbsp;";
			print "</td>\n\t<td width='7%'>";
			print $row2['kross'] ? $row2['kross'] : "&nbsp;";
			print "</td>\n\t<td width='60%'>";
			print $row2['abonent'] ? $row2['abonent'] : "&nbsp;";
			print "</td>\n</tr>";
		}
		print "</table>\n";
	}
}
?>
</body>
</html>
