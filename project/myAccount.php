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
	$sql = "select ename from event where eid in (select eid from volunteer where volunteer.eid = $usn"; /*query to compare check if $usn is there in event table, C_USN */
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
<li role="presentation"><a href="eventDetails.php">List of All Events</a></li>
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
<div class="box"><?php 
if(checkAdmin())
{
  $sql_latest_teams = "select team.tname, event.ename,team.tid from team inner join event on team.eid = event.eid order by team.tid desc limit 5";
  ?><h2>Latest Teams</h2>
<?php
	echo "<table class='table'><th>Team Name</th><th>Event Name</th>";
	$query_latest_teams = mysql_query($sql_latest_teams);
	while($row = mysql_fetch_array($query_latest_teams))
	{
		echo "<tr><td>".$row[0]."<br>
		<ul>";
		$tid = $row[2];
		$result_part = mysql_query("select name, phno from participant where PUSN in (SELECT PUSN FROM belongs_to WHERE tid = $tid)");
		while($row_participant = mysql_fetch_array($result_part)){
		echo "<li>".$row_participant[0]." - ".$row_participant[1]."</li>";
		}
		echo "</ul></td>";
		echo "<td>".$row[1]."</td></tr>";
	}
	echo "</table>";
		}
	else {
	
$sql_volunteering_for = "select ename from event where eid in (select eid from volunteer where volunteer.USN ='$user')"; /*sql for searching all the events the usn is volunteering. get from the volunteers for table  */
$sql_result = mysql_query($sql_volunteering_for);
?>
<h2>You are Volunteering for...</h2>
<?php while($row= mysql_fetch_array($sql_result)){echo "<p>".$row[0]."</p>";}?>
<br />
<br />
<br />

<?php } ?>
<div class="pull-right"><a href="team.php">View All Teams</a></div>
</div>
</div>
</div>
</div>


</body>
</html>