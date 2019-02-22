<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register For Event</title>
<link href="../css/styleForProject.css" type="text/css" rel="stylesheet" />
<link href="../css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<?php
include("connect.php");
session_start();
$flag=0;
if(isset($_SESSION['user'])){
$flag= 1;
}

function checkAdmin()
{
	$admin = 'admin';
	if($_SESSION['user'] == $admin)
	return 1;
	else
	return 0;
}

if(!isset($_GET['eid']))
{
die();
}

$eid = $_GET['eid'];
//echo $eid;
$ename_sql = "select ename from event where eid = $eid";
$ename_result = mysql_query($ename_sql);
while($row = mysql_fetch_array($ename_result)){
$ename = $row['ename'];

}


?>
</head>

<body>
<header id="pageHeader"><?php echo $ename; ?></header>
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
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?eid=<?php echo $eid;?>" method="post">
<div class="alert alert-info">Make Sure Your usn has been registered as a participant </div>
<div class="alert alert-warning">Event Details - <?php
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
<div class="col-sm-4 col-sm-offset-4">
<div class="form-group">
<label>Usn </label>
<input class="form-control" id="usn" name="usn" placeholder="Enter usn " onblur="checkusn()" />
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

<script type="text/javascript">
var flag = [0,0,0,0,0,0,0];
var i;
var usn=document.getElementById("usn");
function checkusn()
{
var test=usn.value.search(/^[1-4]\w{2}\d{2}[a-zA-Z][a-zA-Z]\d{3}$/);
if(!(test>=0))
{
alert("usn is invalid");
flag[0]=1;
}
else
{
flag[0]=0;
}
}
window.onsubmit=function()
{
for(i=0;i<7;i++)
{
if(flag[i]==1)
{
return false;
}
}
}
</script>
<?php


if(isset($_POST['usn'])){
$usn=$_POST['usn'];

/*query to check if the /usn is there in volunteer */
$sql_check_usn = "select pusn from participant where pusn = '$usn'";
$sql_check_query = mysql_query($sql_check_usn);
$count = mysql_num_rows($sql_check_query);
if($count==0)
{
	echo "<div class='alert alert-danger'>You need to Register first. <a href='participant.php'>Click Here</a></div>";
}
else{
$tname="";
$tname_sql = "select name from participant where pusn= '$usn'";
$tname_result = mysql_query($tname_sql);
while($row= mysql_fetch_array($tname_result))
$tname = $row[0];
echo $tname;
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

$sql_insert1=mysql_query("INSERT INTO belongs_to values('$usn','$last_tid')");

$sql_insert2=mysql_query("Insert into participates_in values('$usn',$eid)");
if(!$sql_insert2)
{
	$oops="<div class='alert alert-danger'>You are already Participating in this Event.</div>";
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