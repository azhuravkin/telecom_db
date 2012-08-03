<?php
session_start();
include "lib.php";

if ($_SESSION['admin'] == 'Y') {
    // Сравниваем контрольные суммы данных перед изменениями
    if ($_POST['md5sum'] != md5_count("SELECT * FROM `auth` ORDER BY `username`")) {
	print '<div align="center"><h4><font color="red">Информация в этом списке была обновлена другим пользователем!!!</font></h4>';
    } else {
	// Сколько всего пользователей в списке
	$query = "SELECT COUNT(*) AS `count` FROM `auth`";
	$result = mysql_query($query);

	while ($row = mysql_fetch_array($result)) {
	    $count = $row['count'];
	}

	for ($i = 0; $i < $count; $i++) {
	    $authID = $_POST['authID'][$i];
	    $username = trim($_POST['username'][$i]);
	    $password = $_POST['password'][$i];

	    $query = "UPDATE `auth` SET";

	    // Изменить имя пользователя
	    $query .= " `username` = '$username'";

	    // Изменить пароль
	    if ($password != "") {
		$query .= ", `password` = md5('$password')";
	    }

	    // Изменить права на запись
	    $query .= ", `writable` = '";
	    $query .= (isset($_POST['writable'][$i])) ? 'Y' : 'N';
	    // Изменить права на администрирование
	    $query .= "', `admin` = '";
	    $query .= (isset($_POST['admin'][$i])) ? 'Y' : 'N';

	    $query .= "' WHERE `authID` = '$authID'";

	    mysql_query($query) or die ("Query failed");

	    // Если было отмечено удаление
	    if (isset($_POST['delete'][$i])) {
		$query = "DELETE FROM `auth` WHERE `authID` = '$authID'";

		mysql_query($query) or die ("Query failed");
	    }
	}
	print '<meta http-equiv="Refresh" content="1; URL=/db/edit_users.php">&nbsp;<div align="center"><h4>Изменения успешно сохранены.</h4>';
    }
} else {
    goHome();
}
?>
</body>
</html>
