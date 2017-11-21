<?php

include 'db/config.php';

   session_start();
   
   $user_check = $_SESSION['login_user'];
   $user_check1 = $_SESSION['login_pass'];
   
   $ses_sql = mysqli_query($con,"select * from grret_merchants where mer_id = '$user_check' and mer_pin = '$user_check1' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   $count = mysqli_num_rows($ses_sql);
   
   $login_session = $row['mer_id'];
   
   if(!isset($_SESSION['login_user']) || $count==0){
      header("location:index.php");
   }
?>