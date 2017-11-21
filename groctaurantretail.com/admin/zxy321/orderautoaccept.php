<?php

include '../../db/config.php';
$query1 = mysqli_query($con, "SELECT ord_acc from grret_ordersautoaccept where id=1");
$row1 = mysqli_fetch_array($query1,MYSQLI_ASSOC);
$order_accept = $row1['ord_acc'];
if($order_accept == "Automatic Accept"){
	$order_accept = "Manual Accept";
} else {
	$order_accept = "Automatic Accept";
}
mysqli_query($con, "UPDATE grret_ordersautoaccept set ord_acc = '$order_accept' where id=1");
header("Location: orders.php");

?>