<?php
if(isset($_POST['city'])){
    include 'config.php';
    $city = $_POST['city'];
    $query = mysqli_query($con, "SELECT area from web_city_area where city = '$city'");
    echo "<option>Select Area</option>";
    while($row = mysqli_fetch_array($query)){
        echo "<option>".$row['area']."</option>";
    }
}
?>