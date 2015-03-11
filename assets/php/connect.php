<?php
$ho = "zephyrtasker.db.7835723.hostedresource.com";
$db = "zephyrtasker";
$un = "zephyrtasker";
$pw = "Qaz123!@#";
$DBconn = mysql_connect($ho, $un, $pw) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($db) or die(mysql_error());
?>