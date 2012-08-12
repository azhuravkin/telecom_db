<?php
    include "../header.php";

    if ($_SESSION['writable'] == 'Y') {
	// Сравниваем контрольные суммы данных перед изменениями
	if ($_POST['md5sum'] != md5_count("SELECT * FROM `razdel` ORDER BY `name`")) {
	    print '<div align="center"><h4><font color="red">Информация в этом меню была обновлена другим пользователем!!!</font></h4>';
	} else {
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

		    // Удалить данные из таблицы podrazdel
		    $query = "DELETE FROM `podrazdel` WHERE `razdelID` = '$razdelID'";
		    mysql_query($query) or die ("Query failed 2");

		    // Получить все serviceID, входящие в раздел
		    $query = "SELECT `service`.`serviceID` FROM `service`, `podrazdel`
			WHERE `service`.`podrazdelID` = `podrazdel`.`podrazdelID` AND `podrazdel`.`razdelID` = '$razdelID'";
		    $result = mysql_query($query) or die ("Query failed 3");

		    while ($row = mysql_fetch_array($result)) {
			// Удалить данные из таблицы number
			$serviceID = $row['serviceID'];
			$query = "DELETE FROM `number` WHERE `serviceID` = '$serviceID'";
			mysql_query($query) or die ("Query failed 4");

			// Удалить данные из таблицы service
			$query = "DELETE FROM `service` WHERE `serviceID` = '$serviceID'";
			mysql_query($query) or die ("Query failed 5");
		    }
		}
	    }
	    print "<meta http-equiv=\"Refresh\" content=\"1; URL=/db/spr/\">";
	    print '&nbsp;<div align="center"><h4>Изменения были сохранены.</h4>';
	}
    } else {
	goHome();
    }

    include "../footer.php";
?>
