<?
$uri = $_SERVER["REQUEST_URI"];
if (($uri != "/db/login.php") && ($uri != "/db/logout.php"))
	setcookie('page', $uri, time() + 86400 * 7, '/');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>База данных АТС Hicom-300 производственного объединения БелавтоМАЗ</title>
</head>
<style type = "text/css">
h3 {
	text-align: center;
	border-color: #AAAAAA;
	border-style: double;
	font-family : Arial, sans-serif;
	font-size: 14px;
}
h4 {
	font-family : Arial, sans-serif;
	font-size: 13px;
}
input {
	background-color: #ffffff;
	border-bottom: #808080 1px solid;
	border-left: #808080 1px solid;
	border-right: #808080 1px solid;
	border-top: #808080 1px solid;
	color: #000000;
	font-family: Arial, sans-serif;
	font-size: 11px;
}
input.text {
	width: 100%;
}
table.border {
	border-style: solid;
	border-color: #AAAAAA;
	border-width: 1px;
}
table.small {
	background: #CCCCCC;
}
th {
	white-space: nowrap;
	background: #E9E9E9;
	font-family: Arial, sans-serif;
	font-size: 12px;
}
td {
	white-space: nowrap;
	background: #FFFFFF;
	font-family: Arial, sans-serif;
	font-size: 11px;
}
a {
	color: #0055aa;
	text-decoration: none;
	font-size: 12px;
}
a:hover {
	color: #3399ee;
	text-decoration: none;
}
</style>
<body>
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td><a href="/db">На главную</a></td>
<td align="right">
<?
if (isset($_SESSION['valid_user']))
	print "<a href='/db/logout.php'>Выход (" . $_SESSION['valid_user'] . ")</a>";
else
	print "<a href='/db/login.php'>Вход</a>";
?>
</td></tr>
</table>
<?
function init_db() {
	$db_hostname = "localhost";
	$db_username = "telecom";
	$db_password = "telecom123";
	$db_name = "telecom";

	if (!mysql_connect($db_hostname, $db_username, $db_password)) {
		print "<h4><font color='red'>Невозможно подключиться к серверу mysql...</font></h4>\n";
		print "</body>\n</html>";
		exit;
	}

	if (!mysql_select_db($db_name)) {
		print "<h4><font color='red'>Невозможно использовать базу $db_name...</font></h4>\n";
		print "</body>\n</html>";
		exit;
	}
	mysql_query("SET NAMES 'utf8'");
}

function nextID($query) {
	$result = mysql_query($query);
	$max = mysql_fetch_array($result);
	return $max[0] + 1;
}

function goHome() {
	print '<meta http-equiv="Refresh" content="1; URL=/db/">&nbsp;
<div align="center"><h4><font color="red">Вы не можете просматривать эту страницу!</font></h4>';
}

?>
