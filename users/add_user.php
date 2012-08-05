<?php
    include "../header.php";

    if ($_SESSION['admin'] == 'Y') {
	if (empty($_POST["username"])) {
	    print '<form method="post">
<h3>Добавление нового пользователя:</h3>
<table class="small" width="36%" cellspacing="1">
<th>Пользователь:</th><th>Пароль:</th><th>Редактирование:</th><th>Администратор:</th>
<tr>
<td width="25%"><input type="text" class="text" name="username"></td>
<td width="25%"><input type="password" class="text" name="password"></td>
<td width="25%" align="center"><input type="checkbox" name="writable"></td>
<td width="25%" align="center"><input type="checkbox" name="admin"></td>
</tr>
</table>
<p><input type="submit" value="Добавить"></p>
</form>';
	} else {
	    $username = trim($_POST['username']);
	    $password = $_POST['password'];

	    $query = "INSERT INTO `auth` VALUES (NULL, '$username', md5('$password'), '";
	    $query .= (isset($_POST['writable'])) ? 'Y' : 'N';
	    $query .= "', '";
	    $query .= (isset($_POST['admin'])) ? 'Y' : 'N';
	    $query .= "')";

	    if (empty($password)) {
		print '<meta http-equiv="Refresh" content="1; URL=/db/add_user.php">&nbsp;';
		print '<div align="center"><h4><font color="red">Пароль не указан!</font></h4>';
	    } else {
		mysql_query($query) or die ("Query failed");

		print '<meta http-equiv="Refresh" content="1; URL=/db/users/edit_users.php">&nbsp;<div align="center"><h4>Новый пользователь добавлен.</h4>';
	    }
	}
    } else {
	goHome();
    }

    include "../footer.php";
?>
