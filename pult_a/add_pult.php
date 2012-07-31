<?php
session_start();
include "../lib.php";

if ($_SESSION['writable'] == 'Y') {
	if (empty($_GET["pultSort"])) {
		print '<form action='.$_SERVER["PHP_SELF"].' method="get">
<h3>Добавление нового пульта:</h3>
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
		$pultSort = trim($_GET['pultSort']);
		$pultName = trim($_GET['pultName']);

		// Ищем свободный pultID
		$query = "SELECT MAX(`id`) FROM `pult_a_menu`";
		$pultID = nextID($query);

		$query = "INSERT INTO pult_a_menu VALUES ('$pultID','$pultSort','$pultName')";
		mysql_query($query) or die ("Query failed");

		print "<meta http-equiv=\"Refresh\" content=\"1; URL=/db/pult_a/\">";
		print '&nbsp;<div align="center"><h4>Новый пульт был добавлен.</h4>';
	}
} else {
	goHome();
}
?>
</body>
</html>
