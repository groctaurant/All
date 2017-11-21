<?php
include '../../db/config.php';
$rec_name = $_POST['name_dir'];
$sql = "CREATE TABLE IF NOT EXISTS `".$rec_name."` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `image` text,
	  `description` text,
	  `type` varchar(50) DEFAULT NULL,
	  `description_hindi` text CHARACTER SET utf8,
	  PRIMARY KEY (`id`)
	)	 ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1" ;

mysqli_query($con, $sql);
$id = $_POST['id'];
$type = $_POST['type'];
$imagea = $_POST['imagea'];
$description = $_POST['desc'];
$description_hindi = $_POST['desc_hindi'];
mysqli_set_charset($con, 'utf8');
$target_dir = "uploads/cookdir/";
mysqli_query($con, "TRUNCATE TABLE ".$rec_name."");
for($i=0; $i<count($type); $i++){
	if(empty($_FILES["image"]["name"][$i]) && empty($imagea[$i])){
		$querydirec = mysqli_query($con, "INSERT into ".$rec_name."(description, type, description_hindi) values('$description[$i]', '$type[$i]', '$description_hindi[$i]')");
	} else if(empty($_FILES["image"]["name"][$i])) {
	    $querydirec = mysqli_query($con, "INSERT into ".$rec_name."(image, description, type, description_hindi) values('$imagea[$i]', '$description[$i]', '$type[$i]', '$description_hindi[$i]')");
	} else {
	    $target_file = $target_dir . basename($_FILES["image"]["name"][$i]);
    	$uploadOk = 1;
    	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    	if($uploadOk == 0) {
    	    echo "Sorry, your image was not uploaded.";
    	    die();
    	} else {
    	    if(move_uploaded_file($_FILES["image"]["tmp_name"][$i], $target_file)){
        		$querydirec = mysqli_query($con, "INSERT into ".$rec_name."(image, description, type, description_hindi) values('$target_file', '$description[$i]', '$type[$i]', '$description_hindi[$i]')");
		    } else {
		        echo "Sorry, there was an error uploading your Image.";
		    }
	    }
	}
}
if($querydirec){
    header("location: webrecipedirec.php?id=".$id."");
} else{
    echo "error: ". mysqli_error($con);
}
?>