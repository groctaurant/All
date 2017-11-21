<?php
include '../../db/config.php';
$id = $_POST['id'];
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
$time=$_POST['time'];
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
$target_filea = array();
$target_filea[0] = null;
$target_filea[1] = null;

for($i=0; $i<2; $i++){
	if(!empty($_FILES["image"]["name"][$i])){
	    $target_dir = "uploads/";
	    $target_filea[$i] = $target_dir . basename($_FILES["image"]["name"][$i]);
	    $uploadOk = 1;
	    $imageFileType = pathinfo($target_filea[$i],PATHINFO_EXTENSION);
	    
	    if ($uploadOk == 0) {
	        echo "Sorry, your image was not uploaded.";
	        die();
	    } else {
	        if (move_uploaded_file($_FILES["image"]["tmp_name"][$i], $target_filea[$i])) {
	        } else {
	            echo "Sorry, there was an error uploading your Image.";
	            die();
	        }
	    }
	} 
}
if($target_filea[0] == null && $target_filea[1] == null){
	$sqll= mysqli_query($con, "UPDATE admin_recipee set category='$cname', availability='$vis', sku='$sku', recipe_name1='$name1', recipe_name2='$name2', difficulty='$difficulty', recipe_by='$by', description='$desc', cuisine='$cuisine', veg_tag='$vegtag', video_link='$video', max_time='$time', utensils='$utensils', allergies='$allergy', recipe_keywords='$keyword', prep_dir='$prep_dir', accomp1='$accomp1', accomp2='$accomp2', accomp3='$accomp3', other_dish1='$other_dish1', other_dish2='$other_dish2', other_dish3='$other_dish3' where id='$id'");
} else if($target_filea[0] == null && $target_filea[1] != null){
	$sqll= mysqli_query($con, "UPDATE admin_recipee set category='$cname', availability='$vis', sku='$sku', recipe_name1='$name1', recipe_name2='$name2', difficulty='$difficulty', recipe_by='$by', description='$desc', cuisine='$cuisine', veg_tag='$vegtag', image_dir2='$target_filea[1]', video_link='$video', max_time='$time', utensils='$utensils', allergies='$allergy', recipe_keywords='$keyword', prep_dir='$prep_dir', accomp1='$accomp1', accomp2='$accomp2', accomp3='$accomp3', other_dish1='$other_dish1', other_dish2='$other_dish2', other_dish3='$other_dish3' where id='$id'");
} else if($target_filea[0] != null && $target_filea[1] == null){
	$sqll= mysqli_query($con, "UPDATE admin_recipee set category='$cname', availability='$vis', sku='$sku', recipe_name1='$name1', recipe_name2='$name2', difficulty='$difficulty', recipe_by='$by', description='$desc', cuisine='$cuisine', veg_tag='$vegtag', image_dir1='$target_filea[0]', video_link='$video', max_time='$time', utensils='$utensils', allergies='$allergy', recipe_keywords='$keyword', prep_dir='$prep_dir', accomp1='$accomp1', accomp2='$accomp2', accomp3='$accomp3', other_dish1='$other_dish1', other_dish2='$other_dish2', other_dish3='$other_dish3' where id='$id'");
} else {
	$sqll= mysqli_query($con, "UPDATE admin_recipee set category='$cname', availability='$vis', sku='$sku', recipe_name1='$name1', recipe_name2='$name2', difficulty='$difficulty', recipe_by='$by', description='$desc', cuisine='$cuisine', veg_tag='$vegtag', image_dir1='$target_filea[0]', image_dir2='$target_filea[1]', video_link='$video', max_time='$time', utensils='$utensils', allergies='$allergy', recipe_keywords='$keyword', prep_dir='$prep_dir', accomp1='$accomp1', accomp2='$accomp2', accomp3='$accomp3', other_dish1='$other_dish1', other_dish2='$other_dish2', other_dish3='$other_dish3' where id='$id'");
}
if($sqll){
    $sql11= mysqli_query($con, "select id from admin_recipee where recipe_name1='$name1'");
    $row=mysqli_fetch_array($sql11);
    $rec_id=$row['id'];
    mysqli_query($con, "DELETE from admin_recipeservings where rec_id='$rec_id'");
    for($i=0;$i<count($serving);$i++){
        mysqli_query($con, "INSERT into admin_recipeservings(rec_id, name,servings,price) values ('$rec_id','$name1','$serving[$i]','$price[$i]')");
    }
    mysqli_query($con, "delete from admin_recipeservings where servings='' ");
} else{
   echo "errorx ".mysqli_error($con);
   die();
}



header("location: webrecipes.php");
?>