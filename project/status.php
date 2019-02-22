<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Volunteer Login</title>
<link href="../css/styleForProject.css" rel="stylesheet" type="text/css"/>
<link href="../css/bootstrap.min.css"  rel="stylesheet" type="text/css"/><?php
$content="";
if($_SERVER['REQUEST_METHOD']=='POST')
{
	include("connect.php");
	$usn = mysql_real_escape_string($_POST['usn']);
	
	$sql_status = "";
	
}
?>
</head>
<body>
<div class="container-fluid">
<div class="row">
<header id="pageHeader" >
Check Events
</header>
</div>
</div>
<div class="container"><div class="row">
<section class="col-sm-8 col-sm-offset-2" id="formBody">

<form method="post" name="checkStatus" action="status.php">
<div class="col-sm-6 col-sm-offset-3">
<div class="form-group">
<label>USN</label>
<input name = "usn" id="usn" class="form-control" type="text" placeholder="Enter USN..."/>
</div>
</div>
<div class="form-group">
<div class="col-sm-6 col-sm-offset-3">
<input class="btn btn-success" type="submit" value="Check Status"  />
</div>
</div>
</form>
</section>
<div class="col-sm-12">
<div class="box">
<?php echo $content;?>
</div>
</div>

</body>
</html>