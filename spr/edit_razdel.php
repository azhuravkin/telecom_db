<?php
    include "../header.php";

    $razdelID = $_POST['razdelID'];

    if ($_SESSION['writable'] == 'Y') {
	print "<form action='update_razdel.php' method='post'>\n";
	print "<input type='hidden' name='razdelID' value='$razdelID'>\n";

	// Получить уникальные podrazdelID из данного раздела
	$query1 = "SELECT DISTINCT(`podrazdelID`) AS `podrazdelID`, `name` FROM `podrazdel`
	    WHERE `razdelID` = '$razdelID' ORDER BY `podrazdelID`";
	$result1 = mysql_query($query1);

	while ($row1 = mysql_fetch_array($result1)) {
	    $podrazdelID = $row1['podrazdelID'];
	    $name = $row1['name'];

	    print "<h3><table align='center' width='1%'>\n";
	    print "<tr>\n\t<td><input type='text' size='40' name='podrazdelName[$podrazdelID]' value='$name'></td>\n";
	    print "\t<td><input type='checkbox' name='del_podrazdel[$podrazdelID]'></td>\n";
	    print "\t<td>Удалить подраздел</td>\n</tr>\n</table></h3>\n";

	    print "<table class='small' cellspacing='1' width='100%'>\n";
	    print "<tr><th>Название</th><th>Ф.И.О.</th><th>Номер</th></tr>";

	    $query2 = "SELECT `service`.*, `number`.`numberID`, `number`.`telephone` FROM `service`
		LEFT JOIN `number` ON `number`.`serviceID` = `service`.`serviceID`
		WHERE `service`.`podrazdelID` = '$podrazdelID' ORDER BY `service`.`serviceID`";
	    $result2 = mysql_query($query2);

	    for ($oldID = 0; $row2 = mysql_fetch_array($result2);) {
		$newID = $row2['serviceID'];
		$serviceID = $row2['serviceID'];
		$name = $row2['name'];
		$comment = $row2['comment'];
		$numberID = $row2['numberID'];
		$telephone = $row2['telephone'];

		if ($newID != $oldID) {
		    if ($oldID) {
			print "\n</td>\n</tr>\n";
		    }
		    print "<tr>\n\t<td width='50%'><input type='text' class='text' name='serviceName[$podrazdelID][$serviceID]' value='$name'></td>\n";
		    print "\t<td width='30%'><input type='text' class='text' size='50' name='serviceComment[$podrazdelID][$serviceID]' value='$comment'></td>\n";
		    print "\t<td width='20%'><table><tr>\n\t\t";
		    if ($numberID) {
			print "<td><input type='text' size='9' name='number[$podrazdelID][$numberID]' value='$telephone'></td>\n";
			print "\t\t<td><input type='checkbox' name='del_number[$podrazdelID][$numberID]'></td>\n\t\t<td>Удалить</td>\n";
		    }
		    print "\t\t<td><input type='text' class='text' size='9' name='new_number[$podrazdelID][$serviceID]'></td></tr></table>";

		    $oldID = $newID;
		} else {
		    print "\n\t\t<table><tr>\n\t\t<td><input type='text' size='9' name='number[$podrazdelID][$numberID]' value='$telephone'></td>\n";
		    print "\t\t<td><input type='checkbox' name='del_number[$podrazdelID][$numberID]'></td>\n\t\t<td>Удалить</td></tr></table>";
		}
	    }

	    print "</td>\n</tr>\n</table>\n";
	}
	print "<p><input type='submit' value='Сохранить'></form>\n";
	print "<form action='add_service.php' method='post'>\n";
	print "<input type='hidden' name='razdelID' value='$razdelID'>";
	print "<input type='submit' value='Добавить службу'></form></p>\n";
	print "<p><form action='add_podrazdel.php' method='post'>";
	print "<input type='hidden' name='razdelID' value='$razdelID'>";
	print "<input type='submit' value='Добавить подраздел'></form></p>\n";
    } else {
	goHome();
    }

    include "../footer.php";
?>
