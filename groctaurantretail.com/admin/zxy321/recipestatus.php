<?php

include '../../db/config.php';
if(!empty($_POST["data"]))  
{  
	$data = explode(',',$_POST["data"]);
	if($data[1] == "Available"){
		$query = mysqli_query($con, "UPDATE grret_recipes set rec_status = 'Unavailable' where id='$data[0]'");
		echo $data[0].",Unavailable";
	} else {
		$query = mysqli_query($con, "UPDATE grret_recipes set rec_status = 'Available' where id='$data[0]'");
		echo $data[0].",Available";
	}
}
?>
