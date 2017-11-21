<?php
include 'config.php';
if(isset($_POST['code'])){
	$code = $_POST['code'];
	$query = mysqli_query($con, "SELECT * from web_customers where referral_code = '$code'");
	$count = mysqli_num_rows($query);
	if($count == 1){
		echo 1;
	} else {
		echo 0;
	}
}
?>