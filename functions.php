<?php
    require("config.php");

    function init_db() {
	global $db_host, $db_user, $db_pass, $db_name;

	mysql_connect($db_host, $db_user, $db_pass) or
	    die("<div align='center'><h4><font color='red'>Невозможно подключиться к серверу $db_host...</font></h4></div>\n</body>\n</html>");

	mysql_select_db($db_name) or
	    die("<div align='center'><h4><font color='red'>Невозможно выбрать базу данных $db_name...</font></h4></div>\n</body>\n</html>");

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

    function concat(array $array) {
	$string = "";

	for ($i = 0; isset($array[$i]); $i++) {
	    $string .= $array[$i];
	}

	return $string;
    }

    function md5_count($query) {
	$string = "";
	$result = mysql_query($query);

	for ($i = 0; $row = mysql_fetch_array($result); $i++) {
	    $string .= concat($row);
	}

	return md5($string);
    }

    function print_links() {
	print "<td><a href='/db/'>На главную</a>";

	if (isset($_SESSION['admin']) && $_SESSION['admin'] == 'Y') {
	    echo '&nbsp; <a href="/db/users/edit_users.php">Пользователи</a>';
	}

	print "</td><td align='right'>";

	if (isset($_SESSION['valid_user'])) {
	    print "<a href='/db/logout.php'>Выход (".$_SESSION['valid_user'].")</a>";
	} else {
	    print "<a href='/db/login.php'>Вход</a>";

	    if ($_SERVER["REQUEST_URI"] != "/db/login.php") {
		die("<meta http-equiv='Refresh' content='0; URL=/db/login.php'>\n");
	    }
	}

	print "</td></tr>\n</table>\n";
    }

    function print_numbers_table() {
	print "<table width='100%'><tbody align='center' valign='middle'>\n";
	print "<tr>\n\t<td align='left'>Всего номеров:</td>\n\t<td>";

	// Сколько всего уникальных номеров в базе
	$query = "SELECT COUNT(DISTINCT(`telephone`)) AS `count` FROM `number`";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$all = $row['count'];
	print "$all</td>\n</tr><tr>\n\t<td align='left'>Чисто-городских:</td>\n\t<td>";

	// Сколько чисто-городских номеров в базе
	$query = "SELECT COUNT(DISTINCT(`telephone`)) AS `count` FROM `number` WHERE `telephone` LIKE '2__-__-__'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$onlyGorod = $row['count'];
	print "$onlyGorod</td>\n</tr><tr>\n\t<td align='left'>Городских:</td>\n\t<td>";

	// Сколько городских номеров в базе
	$query = "SELECT COUNT(DISTINCT(`telephone`)) AS `count` FROM `number` WHERE `telephone` LIKE '2_-__' OR `telephone` LIKE '9_-__'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$gorod = $row['count'];
	print "$gorod</td>\n</tr><tr>\n\t<td align='left'>Внутренних:</td>\n\t<td>";

	// Сколько остальных (внутренних)
	print $all - ($onlyGorod + $gorod);
	print "</td>\n</tr></table>\n";
    }
?>
