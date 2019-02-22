<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Due Amount</title>
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
<?php
 /* */  
 echo $result_update_statement;
 $sql_for_due_teams="select team.*, event.ename,event.fee from team inner join event on team.eid = event.eid where pays_to IS NULL";
 
 $result_due_teams = mysql_query($sql_for_due_teams);
 echo "<table class='table'><th>Team Name</th><th>Contact</th><th>Event</th><th>Due Amount</th>";
 if(!checkAdmin())
 {
	 echo "<th>Make Payment</th>";
 }
 while( $row = mysql_fetch_array($result_due_teams))
 {
	 echo "<tr><td>".$row[1]."</td>";
	  /*team name*/
	 $sql_for_getting_one_contact = "select phno from participant where pusn = (select pusn from belongs_to where tid = $row[0])"; 
	 $result_contact = mysql_query($sql_for_getting_one_contact);
	 while($row_contact = mysql_fetch_array($result_contact))
	 {
		 echo "<td>".$row_contact[0]."</td>";
	 }
	 
	 echo "<td>".$row[4]."</td>";
	 echo "<td>".$row[5]."</td>";
	 
	 if(!checkAdmin())
	 {
		 echo "<td><a class='btn btn-success' href='dueAmt.php?tid=".$row[0]."'>Pay</a></td></tr>";
	 }
	 else
	 {
		 echo "</tr>";
	 }
 }
echo "</table>";
?>

</div>
</div>
</div>
</div>


</body>
</html>