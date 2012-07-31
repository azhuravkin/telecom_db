<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>База данных АТС Hicom-300 производственного объединения БелавтоМАЗ</title>
</head>
<link rel="stylesheet" href="/db/style.css" />
</style>
<body>
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td><a href="/db">На главную</a></td>
<td align="right">
<?php
    if (isset($_SESSION['valid_user'])) {
	print "<a href='/db/logout.php'>Выход (" . $_SESSION['valid_user'] . ")</a>";
    } else {
	print "<a href='/db/login.php'>Вход</a>";

	if ($_SERVER["REQUEST_URI"] != "/db/login.php") {
	    die("<meta http-equiv='Refresh' content='0; URL=/db/login.php'>\n");
	}
    }
?>
</td></tr>
</table>
<?php
    function init_db() {
	$db_hostname = "localhost";
	$db_username = "telecom";
	$db_password = "telecom123";
	$db_name = "telecom";

	mysql_connect($db_hostname, $db_username, $db_password) or
	    die("<h4><font color='red'>Невозможно подключиться к серверу mysql...</font></h4>\n</body>\n</html>");

	mysql_select_db($db_name) or
	    die("<h4><font color='red'>Невозможно выбрать базу данных $db_name...</font></h4>\n</body>\n</html>");

	mysql_query("SET NAMES 'utf8'");
    }

    function nextID($query) {
	$result = mysql_query($query);
	$max = mysql_fetch_array($result);

	return ($max[0] + 1);
    }

    function goHome() {
	print "<div align='center'><h4><font color='red'>У вас нет прав для редактирования!</font></h4>\n";
    }
?>
