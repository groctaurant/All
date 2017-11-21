<?php

include '../../db/config.php';
if(isset($_POST['submit'])){
	$discount = $_POST['discount'];
	mysqli_query($con, "UPDATE grret_discounts set discount = '$discount' where id=1");
	header("Location: orders.php");
}
?>