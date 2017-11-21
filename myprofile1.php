<?php
include "session.php";
include "config.php";

if(isset($_POST['name'])){
    $name = $_POST['name'];
    mysqli_query($con, "UPDATE web_customers set name = '$name' where phone = '$login_session1'");
    setcookie('login_user',$name, time() + (86400 * 30), "/");
    $_SESSION['login_user'] = $name;
    echo $name;
    die();
}
if(isset($_POST['submit'])){
    $query = mysqli_query($con, "SELECT * from web_customers where phone = '$login_session1'");
    $row = mysqli_fetch_array($query);
    $referral = $row['referral_code'];
    $namex = str_replace(" ", "_", $login_session);
    $target_dir = "profile/";
    $extension = end(explode(".", $_FILES["image"]["name"]));
    $target_file = $target_dir . $referral . "_" . $namex .".". $extension;
    $uploadOk = 1;
    
    if ($uploadOk == 0) {
        echo "Sorry, your image was not uploaded.";
        die();
    } else {
        //if(file_exists($target_file)){ chmod($target_file,0755); unlink($target_file);}
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            mysqli_query($con, "UPDATE web_customers set image = '$target_file' where phone = '$login_session1'");
            header("Location: myprofile.php");
        } else {
            echo "Sorry, there was an error uploading your Image.";
            die();
        }
    }
}
if(isset($_POST['email'])){
    $email = $_POST['email'];
    mysqli_query($con, "UPDATE web_customers set email = '$email', verify_status = 0, request_status = 0 where phone = '$login_session1'");
    die();
}
?>