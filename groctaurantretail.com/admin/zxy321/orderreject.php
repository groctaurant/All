<?php
include '../../db/config.php';
$id = $_POST['id'];

$sql="SELECT * from grret_orders where id='$id'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result); 
$old_status = $row['ord_status'];

if($old_status != "Rejected" && $ord_status != "Cancelled by Merchant"){

$profile = $row['profile'];
$total_price = $row['total_price'];
$mer_id = $row['mer_id'];
$ord_id = $row['ord_id'];
$payment_type = $row['payment_type'];
$ord_status = $row['ord_status'];
$oracle_recid = $row['oracle_recid'];
$number=$row['cus_phone'];
date_default_timezone_set("Asia/Kolkata");
$trans_date = date("d-m-Y H:i:s");
$status = "Rejected";
$msg="Order Rejected: Sorry, We cannot fulfil your order(Order ID ".$row['ord_id'].") at this time.";
if($ord_status == "Cancelled"){
	$status = "Cancelled by Merchant";
	$msg="Order Cancellation Confirmed(Order ID ".$row['ord_id'].")";
}
mysqli_query($con, "UPDATE grret_orders set ord_status = '$status', payment_status = 'Cancelled' where id='$id'");

if($mer_id != "website" && $mer_id != "androidapp"){
	$sqla="SELECT * from grret_merchants where mer_id='$mer_id'";
	$resulta = mysqli_query($con, $sqla);
	$rowa = mysqli_fetch_array($resulta);
	$wallet = $rowa['mer_wallet'];
	$walletloan = $rowa['mer_loanwallet'];

	if($payment_type == "Pay Via Wallet"){
		$wallet = $wallet + $total_price;
		mysqli_query($con, "UPDATE grret_merchants set mer_wallet = '$wallet' where mer_id='$mer_id'");
		$trans_type = "Refunded(".$ord_id.")";
		$queryx= mysqli_query($con, "INSERT INTO grret_transactions(mer_id, trans_date, trans_type, credit, balance) VALUES ('$mer_id', '$trans_date', '$trans_type', '$total_price', '$wallet')");
	} else if($payment_type == "Pay Via Loan Wallet") {
		$walletloan = $walletloan - $total_price;
		mysqli_query($con, "UPDATE grret_merchants set mer_loanwallet = '$walletloan' where mer_id='$mer_id'");
		$trans_type = "Refunded for loan wallet(".$ord_id.")";
		$queryx= mysqli_query($con, "INSERT INTO grret_loantransactions(mer_id, trans_date, trans_type, debit, loan) VALUES ('$mer_id', '$trans_date', '$trans_type', '$total_price', '$walletloan')");
	} else if($payment_type == "Pay Via Eazy Wallet"){
		$trans_type = "Refunded for EAZY(".$ord_id.")";
		$total_price1 = 0;
		$queryx= mysqli_query($con, "INSERT INTO grret_transactions(mer_id, trans_date, trans_type, credit, balance) VALUES ('$mer_id', '$trans_date', '$trans_type', '$total_price1', '$wallet')");
		$query_cus = mysqli_query($con , "SELECT * from web_customers where phone = '$profile'");
		$row_cus = mysqli_fetch_array($query_cus);
		$wallet_cus = $row_cus['wallet'] - $row_cus['earned_money'];
		$new_wallet = $wallet_cus + $total_price;
		$trans_type = "Credit";
		$trans_details = "Refunded due to order cancellation (order id: ".$ord_id.").";
		mysqli_query($con, "UPDATE web_customers set wallet = '$new_wallet' where phone='$profile'");
		mysqli_query($con, "INSERT into web_transactions(cus_phone, trans_date, trans_type, trans_details, order_id, walletcash_credit, walletcash_balance) VALUES('$profile', '$trans_date', '$trans_type', '$trans_details', '$ord_id', '$total_price', '$new_wallet')");
	} else {
		$trans_type = "Refunded for COD(".$ord_id.")";
		$total_price = 0;
		$queryx= mysqli_query($con, "INSERT INTO grret_transactions(mer_id, trans_date, trans_type, credit, balance) VALUES ('$mer_id', '$trans_date', '$trans_type', '$total_price', '$wallet')");
	} 
} else {
	$grcash = $row['grcash'];
	$walletcash = $row['walletcash'];
	$final_amount = $row['final_amount'];
	
	$query1 = mysqli_query($con,"SELECT * from web_customers where phone='$profile'");
	$row1 = mysqli_fetch_array($query1);
	$name = $row1['name'];
	$wallet = $row1['wallet'];
	$earned_money = $row1['earned_money'];
	$new_earned_money = $earned_money + $grcash;
	$new_wallet = $wallet + $walletcash + $grcash;
	if($payment_type != "Cash On Delivery"){
		$new_wallet = $new_wallet + $final_amount;
		$walletcash = $walletcash + $final_amount;
	}
	$walletcash_balance = ($new_wallet-$grcash);
	$trans_date = date("d-m-Y H:i:s");
	$trans_type = "Credit";
	$trans_details = "Refunded due to order cancellation (order id: ".$ord_id.").";
	mysqli_query($con, "UPDATE web_customers set wallet = '$new_wallet', earned_money = '$new_earned_money' where phone='$profile'");
	mysqli_query($con, "INSERT into web_transactions(cus_phone, trans_date, trans_type, trans_details, order_id, grcash_credit, grcash_balance, walletcash_credit, walletcash_balance) VALUES('$profile', '$trans_date', '$trans_type', '$trans_details', '$ord_id', '$grcash', '$new_earned_money', '$walletcash', '$walletcash_balance')");
	// NOTIFICATIONS.....
}
mysqli_close($con);

$apikey = "3KMJk4xXKkKMZQR2se46YA";
$apisender = "GRFOOD";
$num = $number;    // MULTIPLE NUMBER VARIABLE PUT HERE...!                 
$ms = rawurlencode($msg);   //This for encode your message content                         
$url = 'https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey='.$apikey.'&senderid='.$apisender.'&channel=2&DCS=0&flashsms=0&number='.$num.'&text='.$ms.'&route=1';
                    //echo $url;
$ch=curl_init($url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,"");
curl_setopt($ch, CURLOPT_RETURNTRANSFER,2);
$data = curl_exec($ch);
}
?>