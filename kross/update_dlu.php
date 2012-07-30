<?
session_start();
include "../lib.php";

if (isset($_SESSION['valid_user'])) {
	init_db();

	$dluID = $_POST['dluID'];

	for ($i = 0; $i <= 99; $i++) {
		$paraID = $_POST['paraID'][$i];
		$tel = trim($_POST['tel'][$i]);
		$pult = trim($_POST['pult'][$i]);
		$sign = trim($_POST['sign'][$i]);
		$pen = trim($_POST['pen'][$i]);
		$kross = trim($_POST['kross'][$i]);
		$abonent = trim($_POST['abonent'][$i]);

		// Вносим изменения в таблицу para
		$query = "UPDATE para SET telephone = '$tel', pult = '$pult', sign = '$sign',
		pen = '$pen', kross = '$kross', abonent = '$abonent' WHERE paraID = '$paraID'";
		mysql_query($query) or die ("Query failed");
	}

	print '<meta http-equiv="Refresh" content="1; URL=/db/kross/dlu.php?dluID=' . $dluID . '">&nbsp;
<div align="center"><h4>Изменения были сохранены.</h4>';

} else {
	goHome();
}
?>
</body>
</html>
