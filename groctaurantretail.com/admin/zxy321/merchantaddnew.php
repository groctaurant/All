<?php
include('session.php');
if($login_role != "admin" && $login_role == "Recipe Writer"){
    header("location: recipe.php");
} else if($login_role != "admin" && $login_role == "Order Platform"){
    header("location: orders.php");
}
include '../../db/config.php';
if(isset($_POST['submit'])){
  $mer_name = test_input($_POST['mer_name']);
  $mer_phone = test_input($_POST['mer_phone']);
  $mer_address = $_POST['mer_address'];
  $mer_vegtag = $_POST['mer_vegtag'];
  $mer_id = $_POST['mer_id'];
  $mer_pin = test_input($_POST['mer_pin']);
  $mer_email = $_POST['mer_email'];
  if (!preg_match("/^[7-9][0-9]{9}$/",$mer_phone) || !preg_match("/^[a-zA-Z ]*$/",$mer_name) || !filter_var($mer_email, FILTER_VALIDATE_EMAIL)) {
    echo '<script> alert("Invalid Phone Number or Name or Pin!!");
       window.location="merchantaddnew.php"; </script>';
  } else {
  mysqli_query($con, "INSERT INTO grret_merchants(mer_name, mer_phone, mer_address, mer_vegtag, mer_id, mer_pin, mer_email) VALUES('$mer_name', '$mer_phone', '$mer_address', '$mer_vegtag', '$mer_id', '$mer_pin', '$mer_email')");
  header("Location: merchant.php");
  }
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
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
  <style>

li,h1,h2{font-family: 'Oswald', sans-serif;}

li.active{
  background: #d0d0d0;
}
a.active{
  color: #000;
}
</style>
</head>

<body>
<?php include'navbar.php'; ?>

<div class="wrapper" id="wrapper">
  <div class="container" style="margin-top:60px;"><div class="col-sm-6 col-sm-offset-3">
    <h1><center><u>Merchant Registeration Form</u></center></h1><br><br>
    
    <form method="POST" action="">
      <div class="form-group">        
       <label for="merchant_name">Name :</label>
       <input id="merchant_name" type="text" class="form-control" name="mer_name" required>
     </div>
     <div class="form-group">       
       <label for="merchant_id">ID :</label>
       <input id="merchant_id" type="text" class="form-control" name="mer_id" required>
     </div>
     <div class="form-group">       
       <label for="merchant_pin">PIN :</label>
       <input id="merchant_pin" type="text" class="form-control" name="mer_pin" required>
     </div>
     <div class="form-group">
       <label for="merchant_phone">Phone :</label>
       <input id="merchant_phone" type="number" class="form-control" name="mer_phone"  required>
     </div>
     <div class="form-group">
       <label for="merchant_address">Address :</label>
       <textarea id="merchant_address" type="text" class="form-control" name="mer_address"  required></textarea>
     </div>
     <div class="form-group">       
       <label for="merchant_email">Email :</label>
       <input id="merchant_email" type="text" class="form-control" name="mer_email" required>
     </div>
     <div class="form-group">                     
       <label for="veg_tag">Veg Tag :</label>
       <label class="w3-radio"><input id="veg_tag" type="radio" name="mer_vegtag" value="Veg" required>Veg</label>
       <label class="w3-radio"><input id="veg_tag" type="radio" name="mer_vegtag" value="Non-Veg" required>Non-Veg</label>
       <label class="w3-radio"><input id="veg_tag" type="radio" name="mer_vegtag" value="Both" required>Both</label>
     </div>
     
     <div class="form-group">
       <button type="submit" name="submit" class="btn btn-primary pull-right">Register</button>
     </div>
   </form></div>
 </div>
<script type="text/javascript">
$(".drop").click(function(){
  $(".list2").toggle(400, function(){
    });
});  
</script>
<script src="js/materialMenu.min.js"></script>
<script>
  var menu = new Menu;
</script>  
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
 
 
 