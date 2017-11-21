<html>
<head>
<link rel="shortcut icon" type="image/png" href="../../images/GR.png"/>
    <title>GROCTAURANT</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
<style>
 
 </style>
 
 <?php
   include '../../db/config.php';
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($con,$_POST['username']);
      $mypassword = mysqli_real_escape_string($con,$_POST['password']); 
      
      $sql = "SELECT id FROM grret_users WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
    
      if($count == 1) {
         $_SESSION['admin'] = $myusername;
         $_SESSION['pass'] = $mypassword;
  // date_default_timezone_set("Asia/Kolkata");
  // $login_time = date("Y-m-d H:i:s");
  // $username = 'RISHII';
  // $password = '5413';

  // $number='9711470295';
  // $msg= "Order Platform Login User: ".$myusername." has been successfully logged in at ".$login_time.".";
  // /*
  // * Your phone number, only 10 digit number, i.e. 8107887472 in this case:
  // */
  // $numbers = $number;


  // /*
  // * your 6 characters Sender ID
  // */
  // $sender = 'GRFOOD';


  // /*
  // * A SMS can contain 160 characters equal 1 credit.
  // */
  // $message = $msg;


  // /*
  // * for $_GET method please use message in urlencode().
  // */
  // $message = urlencode($message);


  
  // * Please see the FAQ regarding HTTPS (port 443) and HTTP (port 80/5567)
  
  // $url = "http://bulksmsstar.in/api/pushsms.php";
  // $port = 80;
  // $api_url = $url."?username=".urlencode($username)."&password=".urlencode($password)."&sender=". $sender ."&message=". $message."&numbers=".$numbers;


  // $ch = curl_init( );
  // curl_setopt ( $ch, CURLOPT_URL, $api_url );
  // curl_setopt ( $ch, CURLOPT_PORT, $port );
  // curl_setopt ( $ch, CURLOPT_POST, 1 );
  // curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
  // // Allowing cUrl funtions 20 second to execute
  // curl_setopt ( $ch, CURLOPT_TIMEOUT, 20 );
  // // Waiting 20 seconds while trying to connect
  // curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, 20 );
  // $response_string = curl_exec( $ch );

         header("location: orders.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
 
 
 
 
<body style="background-color:black">
<div class="container" style="margin-top:100px;">
<center><img src="../../images/GR.png" width="240px" height="230px"></center>
</div>
<div class="container"  style="margin-top:58px;">
<div class="col-sm-4 col-sm-offset-4">
<form action="" method="POST" role="form">
<div class="form-group">
    <input type="text" class="form-control" name="username" id="id" placeholder="Username" style="background:black; border-top:none; border-left:none; border-right:none; border-radius:0; color:white">
  </div>
  <div class="form-group">
    <input type="password" class="form-control" name="password" id="pin" placeholder="Password" style="background:black; border-top:none; border-left:none; border-right:none; border-radius:0; color:white">
  </div>
    <button type="submit" class="w3-button w3-hover-red w3-red w3-round w3-right">LOGIN</button>
  </form>

</div>
</div>
</body>
</html>
