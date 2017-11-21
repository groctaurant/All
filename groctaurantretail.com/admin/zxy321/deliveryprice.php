<?php
include '../../db/config.php';
if(!empty($_POST["data"]))  
{  
	$data = explode(',',$_POST["data"]);
	if((int) $data[1] == 11){
		$total = (int) $data[2]-11;
		$final_amount = $data[3]-11;
		$query = mysqli_query($con, "UPDATE grret_orders set del_charges = 0, total_price = '$total', final_amount = '$final_amount' where id='$data[0]'");
		//echo $data[0].$data[1].$data[2];
	} else {
		$total = (int) $data[2]+11;
		$final_amount = $data[3]+11;
		$query = mysqli_query($con, "UPDATE grret_orders set del_charges = 11, total_price = '$total', final_amount = '$final_amount' where id='$data[0]'");
		//echo $data[0].$data[1].$data[2];
	}
}
?>