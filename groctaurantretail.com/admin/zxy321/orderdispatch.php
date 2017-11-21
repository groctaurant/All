<?php
include '../../db/config.php';
$id = $_POST['id'];
$status = "Dispatched";
date_default_timezone_set("Asia/Kolkata");
$dispatch_real = date("Y-m-d H:i:s");
mysqli_query($con, "UPDATE grret_orders set ord_status = '$status', dispatch_real='$dispatch_real' where id='$id'");
?>