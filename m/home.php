<?php 
include 'config.php';
include 'cart1.php';
$cart = new Cart;
$sub_total = $cart->total();

if(isset($_COOKIE['login_user']) && isset($_COOKIE['login_phone'])){
include 'session.php';
}
$flag=0;
if(isset($_SESSION['login_user']) && isset($_SESSION['login_phone'])){
$flag=1;
}

?>
<html>
<head>
    <title>Home</title>
    <link rel="shortcut icon" type="image/png" href="images/GR111.png"/>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	    <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">

    <style type="text/css">
	
	#navbot{
  line-height: 1.2;
  margin:2px;
}
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
		  margin-bottom:-3px;
		  margin-top:3px;
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
		
		

            body{
              font-family: 'Lato', sans-serif;
            }
    #navbar-image{
        top: 28%;
        left: 56%;
    }

    #name-background{
        display: table-cell;
        vertical-align: bottom;
        bottom: -5px;
        width: 100%;
        height: 60%;
        background-image: linear-gradient(to top, rgba(0, 0, 0,0.85),rgba(0, 0, 0, 0));
    }
        
    #recipe_detail{
      position: absolute;
      bottom: 0px;
      left:9px;
    }

    #recipe_image{
        overflow:hidden; 
        color: white;
    }

    .scroll {
        color: #606060;
        box-shadow: 1px 1px 5px rgba(0,0,0,0.46);
        background:black; 
        white-space: nowrap;
        overflow-x: scroll;
        -webkit-overflow-scrolling: touch;
        -ms-overflow-style: -ms-autohiding-scrollbar; 
    }
    .scroll a{
        text-decoration: none;
        font-size: 20px;
        padding: 10px 10px 0px 10px;
    }
    ::-webkit-scrollbar {
        display: none;
    }
        		 #text{
			position: absolute;
			top: 40%;
			left: 50%;
			transform: translate(-50%,-50%);
			-ms-transform: translate(-50%,-50%);
		 }
#overlay {
			position: fixed;
			display: none;
			width: 100%;
			height: 100%;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background-color: rgba(0,0,0,0.75);
			z-index: 4;
			cursor: pointer;
		 }

.sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 2;
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
    .carousel-inner > .item > img,
    .carousel-inner > .item > a > img {
        height: 200px;  }
		
	.recname{font-size: 13px;font-family: 'Questrial', sans-serif; letter-spacing:1px;font-weight:bold;}
	#men{font-family: 'Montserrat', sans-serif;}
	.filter_div{position:relative;z-index:1;}
img{object-fit:cover;}
		

    </style>
</head>
<body>

<!--Top Navbar -->

<div class="w3-top" id="top_div">
<div class="w3-bar w3-border-0 w3-black">
  <a href="#" class="w3-bar-item w3-button w3-padding-small"><span style="font-size:19px; cursor:pointer; text-decoration:none; margin-left:8px;" onclick="openNav()">&#9776;</span></a>
  <a href="cart.php" class="w3-bar-item w3-right w3-padding-small" style="text-decoration:none;"><i class="material-icons" style="margin-right:15px; margin-top:5px; font-size:18px;">shopping_cart</i></a>
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
<div>
<div id="overlay">
        <div id="text"><img src="loader.gif" width="100%"></div>
    </div>
    <!--TOP CAROUSEL -->

    <div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin-top:36px">
        <!-- Indicators -->

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <img src="http://www.groctaurant.com/images/1.jpg">
            </div>

            <div class="item">
                <img src="http://www.groctaurant.com/images/2.jpg">
            </div>
        </div>
    </div>

