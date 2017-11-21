<?php
include('session.php');
include 'config.php';
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
    <link rel="shortcut icon" type="../../image/png" href="../../images/GR.png"/>
    <title>GROCTAURANT</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Cutive+Mono" rel="stylesheet">
	
	
	<style>
	@media print {
   .noprint{
      display: none !important;
   }
   @page { margin: 0;}
   body{font-family: 'Cutive Mono', monospace; font-size:12px; line-height: 90%;}
   
   
	
	</style>
	</head>
	
	<body>
	
	<div class="container-fluid">
<button class="btn btn-default" id="click" onclick="printDiv('printableArea')"></button>
<div id="printableArea">
<center><img src="../../images/GR1.png" width="" height="60px"></center>
<p><center>GSTIN: 06AAGCG4158E1ZR</center></p>
<br>
<p><b><?php echo $row['order_number']; ?></b><span class="pull-right"><?php echo $row['order_at']; ?></span><br><br>
<?php echo $row['ord_id']; ?><br><br>
Name: <span style="font-size:14px;"><?php echo $row['cus_name']; ?></span><br><br>
Phone: <span style="font-size:15px; font-weight:bold;"><?php echo $row['cus_phone']; ?></span><br><br>
Address: <span style="font-size:15px; font-weight:bold;"><?php echo $row['cus_address']; ?></span></p>


<table class="table table-condensed" style="font-family: 'Cutive Mono', monospace; font-size:12px; text-align: initial;">
  
<?php
for($i=0; $i<$count; $i++){
  $query1 = mysqli_query($con, "SELECT * from grret_orderdetails where ord_id = '$ord_id' and rec_name = '$rec_name[$i]'");
?>
  <tr style="font-size:14px;">
    <td style="text-align: center;"><?php echo $rec_qty[$i]; ?></td>
	<td><?php echo $rec_name[$i]; ?> <?php echo $rec_serving[$i]; ?>(s) <div class="pull-right">₹<?php echo $rec_price[$i]; ?>.00</div></td>
  </tr>
<?php
}
?>
</table>
<?php
$sub_total = $row['sub_total'];
$del_charges = $row['del_charges'];
$discount = $row['discount'];
$sgst = $row['sgst'];
$cgst = $row['cgst'];
if($discount == 0){
	$discount = "N/A";
} else {
	$discount = "₹".$discount;
}
$total_price=$row['total_price'];
if($del_charges != 0){
	echo "<p>Sub Total: ₹".$sub_total."<br>
	Discount: ".$discount."<br>
	CGST@2.5.00%: ₹".$cgst."<br>
	SGST@2.5.00%: ₹".$sgst."<br>
	Del. Charges: ₹".$del_charges."<br><br>
	Amt. to be collected: <span style='font-size:15px; font-weight:bold;'>₹".$row['final_amount']."</span><br> 
	Total Price: <span style='font-size:15px; font-weight:bold;'>₹".$total_price."</span></p>";
}
else{
	echo "<p>Sub Total: ₹".$sub_total."<br>
	Discount: ".$discount."<br>
	CGST@2.5.00%: ₹".$cgst."<br>
	SGST@2.5.00%: ₹".$sgst."<br>
	FREE DELIVERY<br><br>
	Amt. to be collected: <span style='font-size:15px; font-weight:bold;'>₹".$row['final_amount']."</span><br>
	Total Price: <span style='font-size:15px; font-weight:bold;'>₹".$total_price."</span></p>";
}
?>
</div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('#click').click();
  });
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