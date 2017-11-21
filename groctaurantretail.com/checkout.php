<?php
include('session.php');
?>
<?php
// include database configuration file
include 'db/config.php';

// initialize shopping cart class
include 'cart1.php';
$cart = new Cart;

// redirect to home if cart is empty
if($cart->total_items() <= 0){
    header("Location: shop.php");
    die();
}
if(isset($_POST['submit'])){

    if($_POST['payment'] == "Pay Via Wallet"){
        $query = mysqli_query($con, "SELECT * FROM grret_merchants WHERE mer_id = '$login_session' ");
        $merRow = mysqli_fetch_array($query);
        
        $total_price = $_POST['total_price'];
        if($merRow['mer_wallet'] < $total_price){
            echo '<script> alert("Insufficient Balance!!");
                 window.location="Cart.php"; </script>';   
        } else {
            if($_POST['delivery_time'] == null){
                $del_time = explode(",",$_POST['delivery_time_default']);
            } else {            
                $del_time = explode(",",$_POST['delivery_time']);
                $del_time[0] = "".$del_time[0]."(Pre-Order)";
            }
            if($_POST['new_cus_discount'] != null){
                $new_cus_discount = $_POST['new_cus_discount'];
            } else {
                $new_cus_discount = 0;
            }
            $sub_total = $_POST['sub_total'];
            $discount_percentage = $_POST['discount_percentage'];
            $discount = $_POST['pre_order_discount'];
            $sgst = $_POST['sgst'];
            $cgst = $_POST['cgst'];
            $del_charges = $_POST['del_charges'];

            $ord_id = $_POST['order_id'];
            $mer_id = $merRow['mer_id'];

            $cus_phone = test_input($_POST['customer_phone']);
            $cus_name = test_input($_POST['customer_name']);
            $cus_address = $_POST['customer_address'];

            if (!preg_match("/^[0-9]{10}$/",$cus_phone) || !preg_match("/^[a-zA-Z ]*$/",$cus_name) || empty($cus_name) || empty($cus_address)) {
              echo '<script> alert("Invalid Customer Phone Number or Customer Name!!");
                 window.location="Cart.php"; </script>';
            } else {
    //FOR JSON
                $rec_skuj = $_POST['rec_sku'];
                $rec_namej = $_POST['rec_name'];
                $rec_servingj = $_POST['rec_serving'];
                $rec_qtyj = $_POST['rec_qty'];
                $countj = count($rec_skuj);
    //END
                $rec_sku = implode(', ', $_POST['rec_sku']);
                $rec_name = implode(', ', $_POST['rec_name']);
                $rec_cuisine = implode(', ', $_POST['rec_cuisine']);
                $rec_serving = implode(', ', $_POST['rec_serving']);
                $rec_qty = implode(', ', $_POST['rec_qty']);
                $rec_price = implode(', ', $_POST['rec_price']);
              
                if($_POST['notes'] == null){
                    $add_notes = null;
                } else {
                    $add_notes = implode(', ', $_POST['notes']);
                }

                $query2 = mysqli_query($con,"SELECT ord_acc FROM grret_ordersautoaccept WHERE id = 1");
                $row2 = mysqli_fetch_array($query2);
                $order1 = $row2['ord_acc'];

                    $ord_status = "Under Review";
                
                date_default_timezone_set("Asia/Kolkata");
                $order_at = date("Y-m-d H:i:s");
                $order_cancel_till = date("Y-m-d H:i:s", strtotime("+10 minutes"));
                // $updated_at = date("Y-m-d H:i:s");
                $trans_date = date("d-m-Y H:i:s");
                $payment_type = "Pay Via Wallet";
                $queryss = mysqli_query($con, "SELECT * from grret_shopstat where id=1");
                $rowss = mysqli_fetch_array($queryss);
                $order_number = $rowss['order_number'];
                $checkout = mysqli_query($con, "INSERT INTO grret_orders(ord_id, cus_phone, cus_name, cus_address, mer_id, rec_sku, rec_name, rec_cuisine, rec_serving, rec_qty, rec_price, sub_total, discount_percentage, discount, new_cus_discount, sgst, cgst, del_charges, total_price, final_amount, payment_type, add_notes, del_time, del_time_real, order_at, order_cancel_till, ord_status, order_number, delivery_expected) VALUES ('$ord_id', '$cus_phone', '$cus_name', '$cus_address', '$mer_id', '$rec_sku', '$rec_name', '$rec_cuisine', '$rec_serving', '$rec_qty', '$rec_price', '$sub_total', '$discount_percentage', '$discount', '$new_cus_discount', '$sgst', '$cgst', '$del_charges', '$total_price', '$total_price', '$payment_type', '$add_notes', '$del_time[0]', '$del_time[1]', '$order_at', '$order_cancel_till', '$ord_status', '$order_number', '$del_time[2]')");
                $order_number++;
                if($checkout){
                    mysqli_query($con, "UPDATE grret_shopstat set order_number = '$order_number' where id=1");
                }  

                
                    $msg="Your order been placed successfully. Expected Delivery: ".$del_time[0].". Enjoy the meal!";
                
                if($checkout){
                    $phone = mysqli_query($con, "SELECT * FROM grret_customers where cus_phone='$cus_phone' and cus_name='$cus_name' and cus_address='$cus_address' ");
                    $phone_count = mysqli_num_rows($phone);
                    $phone1 = mysqli_query($con, "SELECT * FROM grret_uniquecustomers where cus_phone='$cus_phone'");
                    $phone_count1 = mysqli_num_rows($phone1);
                    
                    if($phone_count > 0){

                    } else {
                        mysqli_query($con, "INSERT INTO grret_customers(mer_id, cus_phone, cus_name, cus_address) VALUES ('$mer_id', '$cus_phone', '$cus_name', '$cus_address')");
                    }

                    $trans_type = "Order Placed(".$ord_id.")";
                    $new_cus = $cus_name."(".$cus_phone.")";
                    $mer_wallet = $merRow['mer_wallet'] - $total_price;
                    
                    if($phone_count1 > 0){
                        
                        mysqli_query($con, "INSERT INTO grret_transactions(mer_id, trans_date, trans_type, debit, balance) VALUES ('$mer_id', '$trans_date', '$trans_type', '$total_price', '$mer_wallet')");
                    } else {
                        mysqli_query($con, "INSERT INTO grret_uniquecustomers(mer_id, cus_phone) VALUES ('$mer_id', '$cus_phone')");
                        
                        mysqli_query($con, "INSERT INTO grret_transactions(mer_id, trans_date, trans_type, debit, balance) VALUES ('$mer_id', '$trans_date', '$trans_type', '$total_price', '$mer_wallet')");
                        $mer_wallet = $mer_wallet + 30;
                        $earn = 30;
                        $trans_type = "New Customer-".$new_cus."(".$ord_id.")";
                        mysqli_query($con, "INSERT INTO grret_transactions(mer_id, trans_date, trans_type, credit, balance) VALUES ('$mer_id', '$trans_date', '$trans_type', '$earn', '$mer_wallet')");
                    }
                    
                    mysqli_query($con, "UPDATE grret_merchants SET mer_wallet = '$mer_wallet' WHERE mer_id= '$mer_id'");

                    $apikey = "3KMJk4xXKkKMZQR2se46YA";
                    $apisender = "GRFOOD";
                    $num = $cus_phone;    // MULTIPLE NUMBER VARIABLE PUT HERE...!                 
                    $ms = rawurlencode($msg);   //This for encode your message content                         
                    $url = 'https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey='.$apikey.'&senderid='.$apisender.'&channel=2&DCS=0&flashsms=0&number='.$num.'&text='.$ms.'&route=1';
                    //echo $url;
                    $ch=curl_init($url);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch,CURLOPT_POST,1);
                    curl_setopt($ch,CURLOPT_POSTFIELDS,"");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER,2);
                    $data = curl_exec($ch);

                //destroy cart
                    $cart->destroy();
                    header("Location: myorders.php");
                } else {
                    echo mysqli_error($con);
                    die("error");
                }
            }  
        }

