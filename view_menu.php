<!DOCTYPE>
<html>
<head>
	<title>View Menu</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
	  <style type = "text/css">

table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 80%;
}
th{
  background-color:blue;
border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;

}

td {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
    color: red;
}



</style>
</head>
<h1 style="color:White;background-color:sky-blue">Menu For Today</h1>
<body style="background-color:black;color:white">

	
<?php
session_start();
$db = mysqli_connect('localhost','root','','foodpanda');
if (!$db)
		die("Database Connection Failed Error:". mysqli_connect_error());
$sql= sprintf("select itemname,ingredients,price,itemtype from menu where status='available'");
$result = mysqli_query($db,$sql);
?>

<table>
  <tr>
    <th>Item</th>
    <th>Ingredients Used</th> 
     <th>Price($)</th>
    <th>V/NV</th>
 
  </tr>

 <?php foreach($result as $row) 
  { ?>
    <tr>
        <td><?php echo $row['itemname']; ?></td>

		<td><?php echo $row['ingredients']; ?></td>

		<td><?php echo $row['price']; ?></td>

		<td><?php echo $row['itemtype']; ?></td>

	
    </tr>
    <?php 
} 

mysqli_close($db);


?>
	<input style="float:right;padding:3px" type="button" onclick="location='home.php'" value="Return to home"></input><br>


</body>
</html>