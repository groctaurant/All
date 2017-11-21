<style type="text/css">
#nav-icon3{
  position: relative;
  -webkit-transform: rotate(0deg);
  -moz-transform: rotate(0deg);
  -o-transform: rotate(0deg);
  transform: rotate(0deg);
  -webkit-transition: .5s ease-in-out;
  -moz-transition: .5s ease-in-out;
  -o-transition: .5s ease-in-out;
  transition: .5s ease-in-out;
  cursor: pointer;
}
#nav-icon3 span{
  display: block;
  position: absolute;
  height: 2px;
  width: 100%;
  background: #d3531a;
  opacity: 1;
  left: 0;
  -webkit-transform: rotate(0deg);
  -moz-transform: rotate(0deg);
  -o-transform: rotate(0deg);
  transform: rotate(0deg);
  -webkit-transition: .25s ease-in-out;
  -moz-transition: .25s ease-in-out;
  -o-transition: .25s ease-in-out;
  transition: .25s ease-in-out;
}
#nav-icon3 span:nth-child(1) {
  top: 10px;
}

#nav-icon3 span:nth-child(2){
  top: 16px;
}

#nav-icon3 span:nth-child(3) {
  top: 26px;
}

#nav-icon3.open span:nth-child(1) {
  top: 18px;
  width: 0%;
  left: 50%;
}

#nav-icon3.open span:nth-child(2) {
  top: 18px;
  width: 150%;
}

#nav-icon3.open span:nth-child(3) {
  top: 18px;
  width: 150%;
}

#nav-icon3.open span:nth-child(2) {
  -webkit-transform: rotate(135deg);
  -moz-transform: rotate(135deg);
  -o-transform: rotate(135deg);
  transform: rotate(135deg);

}

#nav-icon3.open span:nth-child(3) {
  -webkit-transform: rotate(-135deg);
  -moz-transform: rotate(-135deg);
  -o-transform: rotate(-135deg);
  transform: rotate(-135deg);
}
.row-centered {
    text-align:center;
}
.col-centered {
    display:inline-block;
    float:left;
    text-align:center;
    vertical-align: top;
}
</style>
<nav class="navbar navbar-fixed-top">
  <div class="container-fluid">
    
             <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" id="nav-icon3" data-target="#myNavbar1">
                    <span class="icon-bar" style="background-color:black;"></span>
                    <span class="icon-bar" style="background-color:black;"></span>
                    <span class="icon-bar" style="background-color:black;"></span>
                </button>
                <a href="home.php" class="navbar-brand hidden-xs" style="cursor:pointer;"><img src="images/logo.png" width="200px"></a>
                <a href="home.php" class="navbar-brand hidden-lg hidden-md hidden-sm" style="cursor:pointer;"><img src="images/GR.png" width="60px"></a>
                
            </div>

            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav pull-right">
                    <li class="active"><a href="shop.php"><span class="glyphicon glyphicon-tower"></span> SHOP</a></li>
               <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-piggy-bank"></span> <?php echo "₹".$merRow['mer_wallet']; ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                <li><a href="wallet.php">Transactions</a></li>
                            <li class="divider"></li>
                            <li><a href="walletrecharge.php">Recharge</a></li>
                            
                        </ul>
                        </li>
                    
 <?php if($merRow['mer_lwstatus'] == "ON"){ ?>
    <li class="dropdown">
         <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-credit-card"></span> Loan <?php echo "₹".$merRow['mer_loanwallet']; ?>
         <span class="caret"></span></a>
            <ul class="dropdown-menu">
      
                <li><a href="walletloan.php">Transactions</a></li>
                <li class="divider"></li>
                <li><a href="myloanorders.php">Loan Orders</a></li>
            </ul>
            </li>
  <?php  } ?>
  <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $login_session; ?> 
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
    <li><a href="myprofile.php">MY PROFILE</a></li>
      <li class="divider"></li>
          <li><a href="myorders.php"><span class="glyphicon glyphicon-th-list"></span> ORDERS</a></li>
      <li class="divider"></li>
          <li><a href="mycustomers.php">CUSTOMERS</a></li>
      <li class="divider"></li>
          <li><a href="logout.php"><span class="glyphicon glyphicon-lock"></span> Logout</a></li>
        </ul>
      </li>
                  
  <li><a href="Cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart <span class="label label-success"><?php echo $cart->total_items(); ?></span></button></a></li>
            </ul></div>

<div class="collapse navbar-collapse" id="myNavbar1" >
            <ul class="nav navbar-nav text-center hidden-sm hidden-md hidden-lg" style="background-color: #e0e0e0;margin-top: 20px;padding-top: 10px">
                <div class="row row-centered" style="margin:0;">
                    <div class="col-xs-2 col-centered text-center">
                        <li class="active"><a href="shop.php" class="btn-block"><span class="glyphicon glyphicon-tower"></span> SHOP</a></li>
                    </div>
                    <div class="col-xs-3 col-centered text-center">
                         <li class="dropdown">
                            <a href="#" class="dropdown-toggle btn-block" data-toggle="dropdown"><span class="glyphicon glyphicon-piggy-bank"> </span> Wallet <?php echo "₹".$merRow['mer_wallet']; ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="wallet.php">Transactions</a></li>
                                    <li class="divider" style="margin-top: 4px"></li>
                                    <li><a href="walletrecharge.php">Recharge</a></li>
                                </ul>
                        </li>
                    </div>
                    <?php if($merRow['mer_lwstatus'] == "ON"){ ?>
                    <div class="col-xs-3 col-centered text-center">
                        <li class="dropdown">
                             <a href="#" class="btn-block dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-credit-card"></span> Loan <?php echo "₹".$merRow['mer_loanwallet']; ?>
                             <span class="caret"></span></a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="walletloan.php">Transactions</a></li>
                                    <li class="divider" style="margin-top: 4px"></li>
                                    <li><a href="myloanorders.php">Loan Orders</a></li>
                                </ul>
                        </li>
                    </div>
                    <?php } else { ?>
                    <div class="hidden_loan" style="display: none;"></div>
                    <?php } ?>
                    <div class="col-xs-2 col-centered text-center">
                        <li class="dropdown">
                            <a class="dropdown-toggle btn-block" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $login_session; ?> 
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="myprofile.php">MY PROFILE</a></li>
                                <li class="divider" style="margin-top: 4px"></li>
                                <li><a href="myorders.php"><span class="glyphicon glyphicon-th-list"></span> ORDERS</a></li>
                                <li class="divider" style="margin-top: 4px"></li>
                                <li><a href="mycustomers.php">CUSTOMERS</a></li>
                                <li class="divider" style="margin-top: 4px"></li>
                                <li><a href="logout.php"><span class="glyphicon glyphicon-lock"></span> Logout</a></li>
                            </ul>
                        </li>
                    </div>
                    <div class="col-xs-2 col-centered text-center">
                        <li><a href="Cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart <span class="label label-success" style="padding-bottom: 0;margin-top: -4px"><?php echo $cart->total_items(); ?></span></button></a></li>
                    </div>             
                </div>
            </ul>
        </div>
        </nav>
<script type="text/javascript">
    $(document).ready(function(){
        $('#nav-icon3').click(function(){
            $(this).toggleClass('open');
        });
        if($("div").hasClass("hidden_loan")){
            $(".col-centered").css("float","none");
        }
    });
</script>