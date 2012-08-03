<?php
    session_start();
    include("lib.php");

    if ($_SESSION['admin'] == 'Y') {

	$query = "SELECT * FROM `auth` ORDER BY `username`";
	$result = mysql_query($query);

	print "<h3>Пользователи:</h3>\n<table>\n";

	while ($row = mysql_fetch_array($result)) {
	    $authID = $row['authID'];
	    $username = $row['username'];
	    print "<tr>\n<td><b><a href=\"update_user.php?authID=$authID\">$username</a></b></td>\n</tr>\n";
	}

	print "</table>\n<p><form align='left' action='add_user.php' method='get'>
<input type='submit' value='Добавить'></form></p>\n";
    } else {
	goHome();
    }
?>
</body>
</html>
