<?php

include '../../db/config.php';

$name=$_POST['name'];

$target_dir = "../../json/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$target_file1=ltrim($target_file,"../../");

$sql=mysqli_query($con, "select * from grret_recipejson where recipe_name='".$name."' ");
$row = mysqli_fetch_array($sql,MYSQLI_ASSOC);
$count = mysqli_num_rows($sql);
if($count > 0) {
        mysqli_query($con, "update grret_recipejson set json_path='".$target_file1."' where recipe_name='".$name."' ");
        header('location:recipe.php');
        }
else{
        mysqli_query($con, "insert into grret_recipejson(recipe_name,json_path) values('".$name."','".$target_file1."') ");    
        header('location:recipe.php');
}

// Allow certain file formats
if($imageFileType != "json") {
    echo "Sorry, only JSON file is allowed.";
    $uploadOk = 0;
}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


?>