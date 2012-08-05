<?php
    include "../header.php";

    $pultID = trim($_GET['pultID']);

    if ($_SESSION['writable'] == 'Y') {
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
<th>Кросс</th>
<th>Удалить:</th>';

	$query = "SELECT * FROM pult_d_data WHERE pultID = '$pultID' ORDER BY `key`, `sort`";
	$result = mysql_query($query);

	print "<form action='update_pult.php' method='post'>\n";
	print "<input type='hidden' name='pultID' value='$pultID'>\n";

	for ($i = 0; $row = mysql_fetch_assoc($result); $i++) {
	    print "<tr>\n\t";
	    print "<input type='hidden' name='keyID[$i]' value='";
	    print $row['keyID'];
	    print "'>\n\t<td width='5%'><input type='text' class='text' name='key[$i]' value='";
	    print $row['key'];
	    print "'></td>\n\t<td align='center'>-";
	    print "</td>\n\t<td width='4%'><input type='text' class='text' name='sort[$i]' value='";
	    print $row['sort'];
	    print "'></td>\n\t<td width='40%'><input type='text' class='text' name='abonent[$i]' value='";
	    print $row['abonent'];
	    print "'></td>\n\t<td width='10%'>";
	    print "<input type='text' class='text' name='tel[$i]' value='";
	    print $row['telephone'];
	    print "'></td>\n\t<td width='10%'>";
	    print "<input type='text' class='text' name='pult[$i]' value='";
	    print $row['pult'];
	    print "'></td>\n\t<td width='10%'>";
	    print "<input type='text' class='text' name='sign[$i]' value='";
	    print $row['sign'];
	    print "'></td>\n\t<td width='10%'>";
	    print "<input type='text' class='text' name='pen[$i]' value='";
	    print $row['pen'];
	    print "'></td>\n\t<td width='10%'>";
	    print "<input type='text' class='text' name='kross[$i]' value='";
	    print $row['kross'];
	    print "'></td>\n\t<td align='center' width='1%'>";
	    print "<input type='checkbox' name='del_key[$i]' value='";
	    print $row['keyID'];
	    print "'></td>\n</tr>";
	}
	print "</table>
<p>
<table width='1%'>
<tr>
<td><input type='submit' value='Сохранить'></form></td>
<form align='left' action='add_key.php' method='post'>
<input type='hidden' name='pultID' value='$pultID'>
<td><input type='submit' value='Добавить кнопку'></td>
</form>	
</tr>
</table></p>";
    } else {
	goHome();
    }

    include "../footer.php";
?>
