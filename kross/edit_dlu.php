<?php

$dluID = $_GET['dluID'];
include "../header.php";

if ($_SESSION['writable'] == 'Y') {
    $string = "";
    $query = "SELECT * FROM `dlu` WHERE `dluID` = '$dluID'";
    $result = mysql_query($query);
    $row = mysql_fetch_assoc($result);

    print "<h3>DLU N-";
    print $row['sort'];
    print " - ";
    print $row['name'];
    print "</h3>";

    print "<table class='small' cellspacing='1' width='100%'>\n";
    print "<tr>\n\t<th>Пара</th>\n\t<th>Тел.</th>\n\t<th>Пульт</th>\n\t<th>Сигн.</th>";
    print "\n\t<th>Pen</th>\n\t<th>Кросс</th>\n\t<th>Абонент</th>\n</tr>\n";

    $query = "SELECT * FROM `para` WHERE `dluID` = '$dluID' ORDER BY `para`";
    $result = mysql_query($query);

    print "<form action='update_dlu.php' method='post'>\n";
    print "<input type='hidden' name='dluID' value='$dluID'>\n";

    while ($row = mysql_fetch_array($result)) {
	$paraID = $row['paraID'];

	print "<tr>\n\t<td align='center' width='5%'>";
	print $row['para'];
	print "</td>\n\t<td width='5%'><input type='text' class='text' name='tel[$paraID]' value='";
	print $row['telephone'];
	print "'></td>\n\t<td width='7%'><input type='text' class='text' name='pult[$paraID]' value='";
	print $row['pult'];
	print "'></td>\n\t<td width='7%'><input type='text' class='text' name='sign[$paraID]' value='";
	print $row['sign'];
	print "'></td>\n\t<td width='7%'><input type='text' class='text' name='pen[$paraID]' value='";
	print $row['pen'];
	print "'></td>\n\t<td width='7%'><input type='text' class='text' name='kross[$paraID]' value='";
	print $row['kross'];
	print "'></td>\n\t<td width='62%'><input type='text' class='text' name='abonent[$paraID]' value='";
	print $row['abonent'];
	print "'></td>\n</tr>\n";

	// Сохраняем все данные в переменную для подсчёта контрольной суммы
	$string .= concat($row);
    }

    // Вычисляем контрольную сумму редактируемых данных
    print "<input type='hidden' name='md5sum' value='".md5($string)."'>\n";

    print "</table><p><input type='submit' value='Сохранить'></p>\n</form>";
} else {
    goHome();
}
?>
</body>
</html>
