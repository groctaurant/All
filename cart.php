<?php
include 'config.php';
include 'cart1.php';
$cart = new Cart;
if(isset($_COOKIE['login_user']) && isset($_COOKIE['login_phone'])){
include 'session.php';
}
$flag=0;
if(isset($_SESSION['login_user']) && isset($_SESSION['login_phone'])){
$flag=1;
}
$queryd = mysqli_query($con,"SELECT discount FROM grret_discounts WHERE id = 1");
$rowd = mysqli_fetch_array($queryd,MYSQLI_ASSOC);
$discount = $rowd['discount'];
$queryde = mysqli_query($con,"SELECT * FROM grret_shopstat WHERE id = 1");
$rowde = mysqli_fetch_array($queryde,MYSQLI_ASSOC);
$deliver_now_bool = $rowde['deliver_now'];
date_default_timezone_set("Asia/Kolkata");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cart</title>
    <link rel="shortcut icon" type="image/png" href="images/GR111.png" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">

    <style type="text/css">
    nav{font-family: 'Josefin sans', sans-serif; }

        .removeCartItem{background-color:white;}

        .removeCartItem:hover{background-color:white;}
        
        div.address_select {
            overflow: auto;
            white-space: nowrap;
            max-width:80%;
        }

        div.address_select label {
            display: inline-block;
            text-decoration: none;
            margin-bottom:6px;
        }  
        		 .address_select::-webkit-scrollbar {
			height: 4px;
		 }
		 
		 .address_select::-webkit-scrollbar-track {
			-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
			border-radius: 80px;
		 }
		 
		 .address_select::-webkit-scrollbar-thumb {
		   	border-radius: 8px;
			-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
		 }
        
        #snackbar {
            visibility: hidden;
            min-width: 250px;
            margin-left: -125px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 2px;
            padding: 10px 20px;
            position: fixed;
            z-index: 1;
            left: 50%;
            top: 80px;
            font-size: 14px;
            letter-spacing: 1.8px;
        }

        #snackbar.show {
            visibility: visible;
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @-webkit-keyframes fadein {
            from {top: 0; opacity: 0;} 
            to {top: 80px; opacity: 1;}
        }

        @keyframes fadein {
            from {top: 0; opacity: 0;}
            to {top: 80px; opacity: 1;}
        }

        @-webkit-keyframes fadeout {
            from {top: 80px; opacity: 1;} 
            to {top: 0; opacity: 0;}
        }

        @keyframes fadeout {
            from {top: 80px; opacity: 1;}
            to {top: 0; opacity: 0;}
        }
        
        .right_frame{position:static;}
        #left_frame{position:absolute;}
        #map{height: 160px;}
        
        .btnpp{color:grey; font-family: 'Questrial', sans-serif; letter-spacing:1px; font-weight:700; font-size:14px;}
        
        .btnpp:hover{text-decoration:none; color:grey;}
        
        .btnminus{padding:1px 7px; background-color:white; text-align:center; border:1px solid grey;}
        
        .btnplus{padding:1px 5px; background-color:white; text-align:center; border:1px solid grey;}
        

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
                <li><a href="cart.php" style="border-bottom:2px solid #c70039"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
                    <li class="login"><a href="myprofile.php" style="cursor: pointer; color:black;"><span class="glyphicon glyphicon-user"></span><span class="hidden-xs login_session"> <?php echo $login_session;?></span></a></li>
                    <li class="login"><a href="logout.php" style="cursor: pointer; color:black;"><span class="glyphicon glyphicon-lock"></span><span class="hidden-xs"> Logout</span></a></li>
                <?php 
                } else { ?>
                    <li class="login"><a href="login.php" style="cursor: pointer; color:black;"><span class="glyphicon glyphicon-user"></span><span class="hidden-xs"> Login/Sign Up</span></a></li>
                <?php 
                } ?>
            </ul>
        </div>
    </div>
</nav>

