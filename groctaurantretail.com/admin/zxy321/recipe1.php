<?php

include '../../db/config.php';
 
$cname=$_POST['cname'];
$vis=$_POST['vis'];
$sku=$_POST['sku'];
$name1 = $_POST['name1'];
$name2=$_POST['name2'];
$video=$_POST['video'];
$difficulty=$_POST['difficulty'];
$by=$_POST['by'];
$desc=$_POST['desc'];
$cuisine=$_POST['cuisine'];
$vegtag=$_POST['vegtag'];
$max_time=$_POST['time'];
$utensils=$_POST['utensils'];
$allergy=$_POST['allergy'];
$keyword=$_POST['keyword'];
$accomp1 = $_POST['accomp1'];
$accomp2 = $_POST['accomp2'];
$accomp3 = $_POST['accomp3'];
$other_dish1 = $_POST['other_dish1'];
$other_dish2 = $_POST['other_dish2'];
$other_dish3 = $_POST['other_dish3'];
$prep_dir=$_POST['prep_dir'];
$serving = $_POST['serving'];
$price = $_POST['price'];
$target_file = array();
$target_file[0] = null;
$target_file[1] = null;
for($i=0; $i<2; $i++){
	if(!empty($_FILES["image"]["name"][$i])){
	    $target_dir = "uploads/";
	    $target_file[$i] = $target_dir . basename($_FILES["image"]["name"][$i]);
	    $uploadOk = 1;
	    $imageFileType = pathinfo($target_file[$i],PATHINFO_EXTENSION);
	    
	    // Allow certain file formats
	    //if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	    //&& $imageFileType != "gif" ) {
	    //    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    //    $uploadOk = 0;
	    //    die();
	    //}
	    // Check if $uploadOk is set to 0 by an error
	    if ($uploadOk == 0) {
	        echo "Sorry, your image was not uploaded.";
	        die();
	    // if everything is ok, try to upload file
	    } else {
	        if (move_uploaded_file($_FILES["image"]["tmp_name"][$i], $target_file[$i])) {
	        } else {
	            echo "Sorry, there was an error uploading your Image.";
	            die();
	        }
	    }   
	}
}

    //storind the data in your database
       $sqll= mysqli_query($con, "INSERT INTO admin_recipee (category, availability, sku, recipe_name1, recipe_name2, difficulty, recipe_by, description, cuisine, veg_tag, image_dir1, image_dir2, video_link, max_time, utensils, allergies, recipe_keywords, prep_dir, accomp1, accomp2, accomp3, other_dish1, other_dish2, other_dish3) VALUES ('$cname' ,'$vis' ,'$sku', '$name1', '$name2', '$difficulty', '$by', '$desc', '$cuisine', '$vegtag', '$target_file[0]', '$target_file[1]', '$video', '$max_time', '$utensils', '$allergy', '$keyword', '$prep_dir', '$accomp1', '$accomp2', '$accomp3', '$other_dish1', '$other_dish2', '$other_dish3')");
   if($sqll){
    
   $sql11= mysqli_query($con, "select id from admin_recipee where recipe_name1='$name1' ");
    $row=mysqli_fetch_array($sql11);
    $rec_id=$row['id'];
   for($i=0;$i<count($serving);$i++){
mysqli_query($con, "INSERT into admin_recipeservings(rec_id, name,servings,price) values ('$rec_id','$name1','$serving[$i]','$price[$i]')");        
        
}
mysqli_query($con, "delete from admin_recipeservings where servings='' ");
   
   }
   else{
       echo "error ".mysqli_error($con);
       die();
   }
    mysqli_close($con);
    header("location: webrecipes.php");

?>