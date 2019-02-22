<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>create Participant</title>
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
$college = mysql_real_escape_string($_POST['college']);
$email = mysql_real_escape_string($_POST['email']);
$phno = mysql_real_escape_string($_POST['phno']);

$name = strtoupper($name);
$usn  = strtoupper($usn);

$flag = 0;
$sql = "SELECT pusn FROM participant WHERE pusn = '$usn'";
$result_test = mysql_query($sql);
$count = mysql_num_rows($result_test);
if($count>0)
$flag++;
if(!$flag)
{
	$sql_insert = "INSERT INTO participant(name,pusn,college,email,phno)
					VALUES ('$name','$usn','$college','$email','$phno')";
	$result_insert=mysql_query($sql_insert);
	if($result_insert){
	$success = "<div class='alert alert-success'>You Are a participant Now</div>";}
	else{
	$fail= "<div class='alert alert-danger'>An Unexpected Error Occured.</div>";
}
}
else
{
	$oops = "<div class='alert alert-info'>Oops! You are already a participant. <a href='login.php'>Login Now</a></div>";
}

}

?>
</head>

<body>
<header id="pageHeader">Create Participant</header>
<div class="container">
<div class="row">
<div id="formBody">
<form action="participant.php" method="post">
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


<div class="col-sm-4">
<div class="form-group">
<label>College</label>
<input class="form-control" id="college" type="text" name="college" />
</div>
</div>
<div class="col-sm-4">
<div class="form-group">
<label>Email</label>
<input class="form-control" id="email" type="email" name="email" />
</div>
</div>
<div class="col-sm-4">
<div class="form-group">
<label>Phone Number</label>
<input class="form-control" id="phno" type="text" name="phno" />
</div>
</div>
<div class="col-sm-5">
<div class="form-group">

</div>
</div>
<div class="col-md-12">
<div class="form-group">
<input class="btn btn-success btn-block" id="register" type="submit" name="participant" value="Create Participant" />
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