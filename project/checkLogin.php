<?php 
// check the login
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

$sql_usn = "SELECT * FROM VOLUNTEER WHERE USN='$myusername' and PWD='$mypassword'";
$result_usn=mysql_query($sql_usn);
$count = $count + mysql_num_rows($result_usn);

if($count==1){

session_start();
$_SESSION['user']=$myusername;

header("location:myAccount.php");
}
else {$flag = 1;
$flagMsg.= "Wrong Username or Password";
}
}
?>