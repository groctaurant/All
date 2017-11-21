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
  <title>Chef-La-Pumb</title> 
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
<script type="text/javascript">
    if (window.screen.width < 980) {
   window.location = 'http://m.groctaurant.com/home.php';
 }
</script>
						   
<style>
  
  nav{font-family: 'Josefin sans', sans-serif; }
		  .carousel-inner > .item > img,
		  .carousel-inner > .item > a > img {
		  height: 350px;}
			  

			  
		  #name-background{
		  display: table-cell;
		  vertical-align: bottom;
		  bottom: -5px;
		  width: 100%;
		  height: 40%;
		  background-image: linear-gradient(to top, rgba(0, 0, 0,0.85),rgba(0, 0, 0, 0.08));
		 }
		 #recipe_detail{
		  position: absolute;
		  bottom: 0px;
		  left: 7px;
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
			width: 4px;
		 }
		 
		 .scrolll::-webkit-scrollbar-track {
			-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
			border-radius: 80px;
		 }
		 
		 .scrolll::-webkit-scrollbar-thumb {
		   	border-radius: 8px;
			-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
		 }

		 .minh{min-height:300px;}

		 .removeCartItem{background-color:white;}
		
		 .removeCartItem:hover{background-color:white;}
		 
		 #map{height: 160px;}
        
        .btnpp{color:grey; font-family: 'Questrial', sans-serif; letter-spacing:1px; font-weight:bold;}
        
        .btnpp:hover{text-decoration:none; color:grey;}
		
		.btn_cuisine{font-size:18px; font-family: 'Questrial', sans-serif; letter-spacing:1.5px;}
		
		.recname{font-size: 15px;font-family: 'Questrial', sans-serif; letter-spacing:1px;font-weight:bold; }
		 
		 .recname1{font-size: 12px;font-family: 'Questrial', sans-serif; letter-spacing:1px;font-weight:bold;}
		 
		 .recname2{font-size: 20px;font-family: 'Questrial', sans-serif; letter-spacing:1px;font-weight:bold;}
				  
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
        <li><a href="index.php" style="border-bottom:2px solid #c70039">Chef-La-Pumb</a></li>
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

<img id="myCarousel" src="images/1.gif" height="350px" width="100%" style="margin-top:53px;">

<div class="row minh">
<div class="col-sm-2 hidden-xs" id="cuis">
	<br><div style="padding-left:10px;">
        <img src="flags/india.png" width="28px" style="margin-bottom:4px;"><a class="btn btn-link btn_cuisine" style="text-decoration:none; color:black; font-weight:bold;">Indian</a><br>
        <img src="flags/italy.png" width="28px" style="margin-bottom:4px;"><a class="btn btn-link btn_cuisine" style="text-decoration:none; color:black; font-weight:bold;">Italian</a><br>
		<img src="flags/china.png" width="28px" style="margin-bottom:4px;"><a class="btn btn-link btn_cuisine" style="text-decoration:none; color:black; font-weight:bold;">Chinese</a><br>
        <img src="flags/thailand.png" width="28px" style="margin-bottom:4px;"><a class="btn btn-link btn_cuisine" style="text-decoration:none; color:black; font-weight:bold;">Thai</a><br>
        <img src="flags/bread.png" width="28px" style="margin-bottom:4px;"><a class="btn btn-link btn_cuisine" style="text-decoration:none; color:black; font-weight:bold;">Breads</a>
	</div>
</div>
<div class="col-sm-7 col-sm-offset-2 mainn" id="mainn" style="min-height:760px;">
    <div id="overlay">
        <div id="text"><img src="images/loader.gif" width="50%"></div>
    </div>
	<div class="row">
	<div class="col-sm-9 col-xs-7">
    <p class="cuisine_head" style="padding:16px; font-family: 'Port Lligat Slab', serif; font-size:48px;">INDIAN</p>
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
  <li class="active recname1"><a data-toggle="tab" href="#brd">Breads</a></li>
  <li class="recname1"><a data-toggle="tab" href="#bev">Beverages</a></li>
  <li class="recname1"><a data-toggle="tab" href="#des">Desserts</a></li>
</ul>

