<?php
    session_start();
    include("lib.php");

    if ($_SESSION['admin'] == 'Y') {
	$string = "";
	$query = "SELECT * FROM `auth` ORDER BY `username`";
	$result = mysql_query($query);

	print '<form action="update_users.php" method="post">
<h3>Пользователи:</h3>
<table class="small" width="45%" cellspacing="1">
<tr>
<th>Пользователь:</th><th>Пароль:</th><th>Редактирование:</th><th>Администратор:</th><th>Удалить:</th>
</tr>';
	while ($row = mysql_fetch_array($result)) {
	    $authID = $row['authID'];

	    print "\n<tr>\n\t<td width='20%'><input type='text' class='text' name='username[$authID]' value='".$row['username']."'></td>";
	    print "\n\t<td width='20%'><input type='password' class='text' name='password[$authID]' value=''></td>";
	    print "\n\t<td width='20%' align='center'><input type='checkbox' name='writable[$authID]'";
	    if ($row['writable'] == 'Y') print " checked";
	    print "></td>\n\t<td width='20%' align='center'><input type='checkbox' name='admin[$authID]'";
	    if ($row['admin'] == 'Y') print " checked";
	    print "></td>\n\t<td width='20%' align='center'><input type='checkbox' name='delete[$authID]'></td>\n</tr>";

	    $string .= concat($row);
	}
	// Вычисляем контрольную сумму редактируемых данных
	print "\n<input type='hidden' name='md5sum' value='".md5($string)."'>\n";

	print '</table><p>
<table width="1%">
<tr>
<td><input type="submit" value="Сохранить"></form></td>
<form align="left" action="add_user.php" method="post">

<td><input type="submit" value="Добавить"></td>
</form>
</tr>
</table></p>';
    } else {
	goHome();
    }
?>
</body>
</html>
