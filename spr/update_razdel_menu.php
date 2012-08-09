<?php
    include "../header.php";

    if ($_SESSION['writable'] == 'Y') {
	foreach ($_POST['razdelName'] as $razdelID => $name) {
	    $razdelName = trim($name);

	    // Изменить название раздела
	    $query = "UPDATE `razdel` SET `name` = '$razdelName' WHERE `razdelID` = '$razdelID'";
	    mysql_query($query) or die ("Query failed");

	    // Если был отмечен чекбокс удаления
	    if (isset($_POST['del_razdelID'][$razdelID])) {
		// Удалить данные из таблицы razdel
		$query = "DELETE FROM `razdel` WHERE `razdelID` = '$razdelID'";
		mysql_query($query) or die ("Query failed 1");

		// Получить все podrazdelID, входящие в раздел
		$query = "SELECT `podrazdelID` FROM `service` WHERE `razdelID` = '$razdelID'";
		$result = mysql_query($query) or die ("Query failed 2");

		while ($row = mysql_fetch_array($result)) {
		    // Удалить данные из таблицы podrazdel
		    $podrazdelID = $row['podrazdelID'];
		    $query = "DELETE FROM `podrazdel` WHERE `podrazdelID` = '$podrazdelID'";
		    mysql_query($query) or die ("Query failed 3");
		}

		// Получить все serviceID, входящие в раздел
		$query = "SELECT `serviceID` FROM `service` WHERE `razdelID` = '$razdelID'";
		$result = mysql_query($query) or die ("Query failed 4");

		while ($row = mysql_fetch_array($result)) {
		    // Удалить данные из таблицы number
		    $serviceID = $row['serviceID'];
		    $query = "DELETE FROM `number` WHERE `serviceID` = '$serviceID'";
		    mysql_query($query) or die ("Query failed 5");
		}

		// Удалить данные из таблицы service
		$query = "DELETE FROM `service` WHERE `razdelID` = '$razdelID'";
		mysql_query($query) or die ("Query failed 6");
	    }
	}

	print "<meta http-equiv=\"Refresh\" content=\"1; URL=/db/spr/\">";
	print '&nbsp;<div align="center"><h4>Изменения были сохранены.</h4>';
    } else {
	goHome();
    }

    include "../footer.php";
?>
