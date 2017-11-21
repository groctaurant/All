<?php
include 'config.php';
date_default_timezone_set("Asia/Kolkata");
$current_time = date("Y-m-d H:i:s");
$query = mysqli_query($con, "SELECT * from web_customers");
while($row = mysqli_fetch_array($query)){
	$id = $row['id'];
	$request_time = $row['request_time'];
	if(strtotime($current_time) - strtotime($request_time) > 14400){
		mysqli_query($con, "UPDATE web_customers set request_time = null, request_status = 0 where id = '$id'");
	}
}
?>