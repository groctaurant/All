<?php

include '../../db/config.php';
include 'session.php';
$mer_id = $_POST['mer_id'];
if(!empty($_POST['amount']) && !empty($_POST['ord_id'])){
	$pin = $_POST['unique_pin'];
	
	$query1 = mysqli_query($con, "SELECT * from grret_users where username='$login_session'");
	$row1 = mysqli_fetch_array($query1,MYSQLI_ASSOC);
	$unique_pin = $row1['unique_pin'];
	if($pin != $unique_pin){
		echo '<script> alert("Invalid PIN!!");
	          window.location="merchantorders.php?id='.$mer_id.'"; </script>';
	} else {
		$amount = $_POST['amount'];
		$ord_id = $_POST['ord_id'];
		
		$query2 = mysqli_query($con, "SELECT * from grret_merchants where mer_id='$mer_id'");
		$row2 = mysqli_fetch_array($query2,MYSQLI_ASSOC);
		$wallet = $row2['mer_loanwallet'];
		$wallet = $wallet - $amount;
		$payment_status = "Paid";

		date_default_timezone_set("Asia/Kolkata");
		$trans_date = date("d-m-Y H:i:s");
		$trans_type = "Loan Payment for orders- ".$ord_id;

		mysqli_query($con, "UPDATE grret_merchants set mer_loanwallet = '$wallet' where mer_id= '$mer_id'");
		mysqli_query($con, "UPDATE grret_orders set payment_status = '$payment_status' where ord_id IN ($ord_id)");
		$querycheck = mysqli_query($con, "INSERT INTO grret_loantransactions(mer_id, trans_date, trans_type, debit, loan) VALUES ('$mer_id', '$trans_date', '$trans_type', '$amount', '$wallet')");
		// if($querycheck){
		// 	echo "complete";
		// 	die();
		// } else {
		// 	echo "error".mysqli_error($con);
		// 	die();
		// }
		header("Location: merchantorders.php?id=".$mer_id."");
	}
} else {
	echo '<script> alert("Select Orders First!!");
	    window.location="merchantorders.php?id='.$mer_id.'"; </script>';
}
	
?>