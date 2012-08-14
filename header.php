<?php
    require("functions.php");
    session_start();

    print <<<END
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>База данных АТС Hicom-300 производственного объединения БелавтоМАЗ</title>
</head>
<link rel="stylesheet" href="$prefix/style.css" />
</style>
<body>
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
END;

    print_links();
    init_db();
?>
