<?php

include '../../db/config.php';
$query2 = mysqli_query($con, "SELECT * from grret_shopstat where id=1");
$row2 = mysqli_fetch_array($query2,MYSQLI_ASSOC);
$shop_stat = $row2['shop_stat'];
$order_number = $row2['order_number'];
if($shop_stat == "CLOSE SHOP"){
	$shop_stat = "OPEN SHOP";
} else {
	$shop_stat = "CLOSE SHOP";
	$order_number = 1;
}
mysqli_query($con, "UPDATE grret_shopstat set shop_stat = '$shop_stat', order_number = '$order_number' where id=1");
header("Location: orders.php");

?>