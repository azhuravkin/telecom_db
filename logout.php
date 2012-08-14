<?php
    include "header.php";

    print "<h3>Выход:</h3><br>\n";

    unset($_SESSION['valid_user']);
    unset($_SESSION['writable']);
    unset($_SESSION['admin']);
    session_destroy();

    print "<meta http-equiv='Refresh' content='1; URL=$prefix/login.php'>&nbsp;<div align='center'><h4>Вы вышли.</h4>";

    include "footer.php";
?>
