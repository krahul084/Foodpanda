<!Doctype html>
<html>
<title >Foodpanda</title>
<head>
	<!--
Javascript For Interaction of webpages
-->
<script type="text/javascript">
window.onload=function(){
alert("Welcome to Foodpanda.com");

};
</script>
<link rel="stylesheet" type="text/css" href="style.css"/>

<!--
Centralized Style Sheet
-->

<style type="text/css">
body{
    color:red;
    background-color:black;
}


</style>
</head>
<div align=center>
<h2 style="color:red">FoodPanda</h2>

<!--
For Authentication Check with backend database username and password
-->
<?php
session_start();
$message="";


if(isset($_POST['email']) && isset($_POST['password']))
{
$db = mysqli_connect('localhost','root','','foodpanda');
$sql = sprintf("SELECT * FROM user WHERE email='%s'",
	mysqli_real_escape_string($db,$_POST['email']));

$result = mysqli_query($db,$sql);
$row = mysqli_fetch_assoc($result);

if($row)

{

$hash=$row['password'];
$userType = $row['usertype']; 

if(password_verify($_POST['password'],$hash))
{
	

    $_SESSION['user']= $row['name'];
    $_SESSION['id']= $row['userid'];
    $_SESSION['userType']=$userType;
     $_SESSION['email']= $row['email'];

    if($userType == 'c')
    {
     header('Location:home.php');

    }

elseif($userType == 's')
{
header('Location:staff_home.php');


}
    elseif($userType == 'a')
    	header('Location:admin_home.php');

else
	echo "Invalid Account";
}


else
{

	$message = "Password Not Matching.";
}

}else
{
$message ='Credentials Incorr.';
}

mysqli_close($db);

}


echo "<p> $message </p>";



?>

<!--
Form defined here passes control to above php code with the user entered credentials as parameters
-->

<form method="post" style="float:center" action="">


  Email  <input style="float:center" type="text" name="email" placeholder="Enter Email"><br><br>
Password <input  style="float:center" type="password" name="password" placeholder="Enter Password"><br><br>
<input type="submit" style="float:center;color:red;background:black" value="Login"><br><br>
<input type="button" style="float:center;color:red;background:black" onclick="location='register.php'"  value="Register To Login"/>

</form>
<br><br>







</html>