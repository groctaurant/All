<?php
include 'cart1.php';
$cart = new Cart;
$sub_total = $cart->total();
$clp_sub = 0;
foreach ($cart->contents() as $item) {
    if($item['category'] != "Kitchen Protein"){
        $clp_sub += $item['subtotal'];
    }
}
$flag=0;
if(isset($_SESSION['login_user']) && isset($_SESSION['login_phone'])){
$flag=1;
}
$discount_percentage = 0;
if(isset($_POST['discount'])){
    $discount_percentage = $_POST['discount'];
}
$discount = round((($clp_sub*$discount_percentage)/100), 2);
$new_sub_total = $sub_total - $discount;
$gst = round(((2.5*$new_sub_total)/100), 2);
$del_charges = 11;
$total = round($new_sub_total + 2*$gst);
if($sub_total < 250){
    $total = $total + $del_charges;
} else {
    $del_charges = 0;
}
?>
    <?php
    if($cart->total_items() > 0){
        echo "<h4><center><b>Cart Items</b></center></h4><br>
        <div class='container-fluid cartt'>";
        //get cart items from session
        $cartItems = $cart->contents();
        foreach($cartItems as $item){ ?>
            
				<input type="text" name="discount_percentage" class="discount_percentage" value="<?php echo $discount_percentage; ?>" style="display:none" readonly />
                <input type="text" name="rec_sku[]" value="<?php echo $item['rec_sku']; ?>" readonly style="border:none; text-align:center; padding:10px; display:none">
                <input type="text" class="cuisine" name="rec_cuisine[]" value="<?php echo $item['rec_cuisine']; ?>" readonly style="border:none; text-align:center; padding:10px; display:none">
                <input type="text" class="category" value="<?php echo $item['category']; ?>" readonly style="display:none">
                    <div class="col-xs-12 text-center" style="padding:5px;">
                        <p style="font-size:13px;"><?php echo $item['rec_name']; ?><span style="font-size:10px; color: grey; font-weight:bold;">(<?php echo $item['rec_serving']; ?> serving)</span></p>
                        <input type="text" class='rec' name="rec_name[]" value="<?php echo $item['rec_name']; ?>" readonly style="display:none; text-align:center; padding:10px;">
                    </div>
                                
                        <input class='rec' type="text" name="rec_serving[]" value="<?php echo $item['rec_serving']; ?>" readonly style="display:none;">
                    <div class="row" style="padding-bottom:7px; border-bottom:1px solid lightgrey;">
                    <div class="col-xs-8">
                       <div class="row">
                           <div class="col-xs-1"><button type="button" class="btnminus btn text-center" style="" value="<?php echo $item["rowid"]; ?>">-</button></div>
                           <div class="col-xs-2"><input type="text" name="rec_qty[]" class="text-center" id="<?php echo $item['rowid']; ?>" value="<?php echo $item['qty']; ?>" style="background-color:white; border:none; width:30px" readonly></div>
                           <div class="col-xs-1"><button type="button" class="btnplus btn text-center"  style="" value="<?php echo $item["rowid"]; ?>">+</button></div>
                           <div class="col-xs-5">&thinsp;<span style="font-size:13px;">X ₹<?php echo $item["price"]; ?></span></div>
                       </div>
                    </div>
          
                        <input type="text" class='rec' value= "<?php echo $item['price']; ?>" readonly style="border:none; text-align:center; padding:10px; display:none;">
          
                    <div class="col-xs-2">
                        ₹<?php echo $item["subtotal"]; ?>
                        <input class='rec rec_price' type="text" name="rec_price[]" value="<?php echo $item['subtotal']; ?>" readonly style="display:none; text-align:center;">
                    </div>
                    <div class="col-xs-1">
                        <button type="button" value="<?php echo $item['rowid']; ?>" class="btn removeCartItem" style="border:none; font-size:18px; padding:0; background-color:white;"><i class="material-icons" style="color:#DC143C;">remove_circle</i></button>
                    </div>
                </div>
            
        <?php 
        } 
    } else { ?>
        <div style="padding-top:100px;">
            <center><i class="material-icons" style="font-size:100px;">remove_shopping_cart</i><br><br></bt><span style="font-size:26px; font-family: 'Josefin Sans', sans-serif;">Clever you! Checking empty cart...</span></center>
        </div>
    <?php } ?>
  </div>  
    <br>
    <?php 
    if($cart->total_items() > 0){ ?>
	<div style="pading:20px;">
	  <div class="panel-group">
    <div class="panel panel-default">
      <a data-toggle="collapse" href="#collapse1" style="text-decoration:none; color:black;"><div class="panel-heading">
        <h4 class="panel-title">
          Total Price <span style="font-size:11px; color: grey;">(Inc. all Tax)</span> : ₹<input type="text" id="total_price"  readonly step="0.01" value="<?php echo $total; ?>" size="6" readonly style="border:none;"></h4>
      </div></a>
      <div id="collapse1" class="panel-collapse collapse">
        <div class="panel-body" style="color:#696969; font-size:13px;">
		Sub-Total: ₹<input type="text" size="6" readonly style="border:none;" name="sub_total" class="sub_total" value="<?php echo $sub_total; ?>">

				<div>SGST@2.5% : ₹<input type="text" class="gst" readonly size="6" name="sgst" style="border:none;" value="<?php echo $gst; ?>"></div>
                <div>CGST@2.5% : ₹<input type="text" class="gst" readonly size="6" name="cgst" style="border:none;" value="<?php echo $gst; ?>"></div>
				 <div>
                    <?php if($del_charges == 0){
                        echo "FREE DELIVERY";
                    } else {
                        echo "Delivery Charges(₹): ".$del_charges;
                    } ?>
                </div>
                <input type="number" name="del_charges" class="del_charges" readonly step="0.01" value="<?php echo $del_charges; ?>" style="display:none;">
                <div class="new_cus_discount_div" style="color: #484; display: none;">
                    New Customer Discount(₹):<input type='text' size='3' class="new_cus_discount" name='new_cus_discount' value='0' style='border:none;' readonly>
                </div>
		</div></div>
        </div>
         <?php 
                if($discount_percentage == 0){ ?>
                    <span class="pre_order_discount_div" style="padding:4px; font-size:13px; color: green; display: none;">
                        Pre-order applied<input readonly style="border: none; display: none;" type="text" size="6" class="pre_order_discount" name="pre_order_discount" value="<?php echo $discount; ?>">
                    </span>
                <?php
                } else { ?>
                    <span class="pre_order_discount_div" style="padding:4px;font-size:13px; color: green;">
                        Pre-order applied<input readonly style="border: none; display: none;" type="text" size="6" class="pre_order_discount" name="pre_order_discount" value="<?php echo $discount; ?>">
                    </span>
                <?php
                } ?>
    </div>
   
<?php 
if($flag == 0 && $cart->total_items() > 0){ ?>
    <center><button type="button" class="btn btn-block login_btn" style="border-radius:0; background-color:#D2691E; color:white;">Checkout</button></center>
<?php 
} ?>
  </div>

    <?php 
    } else { ?>
</div>
    <?php
    } ?>