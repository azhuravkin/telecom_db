<?php
include "../header.php";

if ($_SESSION['writable'] == 'Y') {
	$razdelID = $_GET['razdelID'];
	$podrazdelID = $_GET['podrazdelID'];

	// Удалить данные из таблицы podrazdel
	$query1 = "DELETE FROM podrazdel WHERE podrazdelID = '$podrazdelID'";
	mysql_query($query1) or die ("Query failed 1");

	// Получить все serviceID, входящие в подраздел
	$query2 = "SELECT serviceID FROM service WHERE podrazdelID = '$podrazdelID'";
	$result = mysql_query($query2) or die ("Query failed 2");

	while ($row = mysql_fetch_assoc($result)) {
		// Удалить данные из таблицы number
		$serviceID = $row['serviceID'];
		$query3 = "DELETE FROM number WHERE serviceID = '$serviceID'";
		mysql_query($query3) or die ("Query failed 3");
	}

	// Удалить данные из таблицы service
	$query4 = "DELETE FROM service WHERE podrazdelID = '$podrazdelID'";
	mysql_query($query4) or die ("Query failed 4");

	print "<meta http-equiv=\"Refresh\" content=\"1; URL=/db/spr/edit_razdel.php?razdelID=" . $razdelID . "\">";
	print '&nbsp;<div align="center"><h4>Подраздел был удалён.</h4>';
} else {
	goHome();
}
?>
</body>
</html>
