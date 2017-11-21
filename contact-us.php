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

if(isset($_POST['submit']))
{
	$to = "info@groctaurant.com";
	$name = mysqli_real_escape_string($_POST["name"]);
	$phone = mysqli_real_escape_string($_POST["phone"]);
	$email = mysqli_real_escape_string($_POST["email"]);
	$message = mysqli_real_escape_string($_POST["message"]);
	$header = "From: " . $email;
	$mail = mail($to, $name, $message, $header);
	if(!$mail)
		echo "error";
	else
	{
		echo '
			<div class="alert alert-success alert-dismissible show" role="alert" style="margin-top:50px;">
				Your message has been sent successfully!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		';
	}
}
?>


<!DOCTYPE html>

<html lang="en">

<head>
  <link rel="shortcut icon" type="image/png" href="images/GR111.png"/>
  <title>Groctaurant</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Port+Lligat+Slab" rel="stylesheet">
</head>
  
<style>

nav{font-family: 'Josefin sans', sans-serif; }


	h2{font-size: 50px; font-family: 'Port Lligat Slab', serif; padding-top: 55px; }
	
	label, .btn{font-family: 'Josefin sans', sans-serif;}
	
.well{
  background:rgba(1,1,1,0.5);
  color:white;
  padding-top:30px;
  padding-bottom:60px;
  border-radius:0px;
  font-family: 'Rancho', cursive;
  font-size:24px;
}
 
   	.navbar-collapse{
  		margin-right: 30px;
  	}

    #map{height: 160px;}
    .btnpp{color:grey; font-family: 'Questrial', sans-serif; letter-spacing:1px; font-weight:700;}
    .btnpp:hover{text-decoration:none; color:grey;}
    .btn_cuisine{font-size:19px; font-family: 'Questrial', sans-serif; letter-spacing:1.5px;}
 
</style>
  
  
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
        <li><a href="index.php">Chef-La-Pumb</a></li>
        <li><a href="kitchen-protein.php">Kitchen Protein</a></li>
        <li><a href="about-us.php">About Us</a></li>
        <li><a href="how-it-works.php">How It Works</a></li>
        <li><a href="contact-us.php" style="border-bottom:2px solid #c70039">Contact Us</a></li>
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
<!--------------------------------------------------------->
<div class="container" style="margin-bottom:80px;">
	<h2 class="text-center">Contact Us</h2><br>
	<div class="row">
		<div class="col-md-6 col-md-offset-3 jumbotron">
			<form action="" method="POST">
				<div class="form-group row">
					<label for="name" class="col-sm-3 col-form-label lead">Name:</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="name" name="name" placeholder="Your name" style="border: 0; border-radius: 0; box-shadow: 4px 4px 2px grey;" required>
					</div>
				</div>
				<div class="form-group row">
					<label for="phone" class="col-sm-3 col-form-label lead">Phone:</label>
					<div class="col-sm-9">
						<input type="number" class="form-control" id="phone" name="phone" placeholder="Phone number" maxlength="10" style="border: 0; border-radius: 0; box-shadow: 4px 4px 2px grey;">
					</div>
				</div>
				<div class="form-group row">
					<label for="email" class="col-sm-3 col-form-label lead">Email:</label>
					<div class="col-sm-9">
						<input type="email" class="form-control" id="email" name="email" placeholder="Email address" style="border: 0; border-radius: 0; box-shadow: 4px 4px 2px grey;" required>
					</div>
				</div>
				<div class="form-group row">
					<label for="msg" class="col-sm-3 col-form-label lead">Message:</label>
					<div class="col-sm-9">
						<textarea class="form-control" id="message" name="message" placeholder="Your message goes here.." rows="6" style="border: 0; border-radius: 0; box-shadow: 4px 4px 2px grey;"></textarea>
					</div>
				</div>
				<br><input type="submit" name="submit" class="btn btn-primary btn-block" style="box-shadow: 4px 4px 2px grey;">
			</form>
		</div>
	</div>
</div>
<!-- -------------------------------FOOTER----------------------------------------- -->

<hr style="margin-top:0px;">
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


</body>
</html>  
