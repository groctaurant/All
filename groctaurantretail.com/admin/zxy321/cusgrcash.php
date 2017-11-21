<?php
include '../../db/config.php';
$id = $_GET['id'];
$query2 = mysqli_query($con, "SELECT * from web_customers where id='$id'");
$row2 = mysqli_fetch_array($query2,MYSQLI_ASSOC);
$wallet = $row2['wallet'];
$gr_balance_old = $row2['earned_money'];
$phone = $row2['phone'];

$value = $_GET['wallet'];
$wallet_new = $wallet + $value;
$grcash_balance_new = $gr_balance_old + $value;
date_default_timezone_set("Asia/Kolkata");
$trans_date = date("d-m-Y H:i:s");
mysqli_query($con, "UPDATE web_customers set wallet = '$wallet_new', earned_money = '$grcash_balance_new' where id='$id'");
if($value < 0){
	$value = -1 * $value;
	$trans_details = "Clearance GR CASH";
	$trans_type = "Debit";
	mysqli_query($con, "INSERT into web_transactions(cus_phone, trans_date, trans_type, trans_details, grcash_debit, grcash_balance) VALUES('$phone', '$trans_date', '$trans_type', '$trans_details', '$value', '$grcash_balance_new')");
} else {
	$trans_details = "GR CASH Recharge";
	$trans_type = "Credit";
	mysqli_query($con, "INSERT into web_transactions(cus_phone, trans_date, trans_type, trans_details, grcash_credit, grcash_balance) VALUES('$phone', '$trans_date', '$trans_type', '$trans_details', '$value', '$grcash_balance_new')");
}

header("Location: webcusview.php");
?>