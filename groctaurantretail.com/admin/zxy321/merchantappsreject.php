<?php

include '../../db/config.php';
$id = $_GET['id'];
mysqli_query($con, "DELETE from grret_merchantapps where id='$id'");
header("Location: merchantapps.php");

?>