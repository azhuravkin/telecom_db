<?php
include "../header.php";

if ($_SESSION['writable'] == 'Y') {
	$razdelID = trim($_GET['razdelID']);
	$numberID = trim($_GET['numberID']);
	$number = trim($_GET['number']);

	// Изменить телефонный номер
	$query = "UPDATE number SET telephone = '$number'
	WHERE numberID = '$numberID'";
	mysql_query($query) or die ("Query failed");

	print "<meta http-equiv=\"Refresh\" content=\"1; URL=/db/spr/edit_razdel.php?razdelID=" . $razdelID . "\">";
	print '&nbsp;<div align="center"><h4>Телефонный номер был изменён.</h4>';
} else {
	goHome();
}
?>
</body>
</html>
