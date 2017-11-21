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

  $rec=$_GET['recipe_name1'];
  
  $sql=mysqli_query($con,"select * from admin_recipee where recipe_name1='".$rec."' ");
  
  
	  while($row=mysqli_fetch_array($sql)){	
	      $id=$row['id'];
		  $recipe=$row['recipe_name1'];
		  $sql1=mysqli_query($con,"select MIN(id),name,servings,price from admin_recipeservings where name='".$rec."' ");
		  while($row1=mysqli_fetch_array($sql1)){
		  $price=$row1['price'];
		  }
		  $desc=$row['description'];
		  $cuisine=$row['cuisine'];
		  $vegtag=$row['veg_tag'];
		  $time=$row['max_time'];
		  $diff=$row['difficulty'];
		  $utensils=$row['utensils'];
		  $image=$row['image_dir1']; 
		  $by=$row['recipe_by']; 
		  $video=$row['video_link'];
                  $avail = $row['availability'];
		  
		  $accomp = array($row['accomp1'], $row['accomp2'], $row['accomp3']);
      $other_dish = array($row['other_dish1'], $row['other_dish2'], $row['other_dish3']);
		  
		  ?>
<html>
<head>
	<title><?php echo $recipe; ?></title>
	   <link rel="shortcut icon" type="image/png" href="images/GR111.png"/>
    <meta charset="utf-8">
    <meta name="theme-color" content="#000000" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<style type="text/css">

#name-background{
  display: table-cell;
  vertical-align: bottom;
  bottom: -5px;
  width: 100%;
  height: 38%;
  background-image: linear-gradient(to top, rgba(0, 0, 0,0.85),rgba(0, 0, 0, 0.08));
}
#recipe_detail{
  position: absolute;
  bottom: 9px;
  left:9px;
}
#recipe_image{
  height: 200px;
  background-position: center;
  background-size: cover;
  color: white;
  overflow: hidden;
  background-image: url("http://groctaurantretail.com/admin/zxy321/<?php echo $image;?>");
}
#navbot{
  line-height: 1.2;
  margin:2px;
}

.btn-default{
background: none;
border:none;
color: white;
}
.btn.focus, .btn:focus, .btn:hover {
color: inherit;
}
.btn-bottom{
  border-radius: 0px; 
  padding: 10px;
  font-size: 15px;
}
#footer-1{
  -webkit-transition: .25s ease-in-out;
  -moz-transition: .25s ease-in-out;
  -o-transition: .25s ease-in-out;
  transition: .25s ease-in-out;
}

#footer-1.open{
  -webkit-transform: rotateX(90deg);
  -moz-transform: rotateX(90deg);
  -o-transform: rotateX(90deg);
  transform: rotateX(90deg);
}
#footer-2{
  -webkit-transform: rotateX(-90deg);
  -moz-transform: rotateX(-90deg);
  -o-transform: rotateX(-90deg);
  transform: rotateX(-90deg);
  -webkit-transition: .35s ease-in-out;
  -moz-transition: .35s ease-in-out;
  -o-transition: .35s ease-in-out;
  transition: .35s ease-in-out;
}
#footer-2.open{
  -webkit-transform: rotateX(0deg);
  -moz-transform: rotateX(0deg);
  -o-transform: rotateX(0deg);
  transform: rotateX(0deg);
}
.modal-open .modal {
    
    overflow: hidden;
}
.modal-body{
    max-height: 88vh; 
    padding-bottom: 34px;
    overflow-y: scroll;
}
#ingrd::first-letter { 
    font-size: 170%;
    color: #8A2BE2;
}

.cookdesc::first-letter{
    font-weight:bold;
    color:grey;
    font-size:18px;
}

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
	font-family: 'Montserrat', sans-serif;
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

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}

.recname{font-size: 14px; font-family: 'Questrial', sans-serif; letter-spacing:1px;font-weight:bold;}
.recname1{font-size: 13px; font-family: 'Questrial', sans-serif;}
img{object-fit:cover;}

</style>
</head>
<body>