// Pay vai cash for loan wallet
    } else if($_POST['payment'] == "Pay Via Loan Wallet") {

        $query = mysqli_query($con, "SELECT * FROM grret_merchants WHERE mer_id = '$login_session' ");
        $merRow = mysqli_fetch_array($query);
        $total_price = $_POST['total_price'];
        $newloan = $merRow['mer_loanwallet'] + $total_price;
        //$sub_total += $new_cus_discount;
        if($merRow['credit_limit'] < $newloan){
            echo '<script> alert("Credit Limit Exceeding!!");
                 window.location="Cart.php"; </script>';
            if($newloan > (80*$merRow['credit_limit'])/100){
                $msg1 = "You are near your Credit limit. Please pay ₹".$newloan." now to continue shopping with Groctaurant. Remaining Credit: ₹".($merRow['credit_limit']-$newloan).". ";

                date_default_timezone_set("Asia/Kolkata");
                $not_time = date("Y-m-d H:i:s");
                $mer_id = $merRow['mer_id'];
                $notification = "Merchant (id-".$merRow['mer_id'].") is near his credit limit. Remaining Credit: ₹".($merRow['credit_limit']-$newloan).".";
                $not_status = "Unread";

                mysqli_query($con, "INSERT INTO grret_notifications(mer_id, notification, not_status, not_time) VALUES ('$mer_id', '$notification', '$not_status', '$not_time')");

                $apikey = "3KMJk4xXKkKMZQR2se46YA";
                $apisender = "GRFOOD";
                $num = $merRow['mer_phone'];    // MULTIPLE NUMBER VARIABLE PUT HERE...!                 
                $ms = rawurlencode($msg1);   //This for encode your message content                         
                $url = 'https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey='.$apikey.'&senderid='.$apisender.'&channel=2&DCS=0&flashsms=0&number='.$num.'&text='.$ms.'&route=1';
                //echo $url;
                $ch=curl_init($url);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch,CURLOPT_POST,1);
                curl_setopt($ch,CURLOPT_POSTFIELDS,"");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,2);
                $data = curl_exec($ch);
            }
            
        } else {
            if($_POST['delivery_time'] == null){
                $del_time = explode(",",$_POST['delivery_time_default']);
            } else {            
                $del_time = explode(",",$_POST['delivery_time']);
                $del_time[0] = "".$del_time[0]."(Pre-Order)";
            }
            if($_POST['new_cus_discount'] != null){
                $new_cus_discount = $_POST['new_cus_discount'];
            } else {
                $new_cus_discount = 0;
            }
            $sub_total = $_POST['sub_total'];
            $discount_percentage = $_POST['discount_percentage'];
            $discount = $_POST['pre_order_discount'];
            $sgst = $_POST['sgst'];
            $cgst = $_POST['cgst'];
            $del_charges = $_POST['del_charges'];

            $ord_id = $_POST['order_id'];
            $mer_id = $merRow['mer_id'];

            $cus_phone = test_input($_POST['customer_phone']);
            $cus_name = test_input($_POST['customer_name']);
            $cus_address = $_POST['customer_address'];

            if (!preg_match("/^[0-9]{10}$/",$cus_phone) || !preg_match("/^[a-zA-Z ]*$/",$cus_name) || empty($cus_name) || empty($cus_address)) {
              echo '<script> alert("Invalid Customer Phone Number or Customer Name!!");
                 window.location="Cart.php"; </script>';
            } else {    
    //FOR JSON
                $rec_skuj = $_POST['rec_sku'];
                $rec_namej = $_POST['rec_name'];
                $rec_servingj = $_POST['rec_serving'];
                $rec_qtyj = $_POST['rec_qty'];
                $countj = count($rec_skuj);
    //END
                $rec_sku = implode(', ', $_POST['rec_sku']);
                $rec_name = implode(', ', $_POST['rec_name']);
                $rec_cuisine = implode(', ', $_POST['rec_cuisine']);
                $rec_serving = implode(', ', $_POST['rec_serving']);
                $rec_qty = implode(', ', $_POST['rec_qty']);
                $rec_price = implode(', ', $_POST['rec_price']);
              
                if($_POST['notes'] == null){
                    $add_notes = null;
                } else {
                    $add_notes = implode(', ', $_POST['notes']);
                }

                $query2 = mysqli_query($con,"SELECT ord_acc FROM grret_ordersautoaccept WHERE id = 1");
                $row2 = mysqli_fetch_array($query2);
                $order1 = $row2['ord_acc'];
                    $ord_status = "Under Review";

                date_default_timezone_set("Asia/Kolkata");
                // $created_at = date("Y-m-d H:i:s");
                // $updated_at = date("Y-m-d H:i:s");
                $order_at = date("Y-m-d H:i:s");
                $order_cancel_till = date("Y-m-d H:i:s");
                $trans_date = date("d-m-Y H:i:s");
                $payment_type = "Pay Via Loan Wallet";
                $payment_status = "Unpaid";
                $queryss = mysqli_query($con, "SELECT * from grret_shopstat where id=1");
                $rowss = mysqli_fetch_array($queryss);
                $order_number = $rowss['order_number'];
                $checkout = mysqli_query($con, "INSERT INTO grret_orders(ord_id, cus_phone, cus_name, cus_address, mer_id, rec_sku, rec_name, rec_cuisine, rec_serving, rec_qty, rec_price, sub_total, discount_percentage, discount, new_cus_discount, sgst, cgst, del_charges, total_price, final_amount, payment_type, payment_status, add_notes, del_time, del_time_real, order_at, order_cancel_till, ord_status, order_number, delivery_expected) VALUES ('$ord_id', '$cus_phone', '$cus_name', '$cus_address', '$mer_id', '$rec_sku', '$rec_name', '$rec_cuisine', '$rec_serving', '$rec_qty', '$rec_price', '$sub_total', '$discount_percentage', '$discount', '$new_cus_discount', '$sgst', '$cgst', '$del_charges', '$total_price', '$total_price', '$payment_type', '$payment_status', '$add_notes', '$del_time[0]', '$del_time[1]', '$order_at', '$order_cancel_till', '$ord_status', '$order_number', '$del_time[2]')");
                $order_number++;
                if($checkout){
                    mysqli_query($con, "UPDATE grret_shopstat set order_number = '$order_number' where id=1");
                }
                
                    $msg="Your order been placed successfully. Expected Delivery: ".$del_time[0].". Enjoy the meal!";
                if($checkout){
                    $phone = mysqli_query($con, "SELECT * FROM grret_customers where cus_phone='$cus_phone' and cus_name='$cus_name' and cus_address='$cus_address' ");
                    $phone_count = mysqli_num_rows($phone);
                    $phone1 = mysqli_query($con, "SELECT * FROM grret_uniquecustomers where cus_phone='$cus_phone'");
                    $phone_count1 = mysqli_num_rows($phone1);
                    
                    if($phone_count > 0){

                    } else {
                        mysqli_query($con, "INSERT INTO grret_customers(mer_id, cus_phone, cus_name, cus_address) VALUES ('$mer_id', '$cus_phone', '$cus_name', '$cus_address')");
                    }

                    $trans_type = "Order Placed(".$ord_id.")";
                    $new_cus = $cus_name."(".$cus_phone.")";
                    $mer_loanwallet = $merRow['mer_loanwallet'] + $total_price;
                    
                    if($phone_count1 > 0){
                        $mer_wallet = $merRow['mer_wallet'];
                        mysqli_query($con, "INSERT INTO grret_loantransactions(mer_id, trans_date, trans_type, credit, loan) VALUES ('$mer_id', '$trans_date', '$trans_type', '$total_price', '$mer_loanwallet')");
                    } else {
                        mysqli_query($con, "INSERT INTO grret_uniquecustomers(mer_id, cus_phone) VALUES ('$mer_id', '$cus_phone')");
                        
                        mysqli_query($con, "INSERT INTO grret_loantransactions(mer_id, trans_date, trans_type, credit, loan) VALUES ('$mer_id', '$trans_date', '$trans_type', '$total_price', '$mer_loanwallet')");
                        $mer_wallet = $merRow['mer_wallet'] + 30;
                        $earn = 30;
                        $trans_type = "New Customer-".$new_cus."(".$ord_id.")";
                        mysqli_query($con, "INSERT INTO grret_transactions(mer_id, trans_date, trans_type, credit, balance) VALUES ('$mer_id', '$trans_date', '$trans_type', '$earn', '$mer_wallet')");
                        
                    }

                    mysqli_query($con, "UPDATE grret_merchants SET mer_loanwallet = '$mer_loanwallet', mer_wallet = '$mer_wallet' WHERE mer_id= '$mer_id'");

                    $apikey = "3KMJk4xXKkKMZQR2se46YA";
                    $apisender = "GRFOOD";
                    $num = $cus_phone;    // MULTIPLE NUMBER VARIABLE PUT HERE...!                 
                    $ms = rawurlencode($msg);   //This for encode your message content                         
                    $url = 'https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey='.$apikey.'&senderid='.$apisender.'&channel=2&DCS=0&flashsms=0&number='.$num.'&text='.$ms.'&route=1';
                    //echo $url;
                    $ch=curl_init($url);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch,CURLOPT_POST,1);
                    curl_setopt($ch,CURLOPT_POSTFIELDS,"");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER,2);
                    $data = curl_exec($ch);

                    //cart destroy
                    $cart->destroy();
                    header("Location: myorders.php");
                }else{
                    echo mysqli_error($con);
                    die("error");
                }
            }
        } 

