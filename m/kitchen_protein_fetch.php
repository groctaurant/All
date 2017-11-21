<?php

if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
		include("config.php");
		$veg_tag = "Veg";
		if(isset($_POST['veg_tag'])){
	$veg_tag = $_POST['veg_tag'];
		}
	?>	
	<div class="container-fluid" id="proteins">
	<?php
	$results = mysqli_query($con, "SELECT * FROM admin_recipee where cuisine='Proteins' and veg_tag = '$veg_tag'  and category = 'Kitchen Protein' and availability = 'Available' ORDER BY id ASC");
	$count=mysqli_num_rows($results);
	if($count > 0){
		echo "<h3 class='recname12'>Proteins</h3>";
	while($row = mysqli_fetch_array($results)){
	    $id = $row['id'];
	    $recipe = $row['recipe_name1'];
	    $desc = $row['description'];
	    $cuisine = $row['cuisine'];
	    $vegtag = $row['veg_tag'];
	    $by=$row['recipe_by'];
	    $image = $row['image_dir1'];
	?>
				<div class="row" style="padding:10px">
				 <div class="col-xs-1">
	        <?php 
	                if($vegtag=='Veg'){
	                  echo "<img src='http://groctaurant.com/images/veg.png' width='18px' style='margin-top:3px;'>";
	                } else{
	                  echo "<img src='http://groctaurant.com/images/non.png' width='18px' style='margin-top:3px;'>";
	                }
	                ?> 
					</div>
					<div class="col-xs-6">
					<span class='recname1'> <?php echo $recipe; ?></span>
					</div>
	                <div class="col-xs-2">
	                <?php 
	                $sql2 = mysqli_query($con,"SELECT MIN(id),name,servings,price from admin_recipeservings where name='".$recipe."' GROUP BY name ");
	                while($row2 = mysqli_fetch_array($sql2)){
	                    $price = $row2['price'];
	                    $serving = $row2['servings'];
						
	                }
	                ?>
	                <p class="serv_price recname1 text-center">₹<?php echo $price; ?></p>
					</div>
					<div class="col-xs-2">
					<button class="w3-btn addToCart" value="<?php echo $id ?>,<?php echo $serving; ?>" style="background-color: #C70039; color: white; float:right; padding:1px 8px;">+</button>
	            </div>
		</div>		
	<?php 
	} } ?>
	</div>
		
	<div class="container-fluid" id="carbs">
	<?php
	$results = mysqli_query($con, "SELECT * FROM admin_recipee where cuisine='Carbs' and veg_tag = '$veg_tag'  and category = 'Kitchen Protein' and availability = 'Available' ORDER BY id ASC");
	$count=mysqli_num_rows($results);
	if($count > 0){
		echo "<br><h3 class='recname12'>Carbs</h3>";
	while($row = mysqli_fetch_array($results)){
	    $id = $row['id'];
	    $recipe = $row['recipe_name1'];
	    $desc = $row['description'];
	    $cuisine = $row['cuisine'];
	    $vegtag = $row['veg_tag'];
	    $by=$row['recipe_by'];
	    $image = $row['image_dir1'];
	?>
	
				<div class="row" style="padding:10px">
				 <div class="col-xs-1">
	        <?php 
	                if($vegtag=='Veg'){
	                  echo "<img src='http://groctaurant.com/images/veg.png' width='18px' style='margin-top:3px;'>";
	                } else{
	                  echo "<img src='http://groctaurant.com/images/non.png' width='18px' style='margin-top:3px;'>";
	                }
	                ?> 
					</div>
					<div class="col-xs-6">
					<span class='recname1'> <?php echo $recipe; ?></span>
					</div>
	                <div class="col-xs-2">
	                <?php 
	                $sql2 = mysqli_query($con,"SELECT MIN(id),name,servings,price from admin_recipeservings where name='".$recipe."' GROUP BY name ");
	                while($row2 = mysqli_fetch_array($sql2)){
	                    $price = $row2['price'];
	                    $serving = $row2['servings'];
						
	                }
	                ?>
	                <p class="serv_price recname1 text-center">₹<?php echo $price; ?></p>
					</div>
					<div class="col-xs-2">
					<button class="w3-btn addToCart" value="<?php echo $id ?>,<?php echo $serving; ?>" style="background-color: #C70039; color: white; float:right; padding:1px 8px;">+</button>
	            </div>
		</div>		
	<?php 
	} } ?>
	</div>
		
	<div class="container-fluid" id="breakfast">
	<?php
	$results = mysqli_query($con, "SELECT * FROM admin_recipee where cuisine='Breakfast' and veg_tag = '$veg_tag'  and category = 'Kitchen Protein' and availability = 'Available' ORDER BY id ASC");
	$count=mysqli_num_rows($results);
	if($count > 0){
		echo "<br><h3 class='recname12'>Breakfast</h3>";
	while($row = mysqli_fetch_array($results)){
	    $id = $row['id'];
	    $recipe = $row['recipe_name1'];
	    $desc = $row['description'];
	    $cuisine = $row['cuisine'];
	    $vegtag = $row['veg_tag'];
	    $by=$row['recipe_by'];
	    $image = $row['image_dir1'];
	?>
	
				<div class="row" style="padding:10px">
				 <div class="col-xs-1">
	        <?php 
	                if($vegtag=='Veg'){
	                  echo "<img src='http://groctaurant.com/images/veg.png' width='18px' style='margin-top:3px;'>";
	                } else{
	                  echo "<img src='http://groctaurant.com/images/non.png' width='18px' style='margin-top:3px;'>";
	                }
	                ?> 
					</div>
					<div class="col-xs-6">
					<span class='recname1'> <?php echo $recipe; ?></span>
					</div>
	                <div class="col-xs-2">
	                <?php 
	                $sql2 = mysqli_query($con,"SELECT MIN(id),name,servings,price from admin_recipeservings where name='".$recipe."' GROUP BY name ");
	                while($row2 = mysqli_fetch_array($sql2)){
	                    $price = $row2['price'];
	                    $serving = $row2['servings'];
						
	                }
	                ?>
	                <p class="serv_price recname1 text-center">₹<?php echo $price; ?></p>
					</div>
					<div class="col-xs-2">
					<button class="w3-btn addToCart" value="<?php echo $id ?>,<?php echo $serving; ?>" style="background-color: #C70039; color: white; float:right; padding:1px 8px;">+</button>
	            </div>
		</div>		
	<?php 
	} } ?>
	</div>
		<div class="container-fluid" id="shakes">
	<?php
	$results = mysqli_query($con, "SELECT * FROM admin_recipee where cuisine='Shakes And Smoothies' and veg_tag = '$veg_tag'  and category = 'Kitchen Protein' and availability = 'Available' ORDER BY id ASC");
	$count=mysqli_num_rows($results);
	if($count > 0){
		echo "<br><h3 class='recname12'>Shakes And Smoothies</h3>";
	while($row = mysqli_fetch_array($results)){
	    $id = $row['id'];
	    $recipe = $row['recipe_name1'];
	    $desc = $row['description'];
	    $cuisine = $row['cuisine'];
	    $vegtag = $row['veg_tag'];
	    $by=$row['recipe_by'];
	    $image = $row['image_dir1'];
	?>
	
				<div class="row" style="padding:10px">
				 <div class="col-xs-1">
	        <?php 
	                if($vegtag=='Veg'){
	                  echo "<img src='http://groctaurant.com/images/veg.png' width='18px' style='margin-top:3px;'>";
	                } else{
	                  echo "<img src='http://groctaurant.com/images/non.png' width='18px' style='margin-top:3px;'>";
	                }
	                ?> 
					</div>
					<div class="col-xs-6">
					<span class='recname1'> <?php echo $recipe; ?></span>
					</div>
	                <div class="col-xs-2">
	                <?php 
	                $sql2 = mysqli_query($con,"SELECT MIN(id),name,servings,price from admin_recipeservings where name='".$recipe."' GROUP BY name ");
	                while($row2 = mysqli_fetch_array($sql2)){
	                    $price = $row2['price'];
	                    $serving = $row2['servings'];
						
	                }
	                ?>
	                <p class="serv_price recname1 text-center">₹<?php echo $price; ?></p>
					</div>
					<div class="col-xs-2">
					<button class="w3-btn addToCart" value="<?php echo $id ?>,<?php echo $serving; ?>" style="background-color: #C70039; color: white; float:right; padding:1px 8px;">+</button>
	            </div>
		</div>		
	<?php 
	} } ?>
	</div>
		<div class="container-fluid" id="salads">
	<?php
	$results = mysqli_query($con, "SELECT * FROM admin_recipee where cuisine='Salads' and veg_tag = '$veg_tag'  and category = 'Kitchen Protein' and availability = 'Available' ORDER BY id ASC");
	$count=mysqli_num_rows($results);
	if($count > 0){
		echo "<h3 class='recname12'>Salads</h3>";
	while($row = mysqli_fetch_array($results)){
	    $id = $row['id'];
	    $recipe = $row['recipe_name1'];
	    $desc = $row['description'];
	    $cuisine = $row['cuisine'];
	    $vegtag = $row['veg_tag'];
	    $by=$row['recipe_by'];
	    $image = $row['image_dir1'];
	?>
	
				<div class="row" style="padding:10px">
				 <div class="col-xs-1">
	        <?php 
	                if($vegtag=='Veg'){
	                  echo "<img src='http://groctaurant.com/images/veg.png' width='18px' style='margin-top:3px;'>";
	                } else{
	                  echo "<img src='http://groctaurant.com/images/non.png' width='18px' style='margin-top:3px;'>";
	                }
	                ?> 
					</div>
					<div class="col-xs-6">
					<span class='recname1'> <?php echo $recipe; ?></span>
					</div>
	                <div class="col-xs-2">
	                <?php 
	                $sql2 = mysqli_query($con,"SELECT MIN(id),name,servings,price from admin_recipeservings where name='".$recipe."' GROUP BY name ");
	                while($row2 = mysqli_fetch_array($sql2)){
	                    $price = $row2['price'];
	                    $serving = $row2['servings'];
						
	                }
	                ?>
	                <p class="serv_price recname1 text-center">₹<?php echo $price; ?></p>
					</div>
					<div class="col-xs-2">
					<button class="w3-btn addToCart" value="<?php echo $id ?>,<?php echo $serving; ?>" style="background-color: #C70039; color: white; float:right; padding:1px 8px;">+</button>
	            </div>
		</div>		
	<?php 
	} } ?>
	</div>

	<?php
	}
?>

