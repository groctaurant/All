<?php

if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	
	include("config.php");  //include config file
	//Get page number from Ajax POST
	$item_per_page = 12; //item to display per page
	if(isset($_POST["page"])){
		$cuisine = $_POST['cuisine'];
		$veg_tag = $_POST['veg_tag'];
		$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
		if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
	}else{
		$cuisine = "Indian";
		$veg_tag = "Veg";
		$page_number = 1; //if there's no page number, set it to 1
	}
	
	//get total number of records from database for pagination
	$results = mysqli_query($con, "SELECT * FROM admin_recipee where cuisine='$cuisine' and veg_tag = '$veg_tag' and availability = 'Available'");
	$get_total_rows = mysqli_num_rows($results); //hold total records in variable
	//print_r($get_total_rows);
	//break records into pages
	$total_pages = ceil($get_total_rows/$item_per_page);
	
	//get starting position to fetch the records
	$page_position = (($page_number-1) * $item_per_page);
	?>
	<div class="container-fluid">
	<?php
	$results = mysqli_query($con, "SELECT * FROM admin_recipee where cuisine='$cuisine' and veg_tag = '$veg_tag' and category='Chef-La-Pumb' ORDER BY id ASC LIMIT $page_position, $item_per_page");
	while($row = mysqli_fetch_array($results)){
	    $id = $row['id'];
	    $recipe = $row['recipe_name1'];
	    $desc = $row['description'];
	    $cuisine = $row['cuisine'];
	    $vegtag = $row['veg_tag'];
	    $by=$row['recipe_by'];
	    $image = $row['image_dir1'];
	    $avail = $row['availability'];
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
			<?php if($avail=='Available'){?>
			<div class="row" style="padding:10px 6px; ">
			    
	            <div class="col-sm-5 col-xs-5">
	                
	                <select class="serving" style="padding:4px 0px; border-radius:5px;">
	                <?php 
	                $sql1=mysqli_query($con,"SELECT * from admin_recipeservings where name='$recipe'");
	                while($row1=mysqli_fetch_array($sql1)){
	                    echo "<option value='".$row1['price'].",".$row1['servings'].",".$id."'>".$row1['servings']." - ₹".$row1['price']."</option>"; 
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
	            <div class="col-sm-3 col-xs-3">
		<button class="btn addToCart" value="<?php echo $id ?>,<?php echo $serving; ?>" style="background-color: #C70039; float:right; color: white; padding:4px 12px;" onclick="console.log("yokay");">+</button>
		</div> </div>
			<?php } else{ ?>
			<h4 style="color:red;"><center><b>Out Of Stock</b></center></h2>
			<?php } ?>
		</div>	 
	<?php 
	} ?> 
</div><br>
	<?php 
	echo '<div class="text-center">';
	/* We call the pagination function here to generate Pagination link for us. 
	As you can see I have passed several parameters to the function. */
	echo paginate_function($item_per_page, $page_number, $get_total_rows, $total_pages);
	echo '</div><br><br>';
	exit;
}
################ pagination function #########################################
function paginate_function($item_per_page, $current_page, $total_records, $total_pages)
{
    $pagination = '';
    if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
        $pagination .= '<ul class="pagination">';
        
        $right_links    = $current_page + 3; 
        $previous       = $current_page - 3; //previous link 
        $next           = $current_page + 1; //next link
        $first_link     = true; //boolean var to decide our first link
        
        if($current_page > 1){
			$previous_link = ($previous==0 ? 1: $previous);
        	if($previous < 0){
        		$previous_link = 1;
        	}
            $pagination .= '<a href="#" data-page="1" title="First"><li class="first">&laquo;</li></a>'; //first link
            $pagination .= '<a href="#" data-page="'.$previous_link.'" title="Previous"><li>&lt;</li></a>'; //previous link
                for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
                    if($i > 0){
                        $pagination .= '<a href="#" data-page="'.$i.'" title="Page'.$i.'"><li>'.$i.'</li></a>';
                    }
                }   
            $first_link = false; //set first link to false
        }
        
        if($first_link){ //if current active page is first link
            $pagination .= '<li class="first active">'.$current_page.'</li>';
        }elseif($current_page == $total_pages){ //if it's the last active link
            $pagination .= '<li class="last active">'.$current_page.'</li>';
        }else{ //regular current link
            $pagination .= '<li class="active">'.$current_page.'</li>';
        }
                
        for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
            if($i<=$total_pages){
                $pagination .= '<a href="#" data-page="'.$i.'" title="Page '.$i.'"><li>'.$i.'</li></a>';
            }
        }
        if($current_page < $total_pages){ 
				$next_link = ($i > $total_pages) ? $total_pages : $i;
                $pagination .= '<a href="#" data-page="'.$next_link.'" title="Next"><li>&gt;</li></a>'; //next link
                $pagination .= '<a href="#" data-page="'.$total_pages.'" title="Last"><li class="last">&raquo;</li></a>'; //last link
        }
        
        $pagination .= '</ul>'; 
    }
    return $pagination; //return pagination links
}

?>

