<?php 
include 'db/config.php';
if(isset($_POST['data']) && !empty($_POST['data'])){
  $data = $_POST['data'];
  //echo $data;
   $string = '012345678901234567890123456789012345678901234567890123456789';
   $string_shuffled = str_shuffle($string);
   $password1 = substr($string_shuffled, 14, 6);
   //$password1 = base64_encode($password1);

$user = "groctaurant";
$password = "7882";
$senderid = "RECIPE";
$smsurl = "http://www.kit19.com/ComposeSMS.aspx?";

function httpRequest($url){
    $pattern = "/http...([0-9a-zA-Z-.]*).([0-9]*).(.*)/";
    preg_match($pattern,$url,$args);
    $in = "";
    $fp = fsockopen($args[1],80, $errno, $errstr, 30);
    if (!$fp) {
       return("$errstr ($errno)");
    } else {
        $args[3] = "C".$args[3];
        $out = "GET /$args[3] HTTP/1.1\r\n";
        $out .= "Host: $args[1]:$args[2]\r\n";
        $out .= "User-agent: PARSHWA WEB SOLUTIONS\r\n";
        $out .= "Accept: */*\r\n";
        $out .= "Connection: Close\r\n\r\n";

        fwrite($fp, $out);
        while (!feof($fp)) {
           $in.=fgets($fp, 128);
        }
    }
    fclose($fp);
    return($in);
}

function SMSSend($phone, $msg, $debug=false){
      global $user,$password,$senderid,$smsurl;

      $url = 'username='.$user;
      $url.= '&password='.$password;
    $url.= '&sender='.$senderid;
    $url.= '&to='.urlencode($phone);
      $url.= '&message='.urlencode($msg);
      $url.= '&priority=1';
      $url.= '&dnd=1';
      $url.= '&unicode=0';

   $urltouse =  $smsurl.$url;
      if ($debug) { //echo "Request: <br>$urltouse<br><br>"; 
      }

      //Open the URL to send the message
      $response = httpRequest($urltouse);
      if ($debug) {
           // echo "Response: <br><pre>".
           // str_replace(array("<",">"),array("&lt;","&gt;"),$response).
           // "</pre><br>";
           }

      return($response);
}

$phonenum = $data;
$message = $password1;
$debug = true;

SMSSend($phonenum,$message,$debug);
  echo $password1;
}
?>