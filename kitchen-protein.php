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

<img id="myCarousel" src="images/1.gif" height="350px" width="100%" style="margin-top:53px;">


<div class="row minh">
<div class="col-sm-2 hidden-xs" id="cuis">
<br><div style="padding-left:10px;">
        <a class="btn btn-link bt proteins" style="text-decoration:none; color:black;">Proteins</a><br>
        <a class="btn btn-link bt carbs" style="text-decoration:none; color:black;">Carbs</a><br>
    	<a class="btn btn-link bt breakfast" style="text-decoration:none; color:black;">Breakfast</a><br>
        <a class="btn btn-link bt smoothies" style="text-decoration:none; color:black;">Smoothies</a><br>
        <a class="btn btn-link bt salads" style="text-decoration:none; color:black;">Salads</a>
	</div>
</div>
<div class="col-sm-7 col-sm-offset-2 mainn" id="mainn" style="min-height:760px;">
    <div id="overlay">
        <div id="text"><img src="images/loader.gif" width="50%"></div>
    </div>
	<div class="row">
	<div class="col-sm-9 col-xs-7">
    <p style="padding:16px;font-family: 'Port Lligat Slab', serif; font-size:40px;">Kitchen Protein</p>
	</div>
	<div class="col-sm-3 col-xs-5" style="margin-top:32px;">
	<span class="recname">Veg</span>
	<label class="switch">
        <input type="checkbox" class="veg_tag" value="Non-veg">
        <span class="slider round"></span>
    </label>
	  <span class="recname" style="margin-left:5px;">Non-Veg</span>
	</div>
	</div>
    <div id="results">
    </div>
</div>
<div class="col-sm-3 hidden-xs" id="sidecartparent">
<br><br><div id="sidecart">
</div>
<div style="margin-top:20px;">
<ul class="nav nav-tabs">
  <li class="active recname1"><a data-toggle="tab" href="#home">Add-Ons</a></li>
</ul>

<div class="tab-content" style="margin:10px;">
  <div id="home" class="tab-pane fade in active">
   <?php
  $queryb=mysqli_query($con,"SELECT * from admin_recipee where cuisine='KP' and category='Add-ons' and availability = 'Available' ");
  while($rowb=mysqli_fetch_array($queryb)){
	  $nom=$rowb['recipe_name1']; 
	  $nam=rtrim($nom,"Addon");	  
	  $id = $rowb['id'];
	  $vegtag = $rowb['veg_tag'];
	  $img=$rowb['image_dir1'];
	  $queryb1 = mysqli_query($con, "SELECT * from admin_recipeservings where name = '$nom'"); 
	  $rowb1 = mysqli_fetch_array($queryb1);
	  $serving=$rowb1['servings'];
	  $price=$rowb1['price'];
	  
	  ?>

		<div class="row" style="padding:5px">
				 <div class="col-md-1">
	        <?php 
	                if($vegtag=='Veg'){
	                  echo "<img src='images/veg.png' width='16px'>";
	                } else{
	                  echo "<img src='images/non.png' width='16px'>";
	                }
	                ?> 
					</div>
					<div class="col-md-6" style="margin-top:0px;">
					<span class='recname1'> <?php echo $nam; ?></span>
					</div>
	                <div class="col-md-2">
	                <p class='recname1' style="margin-top:5px;">₹<?php echo $price; ?></p>
					</div>
					<div class="col-md-2">
					<button class="w3-btn addToCart addToCart1" value="<?php echo $id ?>,<?php echo $serving; ?>" style="background-color: #C70039; color: white; float:right; padding:2px 10px;">+</button>
	            </div>
		</div>
		
  <?php } ?>
	</div>
</div>
</div>
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

<script type="text/javascript">
$(document).ready(function(){var t="Veg";$("#results").load("kitchen_protein_fetch.php"),$(document).on("change",".veg_tag",function(o){o.preventDefault(),"Veg"==(t=$(this).val())?($(this).val("Non-veg"),$(".slider").css("background-color","green")):($(this).val("Veg"),$(".slider").css("background-color","firebrick")),$("#results").load("kitchen_protein_fetch.php",{veg_tag:t},function(){})}),$("#sidecart").load("sidecart.php"),$(document).on("click",".btnplus",function(){var t=$(this).val(),o=$("#"+t).text();o++,$.get("cartAction.php",{action:"updateCartItemplus",id:t,qty:o},function(t){"ok"==t&&$("#sidecart").load("sidecart.php")})}),$(document).on("click",".btnminus",function(){var t=$(this).val(),o=parseInt($("#"+t).text());o--,$.get("cartAction.php",{action:"updateCartItemminus",id:t,qty:o},function(t){"ok"==t&&$("#sidecart").load("sidecart.php")})}),$(document).on("click",".removeCartItem",function(){var t=$(this).val();$.ajax({type:"get",url:"cartAction.php",data:{action:"removeCartItem",id:t},success:function(t){$("#sidecart").load("sidecart.php")}})}),$(document).on("click",".addToCart",function(){var t=$(this),o=$(this).val().split(","),s=o[0],a=o[1];t.hasClass("addToCart1"),t.html("+"),$.ajax({type:"GET",url:"cartAction.php",data:{action:"addToCart",id:s,serving:a},success:function(o){t.hasClass("addToCart1"),t.html("+"),$("#sidecart").load("sidecart.php")}})}),$(window).on("scroll",function(){var t=$(this).scrollTop(),o=t+$("#sidecartparent").height()+50,s=t+$("#cuis").height()+50,a=$("#navbar").height(),i=$("#mainn").offset().top,e=$("#footer").offset().top-130;o>e?$("#sidecartparent").css({position:"absolute",top:e-$("#sidecartparent").height()}):t+a>i?$("#sidecartparent").css({position:"fixed",top:a}):$("#sidecartparent").css({position:"absolute",top:$("#myCarousel").height()+a+24}),s>e?$("#cuis").css({position:"absolute",top:e-$("#cuis").height()}):t+a>i?$("#cuis").css({position:"fixed",top:a}):$("#cuis").css({position:"absolute",top:$("#myCarousel").height()+a+24})}),$(".proteins").click(function(){$("html,body").animate({scrollTop:$("#proteins").offset().top-55},"slow")}),$(".smoothies").click(function(){$("html,body").animate({scrollTop:$("#shakes").offset().top-55},"slow")}),$(".carbs").click(function(){$("html,body").animate({scrollTop:$("#carbs").offset().top-55},"slow")}),$(".breakfast").click(function(){$("html,body").animate({scrollTop:$("#breakfast").offset().top-55},"slow")}),$(".salads").click(function(){$("html,body").animate({scrollTop:$("#salads").offset().top-55},"slow")})});
</script>
</body>
</html>
