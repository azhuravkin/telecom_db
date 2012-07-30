<?
session_start();
include "../lib.php";

if (isset($_SESSION['valid_user'])) {
	init_db();

	if (empty($_POST["pultSort"])) {
		print '<form action=' . $_SERVER["PHP_SELF"] . ' method="post">
<h3>Добавление нового цифрового пульта:</h3>
<table class="small" cellspacing="1">
<th colspan="3">Название пульта:</th>
<tr>
<td>Пульт N-</td>
<td><input type="text" name="pultSort" size="3"></td>
<td><input type="text" name="pultName" size="50"></td>
</tr></table>
<p><input type="submit" value="Добавить"></p>
</form>';
	} else {
		$pultSort = trim($_POST['pultSort']);
		$pultName = trim($_POST['pultName']);

		// Ищем свободный pultID
		$query = "SELECT MAX(`pultID`) FROM `pult_d_menu`";
		$pultID = nextID($query);

		$query = "INSERT INTO pult_d_menu VALUES ($pultID, '$pultSort', '$pultName')";
		mysql_query($query) or die ("Query failed");

		print '<meta http-equiv="Refresh" content="1; URL=/db/pult_d/">&nbsp;<div align="center"><h4>Новый пульт добавлен.</h4>';
	}
} else {
	goHome();
}
?>
</body>
</html>
