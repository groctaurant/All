<?php
include '../../db/config.php';

$name=$_POST['name'];
$sql="select * from grret_recipejson where recipe_name = '$name' ";
$result = mysqli_query($con, $sql);
      while($row = mysqli_fetch_array($result))
      {
		  
$file_name = "$name.json";
$file_url = "../../".$row['json_path']."";
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary"); 
header("Content-disposition: attachment;  filename=\"".$file_name."\""); 
	  }
readfile($file_url);
exit;

header('location: recipe.php');
?>