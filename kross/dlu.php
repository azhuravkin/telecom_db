<?php
    $dluID = $_GET['dluID'];
    include "../header.php";

    $query = "SELECT * FROM dlu WHERE dluID = '$dluID'";
    $result = mysql_query($query);
    $row = mysql_fetch_assoc($result);

    print "<h3>DLU N-";
    print $row['sort'];
    print " - ";
    print $row['name'];
    print "</h3>";

    print '<table class="small" cellspacing="1" width="100%">
<th>Пара</th>
<th>Телефон</th>
<th>Пульт</th>
<th>Сигн.</th>
<th>Pen</th>
<th>Кросс</th>
<th>Абонент</th>';

    $query = "SELECT * FROM para WHERE dluID = '$dluID' ORDER BY para";
    $result = mysql_query($query);

    while ($row = mysql_fetch_assoc($result)) {
	print "<tr><td width='5%' align='center'><p>";
	print $row['para'];
	print "</p></td>\n<td width='5%'><p>";
	print $row['telephone'] ? $row['telephone'] : "&nbsp;";
	print "</p></td>\n<td width='7%'><p>";
	print $row['pult'] ? $row['pult'] : "&nbsp;";
	print "</p></td>\n<td width='7%'><p>";
	print $row['sign'] ? $row['sign'] : "&nbsp;";
	print "</p></td>\n<td width='7%'><p>";
	print $row['pen'] ? $row['pen'] : "&nbsp;";
	print "</p></td>\n<td width='7%'><p>";
	print $row['kross'] ? $row['kross'] : "&nbsp;";
	print "</p></td>\n<td width='60%'><p>";
	print $row['abonent'] ? $row['abonent'] : "&nbsp;";
	print "</p></td></tr>\n";
    }

    print "</table>";

    if ($_SESSION['writable'] == 'Y') {
	print "<p><form align='left' action='edit_dlu.php' method='get'>
<input type='hidden' name='dluID' value='$dluID'>
<input type='submit' value='Редактировать'>
</form></p>\n";
    }

    include "../footer.php";
?>
