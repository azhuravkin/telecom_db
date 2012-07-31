<?php
    session_start();
    include "lib.php";
?>
<h3>Выход:</h3><br>
<?php
    unset($_SESSION['valid_user']);
    unset($_SESSION['writable']);
    session_destroy();

    print "<meta http-equiv='Refresh' content='1; URL=/db/login.php'>&nbsp;<div align='center'><h4>Вы вышли.</h4>";
?>
</body>
</html>
