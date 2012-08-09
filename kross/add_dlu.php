<?php
    include "../header.php";

    if ($_SESSION['writable'] == 'Y') {
	if (empty($_POST["dluSort"])) {
	    print '<form method="post">
<h3>Добавление нового DLU:</h3>
<table class="small" width="40%" cellspacing="1">
<th colspan="3">Название DLU:</th>
<tr>
<td width="10%">DLU N-</td>
<td width="8%"><input type="text" class="text" name="dluSort"></td>
<td width="82%"><input type="text" class="text" name="dluName"></td>
</tr>
</table>
<p><input type="submit" value="Добавить"></p>
</form>';
	} else {
	    $dluSort = trim($_POST['dluSort']);
	    $dluName = trim($_POST['dluName']);

	    // Ищем свободный dluID
	    $query = "SELECT MAX(`dluID`) FROM `dlu`";
	    $dluID = nextID($query);

	    $query = "INSERT INTO `dlu` VALUES ('$dluID', '$dluSort', '$dluName')";
	    mysql_query($query) or die ("Query failed");

	    // Создаём пустую таблицу dlu
	    $query = "INSERT INTO `para` (`para`, `dluID`) VALUES ('00', '$dluID')";

	    for ($count = 1; $count < 100; $count++) {
		$query .= ", ('".sprintf("%02d", $count)."', '$dluID')";
	    }

	    // Вставляем данные в таблицу para
	    mysql_query($query) or die ("Query failed");

	    print '<meta http-equiv="Refresh" content="1; URL=/db/kross/">&nbsp;<div align="center"><h4>Новый DLU добавлен.</h4>';
	}
    } else {
	goHome();
    }

    include "../footer.php";
?>
