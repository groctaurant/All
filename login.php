<?php
   include 'config.php';
   session_start();
 
   if(isset($_COOKIE['login_user']) && isset($_COOKIE['login_phone'])){
      header('location: index.php');
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
        echo '<script>window.location="index.php"; window.close();
        window.opener.location.reload(); </script>';
        //header("location: chef-la-pumb.php");
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
  <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  

  
<style>
.recname2{font-size: 30px;font-family: 'Questrial', sans-serif; letter-spacing:1px;font-weight:bold; color:white;}
video { 
    position: fixed;
    top: 50%;
    left: 50%;
    min-width: 100%;
    min-height: 100%;
    width: auto;
    height: auto;
    z-index: -100;
    transform: translateX(-50%) translateY(-50%);
	background-size: cover;
	transition: 1s opacity;
}
</style>
  
<body>

<!-- -->
<video playsinline autoplay muted loop>
<source src="images/backdrop.mp4" type="video/mp4">
</video>
	<div class="col-sm-4 col-sm-offset-4" id="log" style="margin-top:118px;">
    <br><br>
	<p class="recname2 text-center">Log In</p><br>
    <form class="formss text-center" method="POST" action="">
    <input type="text" name="phone" placeholder="Phone" style="width:100%;margin-bottom:20px; border-top:0; border-right:0; border-left:0; border-bottom:1px solid white; width:80%; padding:10px 10px; border-radius:0; color:white; background-color:rgba(0,0,0,0.4);" required>
    <input type="password" name="password" placeholder="Password" style="width:100%;margin-bottom:20px; border-top:0; border-right:0; border-left:0; border-bottom:1px solid white; width:80%; color:white; padding:10px 10px; border-radius:0; background-color:rgba(0,0,0,0.4);" required>
    <center><input type="submit" class="btn btn-block" id='send' name='submit' value="Log in" style="background-color:#C70039; width:80%; padding:10px; color:white;"></center>
    </form>
    <p style="font-size:14px; padding:16px; float:right; color:white;">New User?<b> <a href="signup.php" style="cursor:pointer; color:blue; text-decoration:none;">Signup</a></b> or <a href="index.php" style="color:blue;"><b><u>Skip</u></b></a></p>
	<br>
	</div>
	
	

<!--footer-->

</body>
</html>  
<!-- <script type="text/javascript">
$(document).ready(function(){
    window.onunload = refreshParent;
    function refreshParent() {
        window.opener.location.reload();
    }
  });
</script> -->