<?php
    include "../header.php";

    if ($_SESSION['writable'] == 'Y') {
	$string = "";
	$query = "SELECT * FROM `dlu` ORDER BY `sort`";
	$result = mysql_query($query);

	print "<h3>Редактирование списка DLU:</h3>
<table class='small' cellspacing='1'>
<th colspan='3'>Название DLU:</th>
<th>Удалить:</th>
<form action='update_dlu_menu.php' method='post'>";

	while ($row = mysql_fetch_array($result)) {
	    $dluID = $row['dluID'];

	    print "\n<tr>\n\t<td>DLU N-</td>\n\t<td>";
	    print "<input type='text' name='sort[$dluID]' size='2' value='";
	    print $row['sort'];
	    print "'></td>\n\t<td><input type='text' name='dluName[$dluID]' size='50' value='";
	    print $row['name'];
	    print "'></td>\n\t<td align='center'><input type='checkbox' name='del_dlu[$dluID]'></td>\n</tr>";

	    // Сохраняем все данные в переменную для подсчёта контрольной суммы
	    $string .= concat($row);
	}

	// Вычисляем контрольную сумму редактируемых данных
	print "\n<input type='hidden' name='md5sum' value='".md5($string)."'>\n";

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

    include "../footer.php";
?>
