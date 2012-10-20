<?php
    include "../header.php";

    if ($_SESSION['writable'] == 'Y') {
	$pultID = clean($_POST['pultID']);

	// Получить количество записей в пульте
	$query = "SELECT count(*) AS count FROM pult_d_data WHERE pultID = '$pultID'";
	$result = mysql_query($query);
	while ($row = mysql_fetch_assoc($result)) {
	    $count = $row['count'];
	}

	for ($i = 0; $i < $count; $i++) {
	    $keyID = clean($_POST['keyID'][$i]);
	    $key = clean($_POST['key'][$i]);
	    $sort = clean($_POST['sort'][$i]);
	    $abonent = clean($_POST['abonent'][$i]);
	    $tel = clean($_POST['tel'][$i]);
	    $pult = clean($_POST['pult'][$i]);
	    $sign = clean($_POST['sign'][$i]);
	    $pen = clean($_POST['pen'][$i]);
	    $kross = clean($_POST['kross'][$i]);

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

	print '<meta http-equiv="Refresh" content="1; URL=$prefix/pult_d/pult.php?pultID=' . $pultID . '">&nbsp;
<div align="center"><h4>Изменения были сохранены.</h4>';

    } else {
	goHome();
    }

    include "../footer.php";
?>
