	<?php
	session_start();
	$item1 = '';
	$item2 = '';
	$item3 = '';
	$quantity1 = '';
	$quantity2 = '';
	$quantity3 = '';
	$ordertype = '';
	$comments = '';
	$coupon = '';
	$total ='';
	



		$ok = true;

		
		if (!isset($_POST['item1']) || $_POST['item1']==''){

			$ok = false;
		}
		else{
			$item1 = $_POST['item1'];
			$item2 = $_POST['item2'];
			$item3 = $_POST['item3'];
			
		}

		if (!isset($_POST['quantity1']) || $_POST['quantity1']==''){

			$ok = false;
		}
		else{
			$quantity1 = $_POST['quantity1'];
			$quantity2 = $_POST['quantity2'];
			$quantity3 = $_POST['quantity3'];
		}
		
		
		
	if (!isset($_POST['comments']) || $_POST['comments']==''){

			$ok = false;
		}
		else{
			$comments = $_POST['comments'];

		}
		if (!isset($_POST['ordertype']) || $_POST['ordertype']==''){

			$ok = false;
		}
		else{
			$ordertype = $_POST['ordertype'];

		}

if (!isset($_POST['coupon']) || $_POST['coupon']==''){

			$ok = false;
		}
		else{
			$coupon = $_POST['coupon'];

		}
	$db = mysqli_connect('localhost','root','','foodpanda');
$sql= sprintf("select itemid,price from menu where itemid='%s'",mysqli_real_escape_string($db,$item1));
    $result = mysqli_query($db,$sql);
    $row = $result->fetch_assoc();
    $price1 = $row['price'];

mysqli_close($db);



$db = mysqli_connect('localhost','root','','foodpanda');
$sql= sprintf("select itemid,price from menu where itemid='%s'",mysqli_real_escape_string($db,$item2));
    $result = mysqli_query($db,$sql);
    $row = $result->fetch_assoc();
    $price2 = $row['price'];

mysqli_close($db);

$db = mysqli_connect('localhost','root','','foodpanda');
$sql= sprintf("select itemid,price from menu where itemid='%s'",mysqli_real_escape_string($db,$item3));
    $result = mysqli_query($db,$sql);
    $row = $result->fetch_assoc();
    $price3 = $row['price'];

mysqli_close($db);
if($coupon === 'CC2')
{
$total = (($price1 * $quantity1) + ($price2 * $quantity2) + ($price3 * $quantity3))-2;

}
else
{
$c = (($price1 * $quantity1) + ($price2 * $quantity2) + ($price3 * $quantity3));
$total = $c * 0.5;
}


if ($ok)
{
//Add a database here


	//Below command if for connecting to the required database
	$db = mysqli_connect('localhost','root','','foodpanda');
	//Below condition checks the connection status of database
	if (!$db)
		die("Database Connection Failed Error:". mysqli_connect_error());
    //Below query is for inserting a row into the table user

	$sql= sprintf("INSERT INTO placeorder(customer,ordertype,comments,item1,item2,item3,quantity1,quantity2,quantity3,total) VALUES('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')", 
		mysqli_real_escape_string($db,$_SESSION['id']),
		mysqli_real_escape_string($db,$ordertype),
		mysqli_real_escape_string($db,$comments),
		mysqli_real_escape_string($db,$item1),
		mysqli_real_escape_string($db,$item2),
		mysqli_real_escape_string($db,$item3),
		mysqli_real_escape_string($db,$quantity1),
		mysqli_real_escape_string($db,$quantity2),
		mysqli_real_escape_string($db,$quantity3),
		mysqli_real_escape_string($db,$total));
	

	//The below condition checks the query success status
	 if(mysqli_query($db,$sql))
	{
	 #	$last_id = mysqli_insert_id($db);
		
        echo "Coupon Applied!,Please pay to complete the Order" ;
       $last_id = mysqli_insert_id($db);

           }

    else {

  	echo "Error:" . $sql . "<br>" . mysqli_error($db);
         }
         mysqli_close($db);
}
?>


<!DOCTYPE html>
<html>
<head>
<title>Payment</title>
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
return confirm("Do you really want to pay");
}
</script>
</head>
<h1>Please Enter Card Details to Proceed for Payment</h1>



<body>
	

<br>
<form method="post" action="payment_acknowledge.php" id="paymentform" enctype="multipart/form-data" >


<label for="total">Total Bill(In $)*</label><input type="text" id="total" name="total" value="<?php

echo htmlspecialchars ($total);

?>" readonly><br><br>

<label for="orderid">Orderid*</label><input type="text" id="orderid" name="orderid" value="<?php

echo htmlspecialchars ($last_id);

?>" readonly><br><br>


<fieldset>
<legend>Enter Account Number To Make Payment</legend>
<label for="account">Account Number*</label><input type="number"  max="9999999999" id="account" name="account" placeholder="Enter Account number" value="<?php

echo htmlspecialchars ($account);

?>" required>

</fieldset>

<br><br><br><br><br><br><br><br>
<input style="background-color:black;color:red" type="submit" name="submit" value="Pay"></input>
 <input style="background-color:black;color:red" type="reset" value="Reset"></input><br><br>
 <input style="float:center;padding:5px;background-color:black;color:red" type="button" onclick="location='home.php'" value="Return to home Page"></input><br>

</form>
</body>
</html>