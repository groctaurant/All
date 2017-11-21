<?php
include('session.php');
?>
<?php
// initializ shopping cart class
include 'cart1.php';
$cart = new Cart;
$sub_total = $cart->total();
$gst = round(((2.5*$sub_total)/100), 2);
$query1 = mysqli_query($con,"SELECT discount FROM grret_discounts WHERE id = 1");
$row1 = mysqli_fetch_array($query1,MYSQLI_ASSOC);
$discount = $row1['discount'];

$queryz = mysqli_query($con, "SELECT shop_stat from grret_shopstat where id=1");
$rowz = mysqli_fetch_array($queryz);
$shop_stat = $rowz['shop_stat'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="refresh" content="600">
    <link rel="shortcut icon" type="image/png" href="images/GR.png"/>
    <title>GROCTAURANT</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Baloo+Bhaina" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Arima+Madurai:700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
<style> 
li{font-family: 'Baloo Bhaina', cursive; font-size:17px; letter-spacing:0.8px;}
h3{font-family: 'Arima Madurai', cursive; letter-spacing:1.2px;}
th{text-align:center; padding:12px; font-family: 'Metamorphous', cursive; font-size:15px; letter-spacing:1.2px;}
input[type=number]::-webkit-inner-spin-button { opacity: 1; }
hr.hrs{border-top: 3px double #8c8b8b;}
.customer ul{  
    background-color:#eee;  
    cursor:pointer;  
}  
.customer li{  
    padding:12px;  
}  
input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
input[type="number"] {
    -moz-appearance: textfield;
}

.navbar{background-color:white;}

.dt{font-family: 'Arima Madurai', cursive; font-size:13px; letter-spacing:0.8px;}
.vi{font-family: 'Arima Madurai', cursive; font-size:15px; letter-spacing:0.6px;}

table.ext {
    table-layout: auto;
}

.rec{font-family: 'Arima Madurai', cursive; letter-spacing:1.2px;}
.check{font-family: 'Arima Madurai', cursive; letter-spacing:1.2px; font-size:14px;}
.custo{font-family: 'Metamorphous', cursive; letter-spacing:1.2px; font-size:12px;}
.predisc{font-family: 'Baloo Bhaina', cursive; letter-spacing:1.2px; font-size:14px;}
        
</style>

</head>
<body>
 <?php
    $query = mysqli_query($con, "SELECT * FROM grret_merchants WHERE mer_id = '$login_session' ");
    $merRow = mysqli_fetch_array($query);
    ?>
<?php include 'navbar.php'; ?>
<br>
<form action="checkout.php" method="POST" role="form"  style="margin-top:4em; margin-bottom:6em;">
<div class="container-fluid"><br>
<?php if($shop_stat == "CLOSE SHOP" || $login_session == "test"){ ?>
    
            <a href="shop.php" class="btn btn-primary" style="text-decoration:none;"><span class="glyphicon glyphicon-hand-left"></span> Continue Shopping</a>
            
    <h1 style="font-family: 'Questrial', sans-serif; text-align:center"><b>Your Cart</b></h1>
    <br>
    <div class="container" style="font-family: 'Oswald', sans-serif; color:black; background-color:white;">
            
    <?php
    if($cart->total_items() > 0){
        //get cart items from session
        $cartItems = $cart->contents();
        foreach($cartItems as $item){ ?>
        <div class="row" style="border: 1px solid lightblue; padding:6px;">
        
            <input type="text" name="rec_sku[]" value="<?php echo $item['rec_sku']; ?>" readonly style="border:none; text-align:center; padding:10px; display:none">
            <input type="text" class="cuisine" name="rec_cuisine[]" value="<?php echo $item['rec_cuisine']; ?>" readonly style="border:none; text-align:center; padding:10px; display:none">
            
            <div class="col-sm-5 text-center"><p style="font-size:14px;"><?php echo $item['rec_name']; ?></p>
                <input type="text" class='rec' name="rec_name[]" value="<?php echo $item['rec_name']; ?>" readonly style="display:none; text-align:center; padding:10px;">
            </div>
            
            <div class="col-sm-1 text-center"><?php echo $item['rec_serving']; ?>(s)
                <input class='rec' type="text" name="rec_serving[]" value="<?php echo $item['rec_serving']; ?>" readonly style="display:none;">
            </div>
            
            <div class="col-sm-3">
                <div class="input-group">
                    <div class="input-group-btn">
                        <button type="button" class="btnminus btn btn-default" value="<?php echo $item["rowid"]; ?>">-</button>
                    </div>
                    <input type="text" name="rec_qty[]" size="4" class="form-control" id="<?php echo $item["rowid"]; ?>" readonly value="<?php echo $item["qty"]; ?>">
                    <div class="input-group-btn">
                        <button type="button" class="btnplus btn btn-default" value="<?php echo $item["rowid"]; ?>">+</button>
                    </div>
                </div>
            </div>
                
            <div class="col-sm-1 text-center">
                <input type="text" class='rec' value= "<?php echo ''.$item["price"].''; ?>" readonly style="border:none; text-align:center; padding:10px; display:none;">
                ₹<?php echo ''.$item["subtotal"].''; ?>
                <input class='rec rec_price' type="text" name="rec_price[]" value="<?php echo ''.$item["subtotal"].''; ?>" readonly style="display:none; text-align:center;">
            </div>
                
            <div class="col-sm-2 text-center">
                <center><a href="cartAction.php?action=removeCartItem&id=<?php echo $item["rowid"]; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="glyphicon glyphicon-trash"></i></a></center>
            </div>
        </div>

        <?php 
        } 
    } else { ?>
        <div class="well" style="background: none;border: none;padding:5px;margin:0;">
            <h2 style="padding-top:25px;"><center><img src="images/cart.png" height="150px" width="150px"><br><br><b>Oops!....There`s nothing in your cart</b></center></h2>
        </div>
    <?php } ?>
        
        <br>
        <div class="row text-center" style="font-family: 'Baloo Bhaina', cursive; letter-spacing:1.2px;">
            
            <?php if($cart->total_items() > 0){ ?>
            <input type="number" name="discount_percentage" readonly class="discount_percentage" value="0" style="display: none;">
            
            <div class="col-sm-4" style="font-size:14px;">
                <div>Sub-Total: <input type="text" size="6" readonly name="sub_total" style="border:none;" class="sub_total" value="<?php echo $sub_total; ?>">
                </div>
                <div class="pre_order_discount_div" style="display: none;">
                Pre-Order Dis.(₹): <input readonly style="border:none;" type="text" class="pre_order_discount" size="6" name="pre_order_discount" value="0">
                </div>
            </div>
            <div class=" col-sm-4 sgst" style="font-size:14px;">
                <div>SGST@2.5% (₹): <input type="text" class="gst" readonly size="6" name="sgst" style="border:none;" value="<?php echo $gst; ?>"></div>

                <div>CGST@2.5% (₹): <input type="text" class="gst" readonly size="6" name="cgst" style="border:none;" value="<?php echo $gst; ?>"></div>
            </div>  
            
            <?php if($sub_total < 250){ ?>
            <div class="col-sm-4">
                <div>
                Delivery Charges(₹): 11
                </div>
                <input type="number" name="del_charges" class="del_charges" readonly step="0.01" value="11" style="display:none;">
                <div class="new_cus_discount_div" style="color: #484; display: none;">
                New Customer Discount(₹):<input type='text' size='3' class="new_cus_discount" name='new_cus_discount' value='0' style='border:none;' readonly>
                </div>
                <div>Total Price(₹):<input type="text" id="total_price" name="total_price" readonly step="0.01" value="<?php echo round($sub_total + 2*$gst + 11); ?>" size="6" readonly style="border:none;"></div>
            </div>
            <?php } else { ?>
            <div class="col-sm-4">
                <div>
                FREE DELIVERY
                </div>
                <input type="number" readonly name="del_charges" class="del_charges" step="0.01" value="0" style="display:none;">
                <div class="new_cus_discount_div" style="color: #484; display: none;">
                New Customer Discount(₹):<input type='text' size='3' class="new_cus_discount" name='new_cus_discount' value='0' style='border:none;' readonly>
                </div>
                <div>Total Price(₹): <input type="text" id="total_price" readonly name="total_price" step="0.01" value="<?php echo round($sub_total + 2*$gst); ?>" size="6" readonly style="border:none;"></div>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php date_default_timezone_set("Asia/Kolkata"); $order_id = date("YmdHis").$login_session; ?>
    <input type="hidden" name="order_id" value="<?php echo $order_id; ?>" readonly>

    <div class="container-fluid">
        <hr class="hrs">
        <div class="row">
            <div class="col-sm-6">
                <h3><center><b>Additional Notes :</b></center></h3><br>
                <center>
                    <label class="checkbox-inline check">
                        <input type="checkbox" class="checkbox" name="notes[]" value="No Garlic"><b>No Garlic</b>
                    </label>
                    <label class="checkbox-inline check">              
                        <input type="checkbox" class="checkbox" name="notes[]" value="No Onion"><b>No Onion</b>
                    </label>
                    <label class="checkbox-inline check">
                        <input type="checkbox" class="checkbox" name="notes[]" value="No Ginger"><b>No Ginger</b>
                    </label>
                </center>
                <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                    <center><input type="text" name="notes[]" class="form-control" size="20" placeholder="Enter Additional Details Here..."></center>
                </div>
                <br><br>
                <?php 
                $delivery_start_time          = "10:00";
                $delivery_start_time_today    = "09:00";
                $delivery_end_time            = "09:00pm";
                $delivery_end_time1           = "10:00pm";
                $delivery_frequency           = 60;
                $slotsx = 0;
                if(date("H")>=date("H",strtotime($delivery_start_time_today)) && date("H")<date("H",strtotime($delivery_end_time))){
                    $today = strtotime("+2 hour");

                    for($j = $today; $j<= strtotime($delivery_end_time1); $j = $j + $delivery_frequency * 60) {
                        $slots1[] = date("ha", $j);  
                    }
                } else if(date("H")<date("H",strtotime($delivery_start_time_today))) {
                    $today = strtotime($delivery_start_time);
                    for($j = $today; $j<= strtotime($delivery_end_time); $j = $j + $delivery_frequency * 60) {
                        $slots1[] = date("ha", $j);  
                    }
                } else {
                    $slotsx = 1;
                }

                for($i = strtotime($delivery_start_time); $i<= strtotime($delivery_end_time); $i = $i + $delivery_frequency * 60) {
                    $slots[] = date("ha", $i);  
                }

                if(date("H")>=date("H",strtotime("00:00")) && date("H")<date("H",strtotime("10:00"))){
                    $x = date("ha", strtotime("10:00"));
                    $y = strtotime($x) + $delivery_frequency * 60;
                    $z = date("d-m-y");
                    $del_time_real_default = date("ymdH", strtotime("10:00")).date("is");
                    $delivery_expected = date("Y-m-d H", strtotime("10:00")).":".date("i:s");
                } else if(date("H")>=date("H",strtotime("10:00pm"))) {
                    $x = date("ha", strtotime("10:00"));
                    $y = strtotime($x) + $delivery_frequency * 60;
                    $z = date("d-m-y", strtotime("+1 day"));
                    $del_time_real_default = date("ymd", strtotime("+1 day")).date("H", strtotime("10:00")).date("is");
                    $delivery_expected = date("Y-m-d", strtotime("+1 day"))." ".date("H", strtotime("10:00")).":".date("i:s");
                } else {
                    $x = date("ha", strtotime("+1 hour"));
                    $y = strtotime($x) + $delivery_frequency * 60;
                    $z = date("d-m-y");
                    $del_time_real_default = date("ymdH", strtotime("+1 hour")).date("is");
                    $delivery_expected = date("Y-m-d H", strtotime("+1 hour")).":".date("i:s");
                }
                // echo date("H", strtotime("10:00pm"));
                ?>
                    

                <input type="radio" name="delivery_time_default" value="<?php echo ''.$z."/" . $x . "-".date("ha", $y).''; ?>,<?php echo $del_time_real_default; ?>,<?php echo $delivery_expected; ?>" class="fixed_delivery" checked="true" hidden="true">
                <center><a data-toggle="collapse" data-target="#demo" class="btn btn-danger predisc">Avail Pre-Order</a></center>

                <div id="demo" class="collapse">
                    <br>
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home"><?php echo date("l");?></a></li>
                        <li><a data-toggle="tab" href="#menu1"><?php echo date("l", strtotime("+1 day"));?></a></li>
                        <li><a data-toggle="tab" href="#menu2"><?php echo date("l", strtotime("+2 day"));?></a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="home" class="tab-pane fade in active">
                            <?php
                            if(date("l")!="Tuesday"){
                                if($slotsx == 1){
                                    echo "No pre-orders for today";
                                } else {
                                    foreach($slots1 as $i => $start) {
                                        $finish_time = strtotime($start) + $delivery_frequency * 60; 
                                        echo "<label class='radio-inline dt'><input name = 'delivery_time' value='" .date("d-m-y")."/" . $start . "-".date("ha", $finish_time). ",".date("ymd").date("H", strtotime($start)).date("is").",".date("Y-m-d")." ".date("H", strtotime($start)).":".date("i:s")."' class='delivery_time' type='radio'>".$start . "-".date("ha", $finish_time). "</label>";
                                    }
                                }
                            } else {
                                echo "<h3><b>Shop is Closed on Tuesday</b></h3>";
                            }
                            ?>
                        </div>
                        <div id="menu1" class="tab-pane fade"> 
                            <?php
                            if(date("l", strtotime("+1 day"))!="Tuesday"){
                                foreach($slots as $i => $start) {
                                    $finish_time = strtotime($start) + $delivery_frequency * 60; 
                                    echo "<label class='radio-inline dt'><input name = 'delivery_time' value='" .date("d-m-y", strtotime("+1 day"))."/" . $start . "-".date("ha", $finish_time). ",".date("ymd", strtotime("+1 day")).date("H", strtotime($start)).date("is").",".date("Y-m-d", strtotime("+1 day"))." ".date("H", strtotime($start)).":".date("i:s")."' class='delivery_time' type='radio'>".$start . "-".date("ha", $finish_time). "</label>";
                                }
                            } else {
                                echo "<h3><b>Shop is Closed on Tuesday</b></h3>";
                            }   
                            ?>
                        </div>
                        <div id="menu2" class="tab-pane fade">
                            
                            <?php           
                            if(date("l", strtotime("+2 day"))!="Tuesday"){
                                foreach($slots as $i => $start) {
                                    $finish_time = strtotime($start) + $delivery_frequency * 60; 
                                    echo "<label class='radio-inline dt'><input name = 'delivery_time' value='" .date("d-m-y", strtotime("+2 day"))."/" . $start . "-".date("ha", $finish_time). ",".date("ymd", strtotime("+2 day")).date("H", strtotime($start)).date("is").",".date("Y-m-d", strtotime("+2 day"))." ".date("H", strtotime($start)).":".date("i:s")."' class='delivery_time' type='radio'>".$start . "-".date("ha", $finish_time). "</label>";
                                } 
                            } else {
                                echo "<h3><b>Shop is Closed on Tuesday</b></h3>";
                            }   
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-sm-offset-1 customer">
                
                <h3><center><b>Customer Details :</b></center></h3><br>
                <label class="custo">Phone Number :</label>
                <input type="number" name="customer_phone" list="cus_phone" id="customer_phone" class="form-control" placeholder="Enter Phone" required>
                <datalist id="cus_phone">
                    <?php 
                    $querya = "SELECT cus_phone FROM grret_uniquecustomers";
                    $resulta = mysqli_query($con, $querya);
                    while($rowa=mysqli_fetch_array($resulta)){ ?>
                        <option value="<?php echo $rowa['cus_phone']; ?>" />
                    <?php
                    } ?>
                </datalist><br>
                <label class="custo">Name :</label>
                <div class="customer_name">
                    <input type="text" name="customer_name" class="form-control" placeholder="Enter Name" required>
                </div>
                <br>
                <label class="custo">Address :</label>
                <div class="customer_address">
                    <input type="text" name="customer_address" class="form-control" placeholder="Enter Address" required>
                </div>
            </div>
        </div>
    </div>
    <br>
    <center class="payment_type_radio">
        <?php if($sub_total > $merRow['mer_wallet']){
            ?>
            <label class="radio-inline vi" style="opacity: 0.5"><input type="radio" name="payment" value="Pay Via Wallet" class="radio" disabled><b>Pay Via Wallet</b></label>
            
            <label class="radio-inline vi"> <input type="radio" name="payment" value="Cash On Delivery" class="radio" required><b>Cash On Delivery</b></label>
            <?php if($merRow['mer_lwstatus'] == "ON"){ ?>
                <label class="radio-inline vi"> <input type="radio" name="payment" value="Pay Via Loan Wallet" class="radio"><b>Pay Via Loan Wallet</b></label>
            <?php } ?>
            <?php if($login_session == "test" || $login_session == "dc"){ ?>
            	<label class="radio-inline vi pay_via_eazy"><input type="radio" name="payment" value="Pay Via Eazy Wallet" class="radio"><b>Pay Via EAZY Wallet</b></label><br>
            	<input type="text" style="display:none;" name="eazy_card_no" class="eazy_card_no" placeholder="Enter Eazy Card Number"><span class="eazy_alert" style="color:red;"></span>
            <?php } ?>
            <?php
        } else {
        ?>
            <label class="radio-inline vi"><input type="radio" name="payment" value="Pay Via Wallet" class="radio" required><b>Pay Via Wallet</b></label>
            
            <label class="radio-inline vi"> <input type="radio" name="payment" value="Cash On Delivery" class="radio"><b>Cash On Delivery</b></label>
            <?php if($merRow['mer_lwstatus'] == "ON"){ ?>
                <label class="radio-inline vi"> <input type="radio" name="payment" value="Pay Via Loan Wallet" class="radio"><b>Pay Via Loan Wallet</b></label>
            <?php } ?>
            <?php if($login_session == "test" || $login_session == "dc" || $login_session == "sales" || $login_session == "grstore"){ ?>
            	<label class="radio-inline vi pay_via_eazy"><input type="radio" name="payment" value="Pay Via Eazy Wallet" class="radio"><b>Pay Via EAZY Wallet</b></label><br>
            	<input type="text" style="display:none;" name="eazy_card_no" class="eazy_card_no" placeholder="Enter Eazy Card Number"><span class="eazy_alert" style="color:red;"></span>
            <?php } ?>
        <?php
        }
        ?>   
    </center>
    <br>
    <center><input type="submit" name="submit" value="Checkout" class="btn btn-success" style="padding:8px 18px; font-family: 'Baloo Bhaina', cursive; font-size:25px; letter-spacing:0.8px;"></center>
    <?php } 
} else { ?>
<p style="font-size:50px; color:#ba8e2d; text-align: center;">Shop is Closed right now!! Come again after some time and checkout our Delicious Recipes!!</p>
    <?php } ?>
</div>
</form>
<script type="text/javascript">
$(document).ready(function(){
    var total_price1 = parseInt($("#total_price").val());  
    $('.btnplus').on('click', function(){
        var id = $(this).val();
        var obj = $('#'+id).val();
        obj++;
        updateCartItemplus(obj, id);
    });
    
    $('.btnminus').on('click', function(){
        var id = $(this).val();
        var obj = $('#'+id).val();
        obj--;
        updateCartItemminus(obj, id);
    });

    $("#customer_phone").on('input', function() {
        var val = this.value;
        if(val.length != 10){        
            $('#customer_name').prop("value", "");      
            $('#customer_address').prop("value", "");       
        }
        if($('#cus_phone option').filter(function(){
            return this.value === val;        
        }).length) {
            getname(this.value);
        }
    });
    
    $(document).on('click',".pay_via_eazy", function() {
        var val = $("#customer_phone").val();
        if(val.length == 10){
            geteazy(val);
        } else {
            $(this).children().prop("checked", false);
            $(".eazy_alert").text("*Invalid Phone Number");
        }
    });
    
    var clp_sub = 0;
    $(".cuisine").each(function(){
        var cuisine = $(this).val();
        if(cuisine != "Kitchen Protein"){
            clp_sub += parseInt($(this).parent().find(".rec_price").val());
        }
    });
    
    var flag2 = 0;
    var sub_total = parseInt($(".sub_total").val());
    var del_charges = parseInt($(".del_charges").val());
    $(".delivery_time").on('change', function(){
        flag2 = 1;
        var discount = <?php echo $discount; ?>;
        //console.log(discount);
        var pre_order_discount = (clp_sub*discount)/100;
        var new_sub_total = sub_total - pre_order_discount;
        var gst = Math.round(new_sub_total*2.5)/100;
        var new_cus_discount =  parseInt($(".new_cus_discount").val());
        var new_total = (new_sub_total + del_charges + (2*gst)) - new_cus_discount;
        total_price1 = new_total;
        $(".pre_order_discount_div").show();
        $(".pre_order_discount").val(pre_order_discount);
        $(".gst").val(gst);
        $("#total_price").val(Math.round(new_total));
        $(".discount_percentage").val(discount);
    });

    var flag = 0;
    $(".cuisine").each(function(){
        var cuisine = $(this).val();
        if(cuisine != "Kitchen Protein"){
            flag = 1;
            return false;
        }
    });
      
    $("#customer_phone").on('input', function() { 
    	$(".eazy_alert").text("");
        $(".pay_via_eazy").children().prop("checked", false);
        $(".eazy_card_no").css("display","none");     
        var val = this.value;       
        $.ajax({        
            type: "POST",       
            url: "getdiscount.php",     
            data:'number='+val,     
            success: function(data){        
                if(parseInt(data) == 0 && val.length == 10 && flag == 1 && total_price1 >= 250){ 
                    $('.new_cus_discount').val("100"); 
                    $('.new_cus_discount_div').show();     
                    var temp = total_price1-100;        
                    $("#total_price").val(Math.round(temp));
                    $("#customer_phone").attr("title","Discount for New Customer Applied!").attr('data-toggle', 'tooltip').tooltip({
                        trigger: 'manual'
                    }).tooltip('show');  
                    setTimeout(function(){
                        $("#customer_phone").tooltip('hide');
                    }, 5000);      
                } else if(parseInt(data) == 0 && val.length == 10 && flag == 1){
                    $('.new_cus_discount').val("50"); 
                    $('.new_cus_discount_div').show();     
                    var temp = total_price1-50;        
                    $("#total_price").val(Math.round(temp));
                    $("#customer_phone").attr("title","Discount for New Customer Applied!").attr('data-toggle', 'tooltip').tooltip({
                        trigger: 'manual'
                    }).tooltip('show');  
                    setTimeout(function(){
                        $("#customer_phone").tooltip('hide');
                    }, 5000);       
                } else{
                    $('.new_cus_discount').val("0"); 
                    $('.new_cus_discount_div').hide(); 
                    if(flag2 == 1){
                       var discount = <?php echo $discount; ?>; 
                    } else {
                        var discount = 0;
                    }
                    var pre_order_discount = (clp_sub*discount)/100;
                    var new_sub_total = sub_total - pre_order_discount;
                    var gst = Math.round(new_sub_total*2.5)/100;
                    var new_cus_discount =  0;
                    var new_total = (new_sub_total + del_charges + (2*gst)) - new_cus_discount;      
                    $("#total_price").val(Math.round(new_total));
                    $("#customer_phone").tooltip('hide');     
                    $('#customer_name').prop("value", "");      
                    $('#customer_address').prop("value", "");       
                }       
            }       
        });     
    });
    
});        

function getname(val) {
    $.ajax({
        type: "POST",
        url: "getname.php",
        data:'number='+val,
        success: function(data){
            var values = data.split("|");
            $(".customer_name").html(values[0]);
            $(".customer_address").html(values[1]);
            $('#customer_name').prop("value", $("#cus_name option:last-child").prop("value"));
            $('#customer_address').prop("value", $("#cus_address option:last-child").prop("value"));
        }
    });
}
function geteazy(val) {
    $.ajax({
        type: "POST",
        url: "geteazy.php",
        data:'number='+val,
        success: function(data){
            var values = data.split("|");
            if(values[0] == 0){
                $(".eazy_alert").text("*Phone Number Not Found!!");
                $(".pay_via_eazy").children().prop("checked", false);
                $(".eazy_card_no").css("display","none");
            } else if(parseInt($("#total_price").val()) > parseInt(values[2])){
            	$(".eazy_alert").text("*Insufficient balance in EAZY wallet!!");
                $(".pay_via_eazy").children().prop("checked", false);
                $(".eazy_card_no").css("display","none");
            } else {
            	$(".eazy_card_no").css("display","block");
            	$(".eazy_alert").text("");
            }
        }
    });
}
function updateCartItemplus(obj,id){
    $.get("cartAction.php", {action:"updateCartItemplus", id:id, qty:obj}, function(data){
        if(data == 'ok'){
            location.reload();
        }else{
            //alert('Cannot add more than 10 items!!');
            location.reload();
        }
    });
}

function updateCartItemminus(obj,id){
    $.get("cartAction.php", {action:"updateCartItemminus", id:id, qty:obj}, function(data){
        if(data == 'ok'){
            location.reload();
        }else{
            alert('Some error!!');
            location.reload();
        }
    });
}
</script>
</body>
</html>