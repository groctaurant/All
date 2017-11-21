<?php

include 'db/config.php';
include 'session.php';
$mer_id = $login_session;
if(!empty($_POST['amount1']) && !empty($_POST['ord_id1'])){
	$pin = $_POST['unique_pin1'];
	$amount = $_POST['amount1'];
	
	$query1 = mysqli_query($con, "SELECT * from grret_merchants where mer_id='$mer_id'");
	$row1 = mysqli_fetch_array($query1,MYSQLI_ASSOC);
	$unique_pin = $row1['mer_pin'];
	if($pin != $unique_pin){
		echo '<script> alert("Invalid PIN!!");
	          window.location="myloanorders.php"; </script>';
	} else {

		$ord_id = $_POST['ord_id1'];
		$ord_id1 = str_replace("'", "", $ord_id);

		date_default_timezone_set("Asia/Kolkata");
		$not_time = date("Y-m-d H:i:s");
		$notification = "Merchant (id-".$mer_id.") requested for loan Payment of ₹".$amount." for order(s) id -(".$ord_id1.")";
		$not_status = "Unread";
		$payment_status = "Requested";

		mysqli_query($con, "INSERT INTO grret_notifications(mer_id, notification, not_status, not_time) VALUES ('$mer_id', '$notification', '$not_status', '$not_time')");
		mysqli_query($con, "UPDATE grret_orders set payment_status = '$payment_status' where ord_id IN ($ord_id)");

		header("Location: myloanorders.php");
	}
} else {
	echo '<script> alert("Select Orders First!!");
	    window.location="myloanorders.php"; </script>';
}
	
?>