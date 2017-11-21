<?php
include 'config.php';
include 'session.php';
if(isset($_POST['add1'])){
	$add1 = test_input($_POST['add1']);
	$add2 = test_input($_POST['add2']);
	$add3 = test_input($_POST['add3']);
	$cus_phone = $login_session1;
	$tag = $_POST['tag'];
	$default_address = "0";
	if($_POST['default_address'] != "0"){
		$default_address = $_POST['default_address'];
		mysqli_query($con, "UPDATE web_cus_address set default_address = '0' where cus_phone ='$cus_phone'");
	}
	mysqli_query($con, "INSERT into web_cus_address(cus_phone, address1, address2, address3, tag, default_address) values('$cus_phone', '$add1', '$add2', '$add3', '$tag', '$default_address')");
}
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>