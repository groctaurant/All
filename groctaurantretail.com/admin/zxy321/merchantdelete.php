<?php

include '../../db/config.php';
$id = $_GET['id'];
mysqli_query($con, "DELETE from grret_merchants where id='$id'");
header("Location: merchant.php");
?>