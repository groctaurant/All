<?php
include('session.php');
if($login_role != "admin" && $login_role == "Recipe Writer"){
    header("location: recipe.php");
} else if($login_role != "admin" && $login_role == "Order Platform"){
    header("location: orders.php");
}
include '../../db/config.php';
$mer_id = $_GET['id'];
?>
<html>
<head>
    <link rel="shortcut icon" type="image/png" href="../../images/GR.png"/>
    <title>GROCTAURANT</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Oswald:500,600" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
<style>

li,h2,h1{font-family: 'Oswald', sans-serif; font-size:17px; letter-spacing:0.8px;}
.hidden{
  display: none;
}
li.active{
  background: #d0d0d0;
}
a.active{
  color: #000;
}
.Rejected {
  background-color: orangered;
}
.Cancelled {
  background-color: #a50000;

  color: white;
}
.Unpaid{
  background-color: red;
  color: white;
}
</style>
</head>

<body>
<nav id="mm-menu" class="mm-menu" >
  <div class="mm-menu__header">
    <h2 class="mm-menu__title">Welcome <?php echo $login_session; ?> </h2>
  </div>
  <ul class="mm-menu__items">
    <li class="mm-menu__item ">
      <a class="mm-menu__link " href="home.php">
        <span class="glyphicon glyphicon-home mm-menu__link-text"></span> Home
      </a>
    </li>
    <li class="mm-menu__item">
      <a class="mm-menu__link" href="orders.php">
        <span class="glyphicon glyphicon-certificate mm-menu__link-text"></span> Order
      </a>
    </li>
    <li class="mm-menu__item" >
      <a class="mm-menu__link drop1" >
        <span class="glyphicon glyphicon-king mm-menu__link-text"></span> Recipe
        <span class="caret"></span>
      </a>
    </li> 
    <ul class="mm-menu__items list3">
        <li class="mm-menu__item" >
          <a class="mm-menu__link " href="recipe.php" >
            <span class="glyphicon glyphicon-king mm-menu__link-text" style="padding-left:12px"></span> View Recipe
          </a>
        </li>
        <li class="mm-menu__item">
          <a class="mm-menu__link" href="recipeaddnew.php">
            <span class="glyphicon glyphicon-plus mm-menu__link-text" style="padding-left:12px"></span> Add New
          </a>
        </li>
    </ul>
    <li class="mm-menu__item active" >
      <a class="mm-menu__link active drop" >
        <span class="glyphicon glyphicon-user mm-menu__link-text"></span> Merchants
        <span class="caret"></span>
      </a>
    </li> 
    <ul class="mm-menu__items list2">
        <li class="mm-menu__item" >
          <a class="mm-menu__link " href="merchant.php" >
            <span class="glyphicon glyphicon-user mm-menu__link-text" style="padding-left:12px"></span> View Merchants
          </a>
        </li>
        <li class="mm-menu__item">
          <a class="mm-menu__link" href="merchantaddnew.php">
            <span class="glyphicon glyphicon-plus mm-menu__link-text" style="padding-left:12px"></span> Add New
          </a>
        </li>
        <li class="mm-menu__item">
          <a class="mm-menu__link" href="merchantapps.php">
            <span class="glyphicon glyphicon-list-alt mm-menu__link-text" style="padding-left:12px"></span> View Apps
          </a>
        </li>
    </ul>
    <li class="mm-menu__item ">
      <a class="mm-menu__link " href="notifications.php">
        <span class="glyphicon glyphicon-th-list mm-menu__link-text"></span> Notifications
      </a>
    </li>
    <li class="mm-menu__item">
      <a class="mm-menu__link" href="logout.php">
        <span class="glyphicon glyphicon-lock mm-menu__link-text"></span> Logout
      </a>
    </li>
  </ul>
</nav>

<nav class="navbar navbar-fixed-top" style="background: #fff;border-bottom: 1px solid black"><button id="mm-menu-toggle" class="mm-menu-toggle">Toggle Menu</button>
<h1 class="text-center" style="font-size: 36px">Merchant Orders</h1>
</nav>

        <div class="wrapper" id="wrapper">
        <div class="container-fluid" style="margin-top:60px;">
            <h1><center>Orders of <?php echo $mer_id; ?></center></h1>
            <br>
            <div class="table-responsive"> 
            <table class='table table-condensed table-bordered' id="table">
    <br><tr style="font-family: 'Baloo Bhaina', cursive; font-size:17px; letter-spacing:0.8px;">
    <th>Order ID</th>
    <th>Customer Name</th>
    <th>Customer Phone</th>
    <th>Customer Address</th>
    <th>Recipe Name</th>
    <th>Serving</th>
    <th>Quantity</th>
    <th>Price</th>
    <th>Total Price</th>
    <th>Payment Type</th>
    <th>Payment Status</th>
    <th>Delivery Time</th>
    <th>Status</th>
  </tr>
  <?php

  $sql="SELECT * from grret_orders where mer_id = '$mer_id' order by id desc";
  $result = mysqli_query($con, $sql);

  while($row = mysqli_fetch_array($result))
  {
    echo "<tr class='".$row['ord_status']."'>";
    echo "<td>" . $row['ord_id'] . "</td>";
    echo "<td>" . $row['cus_name'] . "</td>";
    echo "<td>" . $row['cus_phone'] . "</td>";
    echo "<td>" . $row['cus_address'] . "</td>";
    echo "<td>" . str_replace(', ','<br>', $row['rec_name']). "</td>";
    echo "<td>" . str_replace(', ','<br>', $row['rec_serving']). "</td>";
    echo "<td>" . str_replace(', ','<br>', $row['rec_qty']). "</td>";
    echo "<td>" . str_replace(', ','<br>', $row['rec_price']). "</td>";
    echo "<td>" . $row['total_price'] . "</td>";
    echo "<td>" . $row['payment_type'] . "</td>";
    echo "<td class='".$row['payment_status']."'>" . $row['payment_status'] . "</td>";
    echo "<td>" . $row['del_time'] . "</td>";
    echo "<td>" . $row['ord_status'] . "</td>";
    echo "</tr>";
  }
  ?>
</table>
        </div>
    </div>

<script src="js/materialMenu.min.js"></script>
<script>
  var menu = new Menu;
</script>
<script type="text/javascript">
$(".list2").hide();
$(".drop").click(function(){
  $(".list2").toggle(400, function(){
    });
});  
</script>
<script type="text/javascript">
$(".list3").hide();
$(".drop1").click(function(){
  $(".list3").toggle(400, function(){
    });
});  
</script>
</body>
</html>