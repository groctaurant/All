<?php
include '../../db/config.php';
$id = $_POST['id'];
$pay_type = "Payment Collected via ".$_POST['pay_type'];
$query = mysqli_query($con, "UPDATE grret_orders set payment_status = '$pay_type' where id = '$id'");
if($query){
echo "<p>Payment Status:</p>Payment Collected via ".$_POST['pay_type'];
} else {
echo "error";
}
?>