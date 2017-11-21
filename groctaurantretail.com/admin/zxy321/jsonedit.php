<?php
include('session.php');
include '../../db/config.php';

$id = $_POST['id'];
$query = mysqli_query($con, "SELECT * from grret_recipes where id='$id'");
$row = mysqli_fetch_array($query);

$name = $row['rec_name'];
$queryjs = mysqli_query($con, "SELECT * from grret_recipejson where recipe_name = '$name'");
    $rowjs = mysqli_fetch_array($queryjs);
    $pathjs = $rowjs['json_path'];
$dataj = file_get_contents ('../../'.$pathjs);
$json = json_decode($data, TRUE);
$serving = $row['rec_serving'];
$i = 1;

// $rewrite = array();
// foreach($json as $key){
//     $rewrite[$key] = $_POST['slip_name'.$i.''];
//     $i++;
// }
// print_r($rewrite);
// die();
// $i = 1;
// $newArr = array();
foreach($json as $key => $val){
    for($j=0;$j<count($json[$key]);$j++) {
        $json[$key][$j]['NAME'] = $_POST['ing_name'.$i.$j.''];
        $json[$key][$j]['PROCESSING'] = $_POST['ing_process'.$i.$j.''];
        $json[$key][$j]['SERVING'][0][$serving] = $_POST['ing_qty'.$i.$j.''];
        $json[$key][$j]['MEASURE'] = $_POST['ing_msr'.$i.$j.''];
        $json[$key][$j]['SECTION'] = $_POST['ing_section'.$i.$j.''];
    }
    // $json[$_POST['slip_name'.$i.'']] = $json[$key];
    // if($_POST['slip_name'.$i.''] != $key){
    //     unset($json[$key]);  
    // }
    
    $i++;
}   
$newJson = json_encode($json);
file_put_contents('../../'.$pathjs);
header("location: recipeedit.php?id=".$id."")
?>