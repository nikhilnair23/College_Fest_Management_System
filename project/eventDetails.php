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
<?php 
$sql_for_participants = "select eid,ename,max_part,location,c_usn from event";
$result_part = mysql_query($sql_for_participants);
$table = "<table class='table'><tr><th>Event ID</th><th>Event Name</th><th>No of Participants</th><th>Location</th><th>Coordinator USN</th>";
	while ($row = mysql_fetch_array($result_part	))
	{
		$table.="<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td></tr>";
	}
	$table.="</table>";
	echo $table;
	?>
    
    <p><br />
    <br />
    <a href="index.php#artsBox">Click Here for the event Registration</a>
<br /><br />
<p>
</p>
</div>
</div>
</div>
</div>


</body>
</html>