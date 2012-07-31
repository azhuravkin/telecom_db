<?php
session_start();
include "../lib.php";

if ($_SESSION['writable'] == 'Y') {
	$razdelID = trim($_GET['razdelID']);
	$serviceID = trim($_GET['serviceID']);
	$serviceComment = trim($_GET['serviceComment']);

	// Изменить название службы
	$query = "UPDATE service SET comment = '$serviceComment'
	WHERE serviceID = '$serviceID'";
	mysql_query($query) or die ("Query failed");

	print "<meta http-equiv=\"Refresh\" content=\"1; URL=/db/spr/edit_razdel.php?razdelID=" . $razdelID . "\">";
	print '&nbsp;<div align="center"><h4>Ф.И.О. было изменено.</h4>';
} else {
	goHome();
}
?>
</body>
</html>
