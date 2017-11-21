<?php
   include('session.php');
   include 'cart1.php';
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
.navbar{background-color:white; padding-top:10px;}
td{font-family: 'Arima Madurai', cursive; letter-spacing:1.2px; text-align:center;}
th{text-align:center;}
</style>
</head>

<body>
<?php
        $query = mysqli_query($con, "SELECT * FROM grret_merchants WHERE mer_id = '$login_session' ");
        $merRow = mysqli_fetch_array($query);
        ?>
        <?php include'navbar.php'; ?>

<div class="container" style="margin-top: 6em;">
<h1><center>MY CUSTOMERS</center></h1><br>

<div class="table-responsive"> <table class='table table-condensed table-bordered'>
<tr style="font-family: 'Baloo Bhaina', cursive; font-size:17px; letter-spacing:0.8px;">
  
  <th>Customer Name</th>
  <th>Customer Phone</th>
  <th>Customer Address</th>
  
</tr>
<?php

include ('db/config.php');

$sql="SELECT * from grret_uniquecustomers where mer_id = '$login_session'";
$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($result))
{
 echo "<tr>";
 echo "<td>" . $row['cus_phone'] . "</td>";
 $phone = $row['cus_phone'];
 $sql1="SELECT * from grret_customers where cus_phone = '$phone' and mer_id='$login_session'";
 $result1 = mysqli_query($con, $sql1);
 $result2 = mysqli_query($con, $sql1);
 echo "<td>";
 while($row1 = mysqli_fetch_array($result1)){
   echo $row1['cus_name'];
   echo "<br>";
 }
 echo "</td>";
 echo "<td>";
 while($row2 = mysqli_fetch_array($result2)){
   echo $row2['cus_address'];
   echo "<br>";
 }
 echo "</td>";
 echo "</tr>";
}
?>
</table>
</div>
</div>
</body>
</html>