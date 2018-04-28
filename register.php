<!DOCTYPE html>
<html>
<head>
<title>REGISTER</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
<style type="text/css">
body {color:red}
body {background-color:	grey}
fieldset {
float:left;
}


.other{

	clear:both;

}



</style>
<script type="text/javascript">
function onProfileSubmitted(){
return confirm("Do you really want to submit");
}
</script>
</head>

<h1>Please Fill Registration Form:</h1>


<body>
	<?php
	$password = '';
	$name = '';
	$address = '';
    $email = '';
	$mobile = '';
	$account = '';


if (isset($_POST['submit']))
	{
		$ok = true;

		
		if (!isset($_POST['password']) || $_POST['password']==''){

			$ok = false;
		}
		else{
			$password = $_POST['password'];
		}
		
		
	if (!isset($_POST['name']) || $_POST['name']==''){

			$ok = false;
		}
		else{
			$name = $_POST['name'];
		}
	
	
		if (!isset($_POST['address']) || $_POST['address']==''){

			$ok = false;
		}
		else{
			$address = $_POST['address'];
		}

		if (!isset($_POST['email']) || $_POST['email']==''){

			$ok = false;
		}
		else{
			$email = $_POST['email'];
		}

if (!isset($_POST['mobile']) || $_POST['mobile']==''){

			$ok = false;
		}
		else{
			$mobile = $_POST['mobile'];
		}

if (!isset($_POST['account']) || $_POST['account']==''){

			$ok = false;
		}
		else{
			$account = $_POST['account'];
		}

	
if ($ok){
//Add a database here
	$hash = password_hash($password, PASSWORD_DEFAULT);

	//Below command if for connecting to the required database
	$db = mysqli_connect('localhost','root','','foodpanda');
	//Below condition checks the connection status of database
	if (!$db)
		die("Database Connection Failed Error:". mysqli_connect_error());
    //Below query is for inserting a row into the table user

	$sql= sprintf("INSERT INTO user(password,name,address,email,mobile,account) VALUES('%s','%s','%s','%s','%s','%s')", 
		mysqli_real_escape_string($db,$hash),
		mysqli_real_escape_string($db,$name),
		mysqli_real_escape_string($db,$address),
		mysqli_real_escape_string($db,$email),
		mysqli_real_escape_string($db,$mobile),
		mysqli_real_escape_string($db,$account));

	//The below condition checks the query success status
	if (mysqli_query($db,$sql)){
		$last_id = mysqli_insert_id($db);
        echo "User Record Successfully Created";
           }
    else {

  	echo "Error:" . $sql . "<br>" . mysqli_error($db);
         }
         mysqli_close($db);

	
}
}

	?>

<br>
	

<!--
HTML FORM formatting is done
-->
<form method="post" action="" id="profileForm" enctype="multipart/form-data" onsubmit="return onProfileSubmitted()">

<fieldset>
<legend>Contact Information</legend>
<label for="name" >Name*</label><input type="text" id="name" name="name" placeholder="Enter Name" value="<?php

echo htmlspecialchars ($name);

?>"required> <br><br>

<label for="address">Address*</label><br><textarea maxlength="1000" id="address" name="address" placeholder="Enter below 100 words" rows="5" cols="25"  value="<?php

echo htmlspecialchars ($address);
?>" required wrap="hard"></textarea><br><br>
 
<label for="email">Email ID*</label><input type="email" id="email" name="email" placeholder="Enter Email ID" value="<?php

echo htmlspecialchars ($email);

?>"required><br><br>

<label for="mobile">Mobile*</label><input type="number"min="1000000000" max="9999999999" id="mobile" name="mobile" placeholder="Enter mobile number" value="<?php

echo htmlspecialchars ($mobile);

?>" required>
</fieldset>

<fieldset>
	<legend>Profile Information</legend>
	<br>
<label for="password">Password*</label> <input  type="password" id="password" name="password" placeholder="Enter Password" value="<?php

echo htmlspecialchars ($password);

?>"required> <br><br>


</fieldset>


<fieldset>
<legend>Account Details</legend>
<label for="account">Account Number*</label><input type="number" min="1000000000" max="9999999999" id="account" name="account" placeholder="Enter account number" value="<?php

echo htmlspecialchars ($account);

?>" required>
</fieldset>

<div class="other">
	<br>
 
 <input style="background-color:black;color:red" type="submit" name="submit" value="Profile Submit"></input>
 <input style="background-color:black;color:red" type="reset" value="Reset"></input><br><br>
 <input style="float:center;padding:5px;background-color:black;color:red" type="button" onclick="location='login.php'" value="Return to Login Page"></input><br>
 
</div>
</form>

</body>
</html>

