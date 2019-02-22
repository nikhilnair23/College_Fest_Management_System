<?php
define ("DB_HOST", "localhost"); //database host
define ("DB_USER", "root"); //database user
define ("DB_PASS",""); //database password
define ("DB_NAME","udbhav"); //database name

$conn = mysql_connect(DB_HOST,DB_USER, DB_PASS) or die("Couldn't make connection.");
$db = mysql_select_db(DB_NAME, $conn) or die("Couldn't select database");


?>