<div class="w3-top">
<div class="w3-bar w3-black">
  <a href="#" class="w3-bar-item w3-button w3-padding-small"><span style="font-size:19px; cursor:pointer; text-decoration:none; margin-left:8px;" onclick="openNav()">&#9776;</span></a>
  <a href="cart.php" class="w3-bar-item w3-right w3-padding-small" style="margin-right:-10px; text-decoration:none;"><i class="material-icons" style="margin-right:15px; margin-top:5px; font-size:18px;">shopping_cart</i></a>
        <a href="whatsapp://send?text=http://m.groctaurant.com/ppage.php?recipe_name1=<?php echo rawurlencode(urlencode($recipe)); ?>" data-action="share/whatsapp/share" class="w3-bar-item w3-right w3-padding-small"><i class="material-icons" style="margin-top:5px; font-size:18px;">send</i></a>
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
<div onclick="closeNav()">
<div class="w3-display-container" id="recipe_image" style="margin-top:36px">
  <div class="w3-display-bottomleft w3-container" id="name-background">
    <div id="recipe_detail">
      <p style="font-size: 20px;font-family: 'Montserrat', sans-serif; padding-bottom:6px;" class="rec_name"><?php echo $recipe; ?></p>
      <p style="font-size: 12px;font-family: 'Josefin Sans', sans-serif;">By <?php echo $by; ?></p>
    </div>
  </div>
  <?php 
  if($vegtag==Veg){
	  echo "<div class='w3-display-bottomright w3-container' style='bottom: 11px; margin-right:-10;'><img src='http://groctaurant.com/images/veg.png' width='25px'></div>";
  }
  else{
   echo "<div class='w3-display-bottomright w3-container' style='bottom: 11px; margin-right:-10;'><img src='http://groctaurant.com/images/non.png' width='25px'></div>";
  }
  ?>
</div>


<div class="row text-center" style="margin: 0;font-family: 'Lato', sans-serif;">
  <div class="col-xs-6 ingrdi" style="color:white; background: #606060;padding: 6px;box-shadow: 1px 1px 5px rgba(0,0,0,0.46)">
    <p id="navbot">Ingredients</p>
  </div>
  <div class="col-xs-6 recbut" style="color:white;background: #a3715e;padding: 6px;box-shadow: 1px 1px 5px rgba(0,0,0,0.46)">
    <p id="navbot">Recipe Card</p>
</div>
</div>
<div class="row text-center" style="margin: 7px;font-size: 12px;">
  <div class="col-xs-4">
    <p>COOK TIME</p>
        <img src="http://groctaurant.com/images/watch.png" style="width:20px;"> <?php echo $time; ?> Mins
  </div>
  <div class="col-xs-4">
    <div style="position: relative;top:-60px">
  <img src="http://groctaurant.com/images/play-button.png" data-toggle="modal" data-target="#video" style="width: 80px">
</div>
  </div>
  <div class="col-xs-4">
    <p>DIFFICULTY</p>
    <?php
    if($diff==1){
         echo "<img src='http://groctaurant.com/images/DIFFICULTY-1.png' width='70px'>";
    }
    elseif($diff==2){
         echo "<img src='http://groctaurant.com/images/DIFFICULTY-2.png' width='70px'>";
    }
    else{
         echo "<img src='http://groctaurant.com/images/DIFFICULTY-3.png' width='70px'>";
    }
    ?>
   
  </div>
</div><br>
            <div class="container-fluid">
                    <span style="font-size:90px;line-height:0.6em;opacity:0.15;">❝</span>
                    <p class="w3-large text-justify" style="margin-top:-52px; padding:2px 30px; ">
                        <?php echo $desc; ?>
                    </p>
                    <span style="font-size:90px;line-height:0.1em;opacity:0.15;float:right">&#10078;</span>
                </div>
<div class="container-fluid" style="margin: 20px 0 18px;">
  <p style="font-size: 15px">UTENSILS</p>
  <p style="font-size: 13px"><?php echo $utensils; ?></p>
