<?php  
 include ('db/config.php'); 
 if(!empty($_POST["number"]))  
 {  
      $number = $_POST["number"]; 
      $query = "SELECT * FROM web_customers WHERE phone ='$number'";  
      $result = mysqli_query($con, $query);
      $count = mysqli_num_rows($result);
      $row = mysqli_fetch_array($result);
      $name = $row['name'];
      $wallet = $row['wallet'] - $row['earned_money'];    
      echo $count."|".$name."|".$wallet;
 }  
?> 