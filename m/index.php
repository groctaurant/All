<?php
   include 'config.php';
   session_start();
 
   if(isset($_COOKIE['login_user']) && isset($_COOKIE['login_phone'])){
      header('location: home.php');
      die();
	}
  
      if($_SERVER["REQUEST_METHOD"] == "POST") {
      
      $phone = $_POST['phone'];
      $password = $_POST['password']; 
      
      $sql = "SELECT * FROM web_customers WHERE phone = '$phone' and password = '$password'";
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      $count = mysqli_num_rows($result);    
      if($count == 1) {
  		setcookie('login_user',$row['name'], time() + (86400 * 365), "/");
  		setcookie('login_phone',$row['phone'], time() + (86400 * 365), "/");
        echo '<script>window.location="home.php"; window.close();
        window.opener.location.reload(); </script>';
        //header("location: home.php");
      }else {
         echo '<script> alert("Invalid Phone Number or Password!!"); </script>'; 
      }
   }
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" href="images/GR111.png" type="image/gif">
  <title>Groctaurant</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
  
<body>

	<div class="container main" id="log" style="margin-top:80px">
	<div class="col-sm-4 col-sm-offset-4">
    <p style="font-family: 'Open Sans Condensed', sans-serif; color:black; text-align:center; font-size:36px;">Log In</p><br>
    <form class="formss" method="POST" action="">
    <input type="number" name="phone" placeholder="Phone" style="margin-bottom:10px; width:100%; border-top:0; border-right:0; border-left:0; border-bottom:1px solid grey; padding:10px 10px; border-radius:0" required>
    <input type="password" name="password" placeholder="Password"  style="margin-bottom:20px; width:100%; border-top:0; border-right:0; border-left:0; border-bottom:1px solid grey; padding:10px 10px; border-radius:0" required>
    <input type="submit" class="btn-block" id='send' name='submit' value="Log in" style="background-color:#C70039; padding:10px; color:white;">
    </form>
    <p style="font-size:14px; padding:16px; float:right; color:black;">New User?<b> <a href="signup.php" style="cursor:pointer; color:blue; text-decoration:none;">Signup</a></b> or <a href="home.php" style="color:blue;"><b><u>Skip</u></b></a></p>
	</div>
	</div>

</body>
</html>  
