<?php
include('session.php');
include 'db/config.php';
$id = $_POST['mer_id'];
// echo $id;
// die();

if(isset($_POST['submit'])){
  $new_password = $_POST['new_password'];
  $query = mysqli_query($con, "UPDATE grret_merchants set mer_pin = '$new_password' where mer_id= '$id'");
  if($query){
  	session_destroy();
  	header("Location: index.php");
  } else {
  	echo mysqli_error($con);
  }

}

?>
