<?php
include('session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/png" href="images/groclogo.png">
    <title>Groctaurant Retail Home</title>
    <!-- Bootstrap Core CSS -->
    <link href="../../css/freelancer.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Custom Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300|Raleway:100,400" rel="stylesheet">
 	<link href="https://fonts.googleapis.com/css?family=Oswald:500,600" rel="stylesheet">
	<style type="text/css">
	body{

		font-family: 'Raleway', sans-serif;
	}
	h2,h1{font-family: 'Oswald', sans-serif;}
	h1{
		text-transform:none; 
	}
	.navbar-brand{
		margin-top: -6px;
		padding:0;
	}
	#logo{
		height: 100%;
	}
	
	.page-scroll{
	 font-size: 200%;
	}
	
	#nav-bar{
		text-transform: none;
		font-family: 'Raleway', sans-serif;
		font-weight: 400;
		color:#bd951b !important; 
	}

	li.active #nav-bar{
		background:#bd951b !important;
		color: #000 !important;
	}
	#nav-bar:hover{

		text-decoration: underline ; 
	}
	
	.affix-top{
		background:rgba(0,0,155,0);
	}

	.affix{
		background:rgba(0,0,0,1);
	}
	
	header{
			height: 100%;/*
			background-position: center;*/ 
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-size:100%;
			background-image: url("../../images/backgroundhor2.jpg");
	}

    .navbar-custom .navbar-toggle:focus, .navbar-custom .navbar-toggle:hover{
    	background-color: #bd951b;
    	border-color: #bd951b;
    }
    
    #logo3{
       padding-top: 9%;
       width: 30%;
    
	}

	.name{
		font-size: 7.5em !important;
	}
	
	.skills{
		font-size: 40px !important;
		font-family: 'Open Sans', sans-serif;
	}
	
	.jumbotron{
		text-decoration: underline;
		font-size: 5em;
		background: none;
	}
	.affix{
		background: rgba(0,0,0,1);
	}
	
	.affix-top{
		background:rgba(0,0,0,0);
	}

	#what-we{
		margin-top: -1%;
		font-size: 30px;
	}

	.navbar-default .navbar-collapse, .navbar-default .navbar-form {
    	border-color: #bd951b;
	}
	
	#prod-head{
		text-transform: none;
		font-family: 'Raleway', sans-serif;
		font-weight: 400;
		font-size: 60px;
	}
	.carousel-inner > .item > img,
    .carousel-inner > .item > a > img {
      width: 100%;
    }

    #mainNav{
    	border: none;
    }
    #bene{ 
    	font-size: 30px;
    }
    #bene1{
    	font-size: 70px;
    	margin-top: 40px;
    }
    .glyphicon-thumbs-up{
    	margin-top: 20px;
    }
    li,h2,h1{font-family: 'Oswald', sans-serif; font-size:17px; letter-spacing:0.8px;}
	li.active{
	  background: #d0d0d0;
	}
	a.active{
	  color: #000;
	}
	header .container {
    		padding-top: 85px;
    		padding-bottom: 100px;
        }
    

	/*MEDIA QUERIES*/
    @media(max-width: 1200px){
        #logo{
			margin-top: 9px;
			height: 60%;
		}
    }
    @media(max-width: 992px){
		.page-scroll{
			font-size: 120%;
		}
		#logo{
			margin-top: 9px;
			height: 60%;
		}
		
	}
	@media(max-width: 800px){
		#logo{
			height: 60%;
			margin-top: 4px;
		}
		.navbar-brand{
			padding-top: 3%; 
			padding-left: 3%;
		}
	}
	
	@media(max-width: 767px){
     	header{
			height: 70%;
			background-attachment: fixed;
			background-size:100%;
			background-image: url("../../images/backgroundver.jpg");
		}
	
    	.affix-top{
    		background:rgba(0,0,0,1);
    	}
   
    	.skills{
		font-family: 'Open Sans', sans-serif;
		font-size: 25px !important;
		}

		#logo{
			height: 70%;
			margin-top: 4px;
		}
    }
	@media(max-width: 375px){
			
			#logo{
				height: 70%;
			}
			
            #logo2{
			margin-top:-5%;
		    }				
		    .navbar-brand{
				margin-top: 1%;
			}
			.skills{
				font-family: 'Open Sans', sans-serif;
				font-size: 15px !important;
	       	}

	       .name{
             margin-top: -6%;
             font-size: 20px !important;	 
         	}
	}
	@media(max-width: 296px){
			#logo{
				height: 50%;
			}
			
			.navbar-brand{
				margin-top: 1%;
			}
	        header{
				background-size:100% 80%;
	        }
	        .skills{
				font-family: 'Open Sans', sans-serif;
				font-size: 15px !important;
			}
	}	


