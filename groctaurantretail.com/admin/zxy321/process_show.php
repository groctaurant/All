<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="shortcut icon" type="image/png" href="../../images/GR.png"/>
  <title>GROCTAURANT</title>
  <meta charset="utf-8">
 	
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  
<?php
include '../../db/config.php';
$sql=mysqli_query($con,"SELECT * from ingerd_processing_pricing");
echo "<table class='table table-striped table-bordered'>
<tr>
<th>INGREDIENT</th>
<th>PROCESSING NAME</th>
<th>STEPS INVOLVED</th>
<th>DIFFICULTY LEVEL</th>
<th>GENERIC PROCESSING NAME</th>
<th>TASKING</th>
<th>Time Taken / K.G</th>
<th>UTENSILS USED</th>
<th>SECTION INVOLVED</th>
<th>SOURCE PRICE</th>
<th>BASE PRICE(PER KG)</th>
<th>YIELD %</th>
<th>YIELDED PRICE</th>
<th>PROCESSING 1</th>
<th>TIME</th>
<th>COST</th>
<th>PROCESSING 2</th>
<th>TIME</th>
<th>COST</th>
<th>PROCESSING 3</th>
<th>TIME</th>
<th>COST</th>
<th>PROCESSING 4</th>
<th>TIME</th>
<th>COST</th>
<th>PROCESSING 5</th>
<th>TIME</th>
<th>COST</th>
<th>TOTAL STEPS</th>
<th>PROCESSED PRICE</th>
<th>USAGE</th>
<th>RISK FACTOR</th>
<th>POSSIBLE RISKS</th>
</tr>";
while($row=mysqli_fetch_array($sql)){
echo "<tr>";
echo "<td>" . $row['ingredient'] . "</td>";
echo "<td>" . $row['processing_name'] . "</td>";
echo "<td>" . $row['steps_involved'] . "</td>";
echo "<td>" . $row['difficulty_level'] . "</td>";
echo "<td>" . $row['generic_processing_name'] . "</td>";
echo "<td>" . $row['ing_tasking'] . "</td>";
echo "<td>" . $row['time_taken_kg'] . "</td>";
echo "<td>" . $row['utensils_used'] . "</td>";
echo "<td>" . $row['secion_involved'] . "</td>";
echo "<td>" . $row['source_price'] . "</td>";
echo "<td>" . $row['base_price'] . "</td>";
echo "<td>" . $row['yield_perc'] . "</td>";
echo "<td>" . $row['yielded_price'] . "</td>";
echo "<td>" . $row['processing_1'] . "</td>";
echo "<td>" . $row['time_1_minutes'] . "</td>";
echo "<td>" . $row['cost_1'] . "</td>";
echo "<td>" . $row['processing_2'] . "</td>";
echo "<td>" . $row['time_2_minutes'] . "</td>";
echo "<td>" . $row['cost_2'] . "</td>";
echo "<td>" . $row['processing_3'] . "</td>";
echo "<td>" . $row['time_3_minutes'] . "</td>";
echo "<td>" . $row['cost_3'] . "</td>";
echo "<td>" . $row['processing_4'] . "</td>";
echo "<td>" . $row['time_4_minutes'] . "</td>";
echo "<td>" . $row['cost_4'] . "</td>";
echo "<td>" . $row['processing_5'] . "</td>";
echo "<td>" . $row['time_5_minutes'] . "</td>";
echo "<td>" . $row['cost_5'] . "</td>";
echo "<td>" . $row['total_steps'] . "</td>";
echo "<td>" . $row['processed_price'] . "</td>";
echo "<td>" . $row['ing_usage'] . "</td>";
echo "<td>" . $row['risk_factor'] . "</td>";
echo "<td>" . $row['possible_risk'] . "</td>";
echo "</tr>";
}
echo "</table>";

mysqli_close($con);
?>