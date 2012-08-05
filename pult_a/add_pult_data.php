<?php

$id = $_GET['id'];
include "../header.php";

if ($_SESSION['writable'] == 'Y') {
	if (empty($_POST['abonent'])) {
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

		print "<form action=".$_SERVER["PHP_SELF"]."?id=".$id." method='post'>\n";
		print "<input type='hidden' name='id' value='$id'>";
		print "<tr><td width='25%'>
<input type='text' class='text' name='abonent'>
</td><td width='10%'>
<input type='text' class='text' name='dlu_pult'>
</td><td width='10%'>
<input type='text' class='text' name='kross_pult'>
</td><td width='10%'>
<input type='text' class='text' name='dlu_abonent'>
</td><td width='10%'>
<input type='text' class='text' name='kross_abonent'>
</td><td width='35%'>
<input type='text' class='text' name='comment'>
</td></tr>";
		print "</table><p><input type='submit' value='Добавить запись'></form></p>\n";
	} else {
		$abonent = trim($_POST['abonent']);
		$dlu_pult = trim($_POST['dlu_pult']);
		$kross_pult = trim($_POST['kross_pult']);
		$dlu_abonent = trim($_POST['dlu_abonent']);
		$kross_abonent = trim($_POST['kross_abonent']);
		$comment = trim($_POST['comment']);
		$id = $_POST['id'];

		$query = "INSERT INTO pult_a_data VALUES
		(NULL,'$abonent','$dlu_pult','$kross_pult',
		'$dlu_abonent','$kross_abonent','$comment','$id')";
		mysql_query($query) or die ("Query failed");

		print "<meta http-equiv=\"Refresh\" content=\"1; URL=/db/pult_a/pult.php?id=".$id."\">";
		print '&nbsp;<div align="center"><h4>Новые данные были добавлены.</h4>';
	}
} else {
	goHome();
}
?>
</body>
</html>
