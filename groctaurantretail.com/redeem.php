<?php
include 'db/config.php';
include 'session.php';
$mer_id = $login_session;
$amount = $_POST['val'];
date_default_timezone_set("Asia/Kolkata");
$not_time = date("Y-m-d H:i:s");
$notification = "Merchant (id-".$mer_id.") requested to redeem amount of ₹".$amount." from his wallet";
$not_status = "Unread";
mysqli_query($con, "INSERT INTO grret_notifications(mer_id, notification, not_status, not_time) VALUES ('$mer_id', '$notification', '$not_status', '$not_time')");	
?>