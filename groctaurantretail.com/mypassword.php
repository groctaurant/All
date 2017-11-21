<?php

include 'db/config.php';
if(!empty($_POST["data"])) {  
	$mer_id = $_POST["data"];
	$query = mysqli_query($con, "SELECT * from grret_merchants where mer_id = '$mer_id'");
	$row = mysqli_fetch_array($query);
	$pass = $row['mer_pin'];
	echo $pass;	
}

?>