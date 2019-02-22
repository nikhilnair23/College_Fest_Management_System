<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Control Panel</title>
<?php
include("connect.php");


function checkAdmin()
{
	$admin = 'admin';
	if($_SESSION['user'] == $admin)
	return 1;
	else
	return 0;
}
function checkCood()
{
	$usn = $_SESSION['user'];
	$sql = ""; /*query to compare check if $usn is there in event table, C_USN */
}

session_start();
if(!isset($_SESSION['user'])){
header("location:login.php");
}
?>
<link href="../css/styleForProject.css" rel="stylesheet" type="text/css"/>
<link href="../css/bootstrap.min.css"  rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="container-fluid">
<div class="row">
<header id="pageHeader" >
<?php

$user=$_SESSION['user'];
$admin=1;


if(checkAdmin())
{
	echo "Admin's Page";
}
else
{	$sql = "SELECT * FROM VOLUNTEER WHERE USN = '$user'";
$result = mysql_query($sql);
	while($row = mysql_fetch_array($result))
	echo "Welcome, ".$row['NAME'];
}

?>
</header>
</div></div>
<div class="container">
<div class="row">
<div class="nav nav-pills nav-justified">
<li><a href="myAccount.php">Home</a></li>
<li><a href="logout.php">Log Out</a></li>
</div>
</div>
</div>
<div class="container">
<div class="row">
<div class="col-sm-4">
<div id="sidebar">
<div class="nav nav-pills nav-stacked">
<li role="presentation"><a href="allVolunteers.php">List of All Volunteers</a></li>
<li role="presentation"><a href="allCoordinators.php">List of All Co-ordinators</a></li>
<li role="presentation"><a href="eventDetails.php">List of All Co-ordinators</a></li>
<li role="presentation"><a href="allParticipants.php">Participants</a></li>
<li role="presentation"><a href="dueAmt.php">Due Amount By Teams</a></li>

<?php 
if(checkAdmin())
{
	/* admin block */
?>

<li role="presentation"><a href="createEvents.php">Create Events</a></li>;
<?php } ?>
</div>
</div>
</div>
<div class="col-sm-8">
<div class="box">
<?php
if(isset($_GET['usn']))
{
	$usn = $_GET['usn'];
	$sql_for_vol = "select volunteer.*, event.ename from volunteer inner join event on volunteer.eid = event.eid where usn = '$usn'";
	 $result_vol = mysql_query($sql_for_vol);
	 while($row = mysql_fetch_array($result_vol))
	 {
		 echo "<p>Name : ".$row['NAME'];
		 echo "</p><p>Usn : ".$row['USN']."</p><br>";
		 echo "<p>Branch : ".$row['BRANCH']."</p><br>";
		 echo "<p>Semester : ".$row['SEM']."</p><br>";
		 echo "<p>Section : ".$row['SEC']."</p><br>";
		 echo "<p>Contact :  ".$row['PHNO']."</p><br>";
		 echo "<p>Email :".$row['EMAIL']."</p><br>";
		
			 echo "<p>Event Name :  ".$row[9]."</p>";
		 
		 
		 
	 }
}
?>
<br /><br />
<p>

<a href="myAccount.php">Go Back... </a>
</p>
</div>
</div>
</div>
</div>


</body>
</html>