// EAZY EAZY EAZY
    } else if($_POST['payment'] == "Pay Via Eazy Wallet")  {
        $query = mysqli_query($con, "SELECT * FROM grret_merchants WHERE mer_id = '$login_session' ");
        $merRow = mysqli_fetch_array($query);
        $total_price = $_POST['total_price'];

        if($_POST['delivery_time'] == null){
            $del_time = explode(",",$_POST['delivery_time_default']);
        } else {            
            $del_time = explode(",",$_POST['delivery_time']);
            $del_time[0] = "".$del_time[0]."(Pre-Order)";
        }
        if($_POST['new_cus_discount'] != null){
            $new_cus_discount = $_POST['new_cus_discount'];
        } else {
            $new_cus_discount = 0;
        }
        $sub_total = $_POST['sub_total'];
        $discount_percentage = $_POST['discount_percentage'];
        $discount = $_POST['pre_order_discount'];
        $sgst = $_POST['sgst'];
        $cgst = $_POST['cgst'];
        $del_charges = $_POST['del_charges'];
	$eazy_card_no = $_POST['eazy_card_no'];
        $ord_id = $_POST['order_id'];
        $mer_id = $merRow['mer_id'];

        $cus_phone = test_input($_POST['customer_phone']);
        $cus_name = test_input($_POST['customer_name']);
        $cus_address = $_POST['customer_address'];

        if (!preg_match("/^[0-9]{10}$/",$cus_phone) || !preg_match("/^[a-zA-Z ]*$/",$cus_name) || empty($cus_name) || empty($cus_address)) {
          echo '<script> alert("Invalid Customer Phone Number or Customer Name!!");
             window.location="Cart.php"; </script>';
        } else {
//FOR JSON
            $rec_skuj = $_POST['rec_sku'];
            $rec_namej = $_POST['rec_name'];
            $rec_servingj = $_POST['rec_serving'];
            $rec_qtyj = $_POST['rec_qty'];
            $countj = count($rec_skuj);
//END
            $rec_sku = implode(', ', $_POST['rec_sku']);
            $rec_name = implode(', ', $_POST['rec_name']);
            $rec_cuisine = implode(', ', $_POST['rec_cuisine']);
            $rec_serving = implode(', ', $_POST['rec_serving']);
            $rec_qty = implode(', ', $_POST['rec_qty']);
            $rec_price = implode(', ', $_POST['rec_price']);
          
            if($_POST['notes'] == null){
                $add_notes = null;
            } else {
                $add_notes = implode(', ', $_POST['notes']);
            }

            $query2 = mysqli_query($con,"SELECT ord_acc FROM grret_ordersautoaccept WHERE id = 1");
            $row2 = mysqli_fetch_array($query2);
            $order1 = $row2['ord_acc'];

                $ord_status = "Under Review";

            date_default_timezone_set("Asia/Kolkata");
            $order_at = date("Y-m-d H:i:s");
            $order_cancel_till = date("Y-m-d H:i:s", strtotime("+10 minutes"));
            // $updated_at = date("Y-m-d H:i:s");
            $trans_date = date("d-m-Y H:i:s");
            $payment_type = "Pay Via Eazy Wallet";
            $payment_status = "Paid via Eazy";
            $queryss = mysqli_query($con, "SELECT * from grret_shopstat where id=1");
            $rowss = mysqli_fetch_array($queryss);
            $order_number = $rowss['order_number'];
            $checkout = mysqli_query($con, "INSERT INTO grret_orders(ord_id, profile, cus_phone, cus_name, cus_address, mer_id, rec_sku, rec_name, rec_cuisine, rec_serving, rec_qty, rec_price, sub_total, discount_percentage, discount, new_cus_discount, sgst, cgst, del_charges, total_price, final_amount, payment_type, payment_status, add_notes, del_time, del_time_real, order_at, order_cancel_till, ord_status, order_number, delivery_expected, eazy_card_no) VALUES ('$ord_id', '$cus_phone', '$cus_phone', '$cus_name', '$cus_address', '$mer_id', '$rec_sku', '$rec_name', '$rec_cuisine', '$rec_serving', '$rec_qty', '$rec_price', '$sub_total', '$discount_percentage', '$discount', '$new_cus_discount', '$sgst', '$cgst', '$del_charges', '$total_price', '$total_price', '$payment_type', '$payment_status', '$add_notes', '$del_time[0]', '$del_time[1]', '$order_at', '$order_cancel_till', '$ord_status', '$order_number', '$del_time[2]', '$eazy_card_no')");
            $order_number++;
            if($checkout){
                mysqli_query($con, "UPDATE grret_shopstat set order_number = '$order_number' where id=1");
            } 

                $msg="Your order been placed successfully. Expected Delivery: ".$del_time[0].". Enjoy the meal!";

            if($checkout){
                $phone = mysqli_query($con, "SELECT * FROM grret_customers where cus_phone='$cus_phone' and cus_name='$cus_name' and cus_address='$cus_address' ");
                $phone_count = mysqli_num_rows($phone);
                $phone1 = mysqli_query($con, "SELECT * FROM grret_uniquecustomers where cus_phone='$cus_phone'");
                $phone_count1 = mysqli_num_rows($phone1);
                
                if($phone_count > 0){

                } else {
                    mysqli_query($con, "INSERT INTO grret_customers(mer_id, cus_phone, cus_name, cus_address) VALUES ('$mer_id', '$cus_phone', '$cus_name', '$cus_address')");
                }

                $trans_type = "Order Placed(".$ord_id.")-EAZY Wallet";
                $new_cus = $cus_name."(".$cus_phone.")";
                $mer_wallet = $merRow['mer_wallet'];
                $debit = 0;
                
                if($phone_count1 > 0){
                    
                    mysqli_query($con, "INSERT INTO grret_transactions(mer_id, trans_date, trans_type, debit, balance) VALUES ('$mer_id', '$trans_date', '$trans_type', '$debit', '$mer_wallet')");
                } else {
                    mysqli_query($con, "INSERT INTO grret_uniquecustomers(mer_id, cus_phone) VALUES ('$mer_id', '$cus_phone')");
                    
                    mysqli_query($con, "INSERT INTO grret_transactions(mer_id, trans_date, trans_type, debit, balance) VALUES ('$mer_id', '$trans_date', '$trans_type', '$debit', '$mer_wallet')");
                    $mer_wallet = $mer_wallet + 30;
                    $earn = 30;
                    $trans_type = "New Customer-".$new_cus."(".$ord_id.")";
                    mysqli_query($con, "INSERT INTO grret_transactions(mer_id, trans_date, trans_type, credit, balance) VALUES ('$mer_id', '$trans_date', '$trans_type', '$earn', '$mer_wallet')");
                }

                mysqli_query($con, "UPDATE grret_merchants SET mer_wallet = '$mer_wallet' WHERE mer_id= '$mer_id'");
                
                $query_cus = mysqli_query($con, "SELECT * from web_customers where phone = '$cus_phone'");
                $row_cus = mysqli_fetch_array($query_cus);
            	$walletcash_balance = $row_cus['wallet'] - $total_price;
            	$trans_type = "Debit";
            	$trans_details = "Order Placed. Order id: ".$ord_id;
            	mysqli_query($con, "INSERT into web_transactions(cus_phone, trans_date, trans_type, trans_details, order_id, total_price, walletcash_debit, walletcash_balance) VALUES('$cus_phone', '$trans_date', '$trans_type', '$trans_details', '$ord_id', '$total_price', '$total_price', '$walletcash_balance')");
            	mysqli_query($con, "UPDATE web_customers set wallet = '$walletcash_balance' where phone = '$cus_phone'");

                $apikey = "3KMJk4xXKkKMZQR2se46YA";
                $apisender = "GRFOOD";
                $num = $cus_phone;    // MULTIPLE NUMBER VARIABLE PUT HERE...!                 
                $ms = rawurlencode($msg);   //This for encode your message content                         
                $url = 'https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey='.$apikey.'&senderid='.$apisender.'&channel=2&DCS=0&flashsms=0&number='.$num.'&text='.$ms.'&route=1';
                    //echo $url;
                $ch=curl_init($url);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch,CURLOPT_POST,1);
                curl_setopt($ch,CURLOPT_POSTFIELDS,"");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,2);
                $data = curl_exec($ch);

                //cart destroy
                $cart->destroy();
                header("Location: myorders.php");
            }else{
                echo mysqli_error($con);
                die("error");
            }
        }
