<?php
session_start();
include 'config.php';
if(isset($_COOKIE['login_user']) && isset($_COOKIE['login_phone'])){
include 'session.php';
}
else{header('location: index.php');}
$flag=0;
if(isset($_SESSION['login_user']) && isset($_SESSION['login_phone'])){
$flag=1;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>My Profile</title>
<link rel="shortcut icon" type="image/png" href="images/GR111.png"/>
  <meta charset="utf-8">
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Bubblegum Sans' rel='stylesheet'>
  
<style>

nav{font-family: 'Josefin sans', sans-serif; }
        
        .btnpp{color:grey; font-family: 'Questrial', sans-serif; letter-spacing:1px; font-weight:700;}
        
        .btnpp:hover{text-decoration:none; color:grey;}
        
        	.recname{font-size: 15px;font-family: 'Questrial', sans-serif; letter-spacing:1px;font-weight:bold; }
		 
		 .recname1{font-size: 12px;font-family: 'Questrial', sans-serif; letter-spacing:1px;font-weight:bold;}
		 
		 .recname2{font-size: 18px;font-family: 'Questrial', sans-serif; letter-spacing:1px;font-weight:bold;}

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
                    <?php if($flag==1){ ?>
                    <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
                    <li class="login"><a href="myprofile.php" style="cursor: pointer; border-bottom:2px solid #c70039; color:black;"><span class="glyphicon glyphicon-user"></span><span class="hidden-xs login_session"> <?php echo $login_session;?></span></a></li>
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

<div class="container" style="margin-top:50px;">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-1">
<?php
include 'config.php';
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
<br><br>
<form method="post" action="myprofile1.php" enctype="multipart/form-data">
<?php if($image==NULL){?>
<input type="file" class="image_upload" name="image" style="display:none;"><img src="images/noimg.png" class="img-circle" width="200px"  height="190px" ><span><button type="button" class="btn btn-link btn_image" style="text-decoration:none;">Edit</button></span>
<?php } else {?>
<input type="file" class="image_upload" name="image" style="display:none;"><img src="<?php echo $image; ?>" class="img-circle" width="200px"  height="190px" ><span><button type="button" class="btn btn-link btn_image" style="text-decoration:none;">Edit</button></span>
<?php } ?><input type='submit' value='UPDATE' name='submit' class='btn btn-link btn_image1' style='text-decoration:none;' hidden="hidden"></form>
<br><br><input type="text" class="input_name" value="<?php echo $login_session;?>" style="padding:12px 20px;" disabled><span><button class="btn btn-link btn_name" style="text-decoration:none;">Edit</button></span>
<br><br><input type="text" class="cus_phone" value="<?php echo $phone; ?>" style="padding:12px 20px;" disabled>
<br><br><input type="text" class="input_email" value="<?php echo $email; ?>" style="padding:12px 20px;" disabled>
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
<br><br><br>
<p class='recname'>Share your referral code via:</p>
<div class="g-plus" data-action="share" data-href="http://www.groctaurant.com/signup.php?referral_code=<?php echo $ref; ?>"></div>
<br><iframe src="https://www.facebook.com/plugins/share_button.php?href=http%3A%2F%2Fwww.groctaurant.com/signup.php?referral_code=<?php echo $ref; ?>&layout=button&size=small&mobile_iframe=true&width=100&height=20&appId" width="100px" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.10&appId=1081928541944300";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-send" data-href="http%3A%2F%2Fwww.groctaurant.com/signup.php?referral_code=<?php echo $ref; ?>"></div>
</div>
<?php } ?>
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
                //console.log(data);
                    $('#old_password').on('input', function(){
                        var val = $(this).val();
                        if(val == data){
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
                //console.log(data);
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
