<html>
<head>
<link rel="shortcut icon" type="image/png" href="images/GR111.png"/>
    <title>GROCTAURANT</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="google-site-verification" content="5IwEQXsxywiGlBKHF6HFrePcfNgQcQr2i42w2chkcpw" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
<style>
 
 </style>
 
 <?php
   include 'db/config.php';
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($con,$_POST['username']);
      $mypassword = mysqli_real_escape_string($con,$_POST['password']); 
      
      $sql = "SELECT id FROM grret_merchants WHERE mer_id = '$myusername' and mer_pin = '$mypassword'";
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
    
      if($count == 1) {
        $_SESSION['login_user'] = $myusername;
        $_SESSION['login_pass'] = $mypassword;
        date_default_timezone_set("Asia/Kolkata");
        $mer_login = date("Y-m-d H:i:s");
        $_SESSION['mer_login'] = $mer_login;
        mysqli_query($con, "INSERT into grret_login_records(mer_id, mer_login) values('$myusername', '$mer_login')");
        header("location: shop.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<body style="background-color:black">
<div class="container" style="margin-top:30px;">
<center><img src="images/GR.png" width="" height="180px"></center>
</div>
<div class="container"  style="margin-top:50px;">
<div class="col-sm-4 col-sm-offset-4">
<form action="" method="POST" role="form">
<div class="form-group">
    <input type="text" class="form-control" name="username" id="id" placeholder="Merchant ID" style="background:black; border-top:none; border-left:none; border-right:none; border-radius:0; color:white">
  </div>
  <div class="form-group">
    <input type="password" class="form-control" name="password" id="pin" placeholder="Merchant PIN" style="background:black; border-top:none; border-left:none; border-right:none; border-radius:0; color:white">
  </div>
    <br><button type="submit" class="btn btn-danger btn-block"><b>LOGIN</button>
 <br><a href="merchantregister.php" style="float:right; color:blue; text-decoration:none">Register New Merchant</a>
  </form>

</div>
</div>
</body>
</html>
