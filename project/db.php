<?php
include("connect.php");

session_start();


function checkAdmin()
{
	$admin = 'admin';
	if($_SESSION[$username] == $admin)
	return 1;
	else
	return 0;
}

mysql_close($conn);
?>

