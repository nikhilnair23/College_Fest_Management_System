<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Volunteer Login</title>
<link href="../css/styleForProject.css" rel="stylesheet" type="text/css"/>
<link href="../css/bootstrap.min.css"  rel="stylesheet" type="text/css"/>
<?php 
// check the login
session_start();
if(isset($_SESSION['user']))
header("location :myAccount.php");
$flag = 0;$flagMsg="";
if(isset($_POST['log']))
{
include("connect.php");
$myusername=$_POST['username']; 
$mypassword=$_POST['password']; 
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$sql="SELECT * FROM ADMIN WHERE USERNAME='$myusername' and PASS='$mypassword'";
$result=mysql_query($sql);


$count=mysql_num_rows($result);
$myusername = strtoupper($myusername);
$sql_usn = "SELECT * FROM VOLUNTEER WHERE USN='$myusername' and PWD='$mypassword'";
$result_usn=mysql_query($sql_usn);
$count = $count + mysql_num_rows($result_usn);

if($count==1){


$_SESSION['user']=strtolower($myusername);

header("location:myAccount.php");
}
else {$flag = 1;
$flagMsg.= "Wrong Username or Password";
}
}
?>
</head>
<body>
<div class="container-fluid">
<div class="row">
<header id="pageHeader" >
Udbhav Volunteer Login
</header>
</div>
</div>
<div class="container"><div class="row">

<section class="col-sm-8 col-sm-offset-2" id="formBody">
<?php if($flag){ ?>
<div class="alert alert-danger"><?php echo $flagMsg; ?></div>
<?php } ?>
<form method="post" name="login" action="login.php">
<div class="col-sm-6 col-sm-offset-3">
<div class="form-group">
<label>USN</label>
<input name = "username" id="username" class="form-control" type="text" placeholder="Enter USN..."/>
</div>
</div>
<div class="col-sm-6 col-sm-offset-3">
<div class="form-group">
<label>PASSWORD</label>
<input name="password" id="password"class="form-control" type="password" placeholder="Password..."/>
</div>
</div>
<div class="col-sm-6 col-sm-offset-3">
<div class="form-group">
<input name="log" id="log" class="btn btn-success btn-block" type="submit" value="Login"  />
</div>
</div>
</form>

</section>
</div></div>
<div class="col-sm-4 col-sm-offset-4">
<div class="form-group">
<a class="btn btn-info btn-block" href="volReg.php">Register</a>
</div>
</div>

</body>
</html>