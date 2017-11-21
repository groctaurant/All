<?php
include('session.php');
if($login_role != "admin" && $login_role == "Recipe Writer"){
    header("location: recipe.php");
} else if($login_role != "admin" && $login_role == "Order Platform"){
    header("location: orders.php");
}
include '../../db/config.php';
if(isset($_POST['submit'])){
  $mer_name = $_POST['mer_name'];
  $mer_phone = $_POST['mer_phone'];
  $mer_address = $_POST['mer_address'];
  $mer_vegtag = $_POST['mer_vegtag'];
  $mer_id = $_POST['mer_id'];
  $mer_pin = $_POST['mer_pin'];
  $mer_email = $_POST['mer_email'];
  $mer_city = $_POST['merchant_city'];
$mer_state = $_POST['merchant_state'];
$fee_status = $_POST['fee_status'];
  $query = mysqli_query($con, "INSERT INTO grret_merchants(mer_name, mer_phone, mer_address, mer_vegtag, mer_id, mer_pin, mer_email, mer_city, mer_state, fee_status) VALUES('$mer_name', '$mer_phone', '$mer_address', '$mer_vegtag', '$mer_id', '$mer_pin', '$mer_email', '$mer_city', '$mer_state', '$fee_status')");
  if($query){
    mysqli_query($con, "DELETE from grret_merchantapps where mer_phone='$mer_phone' and mer_name='$mer_name' ");
    
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

$phonenum = $mer_phone;
$message = "Your application has been approved with Groctaurant. Your merchant id = ".$mer_id." and pin = ".$mer_pin.". Log in to www.groctaurantretail.com now.";
$debug = true;

SMSSend($phonenum,$message,$debug);
  } else {
      echo mysqli_error($con);
      die();
  }
  header("Location: merchant.php");
}
?>
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
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link href="https://fonts.googleapis.com/css?family=Oswald:500,600" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
<style>

li,h2,h1{font-family: 'Oswald', sans-serif; font-size:17px; letter-spacing:0.8px;}
.hidden{
  display: none;
}
li.active{
  background: #d0d0d0;
}
a.active{
  color: #000;
}
</style>
</head>

<body>
<?php include 'navbar.php'; ?>

<div class="container-fluid wrapper" id="wrapper">

<div class="table-responsive" style="margin-top:120px;"> <table class='table table-bordered'>
<h1 class="text-center" style="font-size: 36px">Merchant Apps</h1>

<tr>
    <th>S. No.</th>
    <th>Merchant Name</th>
    <th>Merchant Phone</th>
    <th>Merchant Address</th>
    <th>Merchant Email</th>
    <th>Veg-Tag</th>
    <th>Fee Status</th>
    <th>Merchant ID</th>
    <th>Merchant PIN</th>
    <th class="text-center" colspan="2">Action</th>
</tr>
<?php


$sql="SELECT * from grret_merchantapps";
$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($result))
{ ?>
  <tr>
  <form method="POST" role="form" action="">
    <td><?php echo $row['id']; ?></td>
    <td><input type="text" name="mer_name" value="<?php echo $row['mer_name']; ?>" required style="border:none;" readonly></td>
    <td><input type="text" name="mer_phone" value="<?php echo $row['mer_phone']; ?>" required style="border:none;" readonly></td>
    <td><input type="text" name="mer_address" value="<?php echo $row['mer_address']; ?>" required style="border:none;" readonly></td>
    <td><input type="text" name="mer_email" value="<?php echo $row['mer_email']; ?>" required style="border:none;" readonly></td>
    <td><input type="text" name="mer_vegtag" value="<?php echo $row['mer_vegtag']; ?>" required style="border:none;" readonly></td>
    <td><input type="text" name="fee_status" value="<?php echo $row['fee_status']; ?>" required style="border:none;" readonly></td>
    <td><input class="form-control" type="text" name="mer_id" placeholder="ID" required></td>
    <td><input class="form-control" type="text" name="mer_pin" placeholder="PIN" required></td>
    <td>
    <input class="btn btn-success" type="submit" name="submit" value="Approve">
    </td></form>
    <td><a href="merchantappsreject.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Reject</a></td>
    
  </tr>

<?php
echo "</tr>";
}
?>
</table>

</div>
</div>
<script src="js/materialMenu.min.js"></script>
<script>
  var menu = new Menu;
</script>
<script type="text/javascript">
$(".drop").click(function(){
  $(".list2").toggle(400, function(){
    });
});  
</script>
<script type="text/javascript">
$(".list3").hide();
$(".drop1").click(function(){
  $(".list3").toggle(400, function(){
    });
});  
</script>
</body>
</html>