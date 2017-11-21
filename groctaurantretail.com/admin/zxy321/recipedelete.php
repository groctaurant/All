<?php

include '../../db/config.php';
$id = $_GET['id'];
mysqli_query($con, "DELETE FROM grret_recipes where id='$id'");
header("Location: recipe.php");
?>