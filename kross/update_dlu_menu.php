<?php
    include "../header.php";

    if ($_SESSION['writable'] == 'Y') {
	// Сравниваем контрольные суммы данных перед изменениями
	if ($_POST['md5sum'] != md5_count("SELECT * FROM `dlu` ORDER BY `sort`")) {
	    print '<div align="center"><h4><font color="red">Информация в этом меню была обновлена другим пользователем!!!</font></h4>';
	} else {
	    foreach ($_POST['sort'] as $dluID => $sort) {
		$dluSort = trim($sort);
		$dluName = trim($_POST['dluName'][$dluID]);

		// Изменить порядковый номер
		$query = "UPDATE `dlu` SET `sort` = '$dluSort'";

		// Изменить название раздела
		$query .= ", `name` = '$dluName' WHERE `dluID` = '$dluID'";

		mysql_query($query) or die ("Query failed");

		// Если было отмечено удаление
		if (isset($_POST['del_dlu'][$dluID])) {
		    // Удалить данные из таблицы dlu
		    $query = "DELETE FROM `dlu` WHERE `dluID` = '$dluID'";
		    mysql_query($query) or die ("Query failed");

		    // Удалить данные из таблицы para
		    $query = "DELETE FROM `para` WHERE `dluID` = '$dluID'";
		    mysql_query($query) or die ("Query failed");
		}
	    }

	    print '<meta http-equiv="Refresh" content="1; URL=/db/kross/">&nbsp;<div align="center"><h4>Изменения успешно сохранены.</h4>';
	}
    } else {
	goHome();
    }

    include "../footer.php";
?>