</style>
</head>
<body id="page-top" class="index" data-spy="scroll" data-target=".navbar" data-offset="50">
<div class="wrapper" id="wrapper">    
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
        <div class="container" id="nav1">
            <div class="navbar-header page-scroll" id="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand " href="#page-top"><img class="img-responsive" id="logo" src="../../images/logo.png" ></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top" id="nav-bar"></a>
                    </li>

                    <li class="page-scroll">
                        <a href="#product" id="nav-bar">Product</a>
                    </li>
					
					<li class="page-scroll">
                        <a href="#benefit" id="nav-bar">Benefits</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#how" id="nav-bar">Working</a>
                    </li>
                    
                    <li class="page-scroll">
                        <a href="#whom-to-offer" id="nav-bar">Buyers</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#faq" id="nav-bar">FAQ</a>
                    </li>
                    <li class="page-scroll">
                        <a href="orders.php" id="nav-bar">ORDERS >></a>
                    </li> 
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container" id="maincontent" tabindex="-1">
        
           <img  id="logo3" src="../../images/groclogo.png">
           
                    <div class="intro-text">
                    <span class="skills">#Khana Banane ka Naya Tarika</span>
                    <br><br>
                    </div>
                </div>  
    </header>

    <div id="product">	
    	<h1 class="text-center " id="prod-head">Our Product</h1>
    		<div class="carousel slide" id="myCarousel1" data-ride="carousel">
	    		<ol class="carousel-indicators">
			      <li data-target="#myCarousel1" data-slide-to="0" class="active"></li>
			      <li data-target="#myCarousel1" data-slide-to="1"></li>
			      <li data-target="#myCarousel1" data-slide-to="2"></li>
			    </ol>			
				<div class="carousel-inner" role="listbox">
					<div class="item active">	
						<img src="../../images/1-1.jpg">
					</div>
					
					<div class="item">	
						<img src="../../images/2-1.jpg">
					</div>
					
					<div class="item">	
						<img src="../../images/3-1.jpg">
					</div>
				</div>
    			<a class="left carousel-control" href="#myCarousel1" role="button" data-slide="prev">
    				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    			</a>
				<a class="right carousel-control" href="#myCarousel1" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				</a>
			</div>
	</div>
    <div class="container-fluid" id="benefit" >
        <h1 class="text-center" id="bene1">Benefits</h1>
				<div class="row">              
               		<div class="col-lg-4 col-md-4 col-sm-4 hidden-xs hidden-sm" id="bene" style="display: inline-block; float: left;">
               			<span class="glyphicon glyphicon-thumbs-up" style="color: #bd951b"> </span><span class="benef"> No Loss </span><br>
		            	<span class="glyphicon glyphicon-thumbs-up" style="color: #bd951b"> </span><span class="benef"> No Risk </span><br>
		            	<span class="glyphicon glyphicon-thumbs-up" style="color: #bd951b"> </span><span class="benef"> No Damage </span><br>
		            </div>
		            <div class="col-lg-4 col-md-4 col-sm-4 hidden-xs hidden-sm" id="bene" style="display: inline-block; float: left;">
		            	<span class="glyphicon glyphicon-thumbs-up" style="color: #bd951b"> </span><span class="benef"> Integrated Accounting </span><br>
		            	<span class="glyphicon glyphicon-thumbs-up" style="color: #bd951b"> </span><span class="benef"> Pure Profit </span><br>
		            	<span class="glyphicon glyphicon-thumbs-up" style="color: #bd951b"> </span><span class="benef"> No Manpower </span><br>
		            </div>
		            <div class="col-lg-4 col-md-4 col-sm-4 hidden-xs hidden-sm" id="bene" style="display: inline-block; float: left;">
		            	<span class="glyphicon glyphicon-thumbs-up" style="color: #bd951b"> </span><span class="benef"> High Order Ticket </span><br>
		            	<span class="glyphicon glyphicon-thumbs-up" style="color: #bd951b"> </span><span class="benef"> Marketing Support </span><br>
		            	<span class="glyphicon glyphicon-thumbs-up" style="color: #bd951b"> </span><span class="benef"> No Expiry </span>
		    		</div>

		    	<div class="col-sm-4"> </div>
		    		<div class="col-sm-8 hidden-xs hidden-lg hidden-md" id="bene" style="display: inline-block;">
               			<span class="glyphicon glyphicon-thumbs-up" style="color: #bd951b"> </span><span class="benef"> No Loss </span><br>
		            	<span class="glyphicon glyphicon-thumbs-up" style="color: #bd951b"> </span><span class="benef"> No Risk </span><br>
		            	<span class="glyphicon glyphicon-thumbs-up" style="color: #bd951b"> </span><span class="benef"> No Damage </span><br>
		            	<span class="glyphicon glyphicon-thumbs-up" style="color: #bd951b"> </span><span class="benef"> Integrated Accounting </span><br>
		            	<span class="glyphicon glyphicon-thumbs-up" style="color: #bd951b"> </span><span class="benef"> Pure Profit </span><br>
		            	<span class="glyphicon glyphicon-thumbs-up" style="color: #bd951b"> </span><span class="benef"> No Manpower </span><br>
		            	<span class="glyphicon glyphicon-thumbs-up" style="color: #bd951b"> </span><span class="benef"> High Order Ticket </span><br>
		            	<span class="glyphicon glyphicon-thumbs-up" style="color: #bd951b"> </span><span class="benef"> Marketing Support </span><br>
		            	<span class="glyphicon glyphicon-thumbs-up" style="color: #bd951b"> </span><span class="benef"> No Expiry </span>
		    		</div>
		    	</div>

    			<div class="col-xs-3"> </div>
		    		<div class="col-xs-8 hidden-sm hidden-lg hidden-md" id="bene" style="display: inline-block;">
               			<span class="glyphicon glyphicon-thumbs-up" style="color: #bd951b"> </span><span class="benef"> No Loss </span><br>
		            	<span class="glyphicon glyphicon-thumbs-up" style="color: #bd951b"> </span><span class="benef"> No Risk </span><br>
		            	<span class="glyphicon glyphicon-thumbs-up" style="color: #bd951b"> </span><span class="benef"> No Damage </span><br>
		            	<span class="glyphicon glyphicon-thumbs-up" style="color: #bd951b"> </span><span class="benef"> Integrated Accounting </span><br>
		            	<span class="glyphicon glyphicon-thumbs-up" style="color: #bd951b"> </span><span class="benef"> Pure Profit </span><br>
		            	<span class="glyphicon glyphicon-thumbs-up" style="color: #bd951b"> </span><span class="benef"> No Manpower </span><br>
		            	<span class="glyphicon glyphicon-thumbs-up" style="color: #bd951b"> </span><span class="benef"> High Order Ticket </span><br>
		            	<span class="glyphicon glyphicon-thumbs-up" style="color: #bd951b"> </span><span class="benef"> Marketing Support </span><br>
		            	<span class="glyphicon glyphicon-thumbs-up" style="color: #bd951b"> </span><span class="benef"> No Expiry </span>
		    		</div>
		    	</div>
   <hr>
   <div class="container-fluid" id="how">
   	<h1 class="text-center" style="font-size: 4em">How It Works</h1>
	   	<div class="row hidden-xs">
	   		<div class="col-sm-1 "></div>
				<div class="col-sm-11 " style="float: left;">
					<div class="btn-social" id="btn1" style="font-size: 2em;background: white">1</div> <span style="font-size: 2em">Customer Choose item from menu with serving</span><br>
				   	<div class="btn-social" id="btn2" style="font-size: 2em;">2</div> <span style="font-size: 2em">Add the Order to the cart in groctaurantretail.com</span><br>
				   	<div class="btn-social" id="btn3" style="font-size: 2em;">3</div> <span style="font-size: 2em">Fill in Customer Name,Phone Number, Address in groctaurantretail.com</span><br>
				   	<div class="btn-social" id="btn4" style="font-size: 2em;">4</div> <span style="font-size: 2em">Collect Payment and Inform Delivery Time(*Pre-Order Available)
				   	</span><br>
				   	<div class="btn-social" id="btn5" style="font-size: 2em;">5</div> <span style="font-size: 2em">Customer receives Order confirmation via SMS</span><br>
				   	<div class="btn-social" id="btn6" style="font-size: 2em;">6</div> <span style="font-size: 2em">Order delivered to customer by Groctaurant</span><br>
			   	</div>
	   	</div>
	   	<div class="row idden-sm hidden-lg hidden-md">
	   		<div class="col-sm-1 "></div>
				<div class="col-sm-11 " style="float: left;">
					<div class="btn-social" id="btn1" style="font-size: 1.5em;background: white">1</div> <span style="font-size: 1.5em">Customer Choose item from menu with serving</span><br>
				   	<div class="btn-social" id="btn2" style="font-size: 1.5em;">2</div> <span style="font-size: 1.5em">Add the Order to the cart in groctaurantretail.com</span><br>
				   	<div class="btn-social" id="btn3" style="font-size: 1.5em;">3</div> <span style="font-size: 1.5em">Fill in Customer Name,Phone Number, Address in groctaurantretail.com</span><br>
				   	<div class="btn-social" id="btn4" style="font-size: 1.5em;">4</div> <span style="font-size: 1.5em">Collect Payment and Inform Delivery Time(*Pre-Order Available)
				   	</span><br>
				   	<div class="btn-social" id="btn5" style="font-size: 1.5em;">5</div> <span style="font-size: 1.5em">Customer receives Order confirmation via SMS</span><br>
				   	<div class="btn-social" id="btn6" style="font-size: 1.5em;">6</div> <span style="font-size: 1.5em">Order delivered to customer by Groctaurant</span><br>
			   	</div>
	   	</div>
	</div>   	
   <hr>
