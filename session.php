<?php

include 'config.php';

   session_start();
   
   $user_check = $_COOKIE['login_user'];
   $user_check1 = $_COOKIE['login_phone'];
   
   $ses_sql = mysqli_query($con,"SELECT * from web_customers where name = '$user_check' and phone = '$user_check1' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   $count = mysqli_num_rows($ses_sql);
   
   if(!isset($_COOKIE['login_user']) || $count==0){
      session_destroy();
setcookie('login_user', "", time() - 3600 , "/");
setcookie('login_phone', "", time() - 3600 , "/");
      header("location:login.php");
   } else {
      $login_session = $row['name'];
      $login_session1 = $row['phone'];
      if(isset($_COOKIE['login_user']) && isset($_COOKIE['login_phone'])){
         $_SESSION['login_user'] = $_COOKIE['login_user'];
         $_SESSION['login_phone'] = $_COOKIE['login_phone'];
      }
   }
?>