<?php
session_start();
include('db/config.php');
if(isset($_POST['formsubmit'])){
$name=$_POST['merchant_name'];
$phone=$_POST['merchant_phone'];
$address=$_POST['merchant_address'];
$mer_city = $_POST['merchant_city'];
$mer_state = $_POST['merchant_state'];
$vegtag=$_POST['veg_tag'];
$email = $_POST['merchant_email'];
if (!preg_match("/^[7-9][0-9]{9}$/",$phone) || !preg_match("/^[a-zA-Z ]*$/",$name) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo '<script> alert("Invalid Phone Number or Name or Email!!");
       window.location="merchantregister.php"; </script>';
  } else {
    $_SESSION['mer_phone'] = $phone;
    $query = mysqli_query($con, "INSERT INTO grret_merchantapps(mer_phone,mer_name,mer_address,mer_vegtag, mer_email, mer_city, mer_state, fee_status) VALUES('$phone','$name','$address','$vegtag', '$email', '$mer_city', '$mer_state', 'Unpaid')");
if(!$query){
    echo mysqli_error($con);
}
  mysqli_close($con);
  }

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
} else {
  header("Location: index.php");
} ?>
<html>
<head>
<link rel="shortcut icon" type="image/png" href="images/GR.png"/>
    <title>GROCTAURANT</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="images/https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="images/https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
  window.onload = function() {
    var d = new Date().getTime();
    document.getElementById("tid").value = d;
  };
</script>
<style>
body {
  background-color: black;
}
  .img1 img {
      width : 500px;
      height : 707px;
  }
</style>
</head>

<body>
  <form method="post" name="customerData" action="redeem/ccavRequestHandler.php">
      <table width="40%" height="100" border='1' align="center" style="display: none;">
        <tr>
          <td>Parameter Name:</td><td>Parameter Value:</td>
        </tr>
        <tr>
          <td colspan="2"> Compulsory information</td>
        </tr>
        <tr>
          <td>TID :</td><td><input type="text" name="tid" id="tid" readonly /></td>
        </tr>
        <tr>
          <td>Merchant Id :</td><td><input type="text" name="merchant_id" value="128274"/></td>
        </tr>
        <tr>
          <td>Order Id  :</td><td><input type="text" name="order_id" value="<?php echo $phone; ?>" readonly /></td>
        </tr>
        <tr>
          <td>Amount  :</td><td><input type="text" name="amount" value="1000" readonly /></td>
        </tr>
        <tr>
          <td>Currency  :</td><td><input type="text" name="currency" value="INR"/></td>
        </tr>
        <tr>
          <td>Redirect URL  :</td><td><input type="text" name="redirect_url" value="http://groctaurantretail.com/redeem/ccavResponseHandler1.php"/></td>
        </tr>
        <tr>
          <td>Cancel URL  :</td><td><input type="text" name="cancel_url" value="http://groctaurantretail.com/redeem/ccavResponseHandler1.php"/></td>
        </tr>
        <tr>
          <td>Language  :</td><td><input type="text" name="language" value="EN"/></td>
        </tr>
          <tr>
            <td colspan="2">Billing information(optional):</td>
          </tr>
            <tr>
              <td>Billing Name  :</td><td><input type="text" name="billing_name" value="<?php echo $name; ?>"/></td>
            </tr>
            <tr>
              <td>Billing Address :</td><td><input type="text" name="billing_address" value="<?php echo $address; ?>"/></td>
            </tr>
            <tr>
              <td>Billing City  :</td><td><input type="text" name="billing_city" value="<?php echo $mer_city; ?>"/></td>
            </tr>
            <tr>
              <td>Billing State :</td><td><input type="text" name="billing_state" value="<?php echo $mer_state; ?>"/></td>
            </tr>
            <tr>
              <td>Billing Zip :</td><td><input type="text" name="billing_zip" value="121002"/></td>
            </tr>
            <tr>
              <td>Billing Country :</td><td><input type="text" name="billing_country" value="India"/></td>
            </tr>
            <tr>
              <td>Billing Tel :</td><td><input type="text" name="billing_tel" value="<?php echo $phone; ?>"/></td>
            </tr>
            <tr>
              <td>Billing Email :</td><td><input type="text" name="billing_email" value="info@groctauarnt.com"/></td>
            </tr>
            <tr>
              <td colspan="2">Shipping information(optional)</td>
            </tr>
            <tr>
              <td>Shipping Name :</td><td><input type="text" name="delivery_name" value="<?php echo $name; ?>"/></td>
            </tr>
            <tr>
              <td>Shipping Address  :</td><td><input type="text" name="delivery_address" value="<?php echo $address; ?>"/></td>
            </tr>
            <tr>
              <td>shipping City :</td><td><input type="text" name="delivery_city" value="<?php echo $mer_city; ?>"/></td>
            </tr>
            <tr>
              <td>shipping State  :</td><td><input type="text" name="delivery_state" value="<?php echo $mer_state; ?>"/></td>
            </tr>
            <tr>
              <td>shipping Zip  :</td><td><input type="text" name="delivery_zip" value="121002"/></td>
            </tr>
            <tr>
              <td>shipping Country  :</td><td><input type="text" name="delivery_country" value="India"/></td>
            </tr>
            <tr>
              <td>Shipping Tel  :</td><td><input type="text" name="delivery_tel" value="<?php echo $phone; ?>"/></td>
            </tr>
            <tr>
              <td>Merchant Param1 :</td><td><input type="text" name="merchant_param1" value="additional Info."/></td>
            </tr>
            <tr>
              <td>Merchant Param2 :</td><td><input type="text" name="merchant_param2" value="additional Info."/></td>
            </tr>
        <tr>
          <td>Merchant Param3 :</td><td><input type="text" name="merchant_param3" value="additional Info."/></td>
        </tr>
        <tr>
          <td>Merchant Param4 :</td><td><input type="text" name="merchant_param4" value="additional Info."/></td>
        </tr>
        <tr>
          <td>Merchant Param5 :</td><td><input type="text" name="merchant_param5" value="additional Info."/></td>
        </tr>
        <tr>
          <td>Promo Code  :</td><td><input type="text" name="promo_code" value=""/></td>
        </tr>
        <tr>
          <td>Vault Info. :</td><td><input type="text" name="customer_identifier" value=""/></td>
        </tr>
            <tr>
              <td>Integration Type  :</td><td><input type="text" name="integration_type" value="iframe_normal"/></td>
            </tr>
            <tr>
              <td></td><td><INPUT TYPE="submit" class="btn btn-primary" value="CheckOut"></td>
            </tr>
          </table>
          <p style="font-size:50px; color:#ba8e2d;">Your registration form has been submitted. </p>
          <p class="text-center" style="color:white"><button type="submit" class="btn btn-success">Proceed</button> to pay the registration fee of ₹1,000 or <a href="index.php">Skip</a></p>
        </form>


<div class="col-md-6 img1" style="margin-top:80px; margin-bottom:80px;">
<center><img src="images/1.jpg"></center>
<center><img src="images/3.jpg"></center>
<center><img src="images/5.jpg"></center>
</div>
<div class="col-md-6 img1" style="margin-top:80px; margin-bottom:80px;">
<center><img src="images/2.jpg"></center>
<center><img src="images/4.jpg"></center>
<center><img src="images/6.jpg"></center>
</div>
</div>
</body>
</html>