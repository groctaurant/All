<?php

include '../../db/config.php';
if(!empty($_POST["data"]))  
{  
	$data = explode(',',$_POST["data"]);
	if($data[1] == "ON"){
		$query = mysqli_query($con, "UPDATE grret_merchants set mer_lwstatus = 'OFF' where id='$data[0]'");
		echo $data[0].",OFF";
	} else {
		$query = mysqli_query($con, "UPDATE grret_merchants set mer_lwstatus = 'ON' where id='$data[0]'");
		echo $data[0].",ON";
	}
}
?>