<form method="POST" action="checkout.php">
    <div class="container">
        <div class="row" style="margin-top:70px;">
            <?php 
            if($cart->total_items() > 0 && $flag == 1){ ?>
                <div id="left_frame" class="col-sm-4" style="margin-top:30px;">
                    <div class="container-fluid" id="fetchdetails" style="border:1px solid lightgrey; padding:20px 40px ;">
                        
                    </div>
                </div>
                <div class="col-sm-7 col-sm-offset-5 right_frame">
            <?php 
            } else { ?>
                <div class="col-sm-8 col-sm-offset-2 right_frame">
            <?php 
            } ?>
                <div id="result">

                </div>
                <div class="container-fluid" style="margin:0px;">
                    <?php 
                    $delivery_start_time          = "10:00";
                    $delivery_start_time_today    = "09:00";
                    $delivery_end_time            = "09:00pm";
                    $delivery_end_time1           = "10:00pm";
                    $delivery_frequency           = 60;
                    $slotsx = 0;
                    if(date("H")>=date("H",strtotime($delivery_start_time_today)) && date("H")<date("H",strtotime($delivery_end_time))){
                        $today = strtotime("+2 hour");
                        for($j = $today; $j<= strtotime($delivery_end_time1); $j = $j + $delivery_frequency * 60){
                            $slots1[] = date("ha", $j);  
                        }
                    } else if(date("H")<date("H",strtotime($delivery_start_time_today))){
                        $today = strtotime($delivery_start_time);
                        for($j = $today; $j<= strtotime($delivery_end_time); $j = $j + $delivery_frequency * 60){
                            $slots1[] = date("ha", $j);  
                        }
                    } else {
                        $slotsx = 1;
                    }

                    for($i = strtotime($delivery_start_time); $i<= strtotime($delivery_end_time); $i = $i + $delivery_frequency * 60){
                        $slots[] = date("ha", $i);  
                    }

                    if(date("H")>=date("H",strtotime("00:00")) && date("H")<date("H",strtotime("10:00"))){
                        $x = date("ha", strtotime("10:00"));
                        $y = strtotime($x) + $delivery_frequency * 60;
                        $z = date("d-m-y");
                        $del_time_real_default = date("ymdH", strtotime("10:00")).date("is");
                        $delivery_expected = date("Y-m-d H", strtotime("10:00")).":".date("i:s");
                    } else if(date("H")>=date("H",strtotime("10:00pm"))) {
                        $x = date("ha", strtotime("10:00"));
                        $y = strtotime($x) + $delivery_frequency * 60;
                        $z = date("d-m-y", strtotime("+1 day"));
                        $del_time_real_default = date("ymd", strtotime("+1 day")).date("H", strtotime("10:00")).date("is");
                        $delivery_expected = date("Y-m-d", strtotime("+1 day"))." ".date("H", strtotime("10:00")).":".date("i:s");
                    } else {
                        $x = date("ha", strtotime("+1 hour"));
                        $y = strtotime($x) + $delivery_frequency * 60;
                        $z = date("d-m-y");
                        $del_time_real_default = date("ymdH", strtotime("+1 hour")).date("is");
                        $delivery_expected = date("Y-m-d H", strtotime("+1 hour")).":".date("i:s");
                    }
                    // echo date("H", strtotime("10:00pm"));
                    ?> 
                    <div id="bottom_right_frame">
                    <?php 
                    if($cart->total_items() > 0 && $flag == 1){
                        if(date("l")!="Tuesday"){ ?>
                           <div class="btn-group btn-group-justified" data-toggle="buttons">
                                <label class="btn btn-primary predisc collapsed"  data-toggle="collapse" data-target="#demo" style="font-size:12px; border-radius:0; padding: 10px 20px;">
                                    <input type="radio" name="delivery_time" required>Choose Pre-Order<span class="discount_percentage_btn" style="display:none;"><?php echo $discount; ?></span>
                                </label>
                                <?php if($deliver_now_bool){ ?>
                                <label class="btn btn-primary fixed_delivery" style="font-size:12px; border-radius:0; padding: 10px 20px;">
                                    <input type="radio" name="delivery_time" value="<?php echo ''.$z."/" . $x . "-".date("ha", $y).''; ?>,<?php echo $del_time_real_default; ?>,<?php echo $delivery_expected; ?>" required>Deliver Now: <?php echo $z."/" . $x . "-".date("ha", $y); ?>
                                </label>
                                <?php } ?>
                            </div>
                        <?php 
                        } else { ?>
                           <div class="text-center" data-toggle="buttons">
                                <p style="color:firebrick; font-size:13px;">*NO DELIVERIES ON TUESDAY, CHOOSE PRE-ORDER TIME*</p>
                                <label class="btn btn-primary predisc collapsed"  data-toggle="collapse" data-target="#demo" style="font-size:12px; border-radius:0; padding: 10px 20px;">
                                    <input type="radio" name="delivery_time" required>Choose Pre-Order<span class="discount_percentage_btn" style="display:none;"><?php echo $discount;?></span>
                                </label>
                            </div>
                        <?php
                        } 
                    }
                    ?>
                    </div>
                    <div id="demo" class="collapse">
                        <br>
                        <ul class="nav nav-tabs nav-justified">
                            <li class="active"><a data-toggle="tab" href="#home"><?php echo date("d M'y"); ?></a></li>
                            <li><a data-toggle="tab" href="#menu1"><?php echo date("d M'y", strtotime("+1 day")); ?></a></li>
                            <li><a data-toggle="tab" href="#menu2"><?php echo date("d M'y", strtotime("+2 day")); ?></a></li>
                        </ul>
                        <div class="tab-content" style="padding:10px;">
                            <div id="home" class="tab-pane fade in active">
                                <?php
                                if(date("l")!="Tuesday"){
                                    if($slotsx == 1){
                                        echo "No pre-orders for today";
                                    } else {
                                        echo '<div data-toggle="buttons" style="margin:10px;">';
                                        foreach($slots1 as $i => $start) {
                                            $finish_time = strtotime($start) + $delivery_frequency * 60; 
                                            echo "<label class='btn btn-default pre_order_delivery_time'><input class='pre_order_delivery_time1' name = 'pre_order_delivery_time' value='" .date("d-m-y")."/" . $start . "-".date("ha", $finish_time). ",".date("ymd").date("H", strtotime($start)).date("is").",".date("Y-m-d")." ".date("H", strtotime($start)).":".date("i:s")."' type='radio'>".$start . "-".date("ha", $finish_time). "</label>";
                                        }
                                        echo "</div>";
                                    }
                                } else {
                                    echo "<p class='text-center' style='font-size:16px; color:#696969; padding:20px;'><b>Closed on Tuesday</b></p>";
                                }
                                ?>
                            </div>
                            <div id="menu1" class="tab-pane fade"> 
                                <?php
                                if(date("l", strtotime("+1 day"))!="Tuesday"){
                                    echo '<div data-toggle="buttons">';
                                    foreach($slots as $i => $start) {
                                        $finish_time = strtotime($start) + $delivery_frequency * 60; 
                                        echo "<label class='btn btn-default pre_order_delivery_time'><input class='pre_order_delivery_time1' name = 'pre_order_delivery_time' value='" .date("d-m-y", strtotime("+1 day"))."/" . $start . "-".date("ha", $finish_time). ",".date("ymd", strtotime("+1 day")).date("H", strtotime($start)).date("is").",".date("Y-m-d", strtotime("+1 day"))." ".date("H", strtotime($start)).":".date("i:s")."' type='radio'>".$start . "-".date("ha", $finish_time). "</label>";
                                    }
                                    echo "</div>";
                                } else {
                                    echo "<p class='text-center' style='font-size:16px; color:#696969; padding:20px;'><b>Closed on Tuesday</b></p>";
                                }   
                                ?>
                            </div>
                            <div id="menu2" class="tab-pane fade">
                                
                                <?php           
                                if(date("l", strtotime("+2 day"))!="Tuesday"){
                                    echo '<div data-toggle="buttons">';
                                    foreach($slots as $i => $start) {
                                        $finish_time = strtotime($start) + $delivery_frequency * 60; 
                                        echo "<label class='btn btn-default pre_order_delivery_time'><input class='pre_order_delivery_time1' name = 'pre_order_delivery_time' value='" .date("d-m-y", strtotime("+2 day"))."/" . $start . "-".date("ha", $finish_time). ",".date("ymd", strtotime("+2 day")).date("H", strtotime($start)).date("is").",".date("Y-m-d", strtotime("+2 day"))." ".date("H", strtotime($start)).":".date("i:s")."' type='radio'>".$start . "-".date("ha", $finish_time). "</label>";
                                    }
                                    echo "</div>";
                                } else {
                                    echo "<p class='text-center' style='font-size:16px; color:#696969; padding:20px;'><b>Closed on Tuesday</b></p>";
                                }   
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div id="result1" class="col-sm-6">
                    
                    </div>
                    <?php 
                    if($cart->total_items() > 0 && $flag == 1){ ?>
                        <div class="col-sm-6" id="mid_bottom_frame">
                            <div class="pay_type" style="margin-top:10px;">
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default radio_last"  style="font-size:12px; border-radius:0; padding: 10px 20px;"><input type="radio" name="pay" value="Cash On Delivery">Cash On Delivery</label>

                                    <label class="btn btn-default radio_last"  style="font-size:12px; border-radius:0; padding: 10px 20px;"><input type="radio" name="pay" value="Online Payment">Online Payment</label>
                                </div>
                            </div>
                            <br>
                            <input type="submit" value="Checkout" name="submit" class="btn btn-success btn_checkout" style="border-radius:0; font-size:12px; padding:10px 113px;">
                        </div>
                    <?php 
                    } ?>
                </div>
            <?php 
            if($cart->total_items() > 0 && $flag == 1){ ?>
                </div>
            <?php 
            } else { ?>
                </div>
            <?php 
            } ?>
        </div>
    </div>
