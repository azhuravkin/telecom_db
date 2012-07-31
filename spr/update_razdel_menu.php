<?php
session_start();
include "../lib.php";

if ($_SESSION['writable'] == 'Y') {

init_db();

// Сколько всего разделов в списке
$query = "SELECT count(*) AS count FROM razdel";
$result = mysql_query($query);
while ($row = mysql_fetch_assoc($result)) {
	$count = $row['count'];
} // while

for ($i = 0; $i < $count; $i++) {
	$razdelID = $_POST['razdelID'][$i];
	$razdelName = trim($_POST['razdelName'][$i]);

	// Изменить название раздела
	$query = "UPDATE razdel SET name = '$razdelName'
	WHERE razdelID = '$razdelID'";
	mysql_query($query) or die ("Query failed");

	// Если был(и) отмечен(ы) чекбокс(ы) 
	if (isset($_POST['del_razdelID'][$i])) {
		$del_razdelID = $_POST['del_razdelID'][$i];
		
		// Удалить данные из таблицы razdel
		$query1 = "DELETE FROM razdel WHERE razdelID = '$del_razdelID'";
		mysql_query($query1) or die ("Query failed 1");

		// Получить все podrazdelID, входящие в раздел
		$query2 = "SELECT podrazdelID FROM service WHERE razdelID = '$del_razdelID'";
		$result = mysql_query($query2) or die ("Query failed 2");

		while ($row = mysql_fetch_assoc($result)) {
			// Удалить данные из таблицы podrazdel
			$podrazdelID = $row['podrazdelID'];
			$query3 = "DELETE FROM podrazdel WHERE podrazdelID = '$podrazdelID'";
			mysql_query($query3) or die ("Query failed 3");
		} // while

		// Получить все serviceID, входящие в раздел
		$query4 = "SELECT serviceID FROM service WHERE razdelID = '$del_razdelID'";
		$result = mysql_query($query4) or die ("Query failed 4");

		while ($row = mysql_fetch_assoc($result)) {
			// Удалить данные из таблицы number
			$serviceID = $row['serviceID'];
			$query5 = "DELETE FROM number WHERE serviceID = '$serviceID'";
			mysql_query($query5) or die ("Query failed 5");
		} // while

		// Удалить данные из таблицы service
		$query6 = "DELETE FROM service WHERE razdelID = '$del_razdelID'";
		mysql_query($query6) or die ("Query failed 6");

	} // if
} // for

print "<meta http-equiv=\"Refresh\" content=\"1; URL=/db/spr/\">";
print '&nbsp;<div align="center"><h4>Изменения были сохранены.</h4>';

} else {

goHome();

}
?>
</body>
</html>
