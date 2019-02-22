<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Control Panel</title>
<?php
include("connect.php");

session_start();
if(!isset($_SESSION['user'])){
header("location:login.php");
}
$result_delete_statement="";
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

if(isset($_GET['USN']))
{
	$usn_delete = $_GET['USN'];
	$sql_for_deleting_volunteer = "delete from volunteer where USN = '$usn_delete'";
	$result_delete_volunteer = mysql_query($sql_for_deleting_volunteer);
	if($result_delete_volunteer)
	{
		$result_delete_statement="<div class='alert alert-info'>Deleted.</div>";
	}
	else
	{
		$result_delete_statement="<div class='alert alert-danger'>Important Volunteer. Cannot Delete This volunteer.</div>";
	}
}

?>
<link href="../css/styleForProject.css" rel="stylesheet" type="text/css"/>
<link href="../css/bootstrap.min.css"  rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="container-fluid">
<div class="row">
<header id="pageHeader" >
List of All Volunteers</header>
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
<li role="presentation"><a href="eventDetails.php">List of All events</a></li>
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
$sql_for_participants = "select * from volunteer";
$result_part = mysql_query($sql_for_participants);
$table = "<table class='table'><tr><th>USN</th><th>Name</th><th>Contact</th><th>Email</th><th>Branch</th>";
if(checkAdmin())
{
	$table.="<th>Delete Volunteer</th>";
}
	while ($row = mysql_fetch_array($result_part	))
	{
		$table.="<tr><td>".$row['USN']."</td><td>".$row['NAME']."</td><td>".$row['PHNO']."</td><td>".$row['EMAIL']."</td><td>".$row['BRANCH']."</td>";
		if(checkAdmin()){
		$table.="<td><a href='allVolunteers.php?USN=".$row['USN']."' class='btn btn-danger'>Delete</a></td></tr>";
		}
		else
		{
			$table.="</tr>";
		}
	}
	$table.="</table>";
	echo $result_delete_statement;
	echo $table;
	?>
<br /><br />
<p>
</p>
</div>
</div>
</div>
</div>


</body>
</html>