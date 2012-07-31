<?php
session_start();
include "../lib.php";

if ($_SESSION['writable'] == 'Y') {
	init_db();

	$dluID = $_POST['dluID'];
	$timestamp = $_POST['timestamp'];

	// Проверяем временную метку начала редактирования
	$query = "SELECT `timestamp` FROM `dlu` WHERE `dluID` = '$dluID'";
	$result = mysql_query($query);
	$last_edit = mysql_fetch_array($result);

	if ($last_edit[0] != $timestamp) {
		print '<div align="center"><h4><font color="red">Кто-то другой редактирует этот же DLU!!!</font></h4>';
	} else {
		for ($i = 0; $i <= 99; $i++) {
			$paraID = $_POST['paraID'][$i];
			$tel = trim($_POST['tel'][$i]);
			$pult = trim($_POST['pult'][$i]);
			$sign = trim($_POST['sign'][$i]);
			$pen = trim($_POST['pen'][$i]);
			$kross = trim($_POST['kross'][$i]);
			$abonent = trim($_POST['abonent'][$i]);

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
?>
</body>
</html>
