<?php
    include "../header.php";

    $razdelID = $_GET['razdelID'];

    // Получить podrazdelID из данного раздела
    $query1 = "SELECT * FROM `podrazdel` WHERE `razdelID` = '$razdelID' ORDER BY `podrazdelID`";
    $result1 = mysql_query($query1);

    while ($row1 = mysql_fetch_array($result1)) {
	$podrazdelID = $row1['podrazdelID'];
	$podrazdelName = $row1['name'];

	print "<h3>$podrazdelName</h3>\n";

	$query2 = "SELECT `service`.*, `number`.`telephone` FROM `service`
	    LEFT JOIN `number` ON `number`.`serviceID` = `service`.`serviceID`
	    WHERE `service`.`podrazdelID` = '$podrazdelID' ORDER BY `service`.`serviceID`";
	$result2 = mysql_query($query2);

	if (mysql_num_rows($result2)) {
	    print '<table class="small" cellspacing="1" width="100%">
<th>Название</th>
<th>Ф.И.О.</th>
<th>Номер</th>';

	    $oldID = 0;
	    while ($row2 = mysql_fetch_assoc($result2)) {
		$newID = $row2['serviceID'];
		if ($newID != $oldID) {
		    print "</td>\n</tr>\n<tr>\n\t<td width='50%'><p>";
		    print $row2['name'] ? $row2['name'] : "&nbsp;";
		    print "</p></td>\n\t<td width='30%'><p>";
		    print $row2['comment'] ? $row2['comment'] : "&nbsp;";
		    print "</p></td>\n\t<td width='20%'><p>";
		    print $row2['telephone'] ? $row2['telephone'] : "&nbsp;";
		    $oldID = $newID;
		} else {
		    print ", ";
		    print $row2['telephone'];
		}
	    }
	}
	print "</td>\n</tr>\n</table>\n";
    }

    if ($_SESSION['writable'] == 'Y') {
	print "<p><form action='edit_razdel.php' method='get'>
<input type='hidden' name='razdelID' value='$razdelID'>
<input type='submit' value='Редактировать'>
</form></p>\n";
    }

    include "../footer.php";
?>
