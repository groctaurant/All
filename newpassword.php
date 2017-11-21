<?php
include 'config.php';
include 'session.php';

if(isset($_POST['submit']))
{
    $new_password = $_POST['new_password'];
    $query = mysqli_query($con, "UPDATE web_customers SET password = '$new_password' WHERE phone = '$login_session1' LIMIT 1");
    if($query)
        header("Location: logout.php");
    else
        echo mysqli_error($con);
}
?>