<?php
    include "../header.php";

    if ($_SESSION['writable'] == 'Y') {
	// Сколько записей у данного пульта
	$id = $_POST['id'];
	$query = "SELECT count(*) AS count FROM pult_a_data WHERE pult_a_menu_id = '$id'";

	$result = mysql_query($query);

	while ($row = mysql_fetch_assoc($result)) {
	    $count = $row['count'];
	}

	for ($i = 0; $i < $count; $i++) {
	    $pult_id = clean($_POST['pultID'][$i]);
	    $abonent = clean($_POST['abonent'][$i]);
	    $dlu_pult = clean($_POST['dlu_pult'][$i]);
	    $kross_pult = clean($_POST['kross_pult'][$i]);
	    $dlu_abonent = clean($_POST['dlu_abonent'][$i]);
	    $kross_abonent = clean($_POST['kross_abonent'][$i]);
	    $comment = clean($_POST['comment'][$i]);

	    // Вносим изменения в таблицу pult
	    $query = "UPDATE pult_a_data SET abonent = '$abonent',
	    dlu_pult = '$dlu_pult', kross_pult = '$kross_pult',
	    dlu_abonent = '$dlu_abonent',
	    kross_abonent = '$kross_abonent',
	    comment = '$comment' WHERE id = '$pult_id'";

	    mysql_query($query) or die ("Query failed");

	    // Если был(и) отмечен(ы) чекбокс(ы) 
	    if (isset($_POST['del_pult_data'][$i])) {
		$del_pult_data = $_POST['del_pult_data'][$i];

		// Удалить данные из таблицы pult_a_data
		$query = "DELETE FROM pult_a_data 
		WHERE id = '$del_pult_data'";

		mysql_query($query) or die ("Query failed");
	    }
	}
	print "<meta http-equiv=\"Refresh\" content=\"1; URL=$prefix/pult_a/pult.php?id=" . $id . "\">";
	print '&nbsp;<div align="center"><h4>Изменения были сохранены.</h4>';
    } else {
	goHome();
    }

    include "../footer.php";
?>
