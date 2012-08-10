<?php
    include "../header.php";

    $razdelID = $_GET['razdelID'];

    if ($_SESSION['writable'] == 'Y') {
	// Получить уникальные podrazdelID из данного раздела
	$query1 = "SELECT DISTINCT `podrazdelID` AS `podrazdelID` FROM `service`
	    WHERE `service`.`razdelID` = '$razdelID' ORDER BY `service`.`podrazdelID`";
	$result1 = mysql_query($query1);

	while ($row1 = mysql_fetch_array($result1)) {
	    $podrazdelID = $row1['podrazdelID'];
	    $query2 = "SELECT * FROM `podrazdel` WHERE `podrazdelID` = '$podrazdelID'";
	    $result2 = mysql_query($query2);
	    $row2 = mysql_fetch_array($result2);
	    $name = $row2['name'];

	    print "<h3><table align='center' width='1%'><form action='update_podrazdel.php' method='post'>\n";
	    print "<input type='hidden' name='razdelID' value='$razdelID'>\n";
	    print "<tr>\n\t<td><input type='text' size='40' name='podrazdelName[$podrazdelID]' value='$name'></td>\n";
	    print "\t<td><input type='checkbox' name='del_podrazdel[$podrazdelID]'></td>\n";
	    print "\t<td>Удалить подраздел</td>\n</tr>\n</table></h3>\n";

	    print "<table class='small' cellspacing='1' width='100%'>\n";
	    print "<tr><th>Название</th><th>Ф.И.О.</th><th>Номер</th></tr>";

	    $query3 = "SELECT `service`.`serviceID`, `service`.`name`, `service`.`comment`, `number`.`numberID`, `number`.`telephone`
		FROM `service`, `number` WHERE `number`.`serviceID` = `service`.`serviceID`
		AND `service`.`podrazdelID` = '$podrazdelID' ORDER BY `service`.`serviceID`";
	    $result3 = mysql_query($query3);

	    for ($oldID = 0; $row3 = mysql_fetch_array($result3);) {
		$newID = $row3['serviceID'];
		$serviceID = $row3['serviceID'];
		$name = $row3['name'];
		$comment = $row3['comment'];
		$numberID = $row3['numberID'];
		$telephone = $row3['telephone'];

		if ($newID != $oldID) {
		    if ($oldID) {
			print "\n</td>\n</tr>\n";
		    }
		    print "<tr>\n\t<td width='50%'><input type='text' class='text' name='serviceName[$serviceID]' value='$name'></td>\n";
		    print "\t<td width='30%'><input type='text' class='text' size='50' name='serviceComment[$serviceID]' value='$comment'></td>\n";
		    print "\t<td width='20%'><table><tr>\n\t\t<td><input type='text' size='9' name='number[$numberID]' value='$telephone'></td>\n";
		    print "\t\t<td><input type='checkbox' name='del_number[$numberID]'></td>\n\t\t<td>Удалить</td>\n";
		    print "\t\t<td><input type='text' class='text' size='9' name='new_number[$serviceID]'></td></tr></table>";

		    $oldID = $newID;
		} else {
		    print "\n\t\t<table><tr>\n\t\t<td><input type='text' size='9' name='number[$numberID]' value='$telephone'></td>\n";
		    print "\t\t<td><input type='checkbox' name='del_number[$numberID]'></td>\n\t\t<td>Удалить</td></tr></table>";
		}
	    }

	    print "</td>\n</tr>\n</table>\n<p><input type='submit' value='Сохранить'></form>\n";
	    print "<form action='add_service.php' method='post'>";
	    print "<input type='hidden' name='razdelID' value='$razdelID'>";
	    print "<input type='hidden' name='podrazdelID' value='$podrazdelID'>";
	    print "<input type='submit' value='Добавить службу'></form></p>";
	}
	print "<p><form action='add_podrazdel.php' method='post'>";
	print "<input type='hidden' name='razdelID' value='$razdelID'>";
	print "<input type='submit' value='Добавить подраздел'></form></p>\n";
    } else {
	goHome();
    }

    include "../footer.php";
?>
