<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Volunteer Registration</title>
<link href="../css/styleForProject.css" type="text/css" rel="stylesheet" />
<link href="../css/bootstrap.min.css" type="text/css" rel="stylesheet" />

<?php
session_start();
$flag=0;
if(isset($_SESSION['user'])){
$flag= 1;
}
?>
</head>

<body>
<header id="pageHeader">Sketching</header>
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
<div id="formBody">
<form action="sketching.php" method="post">
<div class="alert alert-info">Make Sure Your usn has been registered as a participant </div>
<div class="col-sm-4 col-sm-offset-4">
<div class="form-group">
<label>Usn </label>
<input class="form-control" id="usn" name="usn" placeholder="Enter usn " />
</div>
</div>
<div class="col-sm-4 col-sm-offset-4">

<input class="btn btn-success btn-block" type="submit" value="Register" />


</div>

</form></div>
</div></div>
<?php
include("connect.php");
if(isset($_POST['usn'])){
$usn=$_POST['usn'];
$eid=6;
/*query to check if the usn is there in volunteer */
$sql_check_usn = "select pusn from participant where pusn = '$usn'";
$sql_check_query = mysql_query($sql_check_usn);
$count = mysql_num_rows($sql_check_query);
if($count==0)
{
	echo "<div class='alert alert-danger'>You need to Register first. <a href='participant.php'>Click Here</a></div>";
}
else{
$sql_insert_team = mysql_query("INSERT INTO team(eid) VALUES($eid)");

$last=mysql_query("SELECT tid FROM team ORDER BY tid DESC LIMIT 1");
$last_tid=0;
while($row = mysql_fetch_array($last))
{
$last_tid = $row['tid'];
}
echo $last_tid;

$sql_insert1=mysql_query("INSERT INTO belongs_to values('$usn','$last_tid')");

$sql_insert2=mysql_query("Insert into participates_in values('$usn',$eid)");
if(!$sql_insert2)
{
	$oops.="<div class='alert alert-danger'>You are already Participating in this Event.</div>";
	$sql_delete = mysql_query("DELETE FROM TEAM WHERE TID = $last_tid");
	echo $oops;
}
else
{
	$oops="<div class='alert alert-success'>You have resgistered</div>";
	echo $oops;
}
}
}
?>

</body>
</html>