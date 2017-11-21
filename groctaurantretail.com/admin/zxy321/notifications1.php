<?php

include '../../db/config.php';
if(!empty($_POST["data"]))  
{  
	$data = $_POST['data'];
	$query = mysqli_query($con, "UPDATE grret_notifications set not_status = 'Read' where id='$data'");
		
}
?>
