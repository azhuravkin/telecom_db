<?php
include "../header.php";

$razdelID = $_GET['razdelID'];

if ($_SESSION['writable'] == 'Y') {
	// Получить уникальные podrazdelID из данного раздела
	$query1 = "SELECT DISTINCT podrazdelID AS count FROM service
	WHERE service.razdelID = '$razdelID' ORDER BY service.podrazdelID";
	$result1 = mysql_query($query1);
	while ($row1 = mysql_fetch_assoc($result1)) {
		$podrazdelID = $row1['count'];
		$query2 = "SELECT name FROM podrazdel WHERE podrazdel.podrazdelID = '$podrazdelID'";
		$result2 = mysql_query($query2);
		$row2 = mysql_fetch_assoc($result2);

		print "<h3><table align='center' width='1%'><form action='update_podrazdel_name.php' method='post'>";
		print "<tr>\n<td><input type='text' size='40' name='podrazdelName' value='";
		print $row2['name'];
		print "'></td>\n<td>";
		print "<input type='hidden' name='podrazdelID' value='";
		print $podrazdelID;
		print "'>\n<input type='hidden' name='razdelID' value='$razdelID'>";
		print "<input type='submit' value='Сохранить'></td></form>";
		print "<form action='del_podrazdel.php' method='get'>";
		print "<td><input type='submit' value='Удалить подраздел'></td>\n";
		print "<input type='hidden' name='podrazdelID' value='";
		print $podrazdelID;
		print "'><input type='hidden' name='razdelID' value=" . $razdelID . "></tr></form></table></h3>\n";

		print "<table class='small' cellspacing='1' width='100%'>\n";
		print "<tr><th>Название</th>";
		print "<th>Ф.И.О.</th>";
		print "<th>Номер</th></tr>";

		$query3 = "SELECT service.serviceID, service.name, service.comment, number.numberID, number.telephone
		FROM service, number WHERE number.serviceID = service.serviceID
		AND service.podrazdelID = '$podrazdelID' ORDER BY service.serviceID";
		$result3 = mysql_query($query3);

		$oldID = 0;
		while ($row3 = mysql_fetch_assoc($result3)) {
			$newID = $row3['serviceID'];
			if ($newID != $oldID) {
				print "<TR>\n\t<form action='update_service_name.php' method='get'>";
				print "<TD width='33%'>";
				print "\n<table width='100%'><tr><td>\n";
				print "<input type='text' class='text' name='serviceName' value='";
				print $row3['name'];
				print "'>\n<input type='hidden' name='serviceID' value='";
				print $row3['serviceID'];
				print "'><input type='hidden' name='razdelID' value='$razdelID'></td>\n";
				print "<td width='1%'><input type='submit' value='Сохранить'>";
				print "</td></tr></table></TD></form>\n";
				print "\t<TD width='33%'>";
				print "<table width='100%'><tr><form action='update_service_comment.php' method='get'>\n<td>\n";
				print "<input type='text' class='text' size='50' name='serviceComment' value='";
				print $row3['comment'];
				print "'>\n<input type='hidden' name='serviceID' value='";
				print $row3['serviceID'];
				print "'><input type='hidden' name='razdelID' value='$razdelID'></td>\n";
				print "<td width='1%'>\n<input type='submit' value='Сохранить'>";
				print "</td></form></table></TD>\n\t<TD width='33%'>";
				print "<table width='1%'><tr><form action='update_service_number.php' method='get'>\n<td>\n";
				print "<input type='text' size='9' name='number' value='";
				print $row3['telephone'];
				print "'>\n<input type='hidden' name='numberID' value='";
				print $row3['numberID'];
				print "'><input type='hidden' name='razdelID' value='$razdelID'></td>\n";
				print "</td><td>\n<input type='submit' value='Сохранить'></form></td>";
				print "<form action='del_number.php' method='get'>\n<td>\n";
				print "<input type='hidden' name='numberID' value='";
				print $row3['numberID'];
				print "'><input type='hidden' name='razdelID' value='$razdelID'>\n";
				print "<input type='submit' value='Удалить'></form></td>";
				print "<form action='add_number.php' method='get'>\n<td>\n";
				print "<input type='text' name='telephone' size='9'></td><td>";
				print "<input type='hidden' name='serviceID' value='";
				print $row3['serviceID'];
				print "'><input type='hidden' name='razdelID' value='$razdelID'>\n";
				print "<input type='submit' value='Добавить'></form></td></tr></table>\n";

				$oldID = $newID;
			} else {
				print "<table width='1%'><tr><form action='update_service_number.php' method='get'>\n<td>\n";
				print "<input type='text' size='9' name='number' value='";
				print $row3['telephone'];
				print "'>\n<input type='hidden' name='numberID' value='";
				print $row3['numberID'];
				print "'></td><td>\n<input type='submit' value='Сохранить'></form></td>\n";
				print "<form action='del_number.php' method='get'>\n<td>\n";
				print "<input type='hidden' name='numberID' value='";
				print $row3['numberID'];
				print "'><input type='hidden' name='razdelID' value='$razdelID'>\n";
				print "<input type='submit' value='Удалить'></form></td></tr></table>";
			}
		}
		print "</table></TD>\n</TR>\n</TABLE>&nbsp;\n";
		print "<form align='left' action='add_service.php' method='get'>";
		print "<input type='hidden' name='razdelID' value='$razdelID'>";
		print "<input type='hidden' name='podrazdelID' value='$podrazdelID'>";
		print "<input type='submit' value='Добавить службу'></form>";
	}
	print "<p><form align='left' action='add_podrazdel.php' method='get'>";
	print "<input type='hidden' name='razdelID' value='$razdelID'>";
	print "<input type='submit' value='Добавить подраздел'></form></p>\n";
} else {
	goHome();
}
?>
</body>
</html>