<div class="container-fluid" id="whom-to-offer">
	<h1 class="text-center" style="font-size: 70px;">Whom To Offer</h1><br>
    	<div class="row">    		
    	<div class="text-center col-lg-3 col-md-3 col-sm-3 hidden-sm hidden-xs hidden-md">
    			<img src="../../images/hw.png" data-toggle="tooltip" title="House Wife">
    		</div>
    		<div class="text-center col-lg-3 col-md-3 col-sm-3 hidden-sm hidden-xs hidden-md">
    			<img src="../../images/stu.png" data-toggle="tooltip" title="Student" style="margin-top: 20px">
    		</div>
    		<div class="text-center col-lg-3 col-md-3 col-sm-3 hidden-sm hidden-xs hidden-md">
    			<img src="../../images/old.png" data-toggle="tooltip" title="Old People" style="margin-top: 10px" height="160px">
    		</div>
    		<div class="text-center col-lg-3 col-md-3 col-sm-3 hidden-sm hidden-xs hidden-md">
    			<img src="../../images/women.png" data-toggle="tooltip" title="Women">
    		</div>
    	</div>
    
    	<div class="hidden-lg hidden-md hidden-sm text-center">
    		    <img src="../../images/hw.png" data-toggle="tooltip" title="House Wife">
    			<img src="../../images/stu.png" data-toggle="tooltip" title="Student" >
    			<img src="../../images/old.png" data-toggle="tooltip" title="Old People">
    			<img src="../../images/women.png" data-toggle="tooltip" title="Women">

    	</div>
