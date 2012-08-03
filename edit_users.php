<?php
    session_start();
    include("lib.php");

    if ($_SESSION['admin'] == 'Y') {
	$query = "SELECT * FROM `auth` ORDER BY `username`";
	$result = mysql_query($query);

	print '<form action="update_users.php" method="post">
<h3>Пользователи:</h3>
<table class="small" width="45%" cellspacing="1">
<tr>
<th>Пользователь:</th><th>Пароль:</th><th>Редактирование:</th><th>Администратор:</th><th>Удалить:</th>
</tr>';
	while ($row = mysql_fetch_array($result)) {
	    print "\n<tr>\n\t<input type='hidden' name='authID' value='".$row['authID']."'>";
	    print "\n\t<td width='30%'>".$row['username']."</td>";
	    print "\n\t<td width='20%'><input type='password' name='password' value=''></td>";
	    print "\n\t<td width='17%' align='center'><input type='checkbox' name='writable'";
	    if ($row['writable'] == 'Y') print " checked";
	    print "></td>\n\t<td width='17%' align='center'><input type='checkbox' name='admin'";
	    if ($row['admin'] == 'Y') print " checked";
	    print "></td>\n\t<td width='17%' align='center'><input type='checkbox' name='delete'></tr>";
	}
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
