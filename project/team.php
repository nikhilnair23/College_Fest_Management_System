<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>All Team Details</title>
<?php
include("connect.php");
session_start();
if(!isset($_SESSION['user'])){
header("location:login.php");
}

function checkAdmin()
{
	$admin = 'admin';
	if($_SESSION['user'] == $admin)
	return 1;
	else
	return 0;
}
if(isset($_GET['tid']))
updatePayment($_GET['tid']);
function updatePayment($tid)
{
	$usn = $_SESSION['user'];
	$sql_to_update_payment = "update team set pays_to = '$usn' where tid = $tid";	
}
if(isset($_GET['tid']))
updatePayment($_GET['tid']);

function checkCood()
{
	$usn = $_SESSION['user'];
	$sql = ""; /*query to compare check if $usn is there in event table, C_USN */
}


$result_update_statement="";
if(isset($_GET['tid']))
{


	$tid = $_GET['tid'];
	$usn = $_SESSION['user'];
	$sql_to_update_payment = "update team set pays_to = '$usn' where tid = $tid";	
	$result_update = mysql_query($sql_to_update_payment);
	if($result_update)
	{
	$result_update_statement="<div class='alert alert-success'>Successfully Paid</div>";
	}
	else
	{
		$result_update_statement="<div class='alert alert-danger'>Error Occured</div>";
	}
}
if(isset($_GET['tid']))
updatePayment($_GET['tid']);

?>
<link href="../css/styleForProject.css" rel="stylesheet" type="text/css"/>
<link href="../css/bootstrap.min.css"  rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="container-fluid">
<div class="row">
<header id="pageHeader" >
List of All Coordinators
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
<li role="presentation"><a href="eventDetails.php">List of List Of All Events</a></li>
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
<?php $sql_latest_teams = "select team.tname, event.ename,team.tid from team inner join event on team.eid = event.eid order by team.tid";
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
    ?>
</div></div></div>
</div>

</body>
</html>