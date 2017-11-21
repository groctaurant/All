<?php
if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	
	include("config.php");  //include config file
	//Get page number from Ajax POST
	$items_fetch = 12; //item to display per page
	if(isset($_POST["offset"])){
		$cuisine = $_POST['cuisine'];
		$veg_tag = $_POST['veg_tag'];
		$offset = $_POST["offset"];
		$count = $offset+1;
		
	}else{
		$cuisine = "Indian";
		$veg_tag = "Veg";
		$offset = 0;
		$count = 1;
	}
	
	$results = mysqli_query($con, "SELECT * FROM admin_recipee where cuisine='$cuisine' and veg_tag = '$veg_tag' and category='Chef-La-Pumb' ORDER BY id ASC LIMIT $offset, $items_fetch");
	$result_count = mysqli_num_rows($results);
	if($result_count > 0){ ?>
	<div class="container-fluid">
	<?php
	while($row = mysqli_fetch_array($results)){
	    $id = $row['id'];
	    $recipe = $row['recipe_name1'];
	    $desc = $row['description'];
	    $cuisine = $row['cuisine'];
	    $vegtag = $row['veg_tag'];
	    $by=$row['recipe_by'];
	    $image = $row['image_dir1'];
	?>
	    <div class="col-md-4" style="padding: 6px; margin-bottom:24px;">
	        <a href=" productpage.php?recipe_name1=<?php echo $recipe; ?> " style="text-decoration:none; color:black">
	            <div class="w3-display-container" id="recipe_image" style="height: 212px; background-position: center; background-size: cover; color: white; box-shadow: 2px 3px 6px #888888; overflow: hidden; background-image: url('groctaurantretail.com/admin/zxy321/<?php echo $image;?>');">
	                <div class="w3-display-bottomleft w3-container" id="name-background">
	                    <div id="recipe_detail">
	                        <p style="font-size: 15px;font-family: 'Questrial', sans-serif; letter-spacing:1px;font-weight:bold;"><span class="name_rec"><?php echo $recipe; ?></span>
	                            <br>
	                            <span style="font-size: 10px;">By <?php echo $by; ?></span>
	                        </p>
	                    </div>
	                </div>
	                <?php 
	                if($vegtag==Veg){
	                  echo "<div class='w3-display-bottomright w3-container' style='right:-10px; bottom: 10px'><img src='images/veg.png' width='20px'></div>";
	                } else{
	                  echo "<div class='w3-display-bottomright w3-container' style='right:-10px; bottom: 10px'><img src='images/non.png' width='20px'></div>";
	                }
	                ?>
	            </div>
	        </a>
			<div class="row" style="padding:10px; ">
			    
	            <div class="col-sm-4 col-xs-4">
	                
	                <select class="serving" style="padding:4px 8px; border-radius:5px;">
	                <?php 
	                $sql1=mysqli_query($con,"SELECT * from admin_recipeservings where name='$recipe'");
	                while($row1=mysqli_fetch_array($sql1)){
	                    echo "<option value='".$row1['price'].",".$row1['servings'].",".$id."'>".$row1['servings']."</option>"; 
	                }
	                ?>
	                </select><span style="font-family: 'Questrial', sans-serif; letter-spacing:1.5px; float:left; font-size:9px; color:grey;">Servings</span>
				</div>
	            <div class="col-sm-4 col-xs-4">
	                <?php 
	                $sql2 = mysqli_query($con,"SELECT MIN(id),name,servings,price from admin_recipeservings where name='".$recipe."' GROUP BY name ");
	                while($row2 = mysqli_fetch_array($sql2)){
	                    $price = $row2['price'];
	                    $serving = $row2['servings'];
	                }
	                ?>
	                <p class="serv_price recname2 text-center">₹<?php echo $price; ?></p>
	            </div>
	            <div class="col-sm-4 col-xs-4">
		<button class="btn addToCart" value="<?php echo $id ?>,<?php echo $serving; ?>" style="background-color: #C70039; float:right; color: white; padding:4px 12px;">+</button>
		<input type="hidden" class="lazy_count" value="<?php echo $count; ?>">
		</div> </div></div>
		 
	<?php 
	$count++;
	} ?> 
</div><br>
	<?php 
}
}
?>