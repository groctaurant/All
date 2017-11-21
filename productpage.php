<?php
session_start();
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
    <title>Product</title> 
    <link rel="shortcut icon" type="image/png" href="images/GR111.png"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Bubblegum Sans' rel='stylesheet'>

    <style type="text/css">
       nav{font-family: 'Josefin sans', sans-serif; }
        #fixx {
            position:absolute;
            margin-top:-60px;
            right:0;
        }

        .checkout { font-family: 'Josefin Slab', serif; }
        
.card {
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
}

.card:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

#card {
    padding: 2px 16px;
}
 #map{height: 160px;}
    .btnpp{color:grey; font-family: 'Questrial', sans-serif; letter-spacing:1px; font-weight:700;}
    .btnpp:hover{text-decoration:none; color:grey;}
    .btn_cuisine{font-size:19px; font-family: 'Questrial', sans-serif; letter-spacing:1.5px;}
    
    .cook_dir_toggle {margin-right:25px; border-radius:0;}
    
    
		.recname{font-size: 15px;font-family: 'Questrial', sans-serif; letter-spacing:1px;font-weight:bold; }
		 
		 .recname1{font-size: 12px;font-family: 'Questrial', sans-serif; letter-spacing:1px;font-weight:bold;}
		 
		 .recname2{font-size: 18px;font-family: 'Questrial', sans-serif; letter-spacing:1px;font-weight:bold;}
		 
		 .mySlides {display:none}
		 .gal {cursor:pointer}
		 img{object-fit:cover;}
    
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
                <?php 
                if($flag==1){ ?>
                <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
                    <li class="login"><a href="myprofile.php" style="cursor: pointer;"><span class="glyphicon glyphicon-user"></span><span class="hidden-xs login_session"> <?php echo $login_session;?></span></a></li>
                    <li class="login"><a href="logout.php" style="cursor: pointer;"><span class="glyphicon glyphicon-lock"></span><span class="hidden-xs"> Logout</span></a></li>
                <?php 
                } else{ ?>
                    <li class="login"><a href="login.php" style="cursor: pointer;"><span class="glyphicon glyphicon-user"></span><span class="hidden-xs"> Login/Sign Up</span></a></li>
                <?php 
                } ?>
            </ul>
        </div>
    </div>
</nav>

<?php
include 'config.php';
$rec=$_GET['recipe_name1'];
$sql=mysqli_query($con,"SELECT * from admin_recipee where recipe_name1='$rec' ");
$row=mysqli_fetch_array($sql);

$id = $row['id'];
$recipe=$row['recipe_name1'];
$sql1=mysqli_query($con,"SELECT MIN(id),name,servings,price from admin_recipeservings where name='".$rec."' ");
while($row1=mysqli_fetch_array($sql1)){
    $price=$row1['price'];
}
$desc=$row['description'];
$cuisine=$row['cuisine'];
$vegtag=$row['veg_tag'];
$time=$row['max_time'];
$diff=$row['difficulty'];
$utensils=$row['utensils'];
$by=$row['recipe_by'];
$image=$row['image_dir1']; 
$image1=$row['image_dir2']; 
$video=$row['video_link'];
$avail = $row['availability'];

$accomp = array($row['accomp1'], $row['accomp2'], $row['accomp3']);
$other_dish = array($row['other_dish1'], $row['other_dish2'], $row['other_dish3']);
?>
      
<div class="modal fade" id="video" role="dialog" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color:black;">
            <div class="modal-body text-center">
            <button class="close btn" style="font-size:30px; color:white; margin-bottom:5px; margin-top: -15px; " data-dismiss="modal">&times;</button>
            <?php 
            if($video==NULL){?>
                <center><h2 style="color:white; padding:20px; margin-top:30px;">VIDEO NOT AVAILABLE</h2></center>
            <?php 
            } else { ?>
                <iframe width="100%" src="<?php echo $video; ?>" frameborder="0" height="450px;" allowfullscreen></iframe>
            <?php 
            } ?>
            </div>
        </div>
    </div>
</div>
      
<div style="margin-top:60px; padding-top:34px;">
    <div class="row">
        <div class="col-sm-8" id="left_frame">
