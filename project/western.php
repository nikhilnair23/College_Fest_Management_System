<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Western Acoustics</title>
<link href="../css/styleForProject.css" type="text/css" rel="stylesheet" />
<link href="../css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<?php
session_start();
$flag=0;
if(isset($_SESSION['user'])){
$flag= 1;
}
$eid  = 5;
include("connect.php");
function checkAdmin()
{
	$admin = 'admin';
	if($_SESSION['user'] == $admin)
	return 1;
	else
	return 0;
}
?>
</head>

<body>
<header id="pageHeader">Western Acoustics</header>
<?php if($flag)
{

?>
<div class="container">
<div class="row">
<div class="nav nav-pills nav-justified">
<li><a href="myAccount.php">Home</a></li>
<li><a href="logout.php">Log Out</a></li>
</div>
</div>
</div>

<?php }?>
<div class="container">
<div class="row">
<div id="formBody"><div class="alert alert-warning">Event Details - <?php
 $sql_for_event = "select * from event where eid = $eid";
$result_event = mysql_query($sql_for_event);
echo "<table class='table'>";
while($row = mysql_fetch_array($result_event))
{
	echo "<tr><td>Event Name : </td><td>".$row[1]."</td></tr>";
	echo "<tr><td>Date Of Event : </td><td>".$row[5]."</td></tr>";
	echo "<tr><td>Location : </td><td>".$row[4]."</td></tr>";
	echo "<tr><td>Fee : </td><td>".$row[3]."</td></tr>";
}
echo "</table>";?></div>

<form action="western.php" method="post">
<div class="alert alert-info">Make Sure Your usn has been registered as a participant </div>
<div class="col-sm-4 col-sm-offset-4">
<div class="form-group">
<label>Team Name</label>
<input class="form-control" id="tname" name="tname" placeholder="Enter Team Name.. " />
</div>
</div>
<div class="col-sm-4 col-sm-offset-4">
<div class="form-group">
<label>Usn of 1st participant</label>
<input class="form-control" id="usn" name="usn" placeholder="Enter usn " />
</div>
</div>
<div class="col-sm-4 col-sm-offset-4">
<div class="form-group">
<label>Usn of 2nd participant</label>
<input class="form-control" id="usn2" name="usn2" placeholder="Enter usn " />
</div>
</div>
<?php 
if($flag && !checkAdmin())
{

	?>
<div class="col-sm-4 col-sm-offset-4">

<input type="checkbox" id="paid" name="paid"  value="paid" checked="checked"   /><label> Participant is paying</label>

</div>
<?php }?>
<div class="col-sm-4 col-sm-offset-4">

<input class="btn btn-block btn-success" type="submit" value="Register" />
</div>

</form>

</div>
</div>
</div>
<?php 

if(isset($_POST['usn'])&&isset($_POST['usn2'])&&isset($_POST['tname']))
{
	$tname=$_POST['tname'];
	$usn1 = $_POST['usn'];
	$usn2 = $_POST['usn2'];
	
	
	
	$sql_to_check_part = "select pusn from participant where pusn = '$usn1' UNION select pusn from participant where pusn = '$usn2'
";
$result_part = mysql_query($sql_to_check_part);
if(mysql_num_rows($result_part)<2)
{
	
	echo "<div class='alert alert-danger'>You need to Register first. <a href='participant.php'>Click Here</a></div>";
}

else
{
	

if(isset($_POST['paid']))
{
	echo "sss";
	$pays_to = $_SESSION['user'] = strtoupper($_SESSION['user']);
	echo $pays_to;
	$sql_insert_team = mysql_query("INSERT INTO team(TNAME,eid,pays_to) VALUES('$tname',$eid,'$pays_to')");
}
else
{
$sql_insert_team = mysql_query("INSERT INTO team(TNAME,eid) VALUES('$tname',$eid)");
}


$last=mysql_query("SELECT tid FROM team ORDER BY tid DESC LIMIT 1");
$last_tid=0;
while($row = mysql_fetch_array($last))
{
$last_tid = $row['tid'];
}
echo $last_tid;

$sql_insert1=mysql_query("INSERT INTO belongs_to values('$usn1','$last_tid')");

$sql_insert2 = mysql_query("INSERT INTO belongs_to values('$usn2','$last_tid')");

if(!$sql_insert1 && !$sql_insert2)
{
	echo "<div class='alert alert-danger'>An Error Occured.</div>";
}

else
{
	$sql_insert3=mysql_query("Insert into participates_in values('$usn1',$eid)");
	
	if(!$sql_insert3)
	{
		echo "21111";
	echo "<div class='alert alert-danger'>".$usn1." already Participating in this Event.</div>";
	$sql_delete = mysql_query("DELETE FROM TEAM WHERE TID = $last_tid");
	}
	else
	{
		$sql_insert4=mysql_query("Insert into participates_in values('$usn2',$eid)");
	if(!$sql_insert4)
	{
	echo "<div class='alert alert-danger'>".$usn2." already Participating in this Event.</div>";
	$sql_delete2 = mysql_query("DELETE FROM TEAM WHERE TID = $last_tid");
	$sql_delete3 = mysql_query("DELETE FROM participates WHERE pusn = '$usn1'");
	}
	else
	{
		echo "<div class='alert alert-success'>You have Sucessfully Registered</div>";
	}
}
}





}
	
}
?>

</body>
</html>