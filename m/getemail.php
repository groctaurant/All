<?php
include 'config.php';
if(isset($_POST['email'])){
	$email = $_POST['email'];
	$query = mysqli_query($con, "SELECT * from web_customers where email= '$email' and verify_status = 1");
	$count = mysqli_num_rows($query);
	if($count == 1){
		echo 1;
	} else {
		echo 0;
	}
}
?>