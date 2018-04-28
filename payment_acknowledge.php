<?php
session_start();
$account = '';


if (!isset($_POST['account']) || $_POST['account']==''){

			$ok = false;
			
		}
		else{
			$account = $_POST['account'];

		}

		if (!isset($_POST['orderid']) || $_POST['orderid']==''){

			$ok = false;
			
		}
		else{
			$orderid = $_POST['orderid'];

		}

//Below command if for connecting to the required database
	$db = mysqli_connect('localhost','root','','foodpanda');
	//Below condition checks the connection status of database
	if (!$db)
		die("Database Connection Failed Error:". mysqli_connect_error());
    //Below query is for inserting a row into the table user

	$sql= sprintf("select account from user where userid='%s'",mysqli_real_escape_string($db,$_SESSION['id']));
    $result = mysqli_query($db,$sql);
    $row = $result->fetch_assoc();



if($account === $row['account'])
{	
	mysqli_close($db);

	$db = mysqli_connect('localhost','root','','foodpanda');
$sql= sprintf("INSERT INTO payment(customer,orderid) VALUES('%s','%s')", 
		mysqli_real_escape_string($db,$_SESSION['id']),
		mysqli_real_escape_string($db,$orderid));
	
	if(mysqli_query($db,$sql)){
	echo 'You have payed for the order, ';
	
	echo " Please keep the order number carefully for future reference  ";
	echo $orderid;
	
}
 else {

  	echo "Error:" . $sql . "<br>" . mysqli_error($db);
         }
         mysqli_close($db);
}
else
		echo "Invalid Card Details!";


	?>
<br><br><br>
<link rel="stylesheet" type="text/css" href="style.css"/>
 <input style="float:center;padding:5px;background-color:black;color:red" type="button" onclick="location='home.php'" value="Return to home Page"></input><br>