</div>

		  <div class="container-fluid accomp">   
		        <h4><center>Accompanients</center></h4>
                <br>
                <?php
                for($i=0; $i<3; $i++){
                    $querya = mysqli_query($con, "SELECT * from admin_recipee where recipe_name1 = '$accomp[$i]' and availability = 'Available'");
if(mysqli_num_rows($querya)>0){
                    $rowa = mysqli_fetch_array($querya);
                    $ida = $rowa['id'];
					    if($accomp[$i] != NULL){
                        echo "<div class='col-xs-4'>";
                        echo "<img src='http://groctaurantretail.com/admin/zxy321/".$rowa['image_dir1']."' width='100%' height='75px'>";
                        $sqla2 = mysqli_query($con,"SELECT MIN(id),name,servings,price from admin_recipeservings where name='$accomp[$i]' GROUP BY name ");
                        while($rowa2 = mysqli_fetch_array($sqla2)){
                            $pricea = $rowa2['price'];
                            $servinga = $rowa2['servings'];
                        }
                        echo "<div style='min-height:50px; margin-top:8px;'><label class='recname1 text-center'>".$rowa['recipe_name1']."</label>";
                        echo "</div>";
                        echo "<select class='form-control servingaccomp recname' style='margin-bottom:8px;'>";
                        $sqla1=mysqli_query($con,"SELECT * from admin_recipeservings where name='$accomp[$i]'");
                        while($rowa1=mysqli_fetch_array($sqla1)){
                            echo "<option value='".$rowa1['price'].",".$rowa1['servings'].",".$ida."'>".$rowa1['servings']."</option>";
                        }
                        echo "</select>";
                        echo "<center><span class='recname2' style='padding:4px;'> ₹".$pricea."</span><button class='btn checkaccomp' type='button' value='".$ida.",".$servinga."' style='background-color:#C70039; color:white; padding: 2px 8px;'>+</button></center>";
                        echo "</div>";
                    }
				} } ?>
            </div>
			<br>
         <div class="container ingrdiv">
    <h3><b>Ingredients</b></h3><br>
    <div class="panel-group">
  <div class="panel panel-default">
        <div class="panel-heading" style="background-color:white;">
             <a data-toggle="collapse" href="#collapse1" style="text-decoration:none; color:black;">
      <h6 class="panel-title">
       <b>Spices</b> <span class="caret"></span> 
      </h6></a>
    </div>
    <div id="collapse1" class="panel-collapse collapse in">
          <?php
                    $queryjs = mysqli_query($con, "SELECT * from grret_recipejson where recipe_name = '$rec'");
                    $rowjs = mysqli_fetch_array($queryjs);
                    $pathjs = $rowjs['json_path'];
                            $repath = explode("/",$pathjs);
                            $dataj = file_get_contents('http://groctaurantretail.com/json/'.rawurlencode($repath[1]));
                    $json = json_decode($dataj, TRUE);
                    ?>
      <div class="panel-body">
      <?php 
                        foreach($json as $key => $val){
                            if($json[$key][0]['SECTION'] == "SPICE" || $json[$key][0]['SECTION'] == "CEREAL & FLOURS" || $json[$key][0]['SECTION'] == "CEREAL AND FLOURS"){ 
                                echo "<p style='padding:4px; color:grey; cursor:context-menu; font-size:11px;'>".$key."</p>";
                            }
                        } ?></div>
    </div>
  </div>
</div>
    <div class="panel-group">
  <div class="panel panel-default">
    <div class="panel-heading" style="background-color:white;">
        <a data-toggle="collapse" href="#collapse2" style="text-decoration:none; color:black;">
      <h6 class="panel-title">
        <b>Cooking</b> <span class="caret"></span> 
      </h6></a>
    </div>
    <div id="collapse2" class="panel-collapse collapse">
      <div class="panel-body">
      <?php 
                      foreach($json as $key => $val){
                            if($json[$key][0]['SECTION'] == "COOKINGSECTION"){ 
                                echo "<p style='padding:4px; color:grey; cursor:context-menu; font-size:11px;'>".$key."</p>";
                            }
                        } ?></div>
    </div>
  </div>
