<?php
    include "../header.php";

    $razdelID = $_GET['razdelID'];

    if ($_SESSION['writable'] == 'Y') {
	$string_podrazdel = "";
	$string_service = "";
	print "<form action='update_razdel.php' method='post'>\n";
	print "<input type='hidden' name='razdelID' value='$razdelID'>\n";

	// Получить podrazdelID из данного раздела
	$query1 = "SELECT * FROM `podrazdel` WHERE `razdelID` = '$razdelID' ORDER BY `podrazdelID`";
	$result1 = mysql_query($query1);

	while ($row1 = mysql_fetch_array($result1)) {
	    $podrazdelID = $row1['podrazdelID'];
	    $name = $row1['name'];

	    // Сохраняем все данные в переменную для подсчёта контрольной суммы
	    $string_podrazdel .= concat($row1);

	    print "<h3><table align='center'>\n";
	    print "<tr>\n\t<td><input type='text' size='40' name='podrazdelName[$podrazdelID]' value='$name'></td>\n";
	    print "\t<td><input type='checkbox' name='del_podrazdel[$podrazdelID]'></td>\n";
	    print "\t<td>Удалить подраздел</td>\n</tr>\n</table></h3>\n";

	    $query2 = "SELECT `service`.*, `number`.`numberID`, `number`.`telephone` FROM `service`
		LEFT JOIN `number` ON `number`.`serviceID` = `service`.`serviceID`
		WHERE `service`.`podrazdelID` = '$podrazdelID'
		ORDER BY `service`.`serviceID`, `number`.`telephone`";
	    $result2 = mysql_query($query2);

	    if (mysql_num_rows($result2)) {
		print "<table class='small' cellspacing='1' width='100%'>\n";
		print "<tr><th>Название</th><th>Ф.И.О.</th><th>Номер</th><th>Удалить</th></tr>";

		for ($oldID = 0; $row2 = mysql_fetch_array($result2);) {
		    $newID = $row2['serviceID'];

		    if ($oldID && $newID != $oldID) {
			print "</td>\n\t<td width='5%' align='middle'><input type='checkbox' name='del_service[$podrazdelID][$serviceID]'></td>\n</tr>\n";
		    }

		    $serviceID = $row2['serviceID'];
		    $name = $row2['name'];
		    $comment = $row2['comment'];
		    $numberID = $row2['numberID'];
		    $telephone = $row2['telephone'];

		    if ($newID != $oldID) {
			print "<tr>\n\t<td width='45%'><input type='text' class='text' name='serviceName[$podrazdelID][$serviceID]' value='$name'></td>\n";
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

		    // Сохраняем все данные в переменную для подсчёта контрольной суммы
		    $string_service .= concat($row2);
		}
		print "</td>\n\t<td align='middle' width='5%'><input type='checkbox' name='del_service[$podrazdelID][$serviceID]'></td>\n</tr>\n</table>\n";
	    }
	}
	// Вычисляем контрольную сумму редактируемых данных
	print "<input type='hidden' name='md5sum_podrazdel' value='".md5($string_podrazdel)."'>\n";
	print "<input type='hidden' name='md5sum_service' value='".md5($string_service)."'>\n";

	print "<p><input type='submit' value='Сохранить'></form>\n";
	print "<form action='add_service.php' method='post'>\n";
	print "<input type='hidden' name='razdelID' value='$razdelID'>";
	print "<input type='submit' value='Добавить службу'></form></p>\n";
	print "<p><form action='add_podrazdel.php' method='get'>";
	print "<input type='hidden' name='razdelID' value='$razdelID'>";
	print "<input type='submit' value='Добавить подраздел'></form></p>\n";
    } else {
	goHome();
    }

    include "../footer.php";
?>
