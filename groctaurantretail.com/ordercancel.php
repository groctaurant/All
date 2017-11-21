<?php
include('session.php');
include 'db/config.php';
$id = $_GET['id'];
// echo $id;
// die();
$status = "Cancelled";
$query = mysqli_query($con, "UPDATE grret_orders set ord_status = '$status', payment_status= 'Cancelled' where ord_id= '$id'");
if($query){
	header("Location: myorders.php");
} else {
	echo mysqli_error($con);
}

?>
