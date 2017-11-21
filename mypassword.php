<?php

include 'config.php';
if(!empty($_POST["data"])) {  
	$phone = $_POST["data"];
	$query = mysqli_query($con, "SELECT * from web_customers WHERE phone = '$phone'");
	$row = mysqli_fetch_array($query);
	$pass = $row['password'];
	echo $pass;	
}

?>