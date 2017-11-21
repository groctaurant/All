<?php
session_start();
include "config.php";

if(isset($_COOKIE['login_user']) && isset($_COOKIE['login_phone'])){
include 'session.php';
}

$flag=0;
if(isset($_SESSION['login_user']) && isset($_SESSION['login_phone'])){
$flag=1;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Kitchen Protein</title> 
  <link rel="shortcut icon" type="image/png" href="images/GR111.png"/>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Port+Lligat+Slab" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Bubblegum Sans' rel='stylesheet'>
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var
f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-N4QLNPL');</script>
   <script>
        function initMap() {
            var uluru = {lat: 28.417483, lng: 77.319092};
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
                center: uluru
            });
            var marker = new google.maps.Marker({
                position: uluru,
                map: map
            });
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7EQcHcxBBrkd8nkSZiDl5_4DroEv215M&callback=initMap">
    </script>
  
  <style>
  
  nav{font-family: 'Josefin sans', sans-serif; }
		  .carousel-inner > .item > img,
		  .carousel-inner > .item > a > img {
		  height: 350px;}

		  #overlay {
			position: fixed;
			display: none;
			width: 100%;
			height: 100%;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background-color: rgba(0,0,0,0.92);
			z-index: 2;
			cursor: pointer;
		 }

		 #text{
			position: absolute;
			top: 50%;
			left: 60%;
			transform: translate(-50%,-50%);
			-ms-transform: translate(-50%,-50%);
		 }

		#sidecart{height:348px;}
         #sidecartparent{position:absolute; right:0; }
         #cuis{position:absolute;}

		 .scrolll{overflow-y:scroll; overflow-x:hidden; max-height:275px;}

		 .scrolll::-webkit-scrollbar {
			width: 6px;
		 }
		 
		 .scrolll::-webkit-scrollbar-track {
			-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
			border-radius: 80px;
		 }
		 
		 .scrolll::-webkit-scrollbar-thumb {
		   	border-radius: 8px;
			-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
		 }
		 
		  .pagination{margin:0;padding:0;}
		 .pagination li{
			display: inline;
			padding: 6px 10px 6px 10px;
			border: 1px solid #ddd;
			margin-right: -1px;
			font: 15px/20px Arial, Helvetica, sans-serif;
			background: #FFFFFF;
			box-shadow: inset 1px 1px 5px #F4F4F4;
		 }
		 .pagination a{
			text-decoration:none;
			color: rgb(89, 141, 235);
		 }
		 .pagination li.first {
			border-radius: 5px 0px 0px 5px;
		 }
		 .pagination li.last {
			border-radius: 0px 5px 5px 0px;
		 }
		 .pagination li:hover{
			background: #CFF;
		 }
		 .pagination li.active{
			background: #F0F0F0;
			color: #333;
		 }
		 
		 .recname{font-size: 15px;font-family: 'Questrial', sans-serif; letter-spacing:1px;font-weight:bold; }
		 
		 .recname1{font-size: 12px;font-family: 'Questrial', sans-serif; letter-spacing:1px;font-weight:bold;}
		 
		 .recname2{font-size: 22px;font-family: 'Questrial', sans-serif; letter-spacing:1px;font-weight:bold;}


		 .minh{min-height:300px;}

		 .removeCartItem{background-color:white;}
		
		 .removeCartItem:hover{background-color:white;}
		 
		 #map{height: 160px;}
        
        .btnpp{color:grey; font-family: 'Questrial', sans-serif; letter-spacing:1px; font-weight:700;}
        
        .btnpp:hover{text-decoration:none; color:grey;}
		
		.bt{font-size:19px; font-family: 'Questrial', sans-serif; letter-spacing:1.5px;}
		
		 .switch {
		  position: relative;
		  display: inline-block;
		  width: 40px;
		  height: 15px;
		  margin: 0px 0 0px 5px;
		}

		.switch input {display:none;}

		.slider {
		  position: absolute;
		  cursor: pointer;
		  top: 0;
		  left: 0;
		  right: 0;
		  bottom: 0;
		  background-color: #ccc;
		  -webkit-transition: .4s;
		  transition: .4s;
		  border-radius: 34px;
		}

		.slider:before {
		  border-radius: 50%;
		  position: absolute;
		  content: "";
		  height: 23px;
		  width: 23px;
		  left: -4px;
		  bottom: -4px;
		  background-color: white;
		  -webkit-transition: .4s;
		  transition: .4s;
		  box-shadow: 0px 0px 16px 0px rgba(0, 0, 0, 0.5);
		}

		.slider {
		  background-color: green;
		}

		input:focus + .slider {
		  box-shadow: 0 0 1px #2196F3;
		}

		input:checked + .slider:before {
		  -webkit-transform: translateX(25px);
		  -ms-transform: translateX(25px);
		  transform: translateX(25px);
		}
		

  </style>
  
  </head>
<body>
<noscript><iframe
src="https://www.googletagmanager.com/ns.html?id=GTM-N4QLNPL"
height="0" width="0"
style="display:none;visibility:hidden"></iframe></noscript>
<nav class="navbar navbar-fixed-top" style="background-color:white; color:black; ">
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
		<li><a href="kitchen-protein.php" style="border-bottom:2px solid #c70039">Kitchen Protein</a></li>
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

<div style="margin-top:150px;"><h2><center><b>Due to high volume of orders Kitchen Protein is unavailable online.<br>You can place your order at 0129-4146687</b></center></h2></div>

</body>
</html>
