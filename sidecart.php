<div class="scrolll" style="margin-bottom:7px;height:100%">
<?php
include 'cart1.php';
$cart = new cart;
$sub_total = $cart->total();
$gst = round(((6*$sub_total)/100), 2);
$del_charges = 11;
$total = round($sub_total + 2*$gst);
if($sub_total < 250){
    $total = $total + $del_charges;
} else {
    $del_charges = 0;
}
if($cart->total_items() > 0){
    //get cart items from session
    $cartItems = $cart->contents();
    foreach($cartItems as $item){ ?>
    	<div style="margin-bottom:0px; padding:5px; background-color:white; border-bottom:1px solid lightgrey;">
	        <div class="col-sm-12">
	            <a href=" productpage.php?recipe_name1=<?php echo $item['rec_name']; ?> " target="_blank" style="text-decoration:none; color:black"><p class="recname1"><?php echo $item['rec_name']; ?> <span style="color: grey;">(<?php echo $item['rec_serving']; ?> serving)</span></p></a>
	        </div>
			<div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="input-group">
                    <div class="input-group-btn">
                        <button type="button" class="btnminus btn btn-default text-center" style="padding:1.5px; width:25px;" value="<?php echo $item["rowid"]; ?>">-</button>
                    </div>
                    <span style="width:20px;" id="<?php echo $item["rowid"]; ?>"><center> <?php echo $item["qty"]; ?> </center></span>
					
                    <div class="input-group-btn">
                        <button type="button" class="btnplus btn btn-default text-center"  style="padding:1.5px; width:25px;" value="<?php echo $item["rowid"]; ?>">+</button>
                    </div>
                </div>
            </div>
	        <div class="col-sm-3 text-center recname"> 
	            ₹<?php echo ''.$item["subtotal"].''; ?>
	        </div>
	        <div class="col-sm-3 text-center">
                <button type="button" value="<?php echo $item["rowid"]; ?>" style="border:none; font-size:18px; padding:0;" class="btn removeCartItem"><i class="material-icons" style="color:#DC143C;">remove_circle</i></button>
            </div>
	    </div>
			</div>
    <?php 
    } 
} else { ?>
    <div style="margin-top:32%;">
            <center><i class="material-icons" style="font-size:60px;">remove_shopping_cart</i><br><br></bt><span style="font-size:26px; font-family: 'Josefin Sans', sans-serif;">Nothing in your cart...</span></center>
        </div>
<?php 
} ?>
</div><br>
<?php if($cart->total_items() > 0){?>
	<center><a href="cart.php" class="btn btn-bottom btn-success btn-block" style="padding:10px 16px; border-radius:0;">Proceed to Checkout</a>
</div> 
<?php } ?>