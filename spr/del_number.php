<?php
    include "../header.php";

    if ($_SESSION['writable'] == 'Y') {
	$razdelID = trim($_GET['razdelID']);
	$numberID = trim($_GET['numberID']);

	// Какой службе принадлежит номер
	$query = "SELECT serviceID FROM number WHERE numberID = '$numberID'";
	$result = mysql_query($query) or die ("Query failed");

	while ($row = mysql_fetch_assoc($result)) {
	    $serviceID = $row['serviceID'];
	}

	// Сколько номеров принадлежит этой службе
	$query = "SELECT numberID FROM number WHERE serviceID = '$serviceID'";
	$results = mysql_query($query) or die ("Query failed");
	$rows = mysql_num_rows($results);

	// Если у данной службы только один номер:
	if ($rows == 1) {
	    // Какому подразделу принадлежит служба
	    $query = "SELECT podrazdelID FROM service WHERE serviceID = '$serviceID'";
	    $result = mysql_query($query) or die ("Query failed");

	    while ($row = mysql_fetch_assoc($result)) {
		$podrazdelID = $row['podrazdelID'];
	    }

	    // Сколько служб принадлежит данному подразделу
	    $query = "SELECT serviceID FROM service WHERE podrazdelID = '$podrazdelID'";
	    $results = mysql_query($query) or die ("Query failed");
	    $rows = mysql_num_rows($results);

	    // Если у данного подраздела только одна служба:
	    if ($rows == 1) {
		$query = "DELETE FROM podrazdel WHERE podrazdelID = '$podrazdelID'";
		mysql_query($query) or die ("Query failed");
	    }

	    $query = "DELETE FROM service WHERE serviceID = '$serviceID'";
	    mysql_query($query) or die ("Query failed");
	}

	// Удалить телефонный номер
	$query = "DELETE FROM number WHERE numberID = '$numberID'";
	mysql_query($query) or die ("Query failed");

	print "<meta http-equiv=\"Refresh\" content=\"1; URL=/db/spr/edit_razdel.php?razdelID=" . $razdelID . "\">";
	print '&nbsp;<div align="center"><h4>Телефонный номер или служба была удалёна.</h4>';
    } else {
	goHome();
    }

    include "../footer.php";
?>
