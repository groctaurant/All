<?php  
 include ('db/config.php'); 
 if(!empty($_POST["number"]))  
 {  
      $number = $_POST["number"]; 
      $query = "SELECT * FROM grret_uniquecustomers WHERE cus_phone ='$number'";  
      $result = mysqli_query($con, $query);
      $count = mysqli_num_rows($result);
      echo $count;       
 }  
?> 