<?php
include('session.php');
if($login_role != "admin" && $login_role == "Recipe Writer"){
    header("location: recipe.php");
}
include '../../db/config.php';
session_start();
$ord_id = $_GET['id'];
$query = mysqli_query($con, "SELECT * from grret_orders where ord_id = '$ord_id'");
$row= mysqli_fetch_array($query);

$rec_name = explode(', ',$row['rec_name']);
$rec_serving = explode(', ',$row['rec_serving']);
$rec_qty = explode(', ',$row['rec_qty']);
$rec_price = explode(', ',$row['rec_price']);
$count = count($rec_name);
?>
<html>
<head>
<link rel="shortcut icon" type="image/png" href="../../images/GR.png"/>
    <title>GROCTAURANT</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link href="https://fonts.googleapis.com/css?family=Oswald:500,600" rel="stylesheet">
<style>

li,h2,h1{font-family: 'Oswald', sans-serif;}
.hidden{
  display: none;
}
li.active{
  background: #d0d0d0;
}
a.active{
  color: #000;
}
</style>
</head>

<body>
<?php include 'navbar.php'; ?>

<div id="wrapper" class="wrapper">

<div class="container-fluid" style="margin-top:50px;">
<div id="printableArea">
<h1><center>ORDER DETAILS</center></h1>
<button class="btn btn-default pull-right" onclick="printDiv('printableArea')"><i class="fa fa-print" aria-hidden="true"></i> Print</button><br>
<p><b>Order ID :</b> <?php echo $row['ord_id']; ?></p>
<p><b>Ordered At :</b> <?php echo $row['order_at']; ?></p>
<p><b>Merchant ID :</b> <?php echo $row['mer_id']; ?></p>
<p><b>Customer Name :</b> <?php echo $row['cus_name']; ?></p>
<p><b>Customer Phone :</b> <?php echo $row['cus_phone']; ?></p>
<p><b>Customer Address :</b> <?php echo $row['cus_address']; ?></p>
<p><b>Payment Type :</b> <?php echo $row['payment_type']; ?></p>
<p><b>Additional Notes :</b> <?php echo $row['add_notes']; ?></p>
<p><b>Delivery Time :</b> <?php echo $row['del_time']; ?></p>
<p><b>Order Status :</b> <?php echo $row['ord_status']; ?></p>
<p><b>Total Price :</b> ₹<?php echo $row['total_price']; ?></p><br>
</div>
<?php
for($i=0; $i<$count; $i++){
  $query1 = mysqli_query($con, "SELECT * from grret_orderdetails where ord_id = '$ord_id' and rec_name = '$rec_name[$i]'");
 
?>
<div class="well well-sm">
<p><b>Recipe Name :</b> <?php echo $rec_name[$i]; ?></p>
<p><b>Recipe Serving :</b> <?php echo $rec_serving[$i]; ?></p>
<p><b>Recipe Quantity :</b> <?php echo $rec_qty[$i]; ?></p>
<p><b>Recipe Price :</b> ₹<?php echo $rec_price[$i]; ?></p>
<h3>Ingredient Details</h3>
  <table class="table">
    <tr>
      <th>Slip</th>
      <th>Name</th>
      <th>Quantity</th>
      <th>Measure</th>
      <th>Section</th>
      <th>Procesing</th>
    </tr>
    <?php
    while($row1= mysqli_fetch_array($query1)){ ?>

    <tr>
      <td><?php echo $row1['slip_name']; ?></td>
      <td><?php echo str_replace(', ','<br>', $row1['ing_name']); ?></td>
      <td><?php echo str_replace(', ','<br>', $row1['ing_qty']); ?></td>
      <td><?php echo str_replace(', ','<br>', $row1['ing_msr']); ?></td>
      <td><?php echo str_replace(', ','<br>', $row1['ing_section']); ?></td>
      <td><?php echo str_replace(', ','<br>', $row1['ing_process']); ?></td>
    </tr>
    <?php
    }
    ?>
  </table>

</div>
</div>
</div>
<?php
}
?>
<script type="text/javascript">
  function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
</body>
</html>