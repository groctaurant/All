<?php
include '../../db/config.php';
$id = $_POST['id'];
$sql="SELECT * from grret_orders where id='$id'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$ord_id = $row['ord_id'];
$old_status = $row['ord_status'];
if($old_status == "Dispatched"){

$status = "Delivered";
mysqli_query($con, "UPDATE grret_orders set ord_status = '$status' where id='$id'");

$cus_phone = $row['cus_phone'];
$sub_total = $row['sub_total'];
$discount = $row['discount'];
$new_cus_discount = $row['new_cus_discount'];
$amount = $sub_total - $discount - $new_cus_discount;
$mer_id = $row['mer_id'];
$payment_type = $row['payment_type'];
date_default_timezone_set("Asia/Kolkata");

if($mer_id != "website" && $mer_id != "androidapp"){
	$sqla="SELECT * from grret_merchants where mer_id='$mer_id'";
	$resulta = mysqli_query($con, $sqla);
	$rowa = mysqli_fetch_array($resulta);
	$wallet = $rowa['mer_wallet'];
	$walletloan = $rowa['mer_loanwallet'];
	
	$trans_date = date("d-m-Y H:i:s");
	if($mer_id == "dc"){
		$querya1 = mysqli_query($con, "SELECT * from grret_uniquecustomers where cus_phone = '$cus_phone'");
		$count = mysqli_num_rows($querya1);
		$rowa1 = mysqli_fetch_array($querya1);
		$mer_id1 = $rowa1['mer_id'];
		if($count != 0 && $mer_id1 != "dc" && $mer_id1 != "sales" && $mer_id1 != "office" && $mer_id1 != "test"){
			$sqlb="SELECT * from grret_merchants where mer_id='$mer_id1'";
			$resultb = mysqli_query($con, $sqlb);
			$rowb = mysqli_fetch_array($resultb);
			$walletx = $rowb['mer_wallet'];
			$total_pricecb = (5*($amount))/100;
			$trans_typecb = "Royalty CashBack- customer(".$cus_phone.")";
			$mer_walletx = $walletx + $total_pricecb;
			mysqli_query($con, "INSERT INTO grret_transactions(mer_id, trans_date, trans_type, credit, balance) VALUES ('$mer_id1', '$trans_date', '$trans_typecb', '$total_pricecb', '$mer_walletx')");
			mysqli_query($con, "UPDATE grret_merchants set mer_wallet = '$mer_walletx' where mer_id='$mer_id1'");
		}
	}
	
	if($payment_type == "Pay Via Wallet"){
		$total_pricecb = (20*($amount))/100;
		$trans_typecb = "CashBack on order(".$ord_id.")";
		$mer_wallet = $wallet + $total_pricecb;
		mysqli_query($con, "INSERT INTO grret_transactions(mer_id, trans_date, trans_type, credit, balance) VALUES ('$mer_id', '$trans_date', '$trans_typecb', '$total_pricecb', '$mer_wallet')");
		mysqli_query($con, "UPDATE grret_merchants set mer_wallet = '$mer_wallet' where mer_id='$mer_id'");

	} else if($payment_type == "Pay Via Loan Wallet") {
		$total_pricecb = (20*($amount))/100;
		$trans_typecb = "CashBack on order(".$ord_id.")";
		$mer_wallet = $wallet + $total_pricecb;
		mysqli_query($con, "INSERT INTO grret_transactions(mer_id, trans_date, trans_type, credit, balance) VALUES ('$mer_id', '$trans_date', '$trans_typecb', '$total_pricecb', '$mer_wallet')");
		mysqli_query($con, "UPDATE grret_merchants set mer_wallet = '$mer_wallet' where mer_id='$mer_id'");

	} else {
		$total_pricecb = (20*($amount))/100;
		$trans_typecb = "CashBack on order(".$ord_id.")";
		$mer_wallet = $wallet + $total_pricecb;
		mysqli_query($con, "INSERT INTO grret_transactions(mer_id, trans_date, trans_type, credit, balance) VALUES ('$mer_id', '$trans_date', '$trans_typecb', '$total_pricecb', '$mer_wallet')");
		mysqli_query($con, "UPDATE grret_merchants set mer_wallet = '$mer_wallet' where mer_id='$mer_id'");
	}
} else {
	$profile = $row['profile'];
	// referral amount to referred person
	$query1 = mysqli_query($con,"SELECT * from web_customers where phone='$profile'");
	$row1 = mysqli_fetch_array($query1);
	$name = $row1['name'];
	$applied_code = $row1['applied_code'];
	if($applied_code != null){
		$query2 = mysqli_query($con, "SELECT * from web_customers where referral_code = '$applied_code'");
		$row2 = mysqli_fetch_array($query2);
		$referred_money = (10*$amount)/100;
		$wallet1 = $row2['wallet'] + $referred_money;
		$earned_money1 = $row2['earned_money'] + $referred_money;
		$referred_phone = $row2['phone'];
		$trans_date = date("d-m-Y H:i:s");
		$trans_type = "Credit";
		$trans_details = "Referral money on referral order by ".$name." (".$profile.")";
		//MESSAGE to referred person about money....

		mysqli_query($con, "UPDATE web_customers set wallet = '$wallet1', earned_money = '$earned_money1' where referral_code = '$applied_code'");
		mysqli_query($con, "INSERT into web_transactions(cus_phone, trans_date, trans_type, trans_details, order_id, grcash_credit, grcash_balance) VALUES('$referred_phone', '$trans_date', '$trans_type', '$trans_details', '$ord_id', '$referred_money', '$earned_money1')");
		// NOTIFICATIONS.....
	}
	// end
}
mysqli_close($con);
}
?>