// COD COD COD COD 
    } else {
        $query = mysqli_query($con, "SELECT * FROM grret_merchants WHERE mer_id = '$login_session' ");
        $merRow = mysqli_fetch_array($query);
        $total_price = $_POST['total_price'];

        if($_POST['delivery_time'] == null){
            $del_time = explode(",",$_POST['delivery_time_default']);
        } else {            
            $del_time = explode(",",$_POST['delivery_time']);
            $del_time[0] = "".$del_time[0]."(Pre-Order)";
        }
        if($_POST['new_cus_discount'] != null){
            $new_cus_discount = $_POST['new_cus_discount'];
        } else {
            $new_cus_discount = 0;
        }
        $sub_total = $_POST['sub_total'];
        $discount_percentage = $_POST['discount_percentage'];
        $discount = $_POST['pre_order_discount'];
        $sgst = $_POST['sgst'];
        $cgst = $_POST['cgst'];
        $del_charges = $_POST['del_charges'];

        $ord_id = $_POST['order_id'];
        $mer_id = $merRow['mer_id'];

        $cus_phone = test_input($_POST['customer_phone']);
        $cus_name = test_input($_POST['customer_name']);
        $cus_address = $_POST['customer_address'];

        if (!preg_match("/^[0-9]{10}$/",$cus_phone) || !preg_match("/^[a-zA-Z ]*$/",$cus_name) || empty($cus_name) || empty($cus_address)) {
          echo '<script> alert("Invalid Customer Phone Number or Customer Name!!");
             window.location="Cart.php"; </script>';
        } else {
//FOR JSON
            $rec_skuj = $_POST['rec_sku'];
            $rec_namej = $_POST['rec_name'];
            $rec_servingj = $_POST['rec_serving'];
            $rec_qtyj = $_POST['rec_qty'];
            $countj = count($rec_skuj);
//END
            $rec_sku = implode(', ', $_POST['rec_sku']);
            $rec_name = implode(', ', $_POST['rec_name']);
            $rec_cuisine = implode(', ', $_POST['rec_cuisine']);
            $rec_serving = implode(', ', $_POST['rec_serving']);
            $rec_qty = implode(', ', $_POST['rec_qty']);
            $rec_price = implode(', ', $_POST['rec_price']);
          
            if($_POST['notes'] == null){
                $add_notes = null;
            } else {
                $add_notes = implode(', ', $_POST['notes']);
            }

            $query2 = mysqli_query($con,"SELECT ord_acc FROM grret_ordersautoaccept WHERE id = 1");
            $row2 = mysqli_fetch_array($query2);
            $order1 = $row2['ord_acc'];

                $ord_status = "Under Review";

            date_default_timezone_set("Asia/Kolkata");
            $order_at = date("Y-m-d H:i:s");
            $order_cancel_till = date("Y-m-d H:i:s", strtotime("+10 minutes"));
            // $updated_at = date("Y-m-d H:i:s");
            $trans_date = date("d-m-Y H:i:s");
            $payment_type = "Cash On Delivery";
            $payment_status = "Payment not collected";
            $queryss = mysqli_query($con, "SELECT * from grret_shopstat where id=1");
            $rowss = mysqli_fetch_array($queryss);
            $order_number = $rowss['order_number'];
            $checkout = mysqli_query($con, "INSERT INTO grret_orders(ord_id, cus_phone, cus_name, cus_address, mer_id, rec_sku, rec_name, rec_cuisine, rec_serving, rec_qty, rec_price, sub_total, discount_percentage, discount, new_cus_discount, sgst, cgst, del_charges, total_price, final_amount, payment_type, payment_status, add_notes, del_time, del_time_real, order_at, order_cancel_till, ord_status, order_number, delivery_expected) VALUES ('$ord_id', '$cus_phone', '$cus_name', '$cus_address', '$mer_id', '$rec_sku', '$rec_name', '$rec_cuisine', '$rec_serving', '$rec_qty', '$rec_price', '$sub_total', '$discount_percentage', '$discount', '$new_cus_discount', '$sgst', '$cgst', '$del_charges', '$total_price', '$total_price', '$payment_type', '$payment_status', '$add_notes', '$del_time[0]', '$del_time[1]', '$order_at', '$order_cancel_till', '$ord_status', '$order_number', '$del_time[2]')");
            $order_number++;
            if($checkout){
                mysqli_query($con, "UPDATE grret_shopstat set order_number = '$order_number' where id=1");
            }
                $msg="Your order been placed successfully. Expected Delivery: ".$del_time[0].". Enjoy the meal!";
           
            if($checkout){
                $phone = mysqli_query($con, "SELECT * FROM grret_customers where cus_phone='$cus_phone' and cus_name='$cus_name' and cus_address='$cus_address' ");
                $phone_count = mysqli_num_rows($phone);
                $phone1 = mysqli_query($con, "SELECT * FROM grret_uniquecustomers where cus_phone='$cus_phone'");
                $phone_count1 = mysqli_num_rows($phone1);
                
                if($phone_count > 0){

                } else {
                    mysqli_query($con, "INSERT INTO grret_customers(mer_id, cus_phone, cus_name, cus_address) VALUES ('$mer_id', '$cus_phone', '$cus_name', '$cus_address')");
                }

                $trans_type = "Order Placed(".$ord_id.")- COD";
                $new_cus = $cus_name."(".$cus_phone.")";
                $mer_wallet = $merRow['mer_wallet'];
                $debit = 0;
                
                if($phone_count1 > 0){
                    
                    mysqli_query($con, "INSERT INTO grret_transactions(mer_id, trans_date, trans_type, debit, balance) VALUES ('$mer_id', '$trans_date', '$trans_type', '$debit', '$mer_wallet')");
                } else {
                    mysqli_query($con, "INSERT INTO grret_uniquecustomers(mer_id, cus_phone) VALUES ('$mer_id', '$cus_phone')");
                    
                    mysqli_query($con, "INSERT INTO grret_transactions(mer_id, trans_date, trans_type, debit, balance) VALUES ('$mer_id', '$trans_date', '$trans_type', '$debit', '$mer_wallet')");
                    $mer_wallet = $mer_wallet + 30;
                    $earn = 30;
                    $trans_type = "New Customer-".$new_cus."(".$ord_id.")";
                    mysqli_query($con, "INSERT INTO grret_transactions(mer_id, trans_date, trans_type, credit, balance) VALUES ('$mer_id', '$trans_date', '$trans_type', '$earn', '$mer_wallet')");
                }

                mysqli_query($con, "UPDATE grret_merchants SET mer_wallet = '$mer_wallet' WHERE mer_id= '$mer_id'");

                $apikey = "3KMJk4xXKkKMZQR2se46YA";
                $apisender = "GRFOOD";
                $num = $cus_phone;    // MULTIPLE NUMBER VARIABLE PUT HERE...!                 
                $ms = rawurlencode($msg);   //This for encode your message content                         
                $url = 'https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey='.$apikey.'&senderid='.$apisender.'&channel=2&DCS=0&flashsms=0&number='.$num.'&text='.$ms.'&route=1';
                    //echo $url;
                $ch=curl_init($url);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch,CURLOPT_POST,1);
                curl_setopt($ch,CURLOPT_POSTFIELDS,"");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,2);
                $data = curl_exec($ch);

                //cart destroy
                $cart->destroy();
                header("Location: myorders.php");
            }else{
                echo mysqli_error($con);
                die("error");
            }
        }
    }   
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>