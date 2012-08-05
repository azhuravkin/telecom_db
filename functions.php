<?php
    function init_db($host, $user, $pass, $db) {
	mysql_connect($host, $user, $pass) or
	    die("<div align='center'><h4><font color='red'>Невозможно подключиться к серверу $host...</font></h4></div>\n</body>\n</html>");

	mysql_select_db($db) or
	    die("<div align='center'><h4><font color='red'>Невозможно выбрать базу данных $db...</font></h4></div>\n</body>\n</html>");

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
	    echo '&nbsp; <a href="/db/edit_users.php">Пользователи</a>';
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
?>
