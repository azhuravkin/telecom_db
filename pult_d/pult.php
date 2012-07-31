<?php
session_start();
include "../lib.php";

init_db();

$pultID = trim($_GET['pultID']);

$query = "SELECT * FROM pult_d_menu WHERE pultID = '$pultID'";
$result = mysql_query($query);
$row = mysql_fetch_assoc($result);

print "<h3>Пульт N-";
print $row['sort'];
print " - ";
print $row['name'];
print "</h3>";

print '<table class="small" width="100%" cellspacing="1">
<th>№ кнопки</th>
<th>Ф.И.О.</th>
<th>Тел.</th>
<th>Пульт</th>
<th>Сигн.</th>
<th>Pen</th>
<th>Кросс</th>';

$query = "SELECT * FROM `pult_d_data` WHERE `pultID` = '$pultID' ORDER BY `key`, `sort`";
$result = mysql_query($query);

while ($row = mysql_fetch_assoc($result)) {
	print "<tr><td width='10%'>";
	print $row['key']."-".$row['sort'];
	print "</td><td width='40%'>";
	print $row['abonent'] ? $row['abonent'] : "&nbsp;";
	print "</td><td width='10%'>";
	print $row['telephone'] ? $row['telephone'] : "&nbsp;";
	print "</td><td width='10%'>";
	print $row['pult'] ? $row['sign'] : "&nbsp;";
	print "</td><td width='10%'>";
	print $row['sign'] ? $row['sign'] : "&nbsp;";
	print "</td><td width='10%'>";
	print $row['pen'] ? $row['pen'] : "&nbsp;";
	print "</td><td width='10%'>";
	print $row['kross'] ? $row['kross'] : "&nbsp;";
	print "</td></tr>\n";
}
print "</table>";

if ($_SESSION['writable'] == 'Y') {
	print "<p><form align='left' action='edit_pult.php' method='get'>
<input type='hidden' name='pultID' value='$pultID'>
<input type='submit' value='Редактировать'>
</form></p>\n";
}
?>
</body>
</html>
