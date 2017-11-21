<?php

include '../../db/config.php';

   session_start();
   
   $user_check = $_SESSION['admin'];
   $user_check1 = $_SESSION['pass'];
   
   $ses_sql = mysqli_query($con,"select * from grret_users where username = '$user_check' and password = '$user_check1'");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   $count = mysqli_num_rows($ses_sql);
   
   $login_session = $row['username'];
   $login_role = $row['role'];
   
   if(!isset($_SESSION['admin']) || $count==0){
      header("location:index.php");
   }

?>