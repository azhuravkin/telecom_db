<?php
    include "../header.php";

    if ($_SESSION['writable'] == 'Y') {
	if (empty($_POST["name"])) {
	    print '<form action=' . $_SERVER["PHP_SELF"] . ' method="post">
<h3>Добавление нового раздела:</h3>
<table class="small" cellspacing="1">
<th>Название раздела:</th>
<tr>
<td><input type="text" name="name" size="40"></td>
</tr></table>
<p><input type="submit" value="Добавить"></p>
</form>';
	} else {
	    $name = trim($_POST['name']);

	    // Ищем свободный razdelID
	    $query = "SELECT MAX(`razdelID`) FROM `razdel`";
	    $razdelID = nextID($query);

	    $query = "INSERT INTO razdel VALUES ('$razdelID','$name')";
	    mysql_query($query) or die ("Query failed");

	    print "<meta http-equiv=\"Refresh\" content=\"1; URL=/db/spr/\">";
	    print '&nbsp;<div align="center"><h4>Новый раздел был добавлен.</h4>';
	}
    } else {
	goHome();
    }

    include "../footer.php";
?>
