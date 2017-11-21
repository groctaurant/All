<?php
include 'config.php';
if(isset($_POST['number'])){
	$number = $_POST['number'];
	$query = mysqli_query($con, "SELECT * from web_customers where phone = '$number'");
	$count = mysqli_num_rows($query);
	if($count == 0){
		echo 1;
	} else {
		echo 0;
	}
}
?>