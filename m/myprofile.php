<?php
session_start();
include 'config.php';
if(isset($_COOKIE['login_user']) && isset($_COOKIE['login_phone'])){
include 'session.php';
}
else{header('location: home.php');}
$flag=0;
if(isset($_SESSION['login_user']) && isset($_SESSION['login_phone'])){
$flag=1;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
  <link rel="icon" href="http://www.groctaurant.com/images/GR111.png" type="image/gif">
  <title>GROCTAURANT</title>
  <meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    
</head>
  
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

#men{font-family: 'Montserrat', sans-serif;}
</style>
  
<body>

<div class="w3-top">
<div class="w3-bar w3-border-0 w3-black">
  <a href="#" class="w3-bar-item w3-button w3-padding-small"><span style="font-size:19px; cursor:pointer; text-decoration:none; margin-left:8px;" onclick="openNav()">&#9776;</span></a>
  <a href="cart.php" class="w3-bar-item w3-right w3-padding-small" style="margin-right:-10px; text-decoration:none;"><i class="material-icons" style="margin-right:15px; margin-top:5px; font-size:18px;">shopping_cart</i></a>
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

<div class="container" style="margin-top:50px;">
<?php
$sql=mysqli_query($con,"SELECT * from web_customers where phone='$login_session1' ");
while($row=mysqli_fetch_array($sql)){
$phone=$row['phone']; 
$email=$row['email']; 
$wallet=$row['wallet']; 
$ref=$row['referral_code']; 
$em=$row['earned_money']; 
$image=$row['image'];
$sql11=mysqli_query($con,"SELECT * from web_customers where applied_code='$ref' ");
$refcount=mysqli_num_rows($sql11);
?>
<br> 
<form method="post" action="myprofile1.php" enctype="multipart/form-data">
<?php if($image==NULL){?>
<input type="file" class="image_upload" name="image" style="display:none;"><img src="http://www.groctaurant.com/images/noimg.png" class="img-circle" width="200px"  height="190px" ><span><button type="button" class="btn btn-link btn_image" style="text-decoration:none;">Edit</button></span>
<?php } else {?>
<input type="file" class="image_upload" name="image" style="display:none;"><img src="<?php echo "http://www.groctaurant.com/".$image; ?>" class="img-circle" width="200px"  height="190px" ><span><button type="button" class="btn btn-link btn_image" style="text-decoration:none;">Edit</button></span>
<?php } ?><input type='submit' value='UPDATE' name='submit' class='btn btn-link btn_image1' style='text-decoration:none;' hidden="hidden"></form>
<br><br><input type="text" class="input_name" value="<?php echo $login_session;?>" style="padding:12px 20px;" disabled><span><button class="btn btn-link btn_name" style="text-decoration:none;">Edit</button></span>
<br><br><input type="text" class="cus_phone" value="<?php echo $phone; ?>" style="padding:12px 20px;" disabled>
<br><br><input type="email" class="input_email" value="<?php echo $email; ?>" style="padding:12px 20px;" disabled>
<span class="email_verify_status">
<?php if($row['request_status'] == 1){ ?>
<button class="btn btn-link btn_email" style="text-decoration:none;">Edit</button> | Verification link has been sent.
<?php } else if($row['verify_status'] == 0) { ?>
<button class="btn btn-link btn_email" style="text-decoration:none;">Edit</button> | <button class="btn btn-link btn_email_verify" style="text-decoration:none;">Verify Now!</button>
<?php } else { ?>
<button class="btn btn-link btn_email" style="text-decoration:none;">Edit</button> | Verified
<?php } ?>
</span>
<br><br><button class="btn btn-default" data-toggle="modal" data-target="#myModal">Change Password</button>
</div>
<div class="col-sm-5" style="margin-top:80px">
<p class="recname2">Wallet: ₹<?php echo $wallet-$em; ?> <a class="recharge_btn" style="font-size:18px; font-family: 'Josefin Sans', sans-serif; color:blue; text-decoration:underline; cursor:pointer;">Recharge</a></p>
<p class="recname2">Referral Code: <?php echo $ref; ?></p>
<p class="recname2">Referral Count: <?php echo $refcount; ?></p>
<p class="recname2">Earned Money: ₹<?php echo $em; ?></p>

<a href="myorders.php" target="_blank" class="w3-btn w3-red w3-round-large" style="text-decoration:none;">My Orders</a>
<br><br>
<p class='recname'>Share your referral code via:</p>
<a href="whatsapp://send?text=http://m.groctaurant.com/signup.php?referral_code=<?php echo $ref; ?>" data-action="share/whatsapp/share"><i class="fa fa-whatsapp fa-2x" style="color:green;"></i></a><br>
<div class="container text-center" style="margin-bottom:65px;">
<div class="g-plus" data-action="share" data-href="https://m.groctaurant.in/main/signup.php?referral_code=<?php echo $ref; ?>"></div>

<iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fm.groctaurant.com/main/signup.php?referral_code=<?php echo $ref; ?>&layout=button&size=small&mobile_iframe=true&width=59&height=20&appId" width="59" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.10&appId=1081928541944300";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-send" data-href="https://m.groctaurant.com/main/signup.php?referral_code=<?php echo $ref; ?>"></div>

</div>
<?php } ?>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title"><center>Change Password</center></h3>
            </div>
            <div class="modal-body"><br>
                <form class="form-horizontal" action="newpassword.php" method="POST">
                    <div class="form-group">
                        <label class="control-label col-sm-4">Old Password:</label>
                        <div class="col-sm-7">
                            <input type="password" id="old_password" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">New Password:</label>
                        <div class="col-sm-7">
                            <input type="password" id="password" class="form-control" name="new_password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Confirm Password:</label>
                        <div class="col-sm-7">
                            <input type="password" id="confirm_password" class="form-control" required>
                        </div>
                    </div>
                    <center><button type="submit" name="submit" id="btnsub" class="btn btn-success"  style="padding:6px 15px; letter-spacing:0.8px;" disabled>Submit</button></center>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    	$(document).ready(function(){
        $.ajax({
                type : "post",
                url : "mypassword.php",
                data : 'data='+$(".cus_phone").val(),
                success : function(data){
                    $('#old_password').on('input', function(){
                        var val = $(this).val();
                        if(val.trim() == data.trim()){
                            $('#old_password').css('border', '3px solid green');
                            $('#btnsub').removeAttr('disabled');
                        } else {
                            $('#old_password').css('border', '3px solid red');
                            $('#btnsub').attr('disabled','true');
                        }
                    });
                }
            });
            $('#password, #confirm_password').on('input', function () {
                if ($('#password').val() == $('#confirm_password').val()) {
                    $('#confirm_password').css('border', '3px solid green');
                    $('#btnsub').removeAttr('disabled');
                } else { 
                    $('#confirm_password').css('border', '3px solid red');
                    $('#btnsub').attr('disabled','true');
                }
            });
            
        $(document).on("click", ".btn_image", function(){
            $(".image_upload").click();
        });
        var image_src = $(".img-circle").attr("src");
        $(":file").change(function() {
            var tag =$(this);
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    tag.next().attr('src', e.target.result);
                };
                reader.readAsDataURL(this.files[0]);
                $(".btn_image1").attr("hidden", false);
            } else {
                    tag.next().attr('src', image_src);
                    $(".btn_image1").attr("hidden", true);
            }
        });
        $(document).on("click", ".btn_name", function(){
            $(this).text("UPDATE");
            $(this).removeClass("btn_name").addClass("btn_name1");
            $(".input_name").attr("disabled", false);
        });
    
        $(document).on("click", ".btn_name1", function(){
            var name = $(".input_name").val();
            //console.log(name);
            $.ajax({
                type: "post",
                url: "myprofile1.php",
                data : "name="+name,
                success : function(data){
                    $(".input_name").attr("disabled", true);
                    $(".btn_name1").text("Edit");
                    $(".btn_name1").removeClass("btn_name1").addClass("btn_name");
                    $(".login_session").text(data);
                    //console.log(data);
                }
            });
        });
        
        $(document).on("click", ".btn_email_verify", function(){
            var email = $(".input_email").val();
            $.ajax({
                type: "post",
                url: "verify_email1.php",
                data : "email="+email,
                success : function(data){
                    location.reload();
                if(parseInt(data) == 1){
                    $(".email_verify_status").html("Verification link has been sent");
                    }
                }
            });
        });
        
        $(document).on("click", ".btn_email", function(){
            $(".email_verify_status").html('<button class="btn btn-link btn_email1" style="text-decoration:none;">Update</button>');
            $(".input_email").attr("disabled", false);
        });
    
        $(document).on("click", ".btn_email1", function(){
            var email = $(".input_email").val();
            //console.log(name);
            $.ajax({
                type: "post",
                url: "myprofile1.php",
                data : "email="+email,
                success : function(data){
                    $(".input_email").attr("disabled", true);
                    $(".email_verify_status").html('<button class="btn btn-link btn_email" style="text-decoration:none;">Edit</button> | <button class="btn btn-link btn_email_verify" style="text-decoration:none;">Verify Now!</button>');
                }
            });
        });
        $(document).on("click", ".recharge_btn", function(){
            window.open("recharge/dataFrom.php","windowRecharge", "width=500,height=600,scrollbars=yes,resizable=yes,top=50,left=300");
        });
    });     
</script>
</body>
</html>  
