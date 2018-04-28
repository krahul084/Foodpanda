<!DOCTYPE html>
<html>
<head>
<title>Place Order</title>
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

</head>

<h1>Place Order</h1>


<body>
	<?php
	/*
	session_start();
	$item1 = '';
	$item2 = '';
	$item3 = '';
	$quantity1 = '';
	$quantity2 = '';
	$quantity3 = '';
	$ordertype = '';
	$comments = '';
	


if (isset($_POST['submit']))
	{
		$ok = true;

		
		if (!isset($_POST['item1']) || $_POST['item1']==''){

			$ok = false;
		}
		else{
			$item1 = $_POST['item1'];
			$item2 = $_POST['item2'];
			$item3 = $_POST['item3'];
			echo "item1";
		}

		if (!isset($_POST['quantity1']) || $_POST['quantity1']==''){

			$ok = false;
		}
		else{
			$quantity1 = $_POST['quantity1'];
			$quantity2 = $_POST['quantity2'];
			$quantity3 = $_POST['quantity3'];
		}
		
		
		$comments = $_POST['comments'];
	
		if (!isset($_POST['ordertype']) || $_POST['ordertype']==''){

			$ok = false;
		}
		else{
			$ordertype = $_POST['ordertype'];

		}

	


	
if ($ok){
//Add a database here


	//Below command if for connecting to the required database
	$db = mysqli_connect('localhost','root','','foodpanda');
	//Below condition checks the connection status of database
	if (!$db)
		die("Database Connection Failed Error:". mysqli_connect_error());
    //Below query is for inserting a row into the table user

	$sql= sprintf("INSERT INTO placeorder(customer,ordertype,comments,item1,item2,item3,quantity1,quantity2,quantity3) VALUES('%s','%s','%s','%s','%s','%s','%s','%s','%s')", 
		mysqli_real_escape_string($db,$_SESSION['id']),
		mysqli_real_escape_string($db,$ordertype),
		mysqli_real_escape_string($db,$comments),
		mysqli_real_escape_string($db,$item1),
		mysqli_real_escape_string($db,$item2),
		mysqli_real_escape_string($db,$item3),
		mysqli_real_escape_string($db,$quantity1),
		mysqli_real_escape_string($db,$quantity2),
		mysqli_real_escape_string($db,$quantity3));
	

	//The below condition checks the query success status
	 if(mysqli_query($db,$sql))
	{
	 #	$last_id = mysqli_insert_id($db);
		header('Location:make_payment.php');
        echo "Placed Order Successfully" ;
       

           }

    else {

  	echo "Error:" . $sql . "<br>" . mysqli_error($db);
         }
         mysqli_close($db);

	
}
}
*/
	?>

<br>
	

<!--
HTML FORM formatting is done below
-->
<form method="post" action="make_payment.php" id="orderform" enctype="multipart/form-data" >

<fieldset>
<legend>Enter Maximum 3 Items only</legend>


<table>
<tr>
    <td>Item 1*</td>
    <!--
    <td><input type="text" name="source" /></td>
-->
<td> 
	<?php

$conn = new mysqli('localhost', 'root', '', 'foodpanda') 
or die ('Cannot connect to db');

     $result = $conn->query("select itemid, itemname from menu");
    
    echo "<select name='item1'>";

    while ($row = $result->fetch_assoc()) {

                  unset($itemid, $name);
                  $itemid = $row['itemid'];
                  $itemname = $row['itemname']; 
                  echo '<option value="'.$itemid.'">'.$itemname.'</option>';
                 
}

    echo "</select>";
?>
</td>
<td>
<label for="quantity1">Quantity*</label><input type="number" max="5" id="quantity1" name="quantity1" placeholder="Enter Quantity" value="<?php

echo htmlspecialchars ($quantity1);

?>" required>
</td>	


</tr>


<tr>
    <td>Item 2</td>
    <!--
    <td><input type="text" name="source" /></td>
-->
<td> 
	<?php

$conn = new mysqli('localhost', 'root', '', 'foodpanda') 
or die ('Cannot connect to db');

     $result = $conn->query("select itemid, itemname from menu");
    
    echo "<select name='item2'>";

    while ($row = $result->fetch_assoc()) {

                  unset($itemid, $name);
                  $itemid = $row['itemid'];
                  $itemname = $row['itemname']; 
                  echo '<option value="'.$itemid.'">'.$itemname.'</option>';
                 
}

    echo "</select>";
?>
</td>
<td>
<label for="quantity2">Quantity </label><input type="number" max="5" id="quantity2" name="quantity2" placeholder="Enter Quantity" value="<?php

echo htmlspecialchars ($quantity2);

?>">
</td>
</tr>

<tr>
    <td>Item 3</td>
    <!--
    <td><input type="text" name="source" /></td>
-->
<td> 
	<?php

$conn = new mysqli('localhost', 'root', '', 'foodpanda') 
or die ('Cannot connect to db');

     $result = $conn->query("select itemid, itemname from menu");
    
    echo "<select name='item3'>";

    while ($row = $result->fetch_assoc()) {

                  unset($itemid, $name);
                  $itemid = $row['itemid'];
                  $itemname = $row['itemname']; 
                  echo '<option value="'.$itemid.'">'.$itemname.'</option>';
                 
}

    echo "</select>";
?>
</td>
<td>
<label for="quantity3">Quantity  </label><input type="number" max="5" id="quantity3" name="quantity3" placeholder="Enter Quantity" value="<?php

echo htmlspecialchars ($quantity3);

?>">
</td>
</tr>

</table>
</fieldset>
<br><br><br><br><br><br><br>
<fieldset>
<legend>Customer Preference</legend>
Order Type*
 <input type="radio" name="ordertype" value="Pickup" checked> Pickup
  <input type="radio" name="ordertype" value="HomeDelivery"> Home Delivery<br>

Apply Coupon*
 <input type="radio" name="coupon" value="CC2" checked> CC2
 <input type="radio" name="coupon" value="CC50percent"> CC50percent<br>

<br>

<label for="comments">Customer Comments*</label><br><textarea maxlength="1000" id="comments" name="comments" placeholder="Enter below 100 words" rows="5" cols="25"  value="<?php

echo htmlspecialchars ($comments);
?>" required wrap="hard"></textarea><br><br>
 
</fieldset>

<div class="other">
	<br>
 
 <input style="background-color:black;color:red" type="submit" name="submit" value="View Total Bill"></input>
 <input style="background-color:black;color:red" type="reset" value="Reset"></input><br><br>
 <input style="float:center;padding:5px;background-color:black;color:red" type="button" onclick="location='home.php'" value="Return to Home Page"></input><br>
 
</div>
</form>

</body>
</html>

