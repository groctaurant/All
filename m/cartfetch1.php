<?php
include 'cart1.php';
$cart = new Cart;
$sub_total = $cart->total();
$gst = round(((2.5*$sub_total)/100), 2);
$del_charges = 11;
$total = round($sub_total + 2*$gst);
if($sub_total < 250){
    $total = $total + $del_charges;
}
if(isset($_POST['total_price'])){
    $total = $_POST['total_price'];
    //echo $total;
} else {
    //echo "test";
}
$flag=0;
if(isset($_SESSION['login_user']) && isset($_SESSION['login_phone'])){
    include 'session.php';
    $flag=1;
    $query = mysqli_query($con, "SELECT * from web_customers where name = '$login_session' and phone = '$login_session1'");
    $row = mysqli_fetch_array($query);
    $verify_status = $row['verify_status'];
    $request_status = $row['request_status'];
    $earned_money = $row['earned_money'];
    $wallet_total = $row['wallet'];
    $wallet_usable = $wallet_total - $earned_money;
    $limit = round((10*$sub_total)/100);
    $grcash = $earned_money;
    if($earned_money >= $limit){
        $grcash = $limit;
    }
    if($grcash >= $total){
        $grcash = $total;
    }
    $walletcash = $wallet_usable;
    if($total <= $wallet_usable){
        $walletcash = $total;
    }
    $walletcash_usable = $total-$grcash;
    if($walletcash_usable >= $walletcash){
        $walletcash_usable = $walletcash;
    }
    //$final_amount = $total - $grcash - $walletcash_usable;
    $final_amount = $total;

    if($cart->total_items() > 0){ ?>
        <div style="margin-left:26px;">
                <input type="text" class="total_price" name="total_price" value="<?php echo $total; ?>" style="display:none;">
                <input type="text" class="walletcashx" value="<?php echo $walletcash; ?>" style="display:none;">
                <?php if($verify_status == 1){ ?>
                <div class="checkbox">
                    <label style="font-size:13px; color:#696969;"><input class="minus_amount grcash" type="checkbox" name="grcash" value="<?php echo $grcash; ?>"><span class="grcash_label"> ₹<?php echo $grcash; ?></span>&nbsp;<span>(GRCASH: ₹<?php echo $earned_money; ?>)</span></label></div>
					<div class="checkbox">
                    <label style="font-size:13px; color:#696969;"><input class="minus_amount walletcash" type="checkbox" name="walletcash" value="<?php echo $walletcash_usable; ?>"><span class="walletcash_label"> ₹<?php echo $walletcash_usable; ?></span>&nbsp;<span>(Wallet: ₹<?php echo $wallet_usable; ?>)</span></label>
                    <a class="recharge_btn" style="font-size:18px; font-family: 'Josefin Sans', sans-serif; color:blue; text-decoration:underline; cursor:pointer;">Recharge</a>
                </div>
                <?php } else { ?>
                <div class="checkbox">
                    <label style="font-size:13px; color:#696969;"><input class="minus_amount grcash" type="checkbox" name="grcash" value="<?php echo $grcash; ?>" disabled><span class="grcash_label"> ₹<?php echo $grcash; ?></span>&nbsp;<span>(GRCASH: ₹<?php echo $earned_money; ?>)</span></label></div>
					<div class="checkbox">
                    <label style="font-size:13px; color:#696969;"><input class="minus_amount walletcash" type="checkbox" name="walletcash" value="<?php echo $walletcash_usable; ?>" disabled><span class="walletcash_label"> ₹<?php echo $walletcash_usable; ?></span>&nbsp;<span>(Wallet: ₹<?php echo $wallet_usable; ?>)</span></label>
                    <a class="btn btn-link btn_email_verify" href="myprofile.php" style="text-decoration:none;">Verify Email!</a>
                </div>
                <?php } ?>
                <hr style="margin:0">
                <span style="font-size:14px;">Amount</span><span style="font-size:14px; color:grey"> (To be paid)</span>: <span class="final_amount" style="font-size:26px;">₹<?php echo $final_amount; ?></span>
				<input type="text" size="4" name="final_amount" id="final_amount" value="<?php echo $final_amount; ?>" style="display:none;" readonly />
        </div>
<?php } else {
} }
?>