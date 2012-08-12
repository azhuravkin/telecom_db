<?php
    include "../header.php";

    if ($_SESSION['writable'] == 'Y') {
	$string = "";
	print "<h3>Редактирование разделов справки:</h3>\n";
	print "<table class='small' cellspacing='1'>\n<tr>\n\t";
	print "<th>Название раздела:</th>\n\t<th>Удалить:</th>\n</tr>\n";
	print "<form action='update_razdel_menu.php' method='post'>\n";

	$query = "SELECT * FROM `razdel` ORDER BY `name`";
	$result = mysql_query($query);

	while ($row = mysql_fetch_array($result)) {
	    $razdelID = $row['razdelID'];
	    print "<tr>\n\t<td>";
	    print "<input type='text' name=\"razdelName[$razdelID]\" size='40' value='";
	    print $row['name'];
	    print "'></td>\n\t<td align='center'><input type='checkbox' name=\"del_razdelID[$razdelID]\" value='";
	    print $row['razdelID'];
	    print "'></td>\n</tr>\n";

	    // Сохраняем все данные в переменную для подсчёта контрольной суммы
	    $string .= concat($row);
	}

	// Вычисляем контрольную сумму редактируемых данных
	print "<input type='hidden' name='md5sum' value='".md5($string)."'>\n";

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

    include "../footer.php";
?>
