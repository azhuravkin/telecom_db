<?php
    include "../header.php";

    if ($_SESSION['writable'] == 'Y') {
	$dluID = $_POST['dluID'];

	// Сравниваем контрольные суммы данных перед изменениями
	if ($_POST['md5sum'] != md5_count("SELECT * FROM `para` WHERE `dluID` = '$dluID' ORDER BY `para`")) {
	    print '<div align="center"><h4><font color="red">Информация в этом DLU была обновлена другим пользователем!!!</font></h4>';
	} else {
	    foreach ($_POST['tel'] as $paraID => $number) {
		$tel = trim($number);
		$pult = trim($_POST['pult'][$paraID]);
		$sign = trim($_POST['sign'][$paraID]);
		$pen = trim($_POST['pen'][$paraID]);
		$kross = trim($_POST['kross'][$paraID]);
		$abonent = trim($_POST['abonent'][$paraID]);

		// Вносим изменения в таблицу para
		$query = "UPDATE `para` SET `telephone` = '$tel', `pult` = '$pult', `sign` = '$sign',
		    `pen` = '$pen', `kross` = '$kross', `abonent` = '$abonent' WHERE `paraID` = '$paraID'";

		mysql_query($query) or die ("Query failed");
	    }

	print '<meta http-equiv="Refresh" content="1; URL=/db/kross/dlu.php?dluID=' . $dluID . '">&nbsp;
<div align="center"><h4>Изменения были сохранены.</h4>';
	}
    } else {
	goHome();
    }

    include "../footer.php";
?>
