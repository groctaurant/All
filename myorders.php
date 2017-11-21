<?php
include 'cart1.php';
$cart = new Cart;
if(isset($_COOKIE['login_user']) && isset($_COOKIE['login_phone'])){
include 'session.php';
}
else{header('location: index.php');}
$flag=0;
if(isset($_SESSION['login_user']) && isset($_SESSION['login_phone'])){
$flag=1;
}
date_default_timezone_set("Asia/Kolkata");
?>
<html>
<head>
    <title>My Orders</title>
<link rel="shortcut icon" type="image/png" href="images/GR111.png"/>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Bubblegum Sans' rel='stylesheet'>
  
<style>
nav{font-family: 'Josefin sans', sans-serif; }
th{text-align:center;}
		 #map{height: 160px;}
        
        .btnpp{color:grey; font-family: 'Questrial', sans-serif; letter-spacing:1px; font-weight:700;}
        
        .btnpp:hover{text-decoration:none; color:grey;}
        
        .recname{font-size: 15px;font-family: 'Questrial', sans-serif; letter-spacing:1px;font-weight:bold; }
		 
		 .recname1{font-size: 12px;font-family: 'Questrial', sans-serif; letter-spacing:1px;font-weight:bold;}
		 
		 .recname2{font-size: 18px;font-family: 'Questrial', sans-serif; letter-spacing:1px;font-weight:bold;}
		 
		 h2{font-family: 'Josefin sans', sans-serif; letter-spacing:1px;}

</style>
</head>

<body>
<nav class="navbar navbar-fixed-top" style="background-color:white">
  <div class="container-fluid">
    <div class="navbar-header" id="navbar">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="">Groctaurant</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav nav1">
        <li><a href="index.php">Chef-La-Pumb</a></li>
		<li><a href="kitchen-protein.php">Kitchen Protein</a></li>
                <li><a href="about-us.php">About Us</a></li>
        <li><a href="how-it-works.php">How It Works</a></li>
        <li><a href="contact-us.php">Contact Us</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
                    <?php if($flag==1){ ?>
                    <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
                    <li class="login"><a href="myprofile.php" style="cursor: pointer; color:black;"><span class="glyphicon glyphicon-user"></span><span class="hidden-xs login_session"> <?php echo $login_session;?></span></a></li>
                    <li class="login"><a href="logout.php" style="cursor: pointer; color:black;"><span class="glyphicon glyphicon-lock"></span><span class="hidden-xs"> Logout</span></a></li>
            <?php }
            else{ ?>
                    <li class="login"><a href="login.php" style="cursor: pointer; color:black;"><span class="glyphicon glyphicon-user"></span><span class="hidden-xs"> Login/Sign Up</span></a></li>
            <?php }
            ?>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container-fluid" style="margin-top: 75px;">
<h2><center>Order History</center></h2>
<div class="table-responsive">
  <table class='table table-condensed table-bordered' id="table">
    <br><tr class="recname">
    <th>Order ID</th>
    <th>Name</th>
    <th>Phone</th>
    <th>Address</th>
    <th>Recipe Name</th>
    <th>Serving</th>
    <th>Quantity</th>
    <th>Price</th>
    <th>Total Price</th>
    <th>Payment Type</th>
    <th>Payment</th>
    <th>Delivery Time</th>
    <th>Status</th>
  </tr>
  <?php

  $sql="SELECT * from grret_orders where profile = '$login_session1' order by id desc";
  $result = mysqli_query($con, $sql);

  while($row = mysqli_fetch_array($result))
  {
    echo "<tr class='recname1 ".$row['ord_status']."'>";
    echo "<td>" . $row['ord_id'] . "</td>";
    echo "<td>" . $row['cus_name'] . "</td>";
    echo "<td>" . $row['cus_phone'] . "</td>";
    echo "<td>" . $row['cus_address'] . "</td>";
    echo "<td>" . str_replace(', ','<br>', $row['rec_name']). "</td>";
    echo "<td>" . str_replace(', ','<br>', $row['rec_serving']). "</td>";
    echo "<td>" . str_replace(', ','<br>', $row['rec_qty']). "</td>";
    echo "<td>" . str_replace(', ','<br>', $row['rec_price']). "</td>";
    echo "<td>" . $row['total_price'] . "</td>";
    echo "<td>" . $row['payment_type'] . "</td>";
    echo "<td class='".$row['payment_status']."'>" . $row['payment_status'] . "</td>";
    echo "<td>" . $row['del_time'] . "</td>";
    echo "<td>" . $row['ord_status'] . "</td>";
  }
  ?>
</table>
</div>
</div>

<!-- -------------------------------FOOTER----------------------------------------- -->

<hr style="margin-top:80px;">
<footer style="padding-top:10px; padding-bottom:30px;">
    <div class="container-fluid" id="footer">
        <div class="row">
 <div class="col-sm-2 col-sm-offset-1">
                <button class="btn btn-link btnpp">Privacy policy</button><br>
                <button class="btn btn-link btnpp">Terms & conditions</button><br>
                <button class="btn btn-link btnpp">Press release</button><br>
                <button class="btn btn-link btnpp">Legal</button>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-link btnpp">How it works</button><br>
                <button class="btn btn-link btnpp">Grow big with us</button><br>
                <button class="btn btn-link btnpp">Submit your recipe</button><br>
                <button class="btn btn-link btnpp">Blog</button>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-link btnpp">Locate our store</button><br>
                <button class="btn btn-link btnpp">Contact us</button><br>
                <button class="btn btn-link btnpp">Careers</button><br>
                <button class="btn btn-link btnpp">FAQs</button>
            </div>
            <div class="col-sm-5">
            <br><div class="text-center">
        <sup style="font-size:26px; font-family: 'Josefin Sans', sans-serif;">&copy;</sup><span style="font-size:26px; font-family: 'Josefin Sans', sans-serif;">Groctaurant Foods Private Limited</span>
    </div>

    <div class="text-center">
        <a href="https://www.facebook.com/groctaurant" target="_blank" class="fa fa-facebook fa-2x" style="text-decoration:none; padding:20px; color:#3b5998"></a>
        <a href="https://www.youtube.com/channel/UCxHqWo1Xdf6o8nRCle8byhA" target="_blank" class="fa fa-youtube fa-2x" style="text-decoration:none;  padding:20px; color:red;"></a>
        <a href="https://in.linkedin.com/company/groctaurant" target="_blank" class="fa fa-linkedin fa-2x" style="text-decoration:none; padding:20px; color:#0077b5;"></a>
        <a href="https://www.instagram.com/groctaurant/" target="_blank" class="fa fa-instagram fa-2x" style="text-decoration:none; padding:20px; color:#9b6954;"></a>
        <a href="#" target="_blank" class="fa fa-twitter fa-2x" style="text-decoration:none; padding:20px; color:#00aced;"></a>
    </div>
            </div>
        </div>
    </div>
</footer>

</body>
</html>