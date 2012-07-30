<?php
session_start();
include "lib.php";
?>
<h3>Выход:</h3><br>
<?php
$old_user = $_SESSION['valid_user'];
unset($_SESSION['valid_user']);
unset($_SESSION['writable']);
session_destroy();

if (!empty($old_user)) {
	print '<meta http-equiv="Refresh" content="1; URL=' . $_COOKIE['page'] . '">&nbsp;<div align="center"><h4>Вы вышли.</h4>';
}
?>
</body>
</html>
