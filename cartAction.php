<?php
//include('session.php');
// initialize shopping cart class
include 'cart1.php';
$cart = new Cart;
// include database configuration file
include 'config.php';
if($_GET['action'] == 'addToCart' && !empty($_GET['id'])){
    $productID = $_GET['id'];
    $serving = $_GET['serving'];
    // get product details
    $query = mysqli_query($con,"SELECT * FROM admin_recipee WHERE id = ".$productID);
    $row = $query->fetch_assoc();
    $querya = mysqli_query($con,"SELECT * FROM admin_recipeservings WHERE rec_id = '$productID' and servings = '$serving'");
    $rowa = $querya->fetch_assoc();
    $itemData = array(
        'id' => $rowa['id'],
        'rec_sku' => $row['sku'],
        'rec_name' => $row['recipe_name1'],
        'rec_cuisine' => $row['cuisine'],
        'category' => $row['category'],
        'rec_vegtag' => $row['veg_tag'],
        'rec_image' => $row['image_dir1'],
        'rec_serving' => $rowa['servings'],
        'price' => $rowa['price'],
        'qty' => 1
    );
    $insertItem = $cart->insert($itemData);
    echo $cart->total_items();
    //$redirectLoc = $insertItem?'shop.php':'viewCart.php';
    //header("Location: ".$redirectLoc);
    
}else if($_GET['action'] == 'updateCartItemplus' && !empty($_GET['id'])){
    $itemData = array(
        'rowid' => $_GET['id'],
        'qty' => $_GET['qty']
    );
    $updateItem = $cart->update($itemData);
    echo $updateItem?'ok':'err';die;
    
}else if($_GET['action'] == 'updateCartItemminus' && !empty($_GET['id'])){
    $itemData = array(
        'rowid' => $_GET['id'],
        'qty' => $_GET['qty']
    );
    $updateItem = $cart->update($itemData);
    echo $updateItem?'ok':'err';die;
    
}else if($_GET['action'] == 'removeCartItem' && !empty($_GET['id'])){
    $deleteItem = $cart->remove($_GET['id']);
    echo "ok";
    //header("Location: cart.php");

}else if($_GET['action'] == 'removeCartItemAccomp' && !empty($_GET['id'])){
    $id = $_GET['id'];
    $serving = $_GET['serving'];
    $querya = mysqli_query($con,"SELECT * FROM admin_recipeservings WHERE rec_id = '$id' and servings = '$serving'");
    $rowa = $querya->fetch_assoc();
    $idx = md5($rowa['id']);
    $deleteItem = $cart->remove($idx);
    echo "ok";

} else{
    echo "error";
    //header("Location: shop.php");
}