<?php
   include('session.php');
   include 'cart1.php';

include ('db/config.php');
  $cart = new Cart;
?>
<html>
<head>
<link rel="shortcut icon" type="image/png" href="images/GR.png"/>
    <title>GROCTAURANT</title>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link href="https://fonts.googleapis.com/css?family=Baloo+Bhaina" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Arima+Madurai:700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
  
<script id="_webengage_script_tag" type="text/javascript">
var webengage; !function(w,e,b,n,g){function o(e,t){e[t[t.length-1]]=function(){r.__queue.push([t.join("."),arguments])}}var i,s,r=w[b],z=" ",l="init options track screen onReady".split(z),a="feedback survey notification".split(z),c="options render clear abort".split(z),p="Open Close Submit Complete View Click".split(z),u="identify login logout setAttribute".split(z);if(!r||!r.__v){for(w[b]=r={__queue:[],__v:"6.0",user:{}},i=0;i<l.length;i++)o(r,[l[i]]);for(i=0;i<a.length;i++){for(r[a[i]]={},s=0;s<c.length;s++)o(r[a[i]],[a[i],c[s]]);for(s=0;s<p.length;s++)o(r[a[i]],[a[i],"on"+p[s]])}for(i=0;i<u.length;i++)o(r.user,["user",u[i]]);setTimeout(function(){var f=e.createElement("script"),d=e.getElementById("_webengage_script_tag");f.type="text/javascript",f.async=!0,f.src=("https:"==e.location.protocol?"https://ssl.widgets.webengage.com":"http://cdn.widgets.webengage.com")+"/js/webengage-min-v-6.0.js",d.parentNode.insertBefore(f,d)})}}(window,document,"webengage");

webengage.init("11b564bd0");
</script>
  
<style>

li{font-family: 'Baloo Bhaina', cursive; font-size:17px; letter-spacing:0.8px;}
h1{font-family: 'Questrial', sans-serif;}
h4{font-family: 'Arima Madurai', cursive;}
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
.navbar{background-color:white; padding-top:10px;}
td{font-family: 'Arima Madurai', cursive; letter-spacing:1.2px; text-align:center;}
th{text-align:center;}
</style>
</head>

<body>
<?php
      date_default_timezone_set("Asia/Kolkata");
      $order_at = date("Y-m-d", strtotime("first day of this month"));
        $query = mysqli_query($con, "SELECT * FROM grret_merchants WHERE mer_id = '$login_session' ");
        $merRow = mysqli_fetch_array($query);

        $result1 = mysqli_query($con, "SELECT * from grret_orders where mer_id = '$login_session' and order_at >= '$order_at' order by id desc");
        $aov=0;
        $count = mysqli_num_rows($result1);
              
        if($count != 0){
          while($row = mysqli_fetch_array($result1)){
            $aov = $aov + $row['total_price'];
          }
          $mer_aov = round($aov/$count, 2);
          mysqli_query($con, "UPDATE grret_merchants set mer_aov='$mer_aov', mer_sale= '$aov' where mer_id = '$login_session' ");
        } else {
          $mer_aov = 0;
        }
        ?>
        <?php include 'navbar.php'; ?> 



<div class="container-fluid" style="margin-top: 7.4em;">
<h1><center>MY ORDERS</center></h1>
<br><h4>Average Order Value : ₹<?php echo $mer_aov; ?></h4>
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
    <th>Action</th>
  </tr>
  <?php

  $sql="SELECT * from grret_orders where mer_id = '$login_session' order by id desc";
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
    if(($row['ord_status'] == "Under Review" || $row['ord_status'] == "Under Processing") && date("Y-m-d H:i:s") <= $row['order_cancel_till']){
      echo "<td><a href='ordercancel.php?id=".$row['ord_id']."' class='btn btn-danger'>Cancel</a></td>";
    } else {
      echo "<td></td>";
    }
    echo "</tr>";
  }
  ?>
</table>

</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    
  setInterval(function(){
    $('#table').load(document.URL +  ' #table');
  },10000)
  
 });
  </script>
</body>
</html>