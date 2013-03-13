<?php
    require("functions.php");
    session_start();

    print "<html>\n<head>\n";

    if (!isset($_SESSION['valid_user']) && ($_SERVER["REQUEST_URI"] != "$prefix/login.php")) {
	print "<meta http-equiv='Refresh' content='0; URL=$prefix/login.php'>\n</head>";
	include "footer.php";
	exit;
    }

    print <<<END
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>$title</title>
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
