<?php
    include "../header.php";

    if ($_SESSION['writable'] == 'Y') {
	$razdelID = trim($_GET['razdelID']);
	$serviceID = trim($_GET['serviceID']);
	$serviceName = trim($_GET['serviceName']);

	// Изменить название службы
	$query = "UPDATE service SET name = '$serviceName'
	    WHERE serviceID = '$serviceID'";
	mysql_query($query) or die ("Query failed");

	print "<meta http-equiv=\"Refresh\" content=\"1; URL=/db/spr/edit_razdel.php?razdelID=" . $razdelID . "\">";
	print '&nbsp;<div align="center"><h4>Название службы было изменено.</h4>';
    } else {
	goHome();
    }

    include "../footer.php";
?>