<div class="tab-content" style="margin:10px;">
	  <div id="brd" class="tab-pane fade in active">
   <?php
  $queryb=mysqli_query($con,"SELECT * from admin_recipee where cuisine='Breads' and category='Add-ons' and availability = 'Available' ");
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
	
  <div id="bev" class="tab-pane fade">
   <?php
  $queryb=mysqli_query($con,"SELECT * from admin_recipee where cuisine='Beverages' and category='Add-ons' and availability = 'Available' ");
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
	  <div id="des" class="tab-pane fade">
   <?php
  $queryb=mysqli_query($con,"SELECT * from admin_recipee where cuisine='Desserts' and category='Add-ons' and availability = 'Available' ");
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
$(document).ready(function(){
    $(document).on('change', '.serving', function(){
        var value1 = $(this).val();
        var value = value1.split(",");
        $(this).parent().next().find("p").html('₹'+value[0]);
        $(this).parent().next().next().find("button").val(value[2]+','+value[1]);
    });

    var cuisine="Indian";
    var veg_tag = "Veg";
    $("#results" ).load( "chef_la_pumb_fetch.php"); //load initial records
    //executes code below when user click on pagination links
    $("#results").on( "click", ".pagination a", function (e){
        e.preventDefault();
        $(".indica").hide();
        $("#overlay").css("display", "block"); //show loading element
        var page = $(this).attr("data-page"); //get page number from link
        $("#results").load("chef_la_pumb_fetch.php",{"page":page, "cuisine":cuisine, "veg_tag":veg_tag}, function(){ //get content from PHP page
            $(".cuisine_head").text(cuisine.toUpperCase());
            $("#overlay").css("display", "none"); //once done, hide loading element
            $(".indica").show();
        });
    });

    $(document).on( "click", ".btn_cuisine", function (e){
        e.preventDefault();
        $(".indica").hide();
        $("#overlay").css("display", "block"); //show loading element
        var page = 1; //get page number from link
        cuisine = $(this).text();
        //console.log(cuisine);
        $("#results").load("chef_la_pumb_fetch.php",{"page":page, "cuisine":cuisine, "veg_tag":veg_tag}, function(){ //get content from PHP page
            $(".cuisine_head").text(cuisine.toUpperCase());
            $("#overlay").css("display", "none");
            $(".indica").show();
        });
    });

    $(document).on( "change", ".veg_tag", function (e){
        e.preventDefault();
        // $(".indica").hide();
        // $("#overlay").css("display", "block"); //show loading element
        var page = 1; //get page number from link
        veg_tag = $(this).val();
        if(veg_tag == "Veg"){
            $(this).val("Non-veg");
			$(".slider").css("background-color", "green");
        } else {
            $(this).val("Veg");
			$(".slider").css("background-color", "firebrick");
        }
        //console.log(cuisine);
        $("#results").load("chef_la_pumb_fetch.php",{"page":page, "cuisine":cuisine, "veg_tag":veg_tag}, function(){ //get content from PHP page
            $(".cuisine_head").text(cuisine.toUpperCase());
            // $("#overlay").css("display", "none");
            // $(".indica").show();
        });
    });

    $("#sidecart" ).load("sidecart.php");

    $(document).on('click','.btnplus', function(){
        var id = $(this).val();
        var obj = ($('#'+id).text());
        obj++;
        $.get("cartAction.php", {action:"updateCartItemplus", id:id, qty:obj}, function(data){
            if(data == 'ok'){
                $("#sidecart" ).load("sidecart.php");
                //location.reload();
            } else {
                //location.reload();
            }
        });
    });

    $(document).on('click','.btnminus', function(){
        var id = $(this).val();
        var obj = parseInt($('#'+id).text());
        obj--;
        $.get("cartAction.php", {action:"updateCartItemminus", id:id, qty:obj}, function(data){
            if(data == 'ok'){
                $("#sidecart" ).load("sidecart.php");
                //location.reload();
            }else{
                // location.reload();
            }
        });
    });

    $(document).on('click', '.removeCartItem', function(){
        //var x = confirm('Are you sure?');
        //console.log("okay");
        //if(x){
            var action = "removeCartItem";
            var id = $(this).val();
            $.ajax({
                type: "get",
                url: "cartAction.php",
                data: {action:action, id:id},
                success: function(data){
                    $("#sidecart" ).load("sidecart.php");
                    //console.log(data);
                }
            });
        //}   
    });

    $(document).on('click', '.addToCart', function(){
        var tag = $(this);
        var id1 = $(this).val();
        var id = id1.split(",");
        var ida = id[0];
        var idb = id[1];
        var name_rec = tag.parent().parent().parent().find(".name_rec").text();
        // console.log(tag.parent().parent().parent().find(".name_rec"));
        // console.log(name_rec);
        //console.log(ida+" "+idb);
        var action = "addToCart";
        //dataLayer.push({'event':action, 'recipe_name': name_rec, 'id':ida, 'serving':idb});
		if(tag.hasClass("addToCart1")){
					tag.html("+");
				}else{
				tag.html("+");}
        $.ajax({
            type: "GET",
            url: "cartAction.php",
            data:{action: action, id: ida, serving: idb},
            success: function(data){
				if(tag.hasClass("addToCart1")){
					tag.html("+");
				}else{
                tag.html("+");}
                $("#sidecart" ).load("sidecart.php");
               // console.log(data);
            }
        });
        //webengage.track("clickedonproductname", ["itemadded" : ida]);
    });
    
    $(window).on('scroll', function() {
        var scroll = $(this).scrollTop();
        var scroll3 = scroll + $("#sidecartparent").height()+50;
        var scroll3a = scroll + $("#cuis").height()+50;
        var scroll2 = $("#navbar").height();
        var scroll5 = $("#mainn").offset().top;
        var scroll4 = $("#footer").offset().top-130;
        if(scroll3>scroll4){
            $("#sidecartparent").css({position: 'absolute', top: scroll4-$("#sidecartparent").height()});
        } else if((scroll + scroll2) > scroll5) {
            $("#sidecartparent").css({position: 'fixed', top: scroll2});
        } else {
            $("#sidecartparent").css({position: 'absolute', top: $("#myCarousel").height()+scroll2 + 29});
        }
        if(scroll3a>scroll4){
            $("#cuis").css({position: 'absolute', top: scroll4-$("#cuis").height()});
        } else if((scroll + scroll2) > scroll5) {
            $("#cuis").css({position: 'fixed', top: scroll2});
        } else {
            $("#cuis").css({position: 'absolute', top: $("#myCarousel").height()+scroll2 + 29});
        }
    });
});
</script>

</body>
</html>