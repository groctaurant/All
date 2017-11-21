<?php
include('session.php');
// initialize shopping cart class
include 'cart1.php';
$cart = new Cart;
// include database configuration file
include 'db/config.php';
if($_GET['action'] == 'addToCart' && !empty($_GET['id'])){
    $productID = $_GET['id'];
    // get product details
    $query = mysqli_query($con,"SELECT * FROM grret_recipes WHERE id = ".$productID);
    $row = $query->fetch_assoc();
    $itemData = array(
        'id' => $row['id'],
        'rec_sku' => $row['rec_sku'],
        'rec_name' => $row['rec_name'],
        'rec_cuisine' => $row['rec_cuisine'],
        'rec_vegtag' => $row['rec_vegtag'],
        'rec_serving' => $row['rec_serving'],
        'price' => $row['rec_price'],
        'qty' => 1
    );
//    if($cart->total_items() >= 10){
//        echo '<script> alert("Cannot add more than 10 items!!");
//        </script>';
//        echo $cart->total_items();
//    } else {
        $insertItem = $cart->insert($itemData);
        echo $cart->total_items();
        //$redirectLoc = $insertItem?'shop.php':'viewCart.php';
        //header("Location: ".$redirectLoc);
//    }
    
}else if($_GET['action'] == 'updateCartItemplus' && !empty($_GET['id'])){
    $itemData = array(
        'rowid' => $_GET['id'],
        'qty' => $_GET['qty']
    );
//    if($cart->total_items() >= 10){
//        echo '<script> alert("Cannot add more than 10 items!!");
//         window.location="Cart.php"; </script>';
//    } else {
        $updateItem = $cart->update($itemData);
        echo $updateItem?'ok':'err';die;
//    }
    
}else if($_GET['action'] == 'updateCartItemminus' && !empty($_GET['id'])){
    $itemData = array(
        'rowid' => $_GET['id'],
        'qty' => $_GET['qty']
    );
    $updateItem = $cart->update($itemData);
    echo $updateItem?'ok':'err';die;
    
}else if($_GET['action'] == 'removeCartItem' && !empty($_GET['id'])){
    $deleteItem = $cart->remove($_GET['id']);
    header("Location: Cart.php");

} else{
    header("Location: shop.php");
}