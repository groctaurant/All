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
$rec_cuisine = explode(', ',$row['rec_cuisine']);
$count = count($rec_name);
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
	<link href="https://fonts.googleapis.com/css?family=Cutive+Mono" rel="stylesheet">
	
	
	<style>
	@media print {
   .noprint{
      display: none !important;
   }
   @page { margin: 0;}
   body{font-family: 'Cutive Mono', monospace; font-size:18px; line-height: 90%;}
   tr{font-size:18px;}
   
   
	
	</style>
	</head>
	
	<body>
	
	<div class="container-fluid">
<button class="btn btn-default" id="click" onclick="printDiv('printableArea')"></button>
<div id="printableArea">
<center><p><?php echo $row['order_number']; ?></p></center><br>
Name:<br><?php echo $row['cus_name']; ?><br><br>
Address:<br><?php echo $row['cus_address']; ?><br><br>
Order Time:<br><?php echo $row['order_at']; ?><br><br>
<?php
if($rec_cuisine[0] == "Kitchen Protein"){
	$minutes_to_add = 20;
} else {
	$minutes_to_add = 30;
}
    $time = new DateTime($row['order_at']);
    $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
    $stamp = $time->format('Y-m-d H:i:s');
	?>
Dispatch:<br><?php echo $stamp; ?><br><br>

Delivery: <br><?php echo $row['del_time']; ?></p><br>
<table class="table table-condensed" style="font-family: 'Cutive Mono', monospace; font-size:12px; text-align: initial;">
  
<?php
for($i=0; $i<$count; $i++){
?>
  <tr>
    <td style="text-align: center;"><?php echo $rec_qty[$i]; ?></td>
	<td><?php echo $rec_name[$i]; ?> <?php echo $rec_serving[$i]; ?>(s)</td>
  </tr>
<?php
}
?>
</table>
Notes: <?php echo $row['add_notes']; ?>
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