</div>
    <hr>
    <div class="container-fluid" id="faq">
    <h1 class="text-center" style="font-size: 70px;">FAQs</h1><br>
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" style="text-transform: none;"><span class="glyphicon glyphicon-question-sign"></span> Q1. How can I apply for Groctaurant Retail?And what all I need to begin? </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
                    <p>To Begin with us you just need to apply for groctaurant merchant ID at groctaurant retail.com just need a smart phone with Internet better if you have a computer</p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" style="text-transform: none;"><span class="glyphicon glyphicon-question-sign"></span> Q2. Do I need to invest some money?</a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>No,you don't have to invest any money</p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" style="text-transform: none;"><span class="glyphicon glyphicon-question-sign"></span> Q3. What is recipe kit and how it works?</a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>The "Recipe Kit" is a packet of perfectly portioned, processed and packed ingredients along with step by step instructions (Recipe Card) to make a perfect wholesome dish</p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour" style="text-transform: none;"><span class="glyphicon glyphicon-question-sign"></span> Q4. Do you accept orders out of menu?</a>
                </h4>
            </div>
            <div id="collapseFour" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>No,We don't take orders out of menu.But don't worry!We constantly upgrade and change our menu.So stay tuned!</p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive" style="text-transform: none;"><span class="glyphicon glyphicon-question-sign"></span> Q5. Why GRretail?Why not online only?</a>
                </h4>
            </div>
            <div id="collapseFive" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>Online marketing Faridabad is still developing.</p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix" style="text-transform: none;"><span class="glyphicon glyphicon-question-sign"></span> Q6. Is my wallet balance refundable?</a>
                </h4>
            </div>
            <div id="collapseSix" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>Yes,its refundable.Your money is safe with us.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br><br>
    <footer class="text-center" style="color: #bd951b">
        <div class="footer-above" style="background:#000;">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-4">
                        <h3>Location</h3>
                        <p>Sector 18-A,Opposite H/No-11
                            <br>Faridabad,Haryana-121001</p>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>Around the Web</h3>
                        <ul class="list-inline" >
                            <li>
                                <a href="http://www.groctaurant.com" class="btn-social btn-outline"><span class="sr-only">Dribble</span><i class="fa fa-fw fa-globe"></i></a>
                            </li>
                            <li>
                                <a href="https://www.facebook.com/groctaurant" class="btn-social btn-outline" ><span class="sr-only">Facebook</span><i class="fa fa-fw fa-facebook" ></i></a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/groctaurant" class="btn-social btn-outline"><span class="sr-only">Instagram</span><i class="fa fa-fw fa-instagram"></i></a>
                            </li>
                           
                        </ul>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>About Groctaurant</h3>
                        <h5 style="text-transform: none;">The French Mise en Place is the essence of the company.It was born on 15th June 2016 with an aim to bring Grocery and Restaurant in the convenience of your kitchen which the name suggests itself- <strong>GROCTAURANT</strong>.</h5>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
	<script src="js/freelancer.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
     $('[data-toggle="tooltip"]').tooltip();   
    });
    var previousScroll = 0;
	$(window).scroll(function(event){
    var scroll = $(this).scrollTop();
    var scroll2 = $("#product").offset().top;
    var scroll3 = $("#how").offset().top;
    

    if( scroll-scroll2>0 && scroll-scroll2<25 ){
   	$("#myCarousel1").carousel(0);
    }
    
    if($("#mainNav").hasClass("affix-top")){
    }
    else if (scroll > previousScroll){
       $("#mainNav").hide();
    } else {
   	$("#mainNav").show();
    }
   
    previousScroll = scroll;
   });

 </script>  
</body>

</html>
