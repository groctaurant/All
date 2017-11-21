<?php

include '../../db/config.php';
$id = $_GET['id'];
$query2 = mysqli_query($con, "SELECT * from grret_merchants where id='$id'");
$row2 = mysqli_fetch_array($query2,MYSQLI_ASSOC);
$wallet = $row2['mer_wallet'];
$mer_id = $row2['mer_id'];

$value = $_GET['wallet'];
$wallet = $wallet + $value;

date_default_timezone_set("Asia/Kolkata");
$trans_date = date("d-m-Y H:i:s");
mysqli_query($con, "UPDATE grret_merchants set mer_wallet = '$wallet' where id='$id'");
if($value < 0){
	$value = -1*$value;
	$trans_type = "Clearance";
	mysqli_query($con, "INSERT INTO grret_transactions(mer_id, trans_date, trans_type, debit, balance) VALUES ('$mer_id', '$trans_date', '$trans_type', '$value', '$wallet')");
} else {
	$trans_type = "Wallet Recharge";
	mysqli_query($con, "INSERT INTO grret_transactions(mer_id, trans_date, trans_type, credit, balance) VALUES ('$mer_id', '$trans_date', '$trans_type', '$value', '$wallet')");
}

header("Location: merchant.php");

?>