</form>    

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close modal_close" data-dismiss="modal">&times;</button>
                <center><span class="address_error text-center" style="color:red; font-size:11px; display:none;">*All fields are mandatory!!!</span></center>
                <div class="w3-container" style="padding:20px;">

                    <label style="font-size:12px; color:silver; font-weight:400;">Address Line 1</label><span style="color:red; font-size:10px;">*</span>
                    <input type="text" class="w3-input add1" name="add1" placeholder="House/Flat No." required style="margin-bottom:15px;">

                    <label style="font-size:12px; color:silver; font-weight:400;">Address Line 2</label><span style="color:red; font-size:10px;">*</span>

                    <input type="text" class="w3-input add2" name="add2" placeholder="Area/Sector" required style="margin-bottom:15px;">

                    <label style="font-size:12px; color:silver; font-weight:400;">Address Line 3</label><span style="color:red; font-size:10px;">*</span>

                    <input type="text" class="w3-input add3" name="add3" placeholder="City/State" required style="margin-bottom:15px;">

                    <label class="col-sm-4" style="font-size:12px; color:silver; font-weight:400;">Address Name<span style="color:red; font-size:10px;">*</span></label>

                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default btn_address" style="color:#696969; font-size:13px;">
                            <input type="radio" class="btn_addressx" value="Home">Home
                        </label>
                        <label class="btn btn-default btn_address" style="color:#696969; font-size:13px;">
                            <input type="radio" class="btn_addressx" value="Work">Work
                        </label>
                        <label class="btn btn-default btn_address" style="color:#696969; font-size:13px;">
                            <input type="radio" class="btn_addressx" value="Other">Other
                        </label>
                    </div>
                    <input type="text" name="tag" class="btn_address1" placeholder="Enter Address Name" style="border-top:0; border-left:0; border-right:0; width:100%; border-bottom:1px solid #696969; margin-top:10px; padding:8px; font-size:13px;" hidden /><br>
                    <br><center><label style="color:#696969; font-size:13px; font-weight:400; margin-top:0px; margin-bottom:0px;"><input type="checkbox" class="default_address" name="default_address" value="0"> Set As Default</label></center>
                </div>
            </div>
            <center><button type="button" class="btn btn-success add_address" style="border-radius:0; font-size:13px; padding:5px 20px;">ADD</button></center><br>
        </div>
    </div>
