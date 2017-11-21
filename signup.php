<?php
$referral_code = "";
if(isset($_GET['referral_code'])){
    $referral_code = $_GET['referral_code'];
} ?>
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
  <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700" rel="stylesheet">
  <script type="text/javascript">
    if (window.screen.width < 980) {
   window.location = 'http://m.groctaurant.com/signup';
 }
</script>
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

<div class="container" id="signup">
    <div class="col-sm-6 col-sm-offset-3">
<br><br><br><p style="font-family: font-family: 'Open Sans Condensed', sans-serif; color:black; text-align:center; font-size:30px;">Sign Up</p><br>

<input type="number" id="phone" class="form-control" name="phone" placeholder="Phone" required><span class="label label-default number_label" style="padding:6px 10px; border-radius:40px; display:none;"></span>
<br><center><button data-toggle="modal" data-target="#myModal" class="btn" id='send' style="background-color:#C70039; padding:10px 20px; color:white;" disabled>Signup</button></center>

        <p style="font-size:14px; padding:16px; float:right">Already a user?<b> <a href="login.php" style="cursor:pointer; color:blue">Login</a></b></p>
        </div>
    </div>
    
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><center><b>OTP has been sent on your mobile number</b></center></h4>
            </div>
            <div class="modal-body modal_verify" style="padding:40px;">
                    <div class="form-group">
                        <label class="control-label col-sm-3">Enter OTP :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control otp" style="text-align: center;" required>
                        </div>
                    </div>
                    <br><center><button role="button" class="btn btn-success otp_verify" value="">VERIFY</button></center>
                    <a class="otpresend pull-right" style="cursor:pointer; text-decoration:none">Resend OTP</a>
                
            </div>
        </div>
    </div>
</div>
<div style="display:none;">
    <form method="post" action="profile.php" class="form">
        <input type="text" class="phoneform" value="" name="phone">
        <input type="text" value="<?php echo $referral_code; ?>" name="referral_code">
    </form>
</div>
<!-- -footer- -->

<script type="text/javascript">
$(document).ready(function(){
    $("#phone").on('input', function () {      
        var val = this.value;
        if(val.length == 10){
            $.ajax({        
                type: "POST",       
                url: "getnumber.php",     
                data:'number='+val,     
                success: function(data){        
                    console.log(data);
                    if(data == 1){
                        $("#phone").css("border", "1px solid green");
                        $("#send").removeAttr("disabled");
                        $(".number_label").hide();
                    } else {
                        $("#phone").css("border", "1px solid red");
                        $("#send").attr("disabled", "true");
                        $(".number_label").text("Already Registered!").show();
                    }
                }       
            });
        } else{
            $("#phone").css("border", "1px solid red");
            $("#send").attr("disabled", "true");
            $(".number_label").hide();
        } 
    });
    var otp = "";
    $(document).on('click', '#send', function(){
        var data = $("#phone").val();
        //$('.divsend').html('<button value="send" class="otpresend">Resend OTP</button><br><input type="number" name="otp" class="otp" min="100000" max="999999"><br><button class="otpverify">Verify OTP</button>');
        $.ajax({
            type : "post",
            url : "testotp1.php",
            data : 'data='+data,
            success : function(data){
                //console.log(data);
                otp = data;
        }
      });
    });
    $(document).on('click', '.otp_verify', function(){
        var otpc = $(".otp").val();
        var phone = $("#phone").val();
        if(otpc == otp){
            $(".modal_verify").html("<b>VERIFIED</b>");
            $(".phoneform").val(phone);
            setTimeout(function(){
                $(".form").submit();
            }, 1000);
        } else {
            $(".otp").val("Wrong OTP!!");
        }
    });
    $(document).on('click', '.otpresend', function(){
        var data = $("#phone").val();
        $(".otpresend").text("Sent!!");
        $(".otpresend").removeClass("otpresend");
        $.ajax({
            type : "post",
            url : "testotp1.php",
            data : 'data='+data,
            success : function(data){
             //console.log(data);
                otp = data;
        }
      });
    });
});
</script>
</body>
</html>  