<!-- MENU -->
<div class="filter_div">
    <div class="scroll text-center"  style="background-color:black; ">
        <a class="btn btn-link btn_cuisine" style="text-decoration:none; color:white;">Indian</a>
        <a class="btn btn-link btn_cuisine" style="text-decoration:none; color:white;">Chinese</a>
        <a class="btn btn-link btn_cuisine" style="text-decoration:none; color:white;">Thai</a>
        <a class="btn btn-link btn_cuisine" style="text-decoration:none; color:white;">Italian</a>
        <a class="btn btn-link btn_cuisine" style="text-decoration:none; color:white;">Breads</a>
    </div>
        <div class="text-center" style="padding:10px;background-color:white;">
	<span class="recname">Veg</span>
	<label class="switch">
        <input type="checkbox" class="veg_tag" value="Non-veg">
        <span class="slider round"></span>
    </label>
	  <span class="recname" style="margin-left:5px;">Non-Veg</span>
            </div>
</div>

    <div id="results" style="margin-bottom:51.4px; position:relative;">
        
        </div>
</div>
<div class="navbar-fixed-bottom"  id="footer-2" style="background:#0b9444;box-shadow:0px 7px 12px 3px black;color:white; padding:2px;">
  <div class="btn-group btn-group-justified" >
    <div class="btn-group text-center">
        <div class="row">
          <div class="col-xs-6" style="padding-right: 0px">
            <span class="glyphicon glyphicon-shopping-cart" style="font-size: 30px"></span>
          </div>
          <div class="col-xs-6 cartitems1" style="font-size: 13px;padding-left: 0px;margin-top:3%;">
            <?php echo $cart->total_items(); ?> item(s)
          </div>
        </div>
    </div>
    <div class="btn-group text-center">
      <p id="navbot">Total Price</p>
      <p  id="navbot" class="pricee"><b>₹<?php echo round($sub_total); ?>/-</b></p>
    </div>  
    <div class="btn-group text-center ">  
      <a href="cart.php"><button class="btn btn-danger btn-bottom" style="padding:7px;width: 90%;border-radius: 7%">PROCEED</button></a>
    </div>  
  </div>
</div>

<script type="text/javascript">
$(document).ready(function(){$(document).on("change",".serving",function(){var t=$(this).val().split(",");$(this).parent().next().find("b").html("₹"+t[0]+"/-"),$(this).parent().next().next().find("button").val(t[2]+","+t[1])}),$(document).on("click",".addToCart",function(){var t=$(this).parent().parent(),e=$(this),i=$(this).val().split(","),o=i[0],s=i[1];e.html(""),$.ajax({type:"GET",url:"cartAction.php",data:{action:"addToCart",id:o,serving:s},success:function(i){e.html("+"),$(".cartitems").text(i),t.attr("title","Item Sucessfully Added!").attr("data-toggle","tooltip").tooltip({trigger:"manual"}).tooltip("show"),setTimeout(function(){t.tooltip("hide")},2e3);var i=i.split("|");$(".cartitems1").text(i[0]+" item(s)"),$(".pricee").text("₹"+i[1]+"/-")}})}),$(".scroll a").on("click",function(){$(".scroll a").removeClass("active"),$(this).addClass("active")});var t="Indian",e="Veg";$("#results").load("home_fetch.php"),$(document).on("click",".btn_cuisine",function(i){i.preventDefault(),t=$(this).text(),$("#overlay").css("display","block"),$("#results").load("home_fetch.php",{cuisine:t,veg_tag:e},function(){$("#overlay").css("display","none")})}),$(document).on("change",".veg_tag",function(i){i.preventDefault(),"Veg"==(e=$(this).val())?($(this).val("Non-veg"),$(".slider").css("background-color","green")):($(this).val("Veg"),$(".slider").css("background-color","firebrick")),$("#results").load("home_fetch.php",{cuisine:t,veg_tag:e},function(){})}),$(window).on("scroll",function(){var t=$(this).scrollTop()+$(".filter_div").height(),e=$("#myCarousel").height(),i=$("#top_div").height(),o=$(".filter_div").height();t-i>e+i?($(".filter_div").css({position:"fixed",top:i}),$("#results").css("margin-top",o)):($(".filter_div").css({position:"relative",top:0}),$("#results").css("margin-top",0))})});
</script>
</body>
</html>