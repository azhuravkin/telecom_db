<?php
    include "../header.php";

    $value = trim($_GET['search']);

    if (empty($value)) {
	print '<meta http-equiv="Refresh" content="1; URL=/db/pult_d/">&nbsp;
<div align="center"><h4><font color="red">Не указан параметр поиска!</font></h4>';
    } else {
	// Запрос принадлежности поискового параметра к пульту
	$query1 = "SELECT pult_d_menu.pultID, pult_d_menu.sort, pult_d_menu.name
	FROM pult_d_menu, pult_d_data
	WHERE pult_d_data.pultID = pult_d_menu.pultID
	AND pult_d_data.abonent = '$value'
	OR pult_d_data.telephone = '$value'
	OR pult_d_data.pult = '$value'
	OR pult_d_data.sign = '$value'
	OR pult_d_data.pen = '$value'
	ORDER BY pult_d_menu.pultID";

	// Полный запрос
	$query2 = "SELECT * FROM pult_d_data
	WHERE abonent = '$value'
	OR telephone = '$value'
	OR pult = '$value'
	OR sign = '$value'
	OR pen = '$value'
	ORDER BY keyID";

	$result1 = mysql_query($query1);
	$result2 = mysql_query($query2);
	$rows = mysql_num_rows($result2);

	if ((!$rows) || ($rows < 1)) {
	    print '<meta http-equiv="Refresh" content="1; URL=/db/pult_d/">&nbsp;
<div align="center"><h4><font color="red">Объект '.$value.' не найден...</font></h4>';
	} else {
	    $oldID = 0;
	    while (($row1 = mysql_fetch_assoc($result1)) and ($row2 = mysql_fetch_assoc($result2))) {
		$newID = $row1['pultID'];
		if ($newID != $oldID) {
		    print "</table>\n<h3>Пульт N-";
		    print $row1['sort'];
		    print " - ";
		    print $row1['name'];
		    print "</h3>\n";
		    print "<table class='small' width='100%' cellspacing='1'>\n";
		    print "<th>№ кнопки</th>\n";
		    print "<th>Ф.И.О.</th>\n";
		    print "<th>Тел.</th>\n";
		    print "<th>Пульт</th>\n";
		    print "<th>Сигн.</th>\n";
		    print "<th>Pen</th>\n";
		    print "<th>Кросс</th>\n";
		    $oldID = $newID;
		}
		print "<tr>\n\t<td width='10%'>";
		print $row2['key'] ? $row2['key'] : "&nbsp;";
		print "</td>\n\t<td width='40%'>";
		print $row2['abonent'] ? $row2['abonent'] : "&nbsp;";
		print "</td>\n\t<td width='10%'>";
		print $row2['telephone'] ? $row2['telephone'] : "&nbsp;";
		print "</td>\n\t<td width='10%'>";
		print $row2['pult'] ? $row2['pult'] : "&nbsp;";
		print "</td>\n\t<td width='10%'>";
		print $row2['sign'] ? $row2['sign'] : "&nbsp;";
		print "</td>\n\t<td width='10%'>";
		print $row2['pen'] ? $row2['pen'] : "&nbsp;";
		print "</td>\n\t<td width='10%'>";
		print $row2['kross'] ? $row2['kross'] : "&nbsp;";
		print "</td>\n</tr>";
	    }
	    print "</table>\n";
	}
    }

    include "../footer.php";
?>
