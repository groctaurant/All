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

<html lang="en">

<head>
  <link rel="shortcut icon" type="image/png" href="images/GR111.png"/>
  <title>How it works</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Port+Lligat+Slab" rel="stylesheet">
   </head>
  
<style>

nav{font-family: 'Josefin sans', sans-serif; }

.well{
  background:rgba(1,1,1,0.5);
  color:white;
  padding-top:30px;
  padding-bottom:60px;
  border-radius:0px;
  font-family: 'Rancho', cursive;
  font-size:24px;
}

	p{font-family: 'Josefin sans', sans-serif;}

    .body1{background-image: url('images/howit.jpg'); height: "100%";  background-attachment: fixed; background-position: center;
    background-repeat: no-repeat; background-size: cover;}
 
   	.navbar-collapse{
  		margin-right: 30px;
  	}

    #map{height: 160px;}
    .btnpp{color:grey; font-family: 'Questrial', sans-serif; letter-spacing:1px; font-weight:700;}
    .btnpp:hover{text-decoration:none; color:grey;}
    .btn_cuisine{font-size:19px; font-family: 'Questrial', sans-serif; letter-spacing:1.5px;}
 
 
</style>
  
  
<body>

<nav class="navbar navbar-fixed-top" style="background-color:white;">
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
        <li><a href="how-it-works.php" style="border-bottom:2px solid #c70039">How It Works</a></li>
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

	
	
	
<!--------------------------------------------------------->

	<div class="body1" style="padding:80px 60px 100px 60px;">

<br><h1 style="font-family: 'Open Sans Condensed', sans-serif; color:white"><center>Like A Wish, Delivered Home</center></h1>
<br><div class='row'>
<div class='col-sm-5 col-sm-offset-1'>
<div class="well">
<center><i class="fa fa-certificate" aria-hidden="true" style="font-size:100px; color:white"></i></center>
<br><h3 style="font-family: 'Open Sans Condensed', sans-serif;"><center><b>WE CREATE RECIPES YOU WISH</b></center></h3>
<p align='justify'>Our expert professional and home chefs, 
using their years of culinary experience researches on the various aspects of a recipe.
 We experiment with the balance of ingredients understanding the various processes, 
 technique and expertise required to achieve that perfect blend of taste, 
 making sure that the recipe is healthy, nutritious and will be an ease to you at your home.</p></div></div>
<div class='col-sm-5'>
<div class="well">
<center><i class="fa fa-balance-scale" aria-hidden="true" style="font-size:100px; color:white;"></i></center>
<br><h3 style="font-family: 'Open Sans Condensed', sans-serif;"><center><b>WE MEASURE THE INGREDIENTS</b></center></h3>
<p align='justify' >We assist you in buying just the required quantity of grocery for your meal,
 removing the burden of decisions you have to make while purchasing those standard set of quantities. 
 We provide you with a social satisfaction of not throwing anything away. And to top it all, 
 you save yourself from huge spending you do on stocking up your refrigerator and cupboards.</p></div></div>
 </div>

<div class='row'>
<div class='col-sm-5 col-sm-offset-1'>
<div class="well">
<center><i class="fa fa-cutlery" aria-hidden="true" style="font-size:100px; color:white"></i></center>
<br><h3 style="font-family: 'Open Sans Condensed', sans-serif;"><center><b>WE PROCESS THE INGREDIENTS</b></center></h3>
<p align='justify'>To us, your precious time is like money, so we save your time 
by doing the needful processing of ingredients for you to start cooking like a Master Chef. 
Further saving your time, we provide you with every ingredient you need starting from oil, 
spices, chopped or pureed or boiled vegetables, cereals and flour to the tiny amount of garnishing.</p></div></div>
<div class='col-sm-5 '>
<div class="well">
<center><i class="fa fa-credit-card" aria-hidden="true" style="font-size:100px; color:white"></i></center>
<br><h3 style="font-family: 'Open Sans Condensed', sans-serif;"><center><b>RECIPE CARD</b></center></h3>
<p align='justify'>Having assisted you with everything, we do one last thing that is to guide you on how to
proceed with these ingredients and make a perfect dish. 
We call this assistance Recipe kit and the guidance as recipe card.
 So how it works, is that you just come up with a wish and let us know of that by calling us,
 visiting our website or visiting us In person.</p></div></div>
 </div>


</div>


<!-- -------------------------------FOOTER----------------------------------------- -->

<hr style="margin-top:0px;">
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
