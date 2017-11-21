<?php

include '../../db/config.php';
$id = $_GET['id'];
$query2 = mysqli_query($con, "SELECT * from grret_merchants where id='$id'");
$row2 = mysqli_fetch_array($query2,MYSQLI_ASSOC);
$credit_limit = $row2['credit_limit'];
$value = $_GET['credit_limit'];
$credit_limit = $credit_limit + $value;

mysqli_query($con, "UPDATE grret_merchants set credit_limit = '$credit_limit' where id='$id'");
header("Location: merchant.php");

?>