<div class="w3-content">
                <div class="w3-display-container">
                    <center><img class="mySlides" src="http://groctaurantretail.com/admin/zxy321/<?php echo $image; ?>" width="90%" height="420px;"  style="box-shadow:5px 5px 5px grey"></center>
					<?php if($image1!=NULL){ ?>
					<center><img class="mySlides" src="http://groctaurantretail.com/admin/zxy321/<?php echo $image1; ?>" width="90%" height="420px;"  style="box-shadow:5px 5px 5px grey"></center>
					<?php } ?>
                    <?php 
                    if($vegtag=='Veg'){
                        echo "<div class='w3-display-bottomright w3-container' style='bottom: 15px; right: 42px;'><img src='images/veg.png' width='25px'></div>";
                    } else{
                        echo "<div class='w3-display-bottomright w3-container' style='bottom: 15px; right: 42px;'><img src='images/non.png' width='25px'></div>";
                    }
                    ?>
                </div>
				  <div class="w3-row-padding w3-section" style="margin-left:30px;">
    <div class="w3-col s2">
      <img class="gal w3-opacity w3-hover-opacity-off" src="http://www.groctaurantretail.com/admin/zxy321/<?php echo $image;?>"  style="width:150px; height:100px;" onclick="currentDiv(1)">
    </div>
	<?php if($image1!=NULL){ ?>
    <div class="w3-col s2" style="margin-left:20px;">
      <img class="gal w3-opacity w3-hover-opacity-off" src="http://www.groctaurantretail.com/admin/zxy321/<?php echo $image1;?>"  style="width:150px; height:100px;" onclick="currentDiv(2)">
    </div>
	<?php } ?>
  </div>
            </div>
