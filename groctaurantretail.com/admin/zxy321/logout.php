<?php
   session_start();
   
  // date_default_timezone_set("Asia/Kolkata");
  // $logout_time = date("Y-m-d H:i:s");
  // $username = 'RISHII';
  // $password = '5413';

  // $number='9711470295';
  // $msg= "Order Platform Login User: ".$_SESSION['admin']." has been successfully logged out at ".$logout_time.".";
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

   if(session_destroy()) {
      header("Location: index.php");
   }
?>