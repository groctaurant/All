<?php    
session_start(); 
session_destroy();
setcookie('login_user', "", time() - 3600 , "/");
setcookie('login_phone', "", time() - 3600 , "/");
if(isset($_SERVER['HTTP_REFERER'])) {
 header('Location: '.$_SERVER['HTTP_REFERER']);  
} else {
 header('Location: home.php');  
}
exit;  
?>