</div>
<div id="snackbar">Select pre-order time</div>
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
$(document).ready(function(){function t(){r=0,$(".category").each(function(){"Kitchen Protein"!=$(this).val()&&(r+=parseInt($(this).parent().find(".rec_price").val()))})}function e(){var t=parseInt($(".discount_percentage").val());$.ajax({type:"post",url:"cartfetch.php",data:"discount="+t,success:function(t){$("#result").html(t),a()}})}function a(){var e=parseInt($("#total_price").val());$.ajax({type:"post",url:"cartfetch1.php",data:"total_price="+e,success:function(e){$("#result1").html(e),n=parseInt($(".total_price").val()),s=parseInt($(".grcash").val()),o=parseInt($(".walletcashx").val()),d=parseInt($(".walletcash").val()),c(parseInt($("#final_amount").val())),t()}})}function c(t){$.isNumeric(t)?0!=t?($(".radio_last").removeClass("active"),$(".radio_last").children().prop("checked",!1),$(".radio_last").children().attr("required",!0),$(".radio_last").children().attr("disabled",!1),$(".pay_type").show(),$(".btn_checkout").val("Checkout")):($(".radio_last").children().prop("checked",!1),$(".radio_last").children().attr("required",!1),$(".radio_last").children().attr("disabled",!0),$(".pay_type").hide(),$(".btn_checkout").val("Place Order")):($(".right_frame").removeClass("col-sm-7").addClass("col-sm-8").addClass("col-sm-offset-2"),$("#left_frame").hide(),$("#mid_bottom_frame").hide(),$("#bottom_right_frame").hide())}$(document).on("click",".login_btn",function(){window.open("login.php","windowLogin","width=400,height=500,scrollbars=yes,resizable=yes,top=100,left=300")}),$(document).on("click",".recharge_btn",function(){window.open("recharge/dataFrom.php","windowRecharge","width=500,height=600,scrollbars=yes,resizable=yes,top=50,left=300")}),$(window).on("scroll",function(){var t=$(this).scrollTop(),e=t+$("#left_frame").height()+50,a=$("#navbar").height(),c=$(".right_frame").offset().top,r=$("#footer").offset().top-130;e>r?$("#left_frame").css({position:"absolute",top:r-$("#left_frame").height()}):t+a>c?$("#left_frame").css({position:"fixed",top:a}):$("#left_frame").css({position:"absolute",top:a+25})}),$("#result").load("cartfetch.php",function(){t()}),$("#fetchdetails").load("cartfetchdetails.php"),$(document).on("click",".btn_select_tag",function(){var t=$(this).children().val().split("|");$(".customer_address1").val(t[0]),$(".customer_address2").val(t[1]),$(".customer_address3").val(t[2])}),$(document).on("keypress",".click_address",function(){return!1}),$(document).on("click",".radio_last",function(){0==$(this).attr("disabled")&&("Cash On Delivery"==$(this).children().val()?($(".btn_checkout").val("Place Order"),$(".btn_checkout").show()):($(".btn_checkout").val("Checkout & Pay Online"),$(".btn_checkout").show()))}),$(document).on("click",".btnplus",function(){var t=$(this).val(),a=$("#"+t).val();a++,$.get("cartAction.php",{action:"updateCartItemplus",id:t,qty:a},function(t){"ok"==t&&e()})}),$(document).on("click",".btnminus",function(){var t=$(this).val(),a=$("#"+t).val();a--,$.get("cartAction.php",{action:"updateCartItemminus",id:t,qty:a},function(t){"ok"==t&&e()})}),$(document).on("click",".removeCartItem",function(){var t=$(this).val();$.ajax({type:"get",url:"cartAction.php",data:{action:"removeCartItem",id:t},success:function(t){e()}})}),$(document).on("click",".default_address",function(){this.checked?$(this).val("default"):$(this).val("0")}),$(document).on("click",".add_address",function(){var t=$(".add1").val(),e=$(".add2").val(),a=$(".add3").val(),c=$(".btn_address1").val(),r=$(".default_address").val();""!=t&&""!=e&&""!=a&&""!=c?$.ajax({type:"post",url:"newaddressadd.php",data:{add1:t,add2:e,add3:a,tag:c,default_address:r},success:function(t){$(".modal_close").click(),$("#fetchdetails").load("cartfetchdetails.php"),$(".address_error").hide(),$(".add1").val(""),$(".add2").val(""),$(".add3").val(""),$(".btn_address1").val(""),$(".default_address").prop("checked",!1)}}):$(".address_error").show()}),$(document).on("click",".btn_address",function(){var t=$(this).children().val();"Other"==t?($(".btn_address1").val(""),$(".btn_address1").show()):($(".btn_address1").hide(),$(".btn_address1").val(t))});var r=0;$(document).on("change",".pre_order_delivery_time",function(){var t=parseInt($(".sub_total").val()),e=parseInt($(".del_charges").val()),c=parseInt($(".discount_percentage_btn").text()),l=r*c/100,n=t-l,s=Math.round(2.5*n)/100,o=n+e+2*s-parseInt($(".new_cus_discount").val());$(".pre_order_discount_div").show(),$(".pre_order_discount").val(l),$(".gst").val(s),$("#total_price").val(Math.round(o)),$(".discount_percentage").val(c),a(),$(".pre_order_delivery_time").removeClass("active"),$(this).addClass("active")});var l=1;$(".fixed_delivery").on("click",function(){$(".pre_order_delivery_time").children().prop("checked",!1),$(".pre_order_delivery_time").removeClass("active"),$(".predisc").attr("data-target","#demo"),$(".pre_order_delivery_time1").attr("required",!1),l=0,$(".discount_percentage").val(0),e(),0==$(".predisc").hasClass("collapsed")&&($(".predisc").click(),l=1)}),$(document).on("click",".predisc",function(){"#demo"==$(this).attr("data-target")&&1==l&&($(this).attr("data-target",""),$(".pre_order_delivery_time1").attr("required",!0))});var n,s,o,d;$("#result1").load("cartfetch1.php",function(){n=parseInt($(".total_price").val()),s=parseInt($(".grcash").val()),o=parseInt($(".walletcashx").val()),d=parseInt($(".walletcash").val()),c(parseInt($("#final_amount").val()))}),$(document).on("click",".minus_amount",function(){$(".minus_amount")[0].checked&&$(".minus_amount")[1].checked?($(".grcash").val(s),$(".walletcash").val(d),$(".walletcash_label").text("₹"+d),$("#final_amount").val(n-s-d),$(".final_amount").text("₹"+(n-s-d)),c(n-s-d)):$(".minus_amount")[0].checked&&!$(".minus_amount")[1].checked?($(".grcash").val(s),$(".walletcash").val(0),$(".walletcash_label").text("₹"+d),$("#final_amount").val(n-s),$(".final_amount").text("₹"+(n-s)),c(n-s)):!$(".minus_amount")[0].checked&&$(".minus_amount")[1].checked?($(".grcash").val(0),$(".walletcash").val(o),$(".walletcash_label").text("₹"+o),$("#final_amount").val(n-o),$(".final_amount").text("₹"+(n-o)),c(n-o)):($(".grcash").val(0),$(".walletcash").val(o),$(".walletcash_label").text("₹"+o),$("#final_amount").val(n),$(".final_amount").text("₹"+n),c(n))}),$(".pre_order_delivery_time1").on("invalid",function(){var t=document.getElementById("snackbar");t.className="show",setTimeout(function(){t.className=t.className.replace("show","")},2e3)})});
</script>
</body> 
</html>