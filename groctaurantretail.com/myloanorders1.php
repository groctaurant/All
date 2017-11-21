<?php

include 'db/config.php';
include 'session.php';
$mer_id = $login_session;
if(!empty($_POST['amount']) && !empty($_POST['ord_id'])){
	$pin = $_POST['unique_pin'];
	$amount = $_POST['amount'];
	
	$query1 = mysqli_query($con, "SELECT * from grret_merchants where mer_id='$mer_id'");
	$row1 = mysqli_fetch_array($query1,MYSQLI_ASSOC);
	$unique_pin = $row1['mer_pin'];
	if($pin != $unique_pin){
		echo '<script> alert("Invalid PIN!!");
	          window.location="myloanorders.php"; </script>';
	} else {
		if($row1['mer_wallet'] < $amount){
            echo '<script> alert("Insufficient Balance!!");
                 window.location="myloanorders.php"; </script>';
            
        } else {
			
			$ord_id = $_POST['ord_id'];
			$ord_id1 = str_replace("'", "", $ord_id);
		
			$wallet = $row1['mer_wallet'];
			$wallet = $wallet - $amount;
			$loanwallet = $row1['mer_loanwallet'];
			$loanwallet = $loanwallet - $amount;
			$payment_status = "Paid";

			date_default_timezone_set("Asia/Kolkata");
			$trans_date = date("d-m-Y H:i:s");
			$trans_type = "Loan Payment Via Wallet(".$ord_id1.")";

			mysqli_query($con, "UPDATE grret_merchants set mer_wallet = '$wallet' where mer_id= '$mer_id'");
			mysqli_query($con, "UPDATE grret_merchants set mer_loanwallet = '$loanwallet' where mer_id= '$mer_id'");
			mysqli_query($con, "UPDATE grret_orders set payment_status = '$payment_status' where ord_id IN ($ord_id)");
			$querycheck = mysqli_query($con, "INSERT INTO grret_loantransactions(mer_id, trans_date, trans_type, debit, loan) VALUES ('$mer_id', '$trans_date', '".$trans_type."', '$amount', '$loanwallet')");
			mysqli_query($con, "INSERT INTO grret_transactions(mer_id, trans_date, trans_type, debit, balance) VALUES ('$mer_id', '$trans_date', '$trans_type', '$amount', '$wallet')");
	// 		if($querycheck){
	// 			echo "complete";
	// 			die();
	// 		} else {
	// 			echo "error".mysqli_error($con);
	// 			die();
	//		}

			header("Location: myloanorders.php");
		}
	}
} else {
	echo '<script> alert("Select Orders First!!");
	    window.location="myloanorders.php"; </script>';
}
	
?>