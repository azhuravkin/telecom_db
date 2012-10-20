<?php
    include "../header.php";

    if ($_SESSION['writable'] == 'Y') {
	$razdelID = $_GET['razdelID'];

	if (empty($_POST['podrazdel'])) {
	    print "<form method='post'>
<h3><table align='center'><tr><td><input type='text' name='podrazdel' size='40'></td></tr></table></h3>
<p><input type='submit' value='Добавить'></p>
<input type='hidden' name='razdelID' value='$razdelID'>
</form>";
	} else {
	    $podrazdel = clean($_POST['podrazdel']);

	    // Вставляем данные в таблицу podrazdel
	    $query = "INSERT INTO `podrazdel` VALUES (NULL, '$podrazdel', '$razdelID')";
	    mysql_query($query) or die ("Query failed");

	    print "<meta http-equiv=\"Refresh\" content=\"1; URL=$prefix/spr/edit_razdel.php?razdelID=" . $razdelID . "\">";
	    print '&nbsp;<div align="center"><h4>Новый подраздел был добавлен.</h4>';
	}
    } else {
	goHome();
    }

    include "../footer.php";
?>
