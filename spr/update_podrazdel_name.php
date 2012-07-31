<?php
session_start();
include "../lib.php";

if ($_SESSION['writable'] == 'Y') {
	init_db();

	$razdelID = trim($_POST['razdelID']);
	$podrazdelID = trim($_POST['podrazdelID']);
	$podrazdelName = trim($_POST['podrazdelName']);

	// Изменить название подраздела
	$query = "UPDATE podrazdel SET name = '$podrazdelName'
	WHERE podrazdelID = '$podrazdelID'";
	mysql_query($query) or die ("Query failed");

	print "<meta http-equiv=\"Refresh\" content=\"1; URL=edit_razdel.php?razdelID=$razdelID\">";
	print '&nbsp;<div align="center"><h4>Название подраздела было изменено.</h4>';
} else {
	goHome();
}
?>
</body>
</html>
