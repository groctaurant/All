<?php

include '../../db/config.php';

if(isset($_POST['submit'])){
	$rec=$_POST['rec'];
	$rec_name = str_replace(" ", "_", $rec);
	$desc=$_POST['desc'];

	$sql = "CREATE TABLE IF NOT EXISTS `direc_".$rec_name."` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `image` text,
	  `description` text,
	  `type` varchar(50) DEFAULT NULL,
	  `description_hindi` text CHARACTER SET utf8,
	  PRIMARY KEY (`id`)
	)	 ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1" ;

	$query1 = mysqli_query($con, $sql);
	
	for($i=0; $i<count($_POST['desc']); $i++){
		$target_dir = "uploads/cookdir/";
		
		if(empty($_FILES["image"]["name"][$i])){
		    
		    	if($query1){
	        		mysqli_query($con, "INSERT INTO direc_".$rec_name."(description) values ('$desc[$i]')");
			        header('Location: webrecipes.php');
			    }
		}
		else{
		    		$target_file = $target_dir . basename($_FILES["image"]["name"][$i]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

		if ($uploadOk == 0) {
		    echo "Sorry, your image was not uploaded.";
		    die();
		} else {
		    if (move_uploaded_file($_FILES["image"]["tmp_name"][$i], $target_file)){
				if($query1){
	        		mysqli_query($con, "INSERT INTO direc_".$rec_name."(image,description, type) values ('$target_file', '$desc[$i]', 'cooking')");
			        header('Location: webrecipes.php');
			    } 
			}
			
			else {
			        echo "Sorry, there was an error uploading your Image.";
			}
		}
		
		}
	
	} 
} 

else {
    echo "error :".mysqli_error($con);
}        



?>