<?php

	include 'session.php';
   session_start();

   date_default_timezone_set("Asia/Kolkata");
    $mer_logout = date("Y-m-d H:i:s");
    $mer_login = $_SESSION['mer_login'];
    $querycheck = mysqli_query($con, "UPDATE grret_login_records set mer_logout = '$mer_logout' where mer_id= '$login_session' and mer_login= '$mer_login'");
    // if($querycheck){
    // 	if(session_destroy()) {
    //   	header("Location: index.php");
   	// 	}
    // } else {
    // 	echo $mer_login;
    // 	echo "error ".mysqli_error($con);
    // }

    if(session_destroy()) {
      	header("Location: index.php");
   	}
   
?>