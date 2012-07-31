<?php
session_start();
include "../lib.php";

if ($_SESSION['writable'] == 'Y') {
	$razdelID = $_GET['razdelID'];
	$podrazdelID = $_GET['podrazdelID'];

	if ((empty($_GET["name"])) or (empty($_GET["number"]))) {
		print '<form action='.$_SERVER["PHP_SELF"].' method="get">
<h3>Добавление новой службы:</h3>
<table class="small" cellspacing="1" width="65%">
<th>Название</th>
<th>Ф.И.О.</th>
<th>Номер</th>
<tr>
<td width="50%"><input type="text" class="text" name="name"></td>
<td width="30%"><input type="text" class="text" name="comment"></td>
<td width="20%"><input type="text" class="text" name="number" size="9"></td>
</tr></table>
<p><input type="submit" value="Добавить"></p>
<input type="hidden" name="razdelID" value="'.$razdelID.'">
<input type="hidden" name="podrazdelID" value="'.$podrazdelID.'">
</form>';
	} else {
		$razdelID = $_GET['razdelID'];
		$podrazdelID = $_GET['podrazdelID'];
		$name = trim($_GET['name']);
		$comment = trim($_GET['comment']);
		$number = trim($_GET['number']);

		// Ищем свободный serviceID
		$query = "SELECT MAX(`serviceID`) FROM `service`";
		$serviceID = nextID($query);

		// Ищем свободный numberID
		$query = "SELECT MAX(`numberID`) FROM `number`";
		$numberID = nextID($query);

		// Вставляем данные в таблицу service
		$query = "INSERT INTO service VALUES ('$serviceID','$name','$comment','$podrazdelID','$razdelID')";
		mysql_query($query) or die ("Query failed");

		// Вставляем данные в таблицу number
		$query = "INSERT INTO number VALUES ('$numberID','$number','$serviceID')";
		mysql_query($query) or die ("Query failed");

		print "<meta http-equiv=\"Refresh\" content=\"1; URL=/db/spr/edit_razdel.php?razdelID=" . $razdelID . "\">";
		print '&nbsp;<div align="center"><h4>Новая служба добавлена.</h4>';
	}
} else {
	goHome();
}
?>
</body>
</html>
