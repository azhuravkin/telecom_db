<?php
session_start();
include "../lib.php";

if ($_SESSION['writable'] == 'Y') {
    // Сравниваем контрольные суммы данных перед изменениями
    if ($_POST['md5sum'] != md5_count("SELECT * FROM `dlu` ORDER BY `sort`")) {
	print '<div align="center"><h4><font color="red">Информация в этом меню была обновлена другим пользователем!!!</font></h4>';
    } else {
	// Сколько всего DLU в списке
	$query = "SELECT count(*) AS count FROM dlu";
	$result = mysql_query($query);

	while ($row = mysql_fetch_assoc($result)) {
	    $count = $row['count'];
	}

	for ($i = 0; $i < $count; $i++) {
	    $dluID = $_POST['dluID'][$i];
	    $dluSort = trim($_POST['sort'][$i]);
	    $dluName = trim($_POST['dluName'][$i]);

	    // Изменить порядковый номер
	    $query = "UPDATE `dlu` SET `sort` = '$dluSort'";

	    // Изменить название раздела
	    $query .= ", `name` = '$dluName' WHERE `dluID` = '$dluID'";

	    mysql_query($query) or die ("Query failed");

	    // Если было отмечено удаление
	    if (isset($_POST['del_dlu'][$i])) {
		$del_dlu = $_POST['del_dlu'][$i];

		// Удалить данные из таблицы dlu
		$query = "DELETE FROM `dlu` WHERE `dluID` = '$del_dlu'";
		mysql_query($query) or die ("Query failed");

		// Удалить данные из таблицы para
		$query = "DELETE FROM `para` WHERE `dluID` = '$del_dlu'";
		mysql_query($query) or die ("Query failed");
	    }
	}
	print '<meta http-equiv="Refresh" content="1; URL=/db/kross/">&nbsp;<div align="center"><h4>Изменения успешно сохранены.</h4>';
    }
} else {
	goHome();
}
?>
</body>
</html>
