<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Create Events</title>
<link href="../css/styleForProject.css" type="text/css" rel="stylesheet" />
<link href="../css/bootstrap.min.css" type="text/css" rel="stylesheet" /><?php
include("connect.php");


function checkAdmin()
{
	$admin = 'admin';
	if($_SESSION['user'] == $admin)
	return 1;
	else
	return 0;
}


session_start();
if(!isset($_SESSION['user'])){
header("location:login.php");
}
if(!checkAdmin())
{
	header("location:myAccount.php");
}

$coodUsn ="<select class='form-control' name='c_usn' id='c_usn'>";

$coodUsn_sql = "Select usn,name from volunteer where not exists
( select eid from event
Where volunteer.usn=event.c_usn)";

$coodUsn_result = mysql_query($coodUsn_sql);

while($row = mysql_fetch_array($coodUsn_result))
{
	$coodUsn.="<option value='".$row[0]."'>".$row[1]." (".$row[0].")</option>";
}

$coodUsn.="</select>";
if($_SERVER['REQUEST_METHOD']=='POST')
{
	
}

?>
</head>

<body>
<header id="pageHeader">Create udbhav Events</header>
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
<div id="eventFormCont">
<form method="post">
<div class="col-sm-7">
<div class="form-group">
<label>Event Name</label>
<input type="text" id="eventName" class="form-control" placeholder="Enter Event Name"  />
</div>
</div>
<div class="col-sm-5">
<div class="form-group">
<label>Event Type</label>
<select class="form-control" name="etype" id="etype"><option value="arts">Arts
</option><option value="literary">Literary
</option><option value="music">Music
</option><option value="misc">Misc.
</option><option value="dance">Dance
</option></select>
</div>
</div>
<div class="col-sm-4">
<div class="form-group">
<label>Maximum Number Of Participants</label><!-- natural number -->
<input type="text" id="maxPart" name="maxPart" class="form-control" placeholder="Enter the max. no. of Participants" />
</div>
</div>
<div class="col-sm-4">
<div class="form-group">
<label>location</label><!-- No spl charaters -->
<input type="text" class="form-control" id="location" name="location" placeholder="Enter Location"  />
</div></div>
<div class="col-sm-4">
<div class="form-group"><!-- No decimal -->
<label>participation fee</label>

<input type="text" class="form-control" id="fee" name="fee" placeholder="Enter Fees" />
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<!-- date format YYYY-MM-DD HH:MI:SS -->

<label>Enter Date and Time (format: YYYY-MM-DD HH:MI:SS)</label>
<input type="text" id="dateTime" name="dateTime" class="form-control" placeholder="Enter Date..." />
</div>
</div>
<div class="col-sm-6">
<div class="form-group">
<!-- date format YYYY-MM-DD HH:MI:SS -->

<label>Maximum Time (No Decimal)</label>
<input type="text" id="max_time" name="max_time" class="form-control" placeholder="Enter Hours Eg. 2:00:00" />
</div>
</div>
<div class="col-sm-12">
<div class="form-group">
<label>Coordinator USN</label>
<!--Don't bother about this now -->

<?php echo $coodUsn; ?>
</div>
</div>
<div class="form-group">
<div class="col-sm-12">
<input type="submit" class="btn btn-block btn-success" value="Create Event" />
</div>
</div>
</form>
</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

</body>
</html>
