<?php
include '../../db/config.php';
$id = $_POST['id'];
$sql="SELECT * from grret_orders where id='$id'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$total_price = $row['total_price'];
$mer_id = $row['mer_id'];
$ord_id = $row['ord_id'];
$old_status = $row['ord_status'];
if($old_status == "Under Review"){

$status = "Under Processing";
mysqli_query($con, "UPDATE grret_orders set ord_status = '$status' where id='$id'");

$payment_type = $row['payment_type'];

$rec_skuj = explode(', ',$row['rec_sku']);
$rec_namej = explode(', ',$row['rec_name']);
$rec_servingj = explode(', ',$row['rec_serving']);
$rec_qtyj = explode(', ',$row['rec_qty']);
$countj = count($rec_skuj);

// FOR JSON FETCH
for($x=0; $x<$countj; $x++){ 
    
    $queryjs = mysqli_query($con, "SELECT * from grret_recipejson where recipe_name = '$rec_namej[$x]'");
    $rowjs = mysqli_fetch_array($queryjs);
    $pathjs = $rowjs['json_path'];
    
    // $jsonquery = mysqli_query($con, "SELECT * from grret_recipejson where recipe_name = '$rec_namej[$x]'");
    // $jsonrow = mysqli_fetch_array($jsonquery);
    // $dataj = file_get_contents ('https://groctaurantretail.com/'.rawurlencode($jsonrow['json_path']).'');
    // $dataj = file_get_contents ('https://groctaurantretail.com/json/'.rawurlencode(mb_strtoupper($rec_namej[$x])).'.json');
    $dataj = file_get_contents ('../../'.$pathjs);
    $json = json_decode($dataj, TRUE);

    $serving = $rec_servingj[$x];
    $i = 1;
    foreach($json as $key => $val){

        if(is_array($val)){
            $slip_name = $key;
            $ing_name1 = array();
            $ing_qty1 = array();
            $ing_msr1 = array();
            $ing_section1 = array();
            $ing_process1 = array();

            for($j=0;$j<count($json[$key]);$j++) {
                $ing_name1[$j] = $json[$key][$j]['NAME'];
                $ing_qty1[$j] = $json[$key][$j]['SERVING'][0][$serving];
                $ing_msr1[$j] = $json[$key][$j]['MEASURE'];
                $ing_section1[$j] = $json[$key][$j]['SECTION'];
                $ing_process1[$j] = $json[$key][$j]['PROCESSING'];
            }
            $ing_name = implode(', ', $ing_name1);
            $ing_qty = implode(', ', $ing_qty1);
            $ing_msr = implode(', ', $ing_msr1);
            $ing_section = implode(', ', $ing_section1);
            $ing_process = implode(', ', $ing_process1);
        }
        mysqli_query($con, "INSERT INTO grret_orderdetails(ord_id, rec_sku, rec_name, rec_qty, ing_name, ing_qty, ing_msr, ing_section, ing_process, slip_name) VALUES('$ord_id', '$rec_skuj[$x]', '$rec_namej[$x]', '$rec_qtyj[$x]', '$ing_name', '$ing_qty', '$ing_msr', '$ing_section', '$ing_process', '$slip_name')");
        if(count($ing_name1) > 1){
            for($y=0; $y<count($ing_name1); $y++){
                mysqli_query($con, "INSERT INTO grret_orderdetaildetails(ord_id, rec_sku, ing_name, ing_qty, ing_msr, ing_section, ing_process, slip_name) VALUES('$ord_id', '$rec_skuj[$x]', '$ing_name1[$y]', '$ing_qty1[$y]', 'ing_msr1[$y]', '$ing_section1[$y]', '$ing_process1[$y]', '$slip_name')");
            }
        }
        $i++;
    }   
}
// END OF JSON
}

?>