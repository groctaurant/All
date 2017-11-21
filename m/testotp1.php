<?php 
include 'db/config.php';
date_default_timezone_set("Asia/Kolkata");
if(isset($_POST['data'])){
  $data = (int)"+91".(string)$_POST['data'];
  //echo $data;
   $string = '012345678901234567890123456789012345678901234567890123456789';
   $string_shuffled = str_shuffle($string);
   $password1 = substr($string_shuffled, 14, 6);
   //$password1 = base64_encode($password1);
$msg = "Use ".$password1." as OTP for Groctaurant. (".date("H:i:s").")";
                    $apikey = "3KMJk4xXKkKMZQR2se46YA";
                    $apisender = "GRFOOD";
                    $num = $data;    // MULTIPLE NUMBER VARIABLE PUT HERE...!                 
                    $ms = rawurlencode($msg);   //This for encode your message content                         
                    $url = 'https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey='.$apikey.'&senderid='.$apisender.'&channel=2&DCS=0&flashsms=0&number='.$num.'&text='.$ms.'&route=1';
                    //echo $url;
                    $ch=curl_init($url);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch,CURLOPT_POST,1);
                    curl_setopt($ch,CURLOPT_POSTFIELDS,"");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER,2);
                    $data = curl_exec($ch);
  echo $password1;
}
?>