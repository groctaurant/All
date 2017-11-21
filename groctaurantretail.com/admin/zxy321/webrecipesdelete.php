<?php
include '../../db/config.php';
$id = $_GET['id'];
$name = $_GET['name'];
$name = str_replace(" ", "_", $name);
mysqli_query($con, "DELETE from admin_recipee where id='$id'");
mysqli_query($con, "DROP table direc_".$name." ");
header("location: webrecipes.php");
?>