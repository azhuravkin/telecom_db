<?php
session_start();
include "../lib.php";

if (isset($_SESSION['valid_user'])) {
	init_db();

	$razdelID = $_GET['razdelID'];

	if (empty($_GET['telephone'])) {

		print "<meta http-equiv=\"Refresh\" content=\"1; URL=/db/spr/edit_razdel.php?razdelID=" . $razdelID . "\">";
		print '&nbsp;<div align="center"><h4>Не указан телефонный номер!</h4>';
	} else {
		$razdelID = $_GET['razdelID'];
		$serviceID = $_GET['serviceID'];
		$telephone = trim($_GET['telephone']);

		// Ищем свободный numberID
		$query = "SELECT MAX(`numberID`) FROM `number`";
		$numberID = nextID($query);

		// Добавить телефонный номер в данную службу
		$query = "INSERT INTO number VALUES ('$numberID','$telephone','$serviceID')";
		mysql_query($query) or die ("Query failed");


		print "<meta http-equiv=\"Refresh\" content=\"1; URL=/db/spr/edit_razdel.php?razdelID=". $razdelID . "\">";
		print '&nbsp;<div align="center"><h4>Телефонный номер добавлен.</h4>';
	}
} else {
	goHome();
}
?>
</body>
</html>
