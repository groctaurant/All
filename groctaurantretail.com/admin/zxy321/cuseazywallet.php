<?php
include '../../db/config.php';
$id = $_GET['id'];
$query2 = mysqli_query($con, "SELECT * from web_customers where id='$id'");
$row2 = mysqli_fetch_array($query2,MYSQLI_ASSOC);
$wallet = $row2['wallet'];
$wallet_balance_old = $wallet - $row2['earned_money'];
$phone = $row2['phone'];

$value = $_GET['wallet'];
$wallet_new = $wallet + $value;
$wallet_balance_new = $wallet_balance_old + $value;
date_default_timezone_set("Asia/Kolkata");
$trans_date = date("d-m-Y H:i:s");
mysqli_query($con, "UPDATE web_customers set wallet = '$wallet_new' where id='$id'");
if($value < 0){
	$value = -1 * $value;
	$trans_details = "Clearance";
	$trans_type = "Debit";
	mysqli_query($con, "INSERT into web_transactions(cus_phone, trans_date, trans_type, trans_details, walletcash_debit, walletcash_balance) VALUES('$phone', '$trans_date', '$trans_type', '$trans_details', '$value', '$walletcash_balance_new')");
} else {
	$trans_details = "Wallet Recharge";
	$trans_type = "Credit";
	mysqli_query($con, "INSERT into web_transactions(cus_phone, trans_date, trans_type, trans_details, walletcash_credit, walletcash_balance) VALUES('$phone', '$trans_date', '$trans_type', '$trans_details', '$value', '$walletcash_balance_new')");
}

header("Location: webcusview.php");
?>