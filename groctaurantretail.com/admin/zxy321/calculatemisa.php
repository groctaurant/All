<!DOCTYPE html>
<html>
<head>
	  <link rel="shortcut icon" type="image/png" href="../../images/GR.png"/>
  <title>Order <?php echo $_GET['order_no']; ?></title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<style type="text/css">
	th, td {
    padding: 20px;
}
</style>
</style>
</head>
<body>
<?php
include '../../db/config.php';

$ord_id = $_GET['ord_id'];
//$query = mysqli_query($con, "SELECT * from grret_orderdetails where ord_id = '$ord_id'"); ?>
<h1>
	<center><b><u>COOKING SECTION</u></b></center>
</h1>
<?php
$query = mysqli_query($con, "SELECT * from grret_orderdetails where ing_section like '%COOKINGSECTION%' and ord_id = '$ord_id'");
$cs_array=[];
while ($row = mysqli_fetch_array($query)) {
	$x=explode(", ", $row['ing_name']);
	$y=explode(", ", $row['ing_process']);
	for ($i=0; $i < count($x); $i++) {
		$s=$x[$i].", ".$y[$i]; 
		//echo "$s<br>";
		array_push($cs_array, $s);
	}	
}
$cs2_array = array_unique($cs_array);
$cs_unique_array = array();
foreach ($cs2_array as $value) {
	$cs_unique_array[$value] = [];
}
$query = mysqli_query($con, "SELECT * from grret_orderdetails where ing_section like '%COOKINGSECTION%' and ord_id = '$ord_id'");
while ($row = mysqli_fetch_array($query)) {
	$x=explode(", ", $row['ing_name']);
	$y=explode(", ", $row['ing_process']);
	$z=explode(", ", $row['ing_qty']);
	for ($i=0; $i < count($x); $i++) { 
		$ss=$x[$i].", ".$y[$i];
		array_push($cs_unique_array[$ss],$z[$i]);
	}
}
?><table class = "table-bordered" align="center">
<?php foreach ($cs_unique_array as $key => $value) { 
	$x = explode(", ",$key); 
	$query = mysqli_query($con, "SELECT ing_msr from grret_orderdetails where ing_name = '$x[0]'");
	$z = $query->fetch_assoc();
	?>
	<?php //echo $array_sum($value); ?>
	<tr>
	<td><?php echo $x[0]; ?></td>
	<td><?php echo $x[1]; ?></td>
	<td><?php echo array_sum($value); ?></td>
	<td><?php echo $z['ing_msr']; ?></td>
	</tr>
<?php } ?>  
</table>


<h1>
	<center><b><u>VEGETABLE</u></b></center>
</h1>
<?php
$query = mysqli_query($con, "SELECT * from grret_orderdetails where ing_section like '%VEGETABLE%' and ord_id = '$ord_id'");
$vg_array=[];
while ($row = mysqli_fetch_array($query)) {
	$x=explode(", ", $row['ing_name']);
	$y=explode(", ", $row['ing_process']);
	for ($i=0; $i < count($x); $i++) {
		$s=$x[$i].", ".$y[$i]; 
		//echo "$s<br>";
		array_push($vg_array, $s);
	}	
}
$vg2_array = array_unique($vg_array);
$vg_unique_array = array();
foreach ($vg2_array as $value) {
	$vg_unique_array[$value] = [];
}
$query = mysqli_query($con, "SELECT * from grret_orderdetails where ing_section like '%VEGETABLE%' and ord_id = '$ord_id'");
while ($row = mysqli_fetch_array($query)) {
	$x=explode(", ", $row['ing_name']);
	$y=explode(", ", $row['ing_process']);
	$z=explode(", ", $row['ing_qty']);
	for ($i=0; $i < count($x); $i++) { 
		$ss=$x[$i].", ".$y[$i];
		array_push($vg_unique_array[$ss],$z[$i]);
	}
}
?><table class = "table-bordered" align="center">
<?php foreach ($vg_unique_array as $key => $value) { 
	$x = explode(", ",$key); 
	$query = mysqli_query($con, "SELECT ing_msr from grret_orderdetails where ing_name = '$x[0]'");
	$z = $query->fetch_assoc();
	?>
	<?php //echo $array_sum($value); ?>
	<tr>
	<td><?php echo $x[0]; ?></td>
	<td><?php echo $x[1]; ?></td>
	<td><?php echo array_sum($value); ?></td>
	<td><?php echo $z['ing_msr']; ?></td>
	</tr>
<?php } ?>  
</table>
<h1>
	<center><b><u>SPICE</u></b></center>
