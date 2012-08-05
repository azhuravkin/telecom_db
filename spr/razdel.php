<?php

    include "../header.php";

    $razdelID = $_GET['razdelID'];

    // Получить уникальные podrazdelID из данного раздела
    $query1 = "SELECT DISTINCT podrazdelID AS count FROM service WHERE service.razdelID = '$razdelID' ORDER BY service.podrazdelID";
    $result1 = mysql_query($query1);
    while ($row1 = mysql_fetch_assoc($result1)) {
	$podrazdelID = $row1['count'];
	$query2 = "SELECT name FROM podrazdel WHERE podrazdel.podrazdelID = '$podrazdelID'";
	$result2 = mysql_query($query2);
	$row2 = mysql_fetch_assoc($result2);

	print "<h3>" . $row2['name'] . "</h3>";

	print '<table class="small" cellspacing="1" width="100%">
<th>Название</th>
<th>Ф.И.О.</th>
<th>Номер</th>';

	$query3 = "SELECT service.serviceID, service.name, service.comment, number.telephone
FROM service, number WHERE number.serviceID = service.serviceID
AND service.podrazdelID = '$podrazdelID' ORDER BY service.serviceID";
	$result3 = mysql_query($query3);

	$oldID = 0;
	while ($row3 = mysql_fetch_assoc($result3)) {
	    $newID = $row3['serviceID'];
	    if ($newID != $oldID) {
		print "</td>\n</tr>\n<tr>\n\t<td width='50%'><p>";
		print $row3['name'] ? $row3['name'] : "&nbsp;";
		print "</p></td>\n\t<td width='30%'><p>";
		print $row3['comment'] ? $row3['comment'] : "&nbsp;";
		print "</p></td>\n\t<td width='20%'><p>";
		print $row3['telephone'] ? $row3['telephone'] : "&nbsp;";
		$oldID = $newID;
	    } else {
		print ", ";
		print $row3['telephone'];
	    }
	}
	print "</td>\n</tr>\n</table>\n";
    }

    if ($_SESSION['writable'] == 'Y') {
	print "<p><form align=\"left\" action=\"edit_razdel.php\" method=\"get\">
<input type=\"hidden\" name=\"razdelID\" value=$razdelID>
<input type=\"submit\" value=\"Редактировать\">
</form></p>\n";
    }

    include "../footer.php";
?>
