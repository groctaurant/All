<?php 
include 'config.php';
session_start();
date_default_timezone_set("Asia/Kolkata");
$signup_time = date("Y-m-d H:i:s");
if(isset($_POST['submit'])){
    $trans_date = date("d-m-Y H:i:s");
    $name=test_input($_POST['name']);
    $namex = str_replace(" ", "_", $name);
    $phone=test_input($_POST['phone']);
    $email=test_input($_POST['email']);
    $password=test_input($_POST['password']);
 
    if (!preg_match("/^[7-9][0-9]{9}$/",$phone) || !preg_match("/^[a-zA-Z ]*$/",$name) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script> alert("Invalid Phone Number or Name or Email!!");
           window.location="signup.php"; </script>';
           die();
    } else {
        $query_check = mysqli_query($con, "SELECT * from web_customers where phone = '$phone'");
        $count_check = mysqli_num_rows($query);
        if($count_check == 0){
            $wallet = 0;
            $wallet_wallet = 0;
            $wallet_total = $wallet + $wallet_wallet;
            $applied_code = null;
            if(!empty($_POST['referral'])){
                $applied_code = $_POST['referral'];
                $query1 = mysqli_query($con, "SELECT * from web_customers where referral_code = '$applied_code'");
                $count1 = mysqli_num_rows($query1);
                $count2 = 0;
                if($count1==1){
                    $row1 = mysqli_fetch_array($query1);
                    $count2 = $row1['referral_count'];
                    $wallet = 400;
                    $wallet_wallet = 100;
                    $wallet_total = $wallet + $wallet_wallet;
                }
            }
            
            $referral = referral();
            $query = mysqli_query($con, "SELECT * from web_customers where referral_code = '$referral'");
            $count = mysqli_num_rows($query);
            while($count){
                $referral = referral();
                $query = mysqli_query($con, "SELECT * from web_customers where referral_code = '$referral'");
                $count = mysqli_num_rows($query);
            }
            
            if(!empty($_FILES["image"]["name"])){
                $target_dir = "profile/";
                $extension = end(explode(".", $_FILES["image"]["name"]));
                $target_file = $target_dir . $referral . "_" . $namex .".". $extension;
                $uploadOk = 1;
                
                if ($uploadOk == 0) {
                    echo "Sorry, your image was not uploaded.";
                    die();
                } else {
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    } else {
                        echo "Sorry, there was an error uploading your Image.";
                        die();
                    }
                }
                $query_cus = mysqli_query($con, "INSERT INTO web_customers(name, phone, image, email, password, applied_code, referral_code, wallet, earned_money, signup_time) VALUES ('$name', '$phone', '$target_file', '$email', '$password', '$applied_code', '$referral', '$wallet_total', '$wallet', '$signup_time')");
            } else {
                $query_cus = mysqli_query($con, "INSERT INTO web_customers(name, phone, email, password, applied_code, referral_code, wallet, earned_money, signup_time) VALUES ('$name', '$phone', '$email', '$password', '$applied_code', '$referral', '$wallet_total', '$wallet', '$signup_time')");
            }
            if($query_cus){
                if($wallet_total != 0){
                    $trans_type="Credit";
                    $trans_details="Referral used amount";
                    mysqli_query($con, "INSERT into web_transactions(cus_phone, trans_date, trans_type, trans_details, grcash_credit, grcash_balance, walletcash_credit, walletcash_balance) VALUES('$phone', '$trans_date', '$trans_type', '$trans_details', '$wallet', '$wallet', '$wallet_wallet', '$wallet_wallet')");
                }
                if($count1 == 1 && $count2 < 50){
                    $phone1 = $row1['phone'];
                    $wallet_old = $row1['wallet'];
                    $earned_money_old = $row1['earned_money'];
                    $referral_count = $row1['referral_count'];
                    $money = 250;
                    $money_wallet = 0;
                    $wallet_new = $wallet_old + $money + $money_wallet;
                    $wallet_new_balance = ($wallet_old - $earned_money_old) + $money_wallet;
                    $earned_money_new = $earned_money_old + $money;
                    $referral_count++;
                    $trans_type = "Credit";
                    $trans_details = "Referred by ".$name."";
                    mysqli_query($con, "UPDATE web_customers set wallet = '$wallet_new', earned_money = '$earned_money_new', referral_count = '$referral_count' where referral_code = '$applied_code'");
                    mysqli_query($con, "INSERT into web_transactions(cus_phone, trans_date, trans_type, trans_details, grcash_credit, grcash_balance, walletcash_credit, walletcash_balance) VALUES('$phone1', '$trans_date', '$trans_type', '$trans_details', '$money', '$earned_money_new', '$money_wallet', '$wallet_new_balance')");
                } 
                mysqli_close($con);
                
                setcookie('login_user',$name, time() + (86400 * 365), "/");
                setcookie('login_phone',$phone, time() + (86400 * 365), "/");
            }  
            echo '<script>window.location="index.php"; window.close();
            window.opener.location.reload(); </script>';
            //header('Location: chef-la-pumb.php');
        }
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function referral(){
    $string = 'aefghSTUVWXijklmn123opqrstuvwxyz04FGHIJKL56789ABCDEMbcdNOPQRYZ';
    $string_shuffled = str_shuffle($string);
    $referral = substr($string_shuffled, 6, 9);
    return $referral;
}

?>