</h1>
<?php
$query = mysqli_query($con, "SELECT * from grret_orderdetails where ing_section like '%SPICE%' and ord_id = '$ord_id'");
$sp_array=[];
while ($row = mysqli_fetch_array($query)) {
	$x=explode(", ", $row['ing_name']);
	$y=explode(", ", $row['ing_process']);
	for ($i=0; $i < count($x); $i++) {
		$s=$x[$i].", ".$y[$i]; 
		//echo "$s<br>";
		array_push($sp_array, $s);
	}	
}
$sp2_array = array_unique($sp_array);
$sp_unique_array = array();
foreach ($sp2_array as $value) {
	$sp_unique_array[$value] = [];
}
$query = mysqli_query($con, "SELECT * from grret_orderdetails where ing_section like '%SPICE%' and ord_id = '$ord_id'");
while ($row = mysqli_fetch_array($query)) {
	$x=explode(", ", $row['ing_name']);
	$y=explode(", ", $row['ing_process']);
	$z=explode(", ", $row['ing_qty']);
	for ($i=0; $i < count($x); $i++) { 
		$ss=$x[$i].", ".$y[$i];
		array_push($sp_unique_array[$ss],$z[$i]);
	}
}
?><table class = "table-bordered" align="center">
<?php foreach ($sp_unique_array as $key => $value) { 
	$x = explode(", ",$key); 
	$query = mysqli_query($con, "SELECT ing_msr from grret_orderdetails where ing_name = '$x[0]'");
	$z = $query->fetch_assoc();
	?>
	<?php //echo $array_sum($value); ?>
	<tr>
	<td><?php echo $x[0]; ?></td>
	<td><?php echo $x[1]; ?></td>
	<td><?php echo array_sum($value); ?></td>
	<td><?php echo $z['ing_msr']; ?></td>
	</tr>
<?php } ?>  
</table>
<h1>
	<center><b><u>MEAT</u></b></center>
</h1>
<?php
$query = mysqli_query($con, "SELECT * from grret_orderdetails where ing_section like '%MEAT%' and ord_id = '$ord_id'");
$me_array=[];
while ($row = mysqli_fetch_array($query)) {
	$x=explode(", ", $row['ing_name']);
	$y=explode(", ", $row['ing_process']);
	for ($i=0; $i < count($x); $i++) {
		$s=$x[$i].", ".$y[$i]; 
		//echo "$s<br>";
		array_push($me_array, $s);
	}	
}
$me2_array = array_unique($me_array);
$me_unique_array = array();
foreach ($me2_array as $value) {
	$me_unique_array[$value] = [];
}
$query = mysqli_query($con, "SELECT * from grret_orderdetails where ing_section like '%MEAT%' and ord_id = '$ord_id'");
while ($row = mysqli_fetch_array($query)) {
	$x=explode(", ", $row['ing_name']);
	$y=explode(", ", $row['ing_process']);
	$z=explode(", ", $row['ing_qty']);
	for ($i=0; $i < count($x); $i++) { 
		$ss=$x[$i].", ".$y[$i];
		array_push($me_unique_array[$ss],$z[$i]);
	}
}
?><table class = "table-bordered" align="center">
<?php foreach ($me_unique_array as $key => $value) { 
	$x = explode(", ",$key); 
	$query = mysqli_query($con, "SELECT ing_msr from grret_orderdetails where ing_name = '$x[0]'");
	$z = $query->fetch_assoc();
	?>
	<?php //echo $array_sum($value); ?>
	<tr>
	<td><?php echo $x[0]; ?></td>
	<td><?php echo $x[1]; ?></td>
	<td><?php echo array_sum($value); ?></td>
	<td><?php echo $z['ing_msr']; ?></td>
	</tr>
<?php } ?>  
</table>	
</body>
</html>