<?php
    include "../header.php";

    $number = trim($_GET['number']);

    if (empty($number)) {
	print "<meta http-equiv=\"Refresh\" content=\"1; URL=/db/spr/\">";
	print '&nbsp;<div align="center"><h4><font color="red">Не указан номер для поиска!</font></h4>';
    } else {
	// Запрос принадлежности номера к разделу и подразделу
	$query1 = "SELECT razdel.name AS razdel, podrazdel.podrazdelID,
	podrazdel.name AS podrazdel
	FROM number, service, razdel, podrazdel
	WHERE number.serviceID = service.serviceID AND number.telephone = '$number'
	AND razdel.razdelID = service.razdelID
	AND service.podrazdelID = podrazdel.podrazdelID
	ORDER BY razdel.razdelID";

	// Полный запрос
	$query2 = "SELECT service.name, service.comment, number.telephone 
	FROM number, service, razdel, podrazdel
	WHERE number.serviceID = service.serviceID AND number.telephone = '$number'
	AND razdel.razdelID = service.razdelID
	AND service.podrazdelID = podrazdel.podrazdelID
	ORDER BY razdel.razdelID";

	$result1 = mysql_query($query1);
	$result2 = mysql_query($query2);
	$rows = mysql_num_rows($result2);

	if ((!$rows) || ($rows < 1)) {
	    print "<h4 align=\"center\"><font color=\"red\">Номер $number в базе данных отсутствует...</font></h4>\n";
	} else {
	    $oldID = 0;
	    while (($row1 = mysql_fetch_assoc($result1)) and ($row2 = mysql_fetch_assoc($result2))) {
		$newID = $row1['podrazdelID'];
		if ($newID != $oldID) {
		    print "</table>\n<h3>";
		    print $row1['razdel'];
		    print ": ";
		    print $row1['podrazdel'];
		    print "</h3>\n";
		    print "<table class='small' width='100%' cellspacing='1'>";
		    print "<th>Название</th>\n";
		    print "<th>Ф.И.О.</th>\n";
		    print "<th>Номер</th>\n";
		    $oldID = $newID;
		}
		print "<tr>\n\t<td>";
		print $row2['name'] ? $row2['name'] : "&nbsp;";
		print "</td>\n\t<td width=\"35%\">";
		print $row2['comment'] ? $row2['comment'] : "&nbsp;";
		print "</td>\n\t<td width=\"15%\">";
		print $row2['telephone'] ? $row2['telephone'] : "&nbsp;";
		print "</td>\n</tr>\n";
	    }
	    print "</table>\n";
	}
    }

    include "../footer.php";
?>
