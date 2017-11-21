<?php
include('session.php');
include 'db/config.php';
$id = $_POST['id'];
// echo $id;
// die();

if(isset($_POST['submit'])){
  $mer_name = test_input($_POST['mer_name']);
  $mer_phone = $_POST['mer_phone'];
  $mer_address = test_input($_POST['mer_address']);
  $mer_vegtag = $_POST['mer_vegtag'];
  $mer_email = $_POST['mer_email'];
  $mer_bank_name = test_input($_POST['mer_bank_name']);
  $mer_bank_branch_name = test_input($_POST['mer_bank_branch_name']);
  $mer_bank_acc_no = $_POST['mer_bank_acc_no'];
  $mer_bank_ifsc_code = $_POST['mer_bank_ifsc_code'];
  $mer_bank_branch_code = $_POST['mer_bank_branch_code'];
  if (!preg_match("/^[7-9][0-9]{9}$/",$mer_phone) || !preg_match("/^[a-zA-Z ]*$/",$mer_name) || !filter_var($mer_email, FILTER_VALIDATE_EMAIL)) {
    echo '<script> alert("Invalid Details!!!");
       window.location="myprofile.php"; </script>';
  	} else {
	  $query = mysqli_query($con, "UPDATE grret_merchants set mer_name='$mer_name', mer_phone='$mer_phone', mer_address='$mer_address', mer_vegtag='$mer_vegtag', mer_email='$mer_email' mer_bank_name='$mer_bank_name', mer_bank_branch_name='$mer_bank_branch_name', mer_bank_acc_no='$mer_bank_acc_no', mer_bank_ifsc_code='$mer_bank_ifsc_code', mer_bank_branch_code='$mer_bank_branch_code' where id='$id'");
	  // if($query){
	  // 	echo "yo done";
	  // 	die();
	  // } else {
	  // 	echo "error ".mysqli_error($con);
	  // 	die();
	  // }

	  header("Location: myprofile.php");
	}
} else {
	echo "error";
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
