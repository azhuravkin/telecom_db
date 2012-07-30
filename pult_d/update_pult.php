<?
session_start();
include "../lib.php";

if (isset($_SESSION['valid_user'])) {
	init_db();

	$pultID = trim($_POST['pultID']);

	// Получить количество записей в пульте
	$query = "SELECT count(*) AS count FROM pult_d_data WHERE pultID = '$pultID'";
	$result = mysql_query($query);
	while ($row = mysql_fetch_assoc($result)) {
		$count = $row['count'];
	}

	for ($i = 0; $i < $count; $i++) {
		$keyID = trim($_POST['keyID'][$i]);
		$key = trim($_POST['key'][$i]);
		$sort = trim($_POST['sort'][$i]);
		$abonent = trim($_POST['abonent'][$i]);
		$tel = trim($_POST['tel'][$i]);
		$pult = trim($_POST['pult'][$i]);
		$sign = trim($_POST['sign'][$i]);
		$pen = trim($_POST['pen'][$i]);
		$kross = trim($_POST['kross'][$i]);

		// Вносим изменения в таблицу puld_d_data
		$query = "UPDATE `pult_d_data` SET `key` = '$key', `sort` = '$sort', `telephone` = '$tel', `pult` = '$pult',
		`sign` = '$sign', `pen` = '$pen', `kross` = '$kross', `abonent` = '$abonent' WHERE `keyID` = '$keyID'";
		mysql_query($query) or die("Query failed");

		// Если был(и) отмечен(ы) чекбокс(ы)
		if (isset($_POST['del_key'][$i])) {
			$del_key = $_POST['del_key'][$i];

			// Удалить данные из таблицы pult_d_data
			$query = "DELETE FROM pult_d_data WHERE keyID = '$del_key'";
			mysql_query($query) or die ("Query failed");
		}
	}

	print '<meta http-equiv="Refresh" content="1; URL=/db/pult_d/pult.php?pultID=' . $pultID . '">&nbsp;
<div align="center"><h4>Изменения были сохранены.</h4>';

} else {
	goHome();
}
?>
</body>
</html>
