<!DOCTYPE html>

<html>
<link rel="stylesheet" type="text/css" href="style.css"/>
<h1>Welcome <?php session_start();
 echo   $_SESSION['user'] ?></h1>

<input type="button" style="float:center;color:red;background:black" onclick="location='add_item.php'"  value="Add Item"/>
<br><br>
 <input style="float:center;padding:5px" type="button" onclick="location='login.php'" value="Logout"></input><br>

</html>