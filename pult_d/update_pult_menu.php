<?php
include "../header.php";

if ($_SESSION['writable'] == 'Y') {
	// Сколько всего пультов в списке
	$query = "SELECT count(*) AS count FROM pult_d_menu";
	$result = mysql_query($query);
	while ($row = mysql_fetch_assoc($result)) {
		$count = $row['count'];
	}

	for ($i = 0; $i < $count; $i++) {
		$pultID = trim($_POST['pultID'][$i]);
		$pultSort = trim($_POST['sort'][$i]);
		$pultName = trim($_POST['pultName'][$i]);

		// Изменить порядковый номер
		$query = "UPDATE pult_d_menu SET sort = '$pultSort'
		WHERE pultID = '$pultID'";
		mysql_query($query) or die ("Query failed");

		// Изменить название пульта
		$query = "UPDATE pult_d_menu SET name = '$pultName'
		WHERE pultID = '$pultID'";
		mysql_query($query) or die ("Query failed");

		// Если был(и) отмечен(ы) чекбокс(ы) 
		if (isset($_POST['del_pult'][$i])) {
			$del_pult = trim($_POST['del_pult'][$i]);

			// Удалить данные из таблицы pult_d_menu
			$query = "DELETE FROM pult_d_menu WHERE pultID = '$del_pult'";
			mysql_query($query) or die ("Query failed");

			// Удалить данные из таблицы pult_d_data
			$query = "DELETE FROM pult_d_data WHERE pultID = '$del_pult'";
			mysql_query($query) or die ("Query failed");
		}
	}
	print '<meta http-equiv="Refresh" content="1; URL=/db/pult_d/">&nbsp;<div align="center"><h4>Изменения успешно сохранены.</h4>';
} else {
	goHome();
}
?>
</body>
</html>
