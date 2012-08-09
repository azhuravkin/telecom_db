<?php
    include "../header.php";

    if ($_SESSION['writable'] == 'Y') {
	$pultID = trim($_POST['pultID']);

	if (empty($_POST['key'])) {
	    $query = "SELECT * FROM pult_d_menu WHERE pultID = '$pultID'";
	    $result = mysql_query($query);
	    $row = mysql_fetch_assoc($result);

	    print "<h3>Пульт N-";
	    print $row['sort'];
	    print " - ";
	    print $row['name'];
	    print "</h3>";

	    print '<table class="small" width="100%" cellspacing="1">
<th colspan="3">№ кнопки</th>
<th>Ф.И.О.</th>
<th>Тел.</th>
<th>Пульт</th>
<th>Сигн.</th>
<th>Pen</th>
<th>Кросс</th>';

	    print "<form method='post'>\n";
	    print "<input type='hidden' name='pultID' value='$pultID'>\n";
	    print "<tr><td width='5%'>\n";
	    print "<input type='text' class='text' name='key'>";
	    print "</td>\n\t<td align='center'>-</td><td width='4%'>";
	    print "<input type='text' class='text' name='sort'>";
	    print "</td>\n\t<td width='40%'>";
	    print "<input type='text' class='text' name='abonent'>";
	    print "</td>\n\t<td width='10%'>";
	    print "<input type='text' class='text' name='tel'>";
	    print "</td>\n\t<td width='10%'>";
	    print "<input type='text' class='text' name='pult'>";
	    print "</td>\n\t<td width='10%'>";
	    print "<input type='text' class='text' name='sign'>";
	    print "</td>\n\t<td width='10%'>";
	    print "<input type='text' class='text' name='pen'>";
	    print "</td>\n\t<td width='10%'>";
	    print "<input type='text' class='text' name='kross'>";
	    print "</td>\n</tr>";
	    print "</table>
<p>
<table>
<tr>
<td><input type='submit' value='Добавить'></form></td>
</tr>
</table></p>";
	} else {
	    $key = trim($_POST['key']);
	    $sort = trim($_POST['sort']);
	    $tel = trim($_POST['tel']);
	    $pult = trim($_POST['pult']);
	    $sign = trim($_POST['sign']);
	    $pen = trim($_POST['pen']);
	    $kross = trim($_POST['kross']);
	    $abonent = trim($_POST['abonent']);

	    $query = "INSERT INTO `pult_d_data` VALUES
		(NULL, '$key', '$sort', '$tel', '$pult', '$sign', '$pen', '$kross', '$abonent', '$pultID')";
	    mysql_query($query);

	    print '<meta http-equiv="Refresh" content="1; URL=/db/pult_d/pult.php?pultID=' . $pultID . '">';
	    print '&nbsp;<div align="center"><h4>Кнопка добавлена.</h4>';
	}
    } else {
	goHome();
    }

    include "../footer.php";
?>
