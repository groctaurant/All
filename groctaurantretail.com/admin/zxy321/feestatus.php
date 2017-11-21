<?php
include '../../db/config.php';
$id = $_GET['id'];
$query = mysqli_query($con, "SELECT * from grret_merchants where id ='$id'");
$row = mysqli_fetch_array($query);
if($row['fee_status'] == "Unpaid"){
	mysqli_query($con, "UPDATE grret_merchants set fee_status = 'Paid' where id ='$id'");
} else {
	mysqli_query($con, "UPDATE grret_merchants set fee_status = 'Unpaid' where id ='$id'");
}
header("Location: merchant.php");
?>