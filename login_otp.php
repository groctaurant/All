<?php 
include 'config.php';
if(isset($_POST['login'])){
$phone = $_POST['login'];
$sql    = "SELECT * FROM web_customers WHERE phone = '$phone'";
$result = mysqli_query($con,$sql);
$row    = mysqli_fetch_array($result, MYSQLI_ASSOC);
$count = mysqli_num_rows($result);
    if ($count == 1) {
        setcookie('login_user', $row['name'], time() + (86400 * 365), "/");
        setcookie('login_phone', $row['phone'], time() + (86400 * 365), "/");
    }
}
?>