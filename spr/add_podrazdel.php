<?
session_start();
include "../lib.php";

if (isset($_SESSION['valid_user'])) {
	init_db();

	$razdelID = $_GET['razdelID'];

	if (empty($_GET["podrazdel"]) or (empty($_GET["name"])) or (empty($_GET["number"]))) {
		print '<form action='.$_SERVER["PHP_SELF"].' method="get">
<h3><table align="center">
<tr><td><input type="text" name="podrazdel" size="40"></td></tr>
</table></h3>
<table class="small" cellspacing="1" width="65%">
<th>Название</th>
<th>Ф.И.О.</th>
<th>Номер</th>
<tr>
<td width="50%"><input type="text" class="text" name="name"></td>
<td width="30%"><input type="text" class="text" name="comment"></td>
<td width="20%"><input type="text" class="text" name="number"></td>
</tr></table>
<p><input type="submit" value="Добавить"></p>
<input type="hidden" name="razdelID" value="'.$razdelID.'">
</form>';
	} else {
		$razdelID = $_GET['razdelID'];
		$podrazdel = trim($_GET['podrazdel']);
		$name = trim($_GET['name']);
		$comment = trim($_GET['comment']);
		$number = trim($_GET['number']);

		// Ищем свободный podrazdelID
		$query = "SELECT podrazdelID AS id FROM podrazdel ORDER BY podrazdelID";
		$podrazdelID = freeID($query);

		// Ищем свободный serviceID
		$query = "SELECT serviceID AS id FROM service ORDER BY serviceID";
		$serviceID = freeID($query);

		// Ищем свободный numberID
		$query = "SELECT numberID AS id FROM number ORDER BY numberID";
		$numberID = freeID($query);

		// Вставляем данные в таблицу podrazdel
		$query = "INSERT INTO podrazdel VALUES ('$podrazdelID','$podrazdel')";
		mysql_query($query) or die ("Query failed");

		// Вставляем данные в таблицу service
		$query = "INSERT INTO service VALUES ('$serviceID','$name','$comment','$podrazdelID','$razdelID')";
		mysql_query($query) or die ("Query failed");

		// Вставляем данные в таблицу number
		$query = "INSERT INTO number VALUES ('$numberID','$number','$serviceID')";
		mysql_query($query) or die ("Query failed");

		print "<meta http-equiv=\"Refresh\" content=\"1; URL=/db/spr/edit_razdel.php?razdelID=" . $razdelID . "\">";
		print '&nbsp;<div align="center"><h4>Новый подраздел был добавлен.</h4>';
	}
} else {
	goHome();
}
?>
</body>
</html>
