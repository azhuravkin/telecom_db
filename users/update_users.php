<?php
    include "../header.php";

    if ($_SESSION['admin'] == 'Y') {
	// Сравниваем контрольные суммы данных перед изменениями
	if ($_POST['md5sum'] != md5_count("SELECT * FROM `auth` ORDER BY `username`")) {
	    print '<div align="center"><h4><font color="red">Информация в этом списке была обновлена другим пользователем!!!</font></h4>';
	} else {
	    foreach ($_POST['username'] as $authID => $user) {
		$username = trim($user);
		$password = $_POST['password'][$authID];

		$query = "UPDATE `auth` SET";

		// Изменить имя пользователя
		$query .= " `username` = '$username'";

		// Изменить пароль
		if (strlen($password)) {
		    $query .= ", `password` = md5('$password')";
		}

	        // Изменить права на запись
		$query .= ", `writable` = '";
		$query .= (isset($_POST['writable'][$authID])) ? 'Y' : 'N';

		// Изменить права на администрирование
		$query .= "', `admin` = '";
		$query .= (isset($_POST['admin'][$authID])) ? 'Y' : 'N';

		$query .= "' WHERE `authID` = '$authID'";

		mysql_query($query) or die ("Query failed");

		// Если было отмечено удаление
		if (isset($_POST['delete'][$authID])) {
		    $query = "DELETE FROM `auth` WHERE `authID` = '$authID'";

		    mysql_query($query) or die ("Query failed");
		}
	    }
	    print '<meta http-equiv="Refresh" content="1; URL=/db/users/edit_users.php">&nbsp;<div align="center"><h4>Изменения успешно сохранены.</h4>';
	}
    } else {
	goHome();
    }

    include "../footer.php";
?>
