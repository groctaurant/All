<?php

include '../../db/config.php';

$ingredient=$_POST['ingredient'];
$processname=$_POST['processname'];
$steps=$_POST['steps'];
$difficulty=$_POST['difficulty'];
$genericprocess=$_POST['genericprocess'];
$tasking=$_POST['tasking'];
$timetaken=$_POST['timetaken'];
$utensils=$_POST['utensils'];
$section=$_POST['section'];
$sourceprice=$_POST['sourceprice'];
$baseprice=$_POST['baseprice'];
$yield=$_POST['yield'];
$yieldprice=$_POST['yieldprice'];
$process1=$_POST['process1'];
$time1=$_POST['time1'];
$cost1=$_POST['cost1'];
$process2=$_POST['process2'];
$time2=$_POST['time2'];
$cost2=$_POST['cost2'];
$process3=$_POST['process3'];
$time3=$_POST['time3'];
$cost3=$_POST['cost3'];
$process4=$_POST['process4'];
$time4=$_POST['time4'];
$cost4=$_POST['cost4'];
$process5=$_POST['process5'];
$time5=$_POST['time5'];
$cost5=$_POST['cost5'];
$totsteps=$_POST['totsteps'];
$processedprice=$_POST['processedprice'];
$usage=$_POST['usage'];
$riskfact=$_POST['riskfact'];
$possiblerisks=$_POST['possiblerisks'];

$sql=mysqli_query($con,"insert into ingerd_processing_pricing(ingredient, processing_name, steps_involved, difficulty_level, generic_processing_name, ing_tasking, time_taken_kg, utensils_used, secion_involved, source_price, base_price, yield_perc, yielded_price, processing_1, time_1_minutes, cost_1, processing_2, time_2_minutes, cost_2, processing_3, time_3_minutes, cost_3, processing_4, time_4_minutes, cost_4, processing_5, time_5_minutes, cost_5, total_steps, processed_price, ing_usage, risk_factor, possible_risk) values('$ingredient','$processname','$steps','$difficulty','$genericprocess','$tasking','$timetaken','$utensils','$section','$sourceprice','$baseprice','$yield','$yieldprice','$process1','$time1','$cost1','$process2','$time2','$cost2','$process3','$time3','$cost3','$process4','$time4','$cost4','$process5','$time5','$cost5','$totsteps','$processedprice','$usage','$riskfact','$possiblerisks')");

mysqli_close($con);

header('location:process.php');

?>