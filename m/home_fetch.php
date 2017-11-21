<?php
include 'config.php';
$cuisine = "Indian";
$veg_tag = "Veg";
if(isset($_POST['cuisine'])){
    $cuisine = $_POST['cuisine'];
    $veg_tag = $_POST['veg_tag'];
} 
            $sql=mysqli_query($con,"SELECT * from admin_recipee where category='Chef-La-Pumb' and cuisine='$cuisine' and veg_tag = '$veg_tag'");
            while($row = mysqli_fetch_array($sql)){
                $id = $row['id'];
                $recipe = $row['recipe_name1'];
                $desc = $row['description'];
                $cuisine = $row['cuisine'];
                $vegtag = $row['veg_tag'];
                $image = $row['image_dir1']; 
                $by = $row['recipe_by']; 
$avail = $row['availability'];
?>
		
                <div>
        <a href="ppage.php?recipe_name1=<?php echo $recipe; ?> " style="text-decoration:none; color:black">
        <div class="recipe">
            
                    <div class="w3-display-container" id="recipe_image">
                        <img src="http://groctaurantretail.com/admin/zxy321/<?php echo $image; ?>" style="width: 100%;height: 180px">
  <div class="w3-display-bottomleft w3-container" id="name-background">
    <div id="recipe_detail">
      <p style="font-size: 20px;font-family: 'Montserrat', sans-serif; margin-bottom:6px;"><?php echo $recipe; ?></p>
      <p style="font-size: 12px;font-family: 'Josefin Sans', sans-serif;">By <?php echo $by; ?></p>
    </div>
  </div>
  <?php 
  if($vegtag==Veg){
      echo "<div class='w3-display-bottomright w3-container' style='bottom: 11px; margin-right:-10;'><img src='http://www.groctaurant.com/images/veg.png' width='25px'></div>";
  }
  else{
   echo "<div class='w3-display-bottomright w3-container' style='bottom: 11px; margin-right:-10;'><img src='http://www.groctaurant.com/images/non.png' width='25px'></div>";
  }
  ?>
</div>
                    </div> 
                </a></div>
                
<div class="container-fluid">
                <div class="row text-center add-to-cart-row" style="color: white;background:#f7941d;">
<?php if($avail=='Available'){?>
                    <div class="col-xs-4" style="padding: 5px;font-size: 16px"> 
                        Serving
                    </div>
        
                    <div class="col-xs-3" style="padding: 6px">
                        <select class="serving" style="padding: 0 4px;background: white;width: 100%;color: #cc6242;font-size: 15px">
                            <?php 
                            $sql1=mysqli_query($con,"SELECT * from admin_recipeservings where name='$recipe'");
                            while($row1=mysqli_fetch_array($sql1)){
                                echo "<option value='".$row1['price'].",".$row1['servings'].",".$id."'>".$row1['servings']."</option>";
                            } ?>
                        </select>
                    </div>
        
                    <div class="col-xs-3" style="padding: 6px">
                        <?php 
                        $sql2 = mysqli_query($con,"SELECT MIN(id),name,servings,price from admin_recipeservings where name='".$recipe."' GROUP BY name ");
                        while($row2 = mysqli_fetch_array($sql2)){
                            $price = $row2['price'];
                            $serving = $row2['servings'];
                        } ?>
                        <b>₹<?php echo $price; ?>/-</b>
                    </div>
        
                    <div class="col-xs-2 text-center" style="background:#0b9444;padding: 0">  
                        <button class="btn add-to-cart-button addToCart" value="<?php echo $id ?>,<?php echo $serving; ?>" style="background:#0b9444;font-size: 23px;padding: 0px">+</button>
                    </div> 
<?php } else{ ?>
			<h4 style="color:red;"><center><b>Out Of Stock</b></center></h2>
			<?php } ?> 
                </div></div>
            <?php 
            } ?>