<?php
    session_start();
    include "lib.php";

    if (isset($_SESSION['valid_user'])) {
	print "<h3>Выберите базу данных:</h3>\n";
	print "<table>\n\t<tr><td><b><a href='spr/'>Справочник номеров АТС</a></b></td></tr>\n";
	print "\t<tr><td><b><a href='kross/'>Кросс АТС Hicom-300</a><b></td></tr>\n";
	print "\t<tr><td><b><a href='pult_d/'>Цифровые пульты</a><b></td></tr>\n";
	print "\t<tr><td><b><a href='pult_a/'>Аналоговые пульты</a><b></td></tr>\n";
//	print "\t<tr><td><b><a href='sign/'>Сигнализация</a><b></td></tr>\n";
//	print "\t<tr><td><b><a href='gts/'>Телефоны ГТС</a><b></td></tr>\n";
//	print "\t<tr><td><b><a href='other/'>Прочая информация</a><b></td></tr>\n";
	print "</table>\n";
    }
?>
</body>
</html>
