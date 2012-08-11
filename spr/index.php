<?php
    include "../header.php";

    print '<h3>Выберите раздел справки:</h3>';
    print '<table align="right"><tr><td>';
    print '<table align="center">
<tr>
	<form action="find_number.php" method="get">
	<td align="center">Поиск по номеру:</td>
</tr>
<tr>
	<td align="center"><input type="text" size="12" name="number"></td>
</tr>
<tr>
	<td align="center"><input type="submit" value="Искать!"></td>
	</form>
</tr>
<tr>
	<form action="find_comment.php" method="get">
	<td align="center">Поиск по фамилии:</td>
</tr>
<tr>
	<td align="center"><input type="text" size="12" name="comment"></td>
</tr>
<tr>
	<td align="center"><input type="submit" value="Искать!"></td>
	</form>
</tr>
</table>
</td></tr>
<tr><td>';

    print_numbers_table();
    print "</td></tr><table>";

    $query = "SELECT * FROM `razdel` ORDER BY `name`";
    $result = mysql_query($query);

    while ($row = mysql_fetch_assoc($result)) {
	$razdelID = $row['razdelID'];
	$name = $row['name'];
	
	print "<tr>\n<td><b><a href=\"razdel.php?razdelID=$razdelID\">$name</a></b></td>\n</tr>\n";
    }
    print '</table>';

    if ($_SESSION['writable'] == 'Y') {
	print '<p><form align="left" action="edit_menu.php" method="post">
<input type="submit" value="Редактировать"></form></p>';
    }

    include "../footer.php";
?>
