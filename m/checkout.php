<?php 
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['login_phone'])){
} else {
    header("Location: cart.php");
    die();
}
if(isset($_POST['submit'])){
    include 'config.php';
    include 'cart1.php';
    include 'session.php';
    $cart = new Cart;
    if($cart->total_items() <= 0){
        header("Location: cart.php");
        die();
    }
    $profile = $login_session1;
    $cus_phone = test_input($_POST['customer_phone']);
    $cus_name = test_input($_POST['customer_name']);
    $cus_address = $_POST['add1'].", ".$_POST['add2'].", ".$_POST['add3'];
    if (!preg_match("/^[0-9]{10}$/",$cus_phone) || !preg_match("/^[a-zA-Z .]*$/",$cus_name) || empty($cus_name) || empty($cus_address)) {
        echo '<script> alert("Invalid Customer Details!!");
        window.location="cart.php"; </script>';
        die();
    }
    date_default_timezone_set("Asia/Kolkata");

    if(!isset($_POST['pay'])){
        echo "Placing your order..... Please Wait......";
        $mer_id = "androidapp";
        $ord_id = date("YmdHis").$mer_id;
        $sub_total = $_POST['sub_total'];
        $discount_percentage = $_POST['discount_percentage'];
        $discount = $_POST['pre_order_discount'];
        $sgst = $_POST['sgst'];
        $cgst = $_POST['cgst'];
        $del_charges = $_POST['del_charges'];
        $new_cus_discount = 0;
        if($_POST['new_cus_discount'] != null){
            $new_cus_discount = $_POST['new_cus_discount'];
        }
        $total_price = $_POST['total_price'];
        $grcash = 0;
        if(isset($_POST['grcash'])){
            $grcash = $_POST['grcash'];
        }
        $walletcash = 0;
        if(isset($_POST['walletcash'])){
            $walletcash = $_POST['walletcash'];
        }
        $final_amount = $_POST['final_amount'];

        if(isset($_POST['pre_order_delivery_time'])){
            $del_time = explode(",",$_POST['pre_order_delivery_time']);
            $del_time[0] = "".$del_time[0]."(Pre-Order)";
        } else {
            $del_time = explode(",",$_POST['delivery_time']);
        }
       
        $rec_sku = implode(', ', $_POST['rec_sku']);
        $rec_name = implode(', ', $_POST['rec_name']);
        $rec_cuisine = implode(', ', $_POST['rec_cuisine']);
        $rec_serving = implode(', ', $_POST['rec_serving']);
        $rec_qty = implode(', ', $_POST['rec_qty']);
        $rec_price = implode(', ', $_POST['rec_price']);
              
        // if($_POST['notes'] == null){
        //     $add_notes = null;
        // } else {
        //     $add_notes = implode(', ', $_POST['notes']);
        // }
        $add_notes = null;
        $ord_status = "Under Review";      
        $order_at = date("Y-m-d H:i:s");
        $order_cancel_till = date("Y-m-d H:i:s", strtotime("+10 minutes"));
        $trans_date = date("d-m-Y H:i:s");

        $payment_type = "Cashless";
        $payment_status = "Paid Online";
        $queryss = mysqli_query($con, "SELECT * from grret_shopstat where id=1");
        $rowss = mysqli_fetch_array($queryss);
        $order_number = $rowss['order_number'];
        $checkout = mysqli_query($con, "INSERT INTO grret_orders(ord_id, profile, cus_phone, cus_name, cus_address, mer_id, rec_sku, rec_name, rec_cuisine, rec_serving, rec_qty, rec_price, sub_total, discount_percentage, discount, new_cus_discount, sgst, cgst, del_charges, total_price, grcash, walletcash, final_amount, payment_type, payment_status, add_notes, del_time, del_time_real, order_at, order_cancel_till, ord_status, order_number, delivery_expected) VALUES ('$ord_id', '$profile', '$cus_phone', '$cus_name', '$cus_address', '$mer_id', '$rec_sku', '$rec_name', '$rec_cuisine', '$rec_serving', '$rec_qty', '$rec_price', '$sub_total', '$discount_percentage', '$discount', '$new_cus_discount', '$sgst', '$cgst', '$del_charges', '$total_price', '$grcash', '$walletcash', '$final_amount', '$payment_type', '$payment_status', '$add_notes', '$del_time[0]', '$del_time[1]', '$order_at', '$order_cancel_till', '$ord_status', '$order_number', '$del_time[2]')");
        $order_number++;
        if($checkout){
            mysqli_query($con, "UPDATE grret_shopstat set order_number = '$order_number' where id=1");

            $query1 = mysqli_query($con, "SELECT * from web_customers where phone = '$login_session1'");
            $row1 = mysqli_fetch_array($query1);
            $earned_money = $row1['earned_money'] - $grcash;
            $wallet = $row1['wallet'] - $grcash - $walletcash;
            mysqli_query($con, "UPDATE web_customers set wallet = '$wallet', earned_money = '$earned_money' WHERE phone = '$login_session1'");

            $phone = mysqli_query($con, "SELECT * FROM grret_uniquecustomers where cus_phone='$login_session1'");
            $phone_count = mysqli_num_rows($phone);
            if($phone_count == 0){
                mysqli_query($con, "INSERT INTO grret_uniquecustomers(mer_id, cus_phone, cus_name, cus_address) VALUES ('$mer_id', '$login_session1', '$cus_name', '$cus_address')");
            }
//TRANSACTIONS..........
            $grcash_balance = $row1['earned_money'] - $grcash;
            $walletcash_balance = $row1['wallet'] - $row1['earned_money'] - $walletcash;
            $trans_date = date("d-m-Y H:i:s");
            $trans_type = "Debit";
            $trans_details = "Order Placed. Order id: ".$ord_id;
            $query3 = mysqli_query($con, "INSERT into web_transactions(cus_phone, trans_date, trans_type, trans_details, order_id, total_price, grcash_debit, grcash_balance, walletcash_debit, walletcash_balance, final_amount) VALUES('$profile', '$trans_date', '$trans_type', '$trans_details', '$ord_id', '$total_price', '$grcash', '$grcash_balance', '$walletcash', '$walletcash_balance', '$final_amount')");
//MESSAGE TO CUSTOMER...
            $cart->destroy();
            header("Location: myorders.php");
            die();
        } else {
            echo "Error: ".mysqli_error($con);
        }
    } else if($_POST['pay'] == "Cash On Delivery") {
        echo "Placing your order..... Please Wait......";
        $mer_id = "androidapp";
        $ord_id = date("YmdHis").$mer_id;
        $sub_total = $_POST['sub_total'];
        $discount_percentage = $_POST['discount_percentage'];
        $discount = $_POST['pre_order_discount'];
        $sgst = $_POST['sgst'];
        $cgst = $_POST['cgst'];
        $del_charges = $_POST['del_charges'];
        $new_cus_discount = 0;
        if($_POST['new_cus_discount'] != null){
            $new_cus_discount = $_POST['new_cus_discount'];
        }
        $total_price = $_POST['total_price'];
        $grcash = 0;
        if(isset($_POST['grcash'])){
            $grcash = $_POST['grcash'];
        }
        $walletcash = 0;
        if(isset($_POST['walletcash'])){
            $walletcash = $_POST['walletcash'];
        }
        $final_amount = $_POST['final_amount'];

        if(isset($_POST['pre_order_delivery_time'])){
            $del_time = explode(",",$_POST['pre_order_delivery_time']);
            $del_time[0] = "".$del_time[0]."(Pre-Order)";
        } else {
            $del_time = explode(",",$_POST['delivery_time']);
        }
       
        $rec_sku = implode(', ', $_POST['rec_sku']);
        $rec_name = implode(', ', $_POST['rec_name']);
        $rec_cuisine = implode(', ', $_POST['rec_cuisine']);
        $rec_serving = implode(', ', $_POST['rec_serving']);
        $rec_qty = implode(', ', $_POST['rec_qty']);
        $rec_price = implode(', ', $_POST['rec_price']);
              
        // if($_POST['notes'] == null){
        //     $add_notes = null;
        // } else {
        //     $add_notes = implode(', ', $_POST['notes']);
        // }
        $add_notes = null;
        $ord_status = "Under Review";      
        $order_at = date("Y-m-d H:i:s");
        $order_cancel_till = date("Y-m-d H:i:s", strtotime("+10 minutes"));
        $trans_date = date("d-m-Y H:i:s");

        $payment_type = "Cash On Delivery";
        $payment_status = "Payment not collected";
        $queryss = mysqli_query($con, "SELECT * from grret_shopstat where id=1");
        $rowss = mysqli_fetch_array($queryss);
        $order_number = $rowss['order_number'];
        $checkout = mysqli_query($con, "INSERT INTO grret_orders(ord_id, profile, cus_phone, cus_name, cus_address, mer_id, rec_sku, rec_name, rec_cuisine, rec_serving, rec_qty, rec_price, sub_total, discount_percentage, discount, new_cus_discount, sgst, cgst, del_charges, total_price, grcash, walletcash, final_amount, payment_type, payment_status, add_notes, del_time, del_time_real, order_at, order_cancel_till, ord_status, order_number, delivery_expected) VALUES ('$ord_id', '$profile', '$cus_phone', '$cus_name', '$cus_address', '$mer_id', '$rec_sku', '$rec_name', '$rec_cuisine', '$rec_serving', '$rec_qty', '$rec_price', '$sub_total', '$discount_percentage', '$discount', '$new_cus_discount', '$sgst', '$cgst', '$del_charges', '$total_price', '$grcash', '$walletcash', '$final_amount', '$payment_type', '$payment_status', '$add_notes', '$del_time[0]', '$del_time[1]', '$order_at', '$order_cancel_till', '$ord_status', '$order_number', '$del_time[2]')");
        $order_number++;
        if($checkout){
            mysqli_query($con, "UPDATE grret_shopstat set order_number = '$order_number' where id=1");

            $query1 = mysqli_query($con, "SELECT * from web_customers where phone = '$login_session1'");
            $row1 = mysqli_fetch_array($query1);
            $earned_money = $row1['earned_money'] - $grcash;
            $wallet = $row1['wallet'] - $grcash - $walletcash;
            mysqli_query($con, "UPDATE web_customers SET wallet = '$wallet', earned_money = '$earned_money' WHERE phone = '$login_session1'");

            $phone = mysqli_query($con, "SELECT * FROM grret_uniquecustomers where cus_phone='$login_session1'");
            $phone_count = mysqli_num_rows($phone);
            if($phone_count == 0){
                mysqli_query($con, "INSERT INTO grret_uniquecustomers(mer_id, cus_phone, cus_name, cus_address) VALUES ('$mer_id', '$login_session1', '$cus_name', '$cus_address')");
            }
//TRANSACTIONS..........
            $grcash_balance = $row1['earned_money'] - $grcash;
            $walletcash_balance = $row1['wallet'] - $row1['earned_money'] - $walletcash;
            $trans_date = date("d-m-Y H:i:s");
            $trans_type = "Debit";
            $trans_details = "Order Placed via Cash on delivery. Order id: ".$ord_id;
            $query3 = mysqli_query($con, "INSERT into web_transactions(cus_phone, trans_date, trans_type, trans_details, order_id, total_price, grcash_debit, grcash_balance, walletcash_debit, walletcash_balance, final_amount) VALUES('$profile', '$trans_date', '$trans_type', '$trans_details', '$ord_id', '$total_price', '$grcash', '$grcash_balance', '$walletcash', '$walletcash_balance', '$final_amount')");
//MESSAGE TO CUSTOMER...
            $cart->destroy();
            header("Location: myorders.php");
            die();
        } else {
            echo "Error: ".mysqli_error($con);
        }
    } else { 
        echo "Redirecting to secure payment gateway...... Please Wait.......";
        $mer_id = "androidapp";
        $ord_id = date("YmdHis").$mer_id;
        ?>
        <form method="post" action="payment/ccavRequestHandler.php">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
            <script type="text/javascript">
            window.onload = function() {
                var d = new Date().getTime();
                //console.log(d);
                document.getElementById("tid").value = d;
                setTimeout(function(){ $(".submit").click(); }, 2000);
            };
            </script>
            <table height="100" align="center" style="display: none;">
                <tr>
                    <td>Parameter Name:</td><td>Parameter Value:</td>
                </tr>
                <tr>
                    <td colspan="2"> Compulsory information</td>
                </tr>
                <tr>
                    <td>TID :</td><td><input type="text" name="tid" id="tid" readonly /></td>
                </tr>
                <tr>
                    <td>Merchant Id :</td><td><input type="text" name="merchant_id" value="128274"/></td>
                </tr>
                <tr>
                    <td>Order Id    :</td><td><input type="text" name="order_id" value="<?php echo $ord_id; ?>" readonly /></td>
                </tr>
                <tr>
                    <td></td><td>
                        Amount : <input type="text" name="amount" value="<?php echo $_POST['final_amount']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Currency    :</td><td><input type="text" name="currency" value="INR"/></td>
                </tr>
                <tr>
                    <td>Redirect URL    :</td><td><input type="text" name="redirect_url" value="http://groctaurant.com/payment/ccavResponseHandler.php"/></td>
                </tr>
                <tr>
                    <td>Cancel URL  :</td><td><input type="text" name="cancel_url" value="http://groctaurant.com/payment/ccavResponseHandler.php"/></td>
                </tr>
                <tr>
                    <td>Language    :</td><td><input type="text" name="language" value="EN"/></td>
                </tr>
                <tr>
                    <td colspan="2">Billing information(optional):</td>
                </tr>
                <tr>
                    <td>Billing Name    :</td><td><input type="text" name="billing_name" value="<?php echo $_POST['customer_name']; ?>"/></td>
                </tr>
                <tr>
                    <td>Billing Address :</td><td><input type="text" name="billing_address" value="<?php echo $_POST['add1'].', '.$_POST['add2']; ?>"/></td>
                </tr>
                <tr>
                    <td>Billing City    :</td><td><input type="text" name="billing_city" value="<?php echo $_POST['add3']; ?>"/></td>
                </tr>
                <tr>
                    <td>Billing State   :</td><td><input type="text" name="billing_state" value="Haryana"/></td>
                </tr>
                <tr>
                    <td>Billing Zip :</td><td><input type="text" name="billing_zip" value="121006"/></td>
                </tr>
                <tr>
                    <td>Billing Country :</td><td><input type="text" name="billing_country" value="India"/></td>
                </tr>
                <tr>
                    <td>Billing Tel :</td><td><input type="text" name="billing_tel" value="<?php echo $_POST['customer_phone']; ?>"/></td>
                </tr>
                <tr>
                    <td>Billing Email   :</td><td><input type="text" name="billing_email" value="test@groctaurant.com"/></td>
                </tr>
                <tr>
                    <td colspan="2">Shipping information(optional)</td>
                </tr>
                <tr>
                    <td>Shipping Name   :</td><td><input type="text" name="delivery_name" value="<?php echo $login_session; ?>"/></td>
                </tr>
                <tr>
                    <td>Shipping Address    :</td><td><input type="text" name="delivery_address" value="<?php echo $_POST['add1'].', '.$_POST['add2']; ?>"/></td>
                </tr>
                <tr>
                    <td>shipping City   :</td><td><input type="text" name="delivery_city" value="<?php echo $_POST['add3']; ?>"/></td>
                </tr>
                <tr>
                    <td>shipping State  :</td><td><input type="text" name="delivery_state" value="Haryana"/></td>
                </tr>
                <tr>
                    <td>shipping Zip    :</td><td><input type="text" name="delivery_zip" value="121006"/></td>
                </tr>
                <tr>
                    <td>shipping Country    :</td><td><input type="text" name="delivery_country" value="India"/></td>
                </tr>
                <tr>
                    <td>Shipping Tel    :</td><td><input type="text" name="delivery_tel" value="<?php echo $login_session1; ?>"/></td>
                </tr>
                <tr>
                    <td>Merchant Param1 :</td><td><input type="text" name="merchant_param1" value="Groctaurant"/></td>
                </tr>
                <tr>
                    <td>Merchant Param2 :</td><td><input type="text" name="merchant_param2" value="Website"/></td>
                </tr>
                <tr>
                    <td>Merchant Param3 :</td><td><input type="text" name="merchant_param3" value="additional Info."/></td>
                </tr>
                <tr>
                    <td>Merchant Param4 :</td><td><input type="text" name="merchant_param4" value="additional Info."/></td>
                </tr>
                <tr>
                    <td>Merchant Param5 :</td><td><input type="text" name="merchant_param5" value="additional Info."/></td>
                </tr>
                <tr>
                    <td>Promo Code  :</td><td><input type="text" name="promo_code" value=""/></td>
                </tr>
                <tr>
                    <td>Vault Info. :</td><td><input type="text" name="customer_identifier" value=""/></td>
                </tr>
                <tr>
                    <td>Integration Type :</td><td><input type="text" name="integration_type" value="iframe_normal"/></td>
                </tr>
            </table>
            <div style="display: none;">
            <?php 
            foreach ($_POST as $key => $value) { 
                if(is_array($value)){
                    for ($i=0; $i < count($value); $i++) { ?>
                        <input type="text" name='<?php echo $key; ?>[]' value="<?php echo $value[$i]; ?>"><br>
                    <?php
                    }
                } else { ?>
                    <input type="text" name="<?php echo $key; ?>" value="<?php echo $value; ?>"><br>
                <?php
                }
            } ?>
            
            <input class="submit" type="submit" name="submit" value="submit">
            </div>
        </form>
    <?php   
    }
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
