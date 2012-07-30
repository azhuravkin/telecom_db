<?php
session_start();
include "../lib.php";

init_db();

$comment = trim($_GET['comment']);

if (empty($comment)) {
		print "<meta http-equiv=\"Refresh\" content=\"1; URL=/db/spr/\">";
		print '&nbsp;<div align="center"><h4><font color="red">Не указана фамилия для поиска!</font></h4>';
} else {
	// Запрос принадлежности комментария к разделу и подразделу
	$query1 = "SELECT razdel.name AS razdel, podrazdel.podrazdelID,
	podrazdel.name AS podrazdel
	FROM number, service, razdel, podrazdel
	WHERE number.serviceID = service.serviceID AND service.comment LIKE '$comment%'
	AND razdel.razdelID = service.razdelID
	AND service.podrazdelID = podrazdel.podrazdelID
	ORDER BY razdel.razdelID";

	// Полный запрос
	$query2 = "SELECT service.serviceID, service.name, service.comment, number.telephone 
	FROM number, service, razdel, podrazdel
	WHERE number.serviceID = service.serviceID AND service.comment LIKE '$comment%'
	AND razdel.razdelID = service.razdelID
	AND service.podrazdelID = podrazdel.podrazdelID
	ORDER BY razdel.razdelID";

	$result1 = mysql_query($query1);
	$result2 = mysql_query($query2);
	$rows = mysql_num_rows($result2);

	if ((!$rows) || ($rows < 1)) {
		print "&nbsp;<div align=\"center\"><h4><font color=\"red\">
		Фамилия $comment в базе данных отсутствует...</font></h4></div>\n";
	} else {
		$oldID1 = 0; // Подраздел
		$oldID2 = 0; // Служба
		while (($row1 = mysql_fetch_assoc($result1)) and ($row2 = mysql_fetch_assoc($result2))) {	
			$newID1 = $row1['podrazdelID'];
			$newID2 = $row2['serviceID'];
			if (($newID1 != $oldID1) and ($newID2 != $oldID2)) {
				print "</td>\n</tr>\n</table>\n<h3>";
				print $row1['razdel'];
				print ": ";
				print $row1['podrazdel'];
				print "</h3>\n";
				print "<table class='small' width='100%' cellspacing='1'>\n";
				print "<th>Название</th>\n";
				print "<th>Ф.И.О.</th>\n";
				print "<th>Номер</th>\n";
				$oldID1 = $newID1;
			}
			if ($newID2 != $oldID2) {
				print "<tr>\n\t<td>";
				print $row2['name'] ? $row2['name'] : "&nbsp;";
				print "</td>\n\t<td width=\"35%\">";
				print $row2['comment'] ? $row2['comment'] : "&nbsp;";
				print "</td>\n\t<td width=\"15%\">";
				print $row2['telephone'] ? $row2['telephone'] : "&nbsp;";
				$oldID2 = $newID2;
			} else {
				print ", ";
				print $row2['telephone'] ? $row2['telephone'] : "&nbsp;";
			} //else
		} // while

	print "</td>\n</tr>\n</table>\n";

	} // else
} // else
?>
</body>
</html>
