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

.Rejected {
  background-color: orangered;
}

.Paid { background-color: lightgreen; }
.Requested { background-color: lightblue; }

.navbar{background-color:white; padding-top:10px;}
.btns{padding:4px 9px; font-family: 'Baloo Bhaina', cursive; font-size:18px; letter-spacing:0.8px;}
td{font-family: 'Arima Madurai', cursive; letter-spacing:1.2px; text-align:center;}
th{text-align:center;}
</style>
</head>

<body>
<?php
        $query = mysqli_query($con, "SELECT * FROM grret_merchants WHERE mer_id = '$login_session' ");
        $merRow = mysqli_fetch_array($query);
        ?>
        <?php include 'navbar.php'; ?>



<div class="container-fluid" style="margin-top: 6em;">
<h1><center>LOAN ORDERS</center></h1><br>
<a data-toggle="modal" data-target="#myModal" class="btn btn-primary clear_payment btns">Clear Payment Via Wallet</a>
<a data-toggle="modal" data-target="#myModal1" class="btn btn-warning request_to_clear btns">Request To Clear Payment</a>
<div class="table-responsive"> <table class='table table-condensed table-bordered'>
<br><tr style="font-family: 'Baloo Bhaina', cursive; font-size:17px; letter-spacing:0.8px;">
  <th><input type="checkbox" class="check_all" onclick="select_all()"></th>
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
  <th>Delivery Time</th>
  <th>Order Status</th>
  <th>Payment Status</th>
</tr>
<?php

$sql="SELECT * from grret_orders where mer_id = '$login_session' and payment_type='Pay Via Loan Wallet' order by id desc";
$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($result))
{
echo "<tr class='".$row['payment_status']."'>";
  if($row['payment_status'] == "Unpaid"){
      echo "<td><input type='checkbox' class='case'></td>";
  } else {
      echo "<td></td>";
  }
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
echo "<td>" . $row['del_time'] . "</td>";
echo "<td>" . $row['ord_status'] . "</td>";
echo "<td class='".$row['payment_status']."'>" . $row['payment_status'] . "</td>";
echo "</tr>";
}
?>
</table>
</div>
</div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><center>Clear Payment</center></h4>
            </div>
            <div class="modal-body"><br>
                <form class="form-horizontal" action="myloanorders1.php" method="POST">
                    <div class="form-group">
                        <label class="control-label col-sm-3">Order ID(s) :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control ord_id" name="ord_id" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Amount :</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control amount" name="amount" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Unique PIN :</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="unique_pin" placeholder="Enter PIN" required>
                        </div>
                    </div>
                    <center><button type="submit" class="btn btn-primary">Confirm Payment</button></center>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="myModal1" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><center>Request To Clear Payment</center></h4>
            </div>
            <div class="modal-body"><br>
                <form class="form-horizontal" action="myloanorders2.php" method="POST">
                    <div class="form-group">
                        <label class="control-label col-sm-3">Order ID(s) :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control ord_id1" name="ord_id1" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Amount :</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control amount1" name="amount1" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Unique PIN :</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="unique_pin1" placeholder="Enter PIN" required>
                        </div>
                    </div>
                    <center><button type="submit" class="w3-btn w3-blue">Send Request</button></center>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function select_all(){
        $('input[class=case]:checkbox').each(function(){ 
            if($('input[class=check_all]:checkbox:checked').length == 0){ 
                $(this).prop("checked", false); 
            } else {
                $(this).prop("checked", true); 
            } 
        });
    }
    $(document).ready(function(){
        $(".clear_payment").on('click', function() {
            var td1="", td2=0;
            $('.case:checkbox:checked').parents("tr").each(function(){
                for (var i = 0; i < $(this).length; i++) {
                    td1 = td1+"'"+$(this)[i].getElementsByTagName("td")[1].innerHTML+"'"+",";
                    td2 += parseFloat($(this)[i].getElementsByTagName("td")[9].innerHTML);
                }
            });
            td1 = td1.replace(/,+$/,'');
            $('.amount').val(td2);
            $('.ord_id').val(td1);
            
        });
        $(".request_to_clear").on('click', function() {
            var td1="", td2=0;
            $('.case:checkbox:checked').parents("tr").each(function(){
                for (var i = 0; i < $(this).length; i++) {
                    td1 = td1+"'"+$(this)[i].getElementsByTagName("td")[1].innerHTML+"'"+",";
                    td2 += parseFloat($(this)[i].getElementsByTagName("td")[9].innerHTML);
                }
            });
            td1 = td1.replace(/,+$/,'');
            $('.amount1').val(td2);
            $('.ord_id1').val(td1);
            
        });
    });
</script>
</body>
</html>