<!DOCTYPE html>
<html>
<head>
<title>Add Item</title>
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
return confirm("Do you really want to add item?");
}
</script>
</head>

<h1>Please Add Item:</h1>


<body>
	<?php
	$itemname = '';
	$ingredients = '';
	$status = '';
    $price = '';
	$type = '';
	


if (isset($_POST['submit']))
	{
		$ok = true;

		
		if (!isset($_POST['itemname']) || $_POST['itemname']==''){

			$ok = false;
		}
		else{
			$itemname = $_POST['itemname'];
		}
		
		
	if (!isset($_POST['ingredients']) || $_POST['ingredients']==''){

			$ok = false;
		}
		else{
			$ingredients = $_POST['ingredients'];
		}
	
	
		if (!isset($_POST['status']) || $_POST['status']==''){

			$ok = false;
		}
		else{
			$status = $_POST['status'];
		}

		if (!isset($_POST['price']) || $_POST['price']==''){

			$ok = false;
		}
		else{
			$price = $_POST['price'];
		}

if (!isset($_POST['type']) || $_POST['type']==''){

			$ok = false;
		}
		else{
			$type = $_POST['type'];
		}



	
if ($ok){
//Add a database here


	//Below command if for connecting to the required database
	$db = mysqli_connect('localhost','root','','foodpanda');
	//Below condition checks the connection status of database
	if (!$db)
		die("Database Connection Failed Error:". mysqli_connect_error());
    //Below query is for inserting a row into the table user

	$sql= sprintf("INSERT INTO menu(itemname,ingredients,status,price,itemtype) VALUES('%s','%s','%s','%s','%s')", 
		mysqli_real_escape_string($db,$itemname),
		mysqli_real_escape_string($db,$ingredients),
		mysqli_real_escape_string($db,$status),
		mysqli_real_escape_string($db,$price),
		mysqli_real_escape_string($db,$type));

	//The below condition checks the query success status
	if (mysqli_query($db,$sql)){
	#	$last_id = mysqli_insert_id($db);
        echo "Item successfully added" ;
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
<form method="post" action="" id="itemform" enctype="multipart/form-data" onsubmit="return onProfileSubmitted()">

<fieldset>
<legend>Item Information</legend>
<label for="itemname" >Item Name*</label><input type="text" id="itemname" name="itemname" placeholder="Enter Item Name" value="<?php

echo htmlspecialchars ($itemname);

?>"required> <br><br>

<label for="ingredients">Ingredients*</label><br><textarea maxlength="1000" id="ingredients" name="ingredients" placeholder="Enter below 100 words" rows="5" cols="25"  value="<?php

echo htmlspecialchars ($ingredients);
?>" required wrap="hard"></textarea><br><br>
 
Status*
<label><input type="radio" name="status" value="available"<?php
if($status==='available'){

	echo(' checked');
}
?>>Available</label>
<label><input type="radio" name="status" value="Not Available"<?php
if($status==='Not Available'){

	echo(' checked');
}
?> required>Not Available</label><br><br>

<label for="price">Price($)*</label><input type="number" id="price" name="price" placeholder="Enter price" value="<?php

echo htmlspecialchars ($price);

?>" required><br><br>

Type*
<label><input type="radio" name="type" value="v"<?php
if($type==="v"){

	echo(' checked');
}
?>>Vegetarian</label>
<label><input type="radio" name="type" value="nv"<?php
if($type==="nv"){

	echo(' checked');
}
?> required>Non-Vegetarian</label><br><br>

</fieldset>


<div class="other">
	<br>
 
 <input style="background-color:black;color:red" type="submit" name="submit" value="Add Item"></input>
 <input style="background-color:black;color:red" type="reset" value="Reset"></input><br><br>
 <input style="float:center;padding:5px;background-color:black;color:red" type="button" onclick="location='staff_home.php'" value="Return to Home Page"></input><br>
 
</div>
</form>

</body>
</html>