<br><div class="container-fluid" style="padding-left:75px; padding-right:75px;">
                    <span style="font-size:90px;line-height:0.6em;opacity:0.15;">❝</span>
                    <p class="recname2 w3-large text-justify" style="margin-top:-60px; padding:2px 30px; ">
                        <?php echo $desc; ?>
                    </p>
                    <span style="font-size:90px;line-height:0.1em;opacity:0.15;float:right">&#10078;</span>
                </div>

            <br>
            <div class="container-fluid ingrdiv" style="width:75%">
                <h3><b>Ingredients</b></h3>
                <br>
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background-color:white;">
                            <a data-toggle="collapse" href="#collapse1" style="text-decoration:none; color:black;">
                                <h6 class="panel-title">
                                    <b>Spices</b> <span class="caret"></span> 
                                </h6>
                            </a>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <?php
                            $queryjs = mysqli_query($con, "SELECT * from grret_recipejson where recipe_name = '$rec'");
                            $rowjs = mysqli_fetch_array($queryjs);
                            $pathjs = $rowjs['json_path'];
                            $repath = explode("/",$pathjs);
                            $dataj = file_get_contents('http://www.groctaurantretail.com/json/'.rawurlencode($repath[1]));
                            $json = json_decode($dataj, TRUE);
                            ?>
                            <div class="panel-body">
                                <?php 
                                foreach($json as $key => $val){
                                    if($json[$key][0]['SECTION'] == "SPICE" || $json[$key][0]['SECTION'] == "CEREAL & FLOURS" || $json[$key][0]['SECTION'] == "CEREAL AND FLOURS"){ 
                                        echo "<p style='padding:4px; color:grey; cursor:context-menu; font-size:11px;'>".$key."</p>";
                                    }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background-color:white;">
                            <a data-toggle="collapse" href="#collapse2" style="text-decoration:none; color:black;">
                                <h6 class="panel-title">
                                    <b>Cooking</b> <span class="caret"></span> 
                                </h6>
                            </a>
                        </div>
                        <div id="collapse2" class="panel-collapse collapse">
                            <div class="panel-body">
                                <?php 
                                foreach($json as $key => $val){
                                    if($json[$key][0]['SECTION'] == "COOKINGSECTION"){ 
                                        echo "<p style='padding:4px; color:grey; cursor:context-menu; font-size:11px;'>".$key."</p>";
                                    }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background-color:white;">
                            <a data-toggle="collapse" href="#collapse3" style="text-decoration:none; color:black;">
                                <h6 class="panel-title">
                                    <b>Vegetables</b> <span class="caret"></span> 
                                </h6>
                            </a>
                        </div>
                        <div id="collapse3" class="panel-collapse collapse">
                            <div class="panel-body">
                                <?php 
                                foreach($json as $key => $val){
                                    if($json[$key][0]['SECTION'] == "VEGETABLE" || $json[$key][0]['SECTION'] == "DAIRY"){ 
                                        echo "<p style='padding:4px; color:grey; cursor:context-menu; font-size:11px;'>".$key."</p>";
                                    }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background-color:white;">
                            <a data-toggle="collapse" href="#collapse4" style="text-decoration:none; color:black;">
                                <h6 class="panel-title">
                                    <b> Meat</b> <span class="caret"></span> 
                                </h6>
                            </a>
                        </div>
                        <div id="collapse4" class="panel-collapse collapse">
                            <div class="panel-body">
                                <?php 
                                foreach($json as $key => $val){
                                    if($json[$key][0]['SECTION'] == "MEAT"){ 
                                        echo "<p style='padding:4px; color:grey; cursor:context-menu; font-size:11px;'>".$key."</p>";
                                    }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <div class="container-fluid text-center" id="cook_dir">

            </div>

            <div class="text-center">   
                <h3>Our Other Dishes</h3>
                <?php
                for($i=0; $i<3; $i++){
                    $queryo = mysqli_query($con, "SELECT * from admin_recipee where recipe_name1 = '$other_dish[$i]' and availability = 'Available'");
if(mysqli_num_rows($queryo)>0){
                    $rowo = mysqli_fetch_array($queryo);
                    if($other_dish[$i] != NULL){
                        echo "<div class='col-sm-4'>";
                        echo "<a href='productpage.php?recipe_name1=".$rowo['recipe_name1']."' style='text-decoration:none;color:black;'><img src='groctaurantretail.com/admin/zxy321/".$rowo['image_dir1']."' width='100%' height='200px;'>";
                        echo "<p class='recname' style='padding:10px;'> ".$rowo['recipe_name1']."</p></a>";
                        echo "</div>";
                    }
                } } ?>
            </div>
            <br><br><br>
        </div>
        <div class="col-sm-4" id="fixx"><br>
            <div style="background-color:white; padding:20px;">
                <h1 class="rec_name"><?php echo $recipe; ?></h1>
                <p style="font-size:13px;">By <?php echo $by; ?></p>
                <br>
                <div class="row">
                    <a id="ingredients" style="cursor:pointer; text-decoration:none">
                        <div class="col-sm-6 text-center" style="background-color: #606060; padding-top:6px; box-shadow: 1px 1px 5px rgba(0,0,0,0.46)">
                            <p style="color:white; font-size:14px;">Ingredients</p>
                        </div>
                    </a>
                    <a id="cookdirec" style="cursor:pointer; text-decoration:none">
                        <div class="col-sm-6 text-center" style="background-color: #a3715e; padding-top:6px; box-shadow: 1px 1px 5px rgba(0,0,0,0.46)">
                            <p style="color:white; font-size:14px;">Cooking Directions</p>
                        </div>
                    </a>
                </div>
                <div class="col-sm-1 col-sm-offset-4 text-center">
                    <img src="images/play-button.png" data-toggle="modal" data-target="#video" width="85px;" style="margin-top:-71px; cursor:pointer;">
                </div>
                <br><br>
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-2 text-center">
                        <img src="images/watch.png" width="34px">
                        <p style="font-size:14px; margin-top:7px;"><?php echo $time; ?> mins</p>
                    </div>
                    <div class="col-sm-4 text-center">
                        <p style="font-size:11px;">Difficulty:</p>
                        <?php
                        if($diff==1){
                             echo "<img src='images/DIFFICULTY-1.png' width='100px' style='margin-top:-20px'>";
                        } else if($diff==2){
                             echo "<img src='images/DIFFICULTY-2.png' width='100px' style='margin-top:-20px'>";
                        } else{
                             echo "<img src='images/DIFFICULTY-3.png' width='100px' style='margin-top:-20px'>";
                        }
                        ?>
                    </div>
                </div>
					<div class="col-sm-4 col-sm-offset-4"><button class="btn btn-block cook_dir_toggle" value="hindi" style="background-color:#778899; color:white;">Hindi</button></div>
<br><br>
                <p style="font-size:13px;">Utensils: <?php echo $utensils; ?></p>
                <p style="font-size:13px;">Cuisine: <?php echo $cuisine; ?></p>
                <div class="row text-center"><br>
                    <div class="col-sm-8">
                        <span style="float:left; font-size:10px; color:grey"><b>Select your servings</b></span>
                        <select class="form-control serving">
                            <?php 
                            $sql1=mysqli_query($con,"SELECT * from admin_recipeservings where name='$recipe'");
                            while($row1=mysqli_fetch_array($sql1)){
                                echo "<option value='".$row1['price'].",".$row1['servings'].",".$id."'>".$row1['servings']." Serving(s)</option>";
                            } ?>
                        </select> 
                    </div>
                    <div class="col-sm-4">
                        <?php 
                        $sql2 = mysqli_query($con,"SELECT MIN(id),name,servings,price from admin_recipeservings where name='".$recipe."' GROUP BY name ");
                        while($row2 = mysqli_fetch_array($sql2)){
                            $price = $row2['price'];
                            $serving = $row2['servings'];
                        } ?>
                        <p class="serv_price" style="font-size:28px;  font-family: 'Josefin Slab', serif; font-weight:bold; color:green; padding:2px; margin-top:8px;">₹<?php echo $price; ?></p>
                    </div>
                </div>
                <br>
                <div class="checkout">
                 <?php if($avail=='Available'){?>
                    <button class="btn btn-block addToCart" value="<?php echo $id ?>,<?php echo $serving; ?>" style="color:white; font-size:20px; background-color: #C70039; padding:8px; font-weight:bold; border-radius:0; margin-top:-12px;">Add To Cart</button>
<?php } else { ?>
<h2 style="color:red; margin-top:-16px;"><b><center>Out Of Stock</b></center></h2>
<?php } ?>
                </div>
            </div>
            <br>
            <div class="accomp">   
                <h3><center>Accompanients</center></h3>
                <br>
                <?php
                for($i=0; $i<3; $i++){
                    $querya = mysqli_query($con, "SELECT * from admin_recipee where recipe_name1 = '$accomp[$i]' and availability = 'Available'");
if(mysqli_num_rows($querya)>0){
                    $rowa = mysqli_fetch_array($querya);
                    $ida = $rowa['id'];
                    if($accomp[$i] != NULL){
                        echo "<div class='col-sm-4'>";
                        echo "<img src='groctaurantretail.com/admin/zxy321/".$rowa['image_dir1']."' width='100%' height='100px'>";
                        $sqla2 = mysqli_query($con,"SELECT MIN(id),name,servings,price from admin_recipeservings where name='$accomp[$i]' GROUP BY name ");
                        while($rowa2 = mysqli_fetch_array($sqla2)){
                            $pricea = $rowa2['price'];
                            $servinga = $rowa2['servings'];
                        }
                        // echo "<div class='checkbox' style='min-height:20px;'><label class='recname1'><input type='checkbox' class='checkaccomp' value='".$ida.",".$servinga."'>".$rowa['recipe_name1']."</label>";
                        echo "<div style='min-height:30px; margin-top:8px;'><label class='recname1'>".$rowa['recipe_name1']."</label>";
                        echo "</div>";
                        echo "<select class='form-control servingaccomp recname' style='margin-bottom:8px;'>";
                        $sqla1=mysqli_query($con,"SELECT * from admin_recipeservings where name='$accomp[$i]'");
                        while($rowa1=mysqli_fetch_array($sqla1)){
                            echo "<option value='".$rowa1['price'].",".$rowa1['servings'].",".$ida."'>".$rowa1['servings']." serv</option>";
                        }
                        echo "</select>";
                        echo "<center><span class='recname2' style='padding:4px;'> ₹".$pricea."</span><button class='btn checkaccomp' type='button' value='".$ida.",".$servinga."' style='background-color:#C70039; color:white; padding: 2px 8px;'>+</button></center>";
                        echo "</div>";
                    }
                } } ?>
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
    $(".panel-body").each(function(){
        if(!$(this).text().trim()){
            $(this).parent().parent().parent().hide();
        }
    });
    var rec = $(".rec_name").text();
    $.ajax({
        type: "POST",
        url: "cookdirfetch.php",
        data:{lang: "english", rec: rec},
        success: function(data){
            $("#cook_dir").html(data);
        }
    });
    $(document).on( "click", ".cook_dir_toggle", function (e){
        var tag = $(this);
        var value = $(this).val();
        $.ajax({
            type: "POST",
            url: "cookdirfetch.php",
            data:{lang: value, rec: rec},
            success: function(data){
                $("#cook_dir").html(data);
                if(value == "english"){
                    tag.val("hindi");
                    tag.text("Hindi");
                } else {
                    tag.val("english");
                    tag.text("English");
                }
            }
        });
    });

    $(document).on('change', '.serving', function(){
        var value1 = $(this).val();
        var value = value1.split(",");
        $(".serv_price").html('₹'+value[0]);
        $(".addToCart").val(value[2]+','+value[1]);
    });

    $(document).on('click', '.addToCart', function(){
        var tag = $(this);
        var id1 = $(this).val();
        var id = id1.split(",");
        var ida = id[0];
        var idb = id[1];
        //console.log(ida+" "+idb);
        var action = "addToCart";
        tag.html("adding..");
        $.ajax({
            type: "GET",
            url: "cartAction.php",
            data:{action: action, id: ida, serving: idb},
            success: function(data){
                tag.parent().html("<a href='cart.php' class='btn btn-block' style='color:white; font-size:20px; background-color: #C70039; padding:8px; font-weight:bold; border-radius:0; margin-top:-12px;'>Proceed To Checkout</a>");
                //console.log(data);
            }
        });
    });
    $(window).on('scroll', function() {
        var scroll = $(this).scrollTop();
        var scroll3 = scroll + $("#fixx").height()+50;
        var scroll2 = $("#navbar").height()+40; 
        var scroll4 = $("#footer").offset().top-80;
        var scroll5 = $("#left_frame").offset().top + 20;
        if(scroll3>scroll4){
            $("#fixx").css({position: 'absolute', top: scroll4-$("#fixx").height()});
        } else if((scroll + scroll2) > scroll5) {
            $("#fixx").css({position: 'fixed', top: scroll2});
        } else {
            $("#fixx").css({position: 'absolute', top: scroll2});
        }
    });

    $(document).on('change', '.servingaccomp', function(){
        var value1 = $(this).val();
        var value = value1.split(",");
        $(this).next().find("span").html('₹'+value[0]);
        $(this).next().find(".checkaccomp").val(value[2]+','+value[1]);
    });

    $(document).on("click", ".checkaccomp", function(){
	var tag = $(this).parent().parent();
	var id1 = $(this).val();
	var id = id1.split(",");
	var ida = id[0];
	var idb = id[1];
	var action = "addToCart";
	$.ajax({
	    type: "GET",
	    url: "cartAction.php",
	    data:{action: action, id: ida, serving: idb},
	    success: function(data){
	        tag.attr("title","Item Added To Cart!").attr('data-toggle', 'tooltip').tooltip({
	                trigger: 'manual'
	            }).tooltip('show');  
	        setTimeout(function(){
	            tag.tooltip('hide');
	        }, 2000);
	        //console.log(data);
	    }
	});
    });
});
</script>
<script>
$("#video").on('hidden.bs.modal', function (e) {
    $("#video iframe").attr("src", $("#video iframe").attr("src"));
});
</script>
<script>
$("#ingredients").click(function() {
    $('html,body').animate({
        scrollTop: $(".ingrdiv").offset().top - 65},
        'slow');
});

$("#cookdirec").click(function() {
    $('html,body').animate({
        scrollTop: $("#cook_dir").offset().top - 65},
        'slow');
});
</script>
<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("gal");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
     dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
  }
  x[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " w3-opacity-off";
}
</script>
</body>
</html>