<?php
include '../../db/config.php';
if(isset($_POST["data"]))  
{  
	$data = (int)$_POST["data"];
	//echo $data;
	if($data == 1){
		$query = mysqli_query($con, "UPDATE grret_shopstat set deliver_now = 1 where id=1");
		echo 0;
	} else {
		$query = mysqli_query($con, "UPDATE grret_shopstat set deliver_now = 0 where id=1");
		echo 1;
	}
	//if(!$query){
	//	echo mysqli_error($con);
	//}
}
?>
