<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Volunteer Registration</title>
<link href="../css/styleForProject.css" type="text/css" rel="stylesheet" />
<link href="../css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<?php

$success="";
$fail="";
$oops="";

include("connect.php");

$eventlist="";

$sql_event= "select eid,ename from event";

$eventlist.="<select name='event' class='form-control' id='event'>";
$result_event = mysql_query($sql_event);
while($row = mysql_fetch_array($result_event))
{
	$eventlist.="<option value='".$row['eid']."'>".$row['ename']."</option>";
	
}
$eventlist.="</select>";
if($_SERVER['REQUEST_METHOD']=='POST')
{


$name = mysql_real_escape_string($_POST['name']);
$usn = mysql_real_escape_string($_POST['usn']);
$pwd = mysql_real_escape_string($_POST['pwd']);
$sem = mysql_real_escape_string($_POST['sem']);
$sec = mysql_real_escape_string($_POST['sec']);
$branch = mysql_real_escape_string($_POST['studentDepartment']);
$email = mysql_real_escape_string($_POST['email']);
$phno = mysql_real_escape_string($_POST['phno']);

$name = strtoupper($name);
$usn  = strtoupper($usn);

$flag = 0;
$sql = "SELECT USN FROM VOLUNTEER WHERE USN = '$usn'";
$result_test = mysql_query($sql);
$count = mysql_num_rows($result_test);
if($count>0)
$flag++;
if(!$flag)
{
	$sql_insert = "INSERT INTO VOLUNTEER
					VALUES ('$name','$usn','$email','$branch','$phno','$pwd','$sem','$sec')";
	$result_insert=mysql_query($sql_insert);
	if($result_insert){
	$success = "<div class='alert alert-success'>You Are a Volunteer Now</div>";}
	else{
	$fail= "<div class='alert alert-danger'>An Unexpected Error Occured.</div>";
}
}
else
{
	$oops = "<div class='alert alert-info'>Oops! You are already a volunteer. <a href='login.php'>Login Now</a></div>";
}

}
?>
</head>

<body>
<header id="pageHeader">Volunteer Registration</header>
<div class="container">
<div class="row">
<div id="formBody">
<form action="volReg1.php" method="post">
<div class="col-md-12">
<div class="form-group">
<label>Name</label>
<input class="form-control" id="name" type="text" name="name" />
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>USN</label>
<input class="form-control" id="usn" type="text" name="usn" />
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Password </label>
<input class="form-control" id="pwd" type="password" name="pwd" />
</div>
</div>

<div class="col-sm-4">
<div class="form-group">
<label>Semester</label>
<input class="form-control" id="sem" type="text" name="sem" />
</div>
</div>

<div class="col-sm-4">
<div class="form-group">
<label>Section</label>
<input class="form-control" id="sec" type="text" name="sec" />
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>Department</label>
<select class="form-control" required="required" id="department" name="studentDepartment" >
<option value="CV" selected="selected">Civil Engineering </option>
<option  value="IM">Industrial Engineering & Management</option>
<option value="ME">Mechanical Engineering 	</option>
<option value="IT">Instrumentation Technology</option>
<option value="EE">Electrical & Electronics Engineering</option>
<option value="IS">Information Science & Engineering</option>
<option value="EC">Electronics & Communications Engineering </option>
<option value="TC">Telecommunication Engineering</option>
<option value="CS">Computer Science & Engineering</option>
<option value="ML">Medical Electronics</option>
<option value="CE">Chemical Engineering </option>
<option value="BT">Biotechnology</option>
<option value="AT">Architecture</option>
</select> 
</div>
</div>
<div class="col-sm-5">
<div class="form-group">
<label>Email</label>
<input class="form-control" id="email" type="email" name="email" />
</div>
</div>
<div class="col-sm-2">
<div class="form-group">
<label>Phone Number</label>
<input class="form-control" id="phno" type="password" name="phno" />
</div>
</div>
<div class="col-sm-5">
<div class="form-group">
<label>Available Events</label>
<?php echo $eventlist; ?>
</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input class="btn btn-success btn-block" id="volunteer" type="submit" name="vounteer" value="Volunteer Now!" />
</div>
</div>
</form>
<?php
echo "<div class='col-md-12'>".$success.$fail.$oops."</div>";
 
?>
</div>
</div>
</div>
</body>
</html>