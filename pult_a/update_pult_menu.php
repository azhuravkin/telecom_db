<?php
    include "../header.php";

    if ($_SESSION['writable'] == 'Y') {
	// Сколько всего пультов в списке
	$query = "SELECT count(*) AS count FROM pult_a_menu";
	$result = mysql_query($query);

	while ($row = mysql_fetch_assoc($result)) {
	    $count = $row['count'];
	}

	for ($i = 0; $i < $count; $i++) {
	    $pultID = clean($_POST['pultID'][$i]);
	    $pultSort = clean($_POST['sort'][$i]);
	    $pultName = clean($_POST['pultName'][$i]);

	    // Изменить порядковый номер
	    $query = "UPDATE pult_a_menu SET sort = '$pultSort'
	    WHERE id = '$pultID'";
	    mysql_query($query) or die ("Query failed");

	    // Изменить название пульта
	    $query = "UPDATE pult_a_menu SET name = '$pultName'
	    WHERE id = '$pultID'";
	    mysql_query($query) or die ("Query failed");

	    // Если был(и) отмечен(ы) чекбокс(ы) 
	    if (isset($_POST['del_pult'][$i])) {
		$del_pult = $_POST['del_pult'][$i];

		// Удалить данные из таблицы pult_menu
		$query = "DELETE FROM pult_a_menu WHERE id = '$del_pult'";
		mysql_query($query) or die ("Query failed");

		// Удалить данные из таблицы pult
		$query = "DELETE FROM pult_a_data WHERE id = '$del_pult'";
		mysql_query($query) or die ("Query failed");
	    }
	}

	print "<meta http-equiv=\"Refresh\" content=\"1; URL=$prefix/pult_a/\">";
	print '&nbsp;<div align="center"><h4>Изменения были сохранены.</h4>';
    } else {
	goHome();
    }

    include "../footer.php";
?>
