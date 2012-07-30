<?php
session_start();
include("lib.php");

print "<h3>Вход:</h3><br>";

if (isset($_POST['username']) and isset($_POST['password'])) {
	// Если пользователь попытался зарегистрироваться
	$username = $_POST['username'];
	$password = $_POST['password'];
	init_db();
	$query = "SELECT * FROM auth WHERE username = '$username' AND password = md5('$password')";
	$result = mysql_query($query);
	if (mysql_num_rows($result) > 0) {
		// Если пользователь найден в базе данных,
		// регистрируем его идентификатор
		$access = mysql_fetch_assoc($result);
		$_SESSION['valid_user'] = $username;
		$_SESSION['writable'] = $access['writable'];
		print '<meta http-equiv="Refresh" content="1; URL=' . $_COOKIE['page'] . '">&nbsp;<div align="center"><h4>Вы вошли.</h4>';
	} else {
		print '<meta http-equiv="Refresh" content="1; URL=/db/login.php">&nbsp;<div align="center"><h4>Неудачная попытка входа</h4>';
	}
} else {
    print '<table class="border" cellspacing="0" align="center">
<tr>
<td>
    <table>
	<form method="post" action="login.php">
	<tr><td>Логин:</td><td><input type="text" name="username" size="12"></td></tr>
	<tr><td>Пароль:</td><td><input type="password" name="password" size="12"></td></tr>
	<tr><td colspan="2" align="center"><input type="submit" value="Войти"></td></tr>
    </table>
</td></tr>
</table>
</body>
</html>';
}
?>
