<?php

include '../../db/config.php';
$query = mysqli_query($con, "SELECT * from grret_orders");
$count = mysqli_num_rows($query);
echo $count;
?>