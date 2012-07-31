<?php
session_start();
include "../lib.php";

$id = $_GET['id'];

init_db();

$query = "SELECT * FROM pult_a_menu WHERE id = '$id'";
$result = mysql_query($query);
$row = mysql_fetch_assoc($result);

print "<h3>Пульт N-";
print $row['sort'];
print " - ";
print $row['name'];
print "</h3>";

print '<table class="small" width="100%" cellspacing="1">
<tr>
<th rowspan="2">Ф.И.О.</th>
<th colspan="2">Сторона пульта</th>
<th colspan="2">Сторона абонента</th>
<th rowspan="2">Примечание</th>
</tr>
<tr>
<th>DLU</th>
<th>Кросс</th>
<th>DLU</th>
<th>Кросс</th>
</tr>';

$query = "SELECT * FROM pult_a_data WHERE
pult_a_menu_id = '$id' ORDER BY abonent";
$result = mysql_query($query);

while ($row = mysql_fetch_assoc($result)) {
	print "<tr><td width='25%'>";
	print $row['abonent'] ? $row['abonent'] : "&nbsp;";
	print "</td><td width='10%'>";
	print $row['dlu_pult'] ? $row['dlu_pult'] : "&nbsp;";
	print "</td><td width='10%'>";
	print $row['kross_pult'] ? $row['kross_pult'] : "&nbsp;";
	print "</td><td width='10%'>";
	print $row['dlu_abonent'] ? $row['dlu_abonent'] : "&nbsp;";
	print "</td><td width='10%'>";
	print $row['kross_abonent'] ? $row['kross_abonent'] : "&nbsp;";
	print "</td><td width='35%'>";
	print $row['comment'] ? $row['comment'] : "&nbsp;";
	print "</td></tr>";
}

print "</table>";

if ($_SESSION['writable'] == 'Y') {
	print "<p><form align='left' action='edit_pult.php' method='get'>
<input type='hidden' name='id' value='$id'>
<input type='submit' value='Редактировать'>
</form></p>\n";
}
?>
</body>
</html>
