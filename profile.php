<?php

   include 'config.php';
   session_start();
   if(isset($_SESSION['login_user']) && isset($_SESSION['login_phone'])){
      header('location: home.php');
      die();
  }
  if(!isset($_POST['phone'])){
      header('location: signup.php');
      die();
  } else {
      $phone = $_POST['phone'];
      $referral_code = $_POST['referral_code'];
  } 
?>
<!DOCTYPE html>

<html lang="en">

<head>
    
  <link rel="icon" href="images/GR111.png" type="image/gif">
  <title>GROCTAURANT</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
  
<style>
 

.nav{
background-color:white;
}

.menu{font-family: 'Open Sans Condensed', sans-serif; font-size:18px; font-weight:bold}

.dr:hover{color:white;}

footer{font-family: 'Open Sans Condensed', sans-serif; font-weight:bold}

.navbar .navbar-nav {
    display: inline-block;
    float: none;
}

.navbar .navbar-collapse {
    text-align: center;
}

.divider{
    position:absolute;
    left:50%;
    top:30%;
    bottom:4%;
    border-left:1px solid black;
}

.formss,p{font-family: 'Open Sans Condensed', sans-serif; font-weight:bold;}

  .iaf:hover{color:dodgerblue;}
  .iai:hover{color:#FF5733;}
  
  .fhr{
     height: 12px;
    border: 0;
    box-shadow: inset 0 12px 12px -12px rgba(0, 0, 0, 0.5);
  }

</style>
  
<body>
<!-- - - - - - - - - - - - - - - - - - -->
<div class="container" id="signup">
    <div class="col-sm-6 col-sm-offset-3">
        <br><br><br>
        <p style="font-family: font-family: 'Open Sans Condensed', sans-serif; color:black; text-align:center; font-size:30px;">Sign Up</p><br>
        <form class="formss" action="signup_1.php" method="POST" enctype="multipart/form-data">
            <br><center><input type="file" name="image"><img src="" width="200px" height="200px"></center>
            <br><input type="text" name="name" class="form-control" placeholder="Full Name" required>
            <br><input type="email" class="form-control" id="email" name="email" placeholder="Email" required><span id="emailspan"></span>
            <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>" style="display:none;">
            <br><input type="password" class="form-control" name="password" placeholder="Password" required>
            <br><input type="text" class="form-control" id="referral" name="referral" placeholder="Enter Referral Code" value="<?php echo $referral_code; ?>">
            <br><center><input type="submit" class="btn" id='send' name='submit' value="Complete" style="background-color:#C70039; padding:10px; color:white; letter-spacing:2px;" ></center>
        </form>
                <p style="font-size:14px; padding:16px; float:right">Already a user?<b> <a href="index.php" style="cursor:pointer; color:blue">Login</a></b></p>
    </div>
</div>

<!-- -footer- -->

<script type="text/javascript">
$(document).ready(function(){
    $("#referral").on('keyup', function () {      
        var val = this.value;
        if(val.length == 9 || val.length == 5){
            $.ajax({        
                type: "POST",       
                url: "getreferral.php",     
                data:'code='+val,     
                success: function(data){        
                    //console.log(data);
                    if(parseInt(data) == 1){
                        $("#referral").css("border", "1px solid green");
                        $("#send").removeAttr("disabled");
                    } else {
                        $("#referral").css("border", "1px solid red");
                        $("#send").attr("disabled", "true");
                    }
                }       
            });
        } else if(val.length == 0){
            $("#referral").css("border", "");
            $("#send").removeAttr("disabled");
        } else{
            $("#referral").css("border", "1px solid red");
            $("#send").attr("disabled", "true");
        } 
    });
    
    $("#email").on('focusout', function () {      
        var val = this.value;
        if(val.length > 0){
            $.ajax({        
                type: "POST",       
                url: "getemail.php",     
                data:'email='+val,     
                success: function(data){        
                    //console.log(data);
                    if(parseInt(data) == 0){
                        $("#email").css("border", "1px solid green");
                        $("#send").removeAttr("disabled");
                        $("#emailspan").css("color", "green");
                        $("#emailspan").html("");
                    } else {
                        $("#email").css("border", "1px solid red");
                        $("#send").attr("disabled", "true");
                        $("#emailspan").css("color", "red");
                        $("#emailspan").html("! Already Registered");
                    }
                }       
            });
        } else if(val.length == 0){
            $("#email").css("border", "");
            $("#send").removeAttr("disabled");
            $("#emailspan").html("");
        } else{
            $("#email").css("border", "1px solid red");
            $("#send").attr("disabled", "true");
            $("#emailspan").html("");
        } 
    });
    
    $("#email").on('focusin', function () {  
    	$("#email").css("border", ""); 
    	$("#send").attr("disabled", "true");   
        $("#emailspan").html("");
    });
    
    $(":file").change(function() {
        var tag =$(this);
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                tag.next().attr('src', e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
        } else {
                tag.next().attr('src', "");
        }
    });
});
</script>
</body>
</html>  
