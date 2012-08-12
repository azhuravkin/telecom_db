<?php
    include "../header.php";

    if ($_SESSION['writable'] == 'Y') {
	$razdelID = $_POST['razdelID'];

	if (empty($_POST["name"])) {
	    // Получить название данного подраздела
	    $query = "SELECT * FROM `podrazdel` WHERE `razdelID` = '$razdelID' ORDER BY `podrazdelID`";
	    $result = mysql_query($query);

	    if (mysql_num_rows($result) == 0) {
		print "<meta http-equiv=\"Refresh\" content=\"1; URL=/db/spr/edit_razdel.php?razdelID=".$razdelID."\">";
		print "&nbsp;<div align=\"center\"><h4>Сначала добавьте подраздел!</h4>\n";
		exit;
	    }

	    print "<form method='post'>\n<h3><select name='podrazdelID'>";

	    while ($row = mysql_fetch_array($result)) {
		$podrazdelID = $row['podrazdelID'];
		$name = $row['name'];
		print "\t<option value='$podrazdelID'>$name</option>\n";
	    }

	    print "</select></h3>
<table class='small' cellspacing='1' width='65%'>
<th>Название*</th>
<th>Ф.И.О.</th>
<th>Номер</th>
<tr>
<td width='50%'><input type='text' class='text' name='name'></td>
<td width='30%'><input type='text' class='text' name='comment'></td>
<td width='20%'><input type='text' class='text' name='number' size='9'></td>
</tr></table>
<p><input type='submit' value='Добавить'></p>
<input type='hidden' name='razdelID' value='$razdelID'>
</form>";
	} else {
	    $razdelID = $_POST['razdelID'];
	    $podrazdelID = $_POST['podrazdelID'];
	    $name = trim($_POST['name']);
	    $comment = trim($_POST['comment']);
	    $number = trim($_POST['number']);

	    // Ищем свободный serviceID
	    $query = "SELECT MAX(`serviceID`) FROM `service`";
	    $serviceID = nextID($query);

	    // Вставляем данные в таблицу service
	    $query = "INSERT INTO `service` VALUES ('$serviceID', '$name', '$comment', '$podrazdelID')";
	    mysql_query($query) or die ("Query failed 1");

	    if (strlen($number)) {
		// Вставляем данные в таблицу number
		$query = "INSERT INTO `number` VALUES (NULL, '$number', '$serviceID')";
		mysql_query($query) or die ("Query failed 2");
	    }

	    print "<meta http-equiv=\"Refresh\" content=\"1; URL=/db/spr/edit_razdel.php?razdelID=".$razdelID."\">";
	    print "&nbsp;<div align=\"center\"><h4>Новая служба добавлена.</h4>\n";
	}
    } else {
	goHome();
    }

    include "../footer.php";
?>