</div>
    <div class="panel-group">
  <div class="panel panel-default">
    <div class="panel-heading" style="background-color:white;">
         <a data-toggle="collapse" href="#collapse3" style="text-decoration:none; color:black;">
      <h6 class="panel-title">
       <b>Vegetables</b> <span class="caret"></span> 
      </h6></a>
    </div>
    <div id="collapse3" class="panel-collapse collapse">
      <div class="panel-body">
       <?php 
                        foreach($json as $key => $val){
                            if($json[$key][0]['SECTION'] == "VEGETABLE" || $json[$key][0]['SECTION'] == "DAIRY"){ 
                                echo "<p style='padding:4px; color:grey; cursor:context-menu; font-size:11px;'>".$key."</p>";
                            }
                        } ?></div>
    </div>
  </div>
</div>
    <div class="panel-group">
  <div class="panel panel-default">
    <div class="panel-heading" style="background-color:white;">
        <a data-toggle="collapse" href="#collapse4" style="text-decoration:none; color:black;">
      <h6 class="panel-title">
       <b>Meat</b> <span class="caret"></span> 
      </h6></a>
    </div>
    <div id="collapse4" class="panel-collapse collapse">
      <div class="panel-body">
     <?php 
                        foreach($json as $key => $val){
                            if($json[$key][0]['SECTION'] == "MEAT"){ 
                                echo "<p style='padding:4px; color:grey; cursor:context-menu; font-size:11px;'>".$key."</p>";
                            }
                        } ?></div>
    </div>
  </div>
</div>
</div>
                <br>
<button class="btn btn-primary cook_dir_toggle pull-right" value="hindi" style="margin-right:6px;">Hindi</button>
    
	<div class="container-fluid text-center" id="cook_dir">
    </div>
	
<?php if($other_dish != NULL){ ?>
  <div class="container-fluid text-center" style="margin-left:-10px; margin-right:-10px;">   
        <h4><center>Other suggested dishes</center></h4>
		<br>
        <?php
        for($i=0; $i<3; $i++){
        $queryo = mysqli_query($con, "SELECT * from admin_recipee where recipe_name1 = '$other_dish[$i]'");
        $rowo = mysqli_fetch_array($queryo);
        echo "<div class='col-xs-4'>";
        echo "<a href='ppage.php?recipe_name1=".$rowo['recipe_name1']."' style='text-decoration:none;color:black;'><img src='http://groctaurantretail.com/admin/zxy321/".$rowo['image_dir1']."' width='100%' height='80vh;'>";
        echo "<p class='recname1 text-center' style='padding:10px;'> ".$rowo['recipe_name1']."</p></a>";
        echo "</div>";
        }
            ?>
    </div>
    <?php } ?>
			<br>
				<br><br>
               
<div class="modal modal-lg fade" id="video" role="dialog" >
    <div class="modal-dialog" style="top:10%">
        <div class="modal-content" style="background-color:rgba(0,0,0,0);">
            <div class="modal-body text-center">
            <button class="close btn" style="font-size:30px; color:white; margin-bottom:5px; margin-top: -15px; " data-dismiss="modal">&times;</button>
                			<?php if($video==NULL){?>
			<center><h2 style="color:white; padding:20px; margin-top:30px;">VIDEO NOT AVAILABLE</h2></center>
			<?php } else { ?>
                <iframe width="100%" src="<?php echo $video; ?>" frameborder="0" allowfullscreen></iframe>
				<?php } ?>
            </div>
        </div>
    </div>
