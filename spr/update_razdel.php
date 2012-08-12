<?php
    include "../header.php";

    if ($_SESSION['writable'] == 'Y') {
	$razdelID = $_POST['razdelID'];

	// Сравниваем контрольные суммы данных перед изменениями
	if (($_POST['md5sum_podrazdel'] != md5_count("SELECT * FROM `podrazdel` WHERE `razdelID` = '$razdelID' ORDER BY `podrazdelID`")) or
		($_POST['md5sum_service'] != md5_count("SELECT `service`.*, `number`.`numberID`, `number`.`telephone` FROM `podrazdel`, `service`
		    LEFT JOIN `number` ON `number`.`serviceID` = `service`.`serviceID`
		    WHERE `service`.`podrazdelID` = `podrazdel`.`podrazdelID` AND `podrazdel`.`razdelID` = '$razdelID'
		    ORDER BY `podrazdel`.`podrazdelID`, `service`.`serviceID`, `number`.`telephone`"))) {
	    print '<div align="center"><h4><font color="red">Информация в этом разделе была обновлена другим пользователем!!!</font></h4>';
	} else {
	    foreach ($_POST['podrazdelName'] as $podrazdelID => $podrazdel) {
		$podrazdelName = trim($podrazdel);

		// Изменить название подраздела
		$query = "UPDATE `podrazdel` SET `name` = '$podrazdelName' WHERE `podrazdelID` = '$podrazdelID'";
		mysql_query($query) or die ("Query failed 1");

		foreach ($_POST['serviceName'][$podrazdelID] as $serviceID => $service) {
		    $serviceName = trim($service);
		    $serviceComment = trim($_POST['serviceComment'][$podrazdelID][$serviceID]);

		    // Изменить название и комментарий службы
		    $query = "UPDATE `service` SET `name` = '$serviceName', `comment` = '$serviceComment'
			WHERE `serviceID` = '$serviceID'";
		    mysql_query($query) or die ("Query failed 2");
		}

		foreach ($_POST['number'][$podrazdelID] as $numberID => $number) {
		    $telephone = trim($number);

		    // Изменить телефонный номер
		    $query = "UPDATE `number` SET `telephone` = '$telephone' WHERE `numberID` = '$numberID'";
		    mysql_query($query) or die ("Query failed 3");
		}

		foreach ($_POST['new_number'][$podrazdelID] as $serviceID => $number) {
		    $telephone = trim($number);

		    if (strlen($telephone)) {
			// Добавить новый номер для службы
			$query = "INSERT INTO `number` VALUES (NULL, '$telephone', '$serviceID')";
			mysql_query($query) or die ("Query failed 4");
		    }
		}

		if (isset($_POST['del_number'][$podrazdelID])) {
		    foreach ($_POST['del_number'][$podrazdelID] as $numberID => $val) {
			// Удалить номер
			$query = "DELETE FROM `number` WHERE `numberID` = '$numberID'";
			mysql_query($query) or die ("Query failed 5");
		    }
		}

		if (isset($_POST['del_service'][$podrazdelID])) {
		    foreach ($_POST['del_service'][$podrazdelID] as $serviceID => $val) {
			// Удалить телефоны, принадлежащие этому сервису
			$query = "DELETE FROM `number` WHERE `serviceID` = '$serviceID'";
			mysql_query($query) or die ("Query failed 6");

			// Удалить данные из таблицы service
			$query = "DELETE FROM `service` WHERE `serviceID` = '$serviceID'";
			mysql_query($query) or die ("Query failed 7");
		    }
		}

		if (isset($_POST['del_podrazdel'][$podrazdelID])) {
		    // Удалить данные из таблицы podrazdel
		    $query = "DELETE FROM `podrazdel` WHERE `podrazdelID` = '$podrazdelID'";
		    mysql_query($query) or die ("Query failed 8");

		    // Получить все сервисы, входящие в подраздел
		    $query = "SELECT `serviceID` FROM `service` WHERE `podrazdelID` = '$podrazdelID'";
		    $result = mysql_query($query) or die ("Query failed 9");

		    while ($row = mysql_fetch_assoc($result)) {
			$serviceID = $row['serviceID'];

			// Удалить телефоны, принадлежащие этим сервисам
			$query = "DELETE FROM `number` WHERE `serviceID` = '$serviceID'";
			mysql_query($query) or die ("Query failed 10");
		    }

		    // Удалить данные из таблицы service
		    $query = "DELETE FROM `service` WHERE `podrazdelID` = '$podrazdelID'";
		    mysql_query($query) or die ("Query failed 11");
		}
	    }

	    print "<meta http-equiv=\"Refresh\" content=\"1; URL=razdel.php?razdelID=$razdelID\">";
	    print '&nbsp;<div align="center"><h4>Изменения были сохранены.</h4>';
	}
    } else {
	goHome();
    }

    include "../footer.php";
?>
