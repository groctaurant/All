<?php
include 'cart1.php';
$cart = new Cart;
if(isset($_COOKIE['login_user']) && isset($_COOKIE['login_phone'])){
include 'session.php';
}
$flag=0;
if(isset($_SESSION['login_user']) && isset($_SESSION['login_phone'])){
$flag=1;
}
date_default_timezone_set("Asia/Kolkata");
?>
<html>
<head>
<link rel="shortcut icon" type="image/png" href="images/GR.png"/>
    <title>GROCTAURANT</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
.sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: black;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
}

#men {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 18px;
    color: white;
    display: block;
    transition: 0.3s;
}

.sidenav a:hover {
    color: #f1f1f1;
}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    left: 0;
    font-size: 34px;
    padding-left:14.9px;
    margin-top:-7.6px;
    color:white;
    text-decoration:none;
}

</style>
</head>

<body>
<div class="w3-top">
<div class="w3-bar w3-black">
  <a href="#" class="w3-bar-item w3-button w3-padding-small"><span style="font-size:19px; cursor:pointer; text-decoration:none; margin-left:8px;" onclick="openNav()">&#9776;</span></a>
  <a href="cart.php" class="w3-bar-item w3-right w3-padding-small" style="margin-right:-10px; text-decoration:none;"><i class="material-icons" style="margin-right:15px; margin-top:5px; font-size:18px;">shopping_cart</i></a>
        <a href="whatsapp://send?text=http://m.groctaurant.in/ppage.php?recipe_name1=<?php echo rawurlencode(urlencode($recipe)); ?>" data-action="share/whatsapp/share" class="w3-bar-item w3-right w3-padding-small"><i class="material-icons" style="margin-top:5px; font-size:18px;">send</i></a>
</div>
</div>
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="home.php" id="men">Chef-la-pumb</a>
  <a href="kitchen-protein.php" id="men">Kitchen Protein</a>
  <a href="cart.php" id="men">My Cart</a>
  <a href="#" id="men">About</a>
  <a href="#" id="men">Contact</a>  
  <?php 
                if($flag==1){ ?>
                <a href="myprofile.php" id="men">My Profile</a>
  <a href="logout.php" id="men">Log Out</a>
   <?php 
                } else { ?>
                <a href="index.php" id="men">Login</a>
                 <?php 
                } ?>
</div>
<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "240px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script>
<div class="container-fluid" style="margin-top: 50px;">
<h3><center>Orders</center></h3><br>
  <?php

  $sql="SELECT * from grret_orders where profile = '$login_session1' order by id desc";
  $result = mysqli_query($con, $sql);

  while($row = mysqli_fetch_array($result))
  {
  ?>
<div class="well">
<p>Id: <b><?php echo $row['ord_id']; ?></b></p>
<p>Status: <b><?php echo $row['ord_status']; ?></b></p>
<p>Items: </p>
<p><b><?php echo str_replace(', ','<br>', $row['rec_name']); ?></b></p>
<p>Total Price: <b><?php echo $row['total_price']; ?></b></p>
<p>Mode of payment: <b><?php echo $row['payment_type']; ?></b></p>
</div>
  <?php } ?>
  </div>
</body>
</html>