</div>
</div>
<div class="navbar-fixed-bottom" style=" box-shadow: 0px 2px 12px 2px black;background:#f7941d;">
<?php if($avail=='Available'){?>
  <div class="btn-group btn-group-justified" id="footer-1">
    <div class="btn-group text-center btn-bottom">
        
		<select class="serving" style="padding: 0 4px;background: white;width: 100%;color: #cc6242;font-size: 14px">
                        <?php 
                            $sql1=mysqli_query($con,"SELECT * from admin_recipeservings where name='$recipe'");
                            while($row1=mysqli_fetch_array($sql1)){
                                echo "<option value='".$row1['price'].",".$row1['servings'].",".$id."'>".$row1['servings']."</option>";
                            }
                        ?>
        </select>
    </div>
	<?php 
                            $sql2 = mysqli_query($con,"SELECT MIN(id),name,servings,price from admin_recipeservings where name='".$recipe."' GROUP BY name ");
                                while($row2 = mysqli_fetch_array($sql2)){
                                    $price = $row2['price'];
                                    $serving = $row2['servings'];
                                }
                            ?>
      <a class="btn btn-bottom" style="background:#f7941d;color: white; font-weight:bold;">₹<?php echo $price; ?>/-</a>
    <div class="btn-group text-center ">  
     <button class="w3-btn w3-green w3-block w3-ripple add-to-cart addToCart" value="<?php echo $id ?>,<?php echo $serving; ?>" style="color:white; padding: 11px;font-size:15px;">Add To Cart</button>
    </div>  
  </div> 
<?php } else { ?>
<h6 style="color:red;"><b><center>OUT OF STOCK</b></center></h6>
<?php } ?> 
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
  </div></div>

	  <?php } ?>
	  
	  <script type="text/javascript">
  $(document).ready(function(){
    $(".add-to-cart").on("click",function(){
      $("#footer-1").addClass("open");
      $("#footer-2").addClass("open");
    });

  });
</script>
	  
	  
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
        $(this).parent().next().html('₹'+value[0]+'/-');
        $(this).parent().next().next().find("button").val(value[2]+','+value[1]);
    });

    $(document).on('click', '.addToCart', function(){
  
        var tag = $(this);
        var id1 = $(this).val();
        var id = id1.split(",");
        var ida = id[0];
        var idb = id[1];
  //      console.log(ida+" "+idb);
        var action = "addToCart";
        tag.html("");
        $.ajax({
            type: "GET",
            url: "cartAction.php",
            data:{action: action, id: ida, serving: idb},
            success: function(data){
                tag.html("+");
                var data = data.split("|");
                $('.cartitems').text(data[0]);
                $('.cartitems1').text(data[0]+' item(s)');
                $(".pricee").text("₹"+data[1]+"/-");
//                console.log(data);

            }
        });
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

function getVals(){
    // Get slider values
    var parent = this.parentNode;
    var slides = parent.getElementsByTagName("input");
    var slide1 = parseFloat( slides[0].value );
    var slide2 = parseFloat( slides[1].value );
    // Neither slider will clip the other, so make sure we determine which is larger
    if( slide1 > slide2 ){ var tmp = slide2; slide2 = slide1; slide1 = tmp; }
    var displayElement = parent.getElementsByClassName("rangeValues")[0];
    displayElement.innerHTML = slide1 + " - " + slide2;
}

window.onload = function(){
    // Initialize Sliders
    var sliderSections = document.getElementsByClassName("range-slider");
    //console.log(sliderSections.length);
    for( var x = 0; x < sliderSections.length; x++ ){
        var sliders = sliderSections[x].getElementsByTagName("input");
        //console.log(sliders.length);
        for( var y = 0; y < sliders.length; y++ ){
            if( sliders[y].type ==="range" ){
                sliders[y].oninput = getVals;
                // Manually trigger event first time to display values
                sliders[y].oninput();
            }
        }
    }
}
</script>
<script>
$("#video").on('hidden.bs.modal', function (e) {
    $("#video iframe").attr("src", $("#video iframe").attr("src"));
});
$(".recbut").click(function() {
    $('html,body').animate({
        scrollTop: $("#cook_dir").offset().top - 50},
        'slow');
});
$(".ingrdi").click(function() {
    $('html,body').animate({
        scrollTop: $(".ingrdiv").offset().top - 50},
        'slow');
});
</script>
</body>
</html>