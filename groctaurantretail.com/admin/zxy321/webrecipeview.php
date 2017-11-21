<?php
include 'session.php';
if($login_role != "admin" && $login_role == "Order Platform"){
    header("location: orders.php");
    die();
}
if(isset($_GET['id'])){ 
    $id = $_GET['id'];
    include '../../db/config.php';
    $result = mysqli_query($con, "SELECT * from admin_recipee where id='$id'");
    $row= mysqli_fetch_array($result);
    $name = $row['recipe_name1'];
    $name_dir = "direc_".str_replace(" ", "_", $name);
    $query = mysqli_query($con, "SELECT * from admin_recipeservings where name = '$name'");
    $queryx = mysqli_query($con, "SELECT * from admin_recipee order by recipe_name1");
    $rec_name = "";
    while($result = mysqli_fetch_array($queryx)){
    $rec_name .= "<option>".$result['recipe_name1']."</option>"; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" type="image/png" href="../../images/GR.png"/>
    <title>GROCTAURANT</title>
	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" />
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	  <link href="https://fonts.googleapis.com/css?family=Oswald:500,600" rel="stylesheet">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2-bootstrap.css"> 
	
</head>
<body>
    <?php include 'navbar.php'; ?> 	
	<div class="container-fluid" style="margin-bottom:80px; margin-top:50px">
	    <h2><center>Web Recipe of <?php echo $row['recipe_name1']; ?></center></h2>
	    <a href="webrecipes.php" class="btn btn-danger">Go Back Simon!</a>
	    <br>
	    <div class="col-sm-8 col-sm-offset-2">
	        <form class="form-horizontal" method="POST" action="webrecipeview1.php" enctype="multipart/form-data">
	            <input type="text" name="id" value="<?php echo $row['id']; ?>" hidden>
	        <div class="form-group">
	        <div class="col-sm-3">
	            <label>Name 1: </label>
	        </div>
	        <div class="col-sm-9">
	            <input type="text" class="form-control" value="<?php echo $row['recipe_name1']; ?>" name="name1" readonly required>
	        </div>
	        </div>
	        <div class="form-group">
	        <div class="col-sm-3">
	            <label>Name 2: </label>
	        </div>
	        <div class="col-sm-9">
	            <input type="text" class="form-control" value="<?php echo $row['recipe_name2']; ?>" name="name2">
	        </div>
	        </div>
	        <div class="form-group">
	        <div class="col-sm-3">
	            <label>Category: </label>
	        </div>
	        <div class="col-sm-9">
	            <input type="text" class="form-control" value="<?php echo $row['category']; ?>" name="cname" required>
	        </div>
	        </div>
	        <div class="form-group">
	        <div class="col-sm-3">
	            <label>SKU: </label>
	        </div>
	        <div class="col-sm-9">
	            <input type="text" class="form-control" value="<?php echo $row['sku']; ?>" name="sku" required>
	        </div>
	        </div>
	        <div class="form-group">
	        <div class="col-sm-3">
	            <label>Cuisine: </label>
	        </div>
	        <div class="col-sm-9">
	            <select class='form-control' id="cuisine" name='cuisine' placeholder="Select Cuisne" required>
					<option><?php echo $row['cuisine']; ?></option>
					<option>Indian</option>
					<option>Italian</option>
					<option>Chinese</option>
					<option>Thai</option>
					<option>Kitchen Protein</option>					
				</select>
	        </div>
	        </div>
	        <div class="form-group">
	           <div class="col-sm-3">
	        <label class="control-label">Veg Tag:</label></div>
	        <?php if($row['veg_tag'] == "Veg"){ ?>
			<div class="col-sm-9">
				<label class="radio-inline">
					<input type="radio" name="vegtag" value="Veg" checked required>Veg
				</label>
				<label class="radio-inline">
					<input type="radio" name="vegtag" value="Non-veg">Non-veg
				</label>
			</div>
			<?php } else { ?>
			<div class="col-sm-9">
				<label class="radio-inline">
					<input type="radio" name="vegtag" value="Veg" required>Veg
				</label>
				<label class="radio-inline">
					<input type="radio" name="vegtag" value="Non-veg" checked>Non-veg
				</label>
			</div>
			<?php } ?>
	        </div>
	        <div class="form-group">
	        <div class="col-sm-3">
	            <label>Difficulty: </label>
	        </div>
	        <div class="col-sm-9">
	            <input type="number" class="form-control" min="1" max="3" value="<?php echo $row['difficulty']; ?>" name="difficulty" required>
	        </div>
	        </div>
	        <div class="form-group">
	        <div class="col-sm-3">
	            <label>Recipe By: </label>
	        </div>
	        <div class="col-sm-9">
	            <input type="text" class="form-control" value="<?php echo $row['recipe_by']; ?>" name="by">
	        </div>
	        </div>
	        <div class="form-group">
	        <div class="col-sm-3">
	            <label>Description: </label>
	        </div>
	        <div class="col-sm-9">
	            <textarea class="form-control" name="desc"><?php echo $row['description']; ?></textarea>
	        </div>
	        </div>
	        <div class="form-group">
	        <div class="col-sm-3">
	            <label>Max-Time: </label>
	        </div>
	        <div class="col-sm-9">
	            <input type="number" class="form-control" min="0" value="<?php echo $row['max_time']; ?>" name="time" >
	        </div>
	        </div>
	        <div class="form-group">
	        <div class="col-sm-3">
	            <label>Utensils: </label>
	        </div>
	        <div class="col-sm-9">
	            <input type="text" class="form-control" value="<?php echo $row['utensils']; ?>" name="utensils">
	        </div>
	        </div>
	        <div class="form-group">
	        <div class="col-sm-3">
	            <label>Allergies: </label>
	        </div>
	        <div class="col-sm-9">
	            <input type="text" class="form-control" value="<?php echo $row['allergies']; ?>" name="allergy">
	        </div>
	        </div>
	        <div class="form-group">
	        <div class="col-sm-3">
	            <label>Keywords: </label>
	        </div>
	        <div class="col-sm-9">
	            <input type="text" class="form-control" value="<?php echo $row['recipe_keywords']; ?>" name="keyword">
	        </div>
	        </div>
	        <div class="form-group">
			<label class="col-sm-3">Accompanients:</label>
			<div class="col-sm-3">
				<select class='form-control selectrec' name='accomp1'>
				    <option><?php echo $row['accomp1']; ?></option>
					<?php
					echo $rec_name;
					?>
				</select>
			</div>
			<div class="col-sm-3">
				<select class='form-control selectrec' name='accomp2'>
				    <option><?php echo $row['accomp2']; ?></option>
					<?php
					echo $rec_name;
					?>
				</select>
			</div>
			<div class="col-sm-3">
				<select class='form-control selectrec' name='accomp3'>
				    <option><?php echo $row['accomp3']; ?></option>
					<?php
					echo $rec_name;
					?>
				</select>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3">Try other Dishes:</label>
			<div class="col-sm-3">
				<select class='form-control selectrec' name='other_dish1'>
				    <option><?php echo $row['other_dish1']; ?></option>
					<?php
					echo $rec_name;
					?>
				</select>
			</div>
			<div class="col-sm-3">
				<select class='form-control selectrec' name='other_dish2'>
				    <option><?php echo $row['other_dish2']; ?></option>
					<?php
					echo $rec_name;
					?>
				</select>
			</div>
			<div class="col-sm-3">
				<select class='form-control selectrec' name='other_dish3'>
				    <option><?php echo $row['other_dish3']; ?></option>
					<?php
					echo $rec_name;
					?>
				</select>
			</div>
		</div>
	        <div class="form-group">
	        <div class="col-sm-3">
	            <label>Availability: </label>
	        </div>
	        <div class="col-sm-9">
	            <select class='form-control' id="vis" name='vis' name="vis" required>
	                <?php if($row['availability']== "Available"){ ?>
					<option>Available</option>
					<option>Unavailable</option>
					<?php } else { ?>
					<option>Unavailable</option>
					<option>Available</option>
					<?php } ?>
				</select>
	        </div>
	        </div>
	        <div class="form-group">
	        <div class="col-sm-3">
			    <label>Dish Image 1:</label></div>
    			<div class="col-sm-9">
    				<input type='file' name="image[]"><img id="myImg" src="<?php echo $row['image_dir1']; ?>" width="300px">
    			</div>
			</div>
		<div class="form-group">
	        <div class="col-sm-3">
			    <label>Dish Image 2:</label></div>
    			<div class="col-sm-9">
    				<input type='file' name="image[]"><img id="myImg" src="<?php echo $row['image_dir2']; ?>" width="300px">
    			</div>
			</div>

			<div class="form-group">
	        <div class="col-sm-3">
    			<label>Video Link:</label></div>
    			<div class="col-sm-9">
    				<input type="text" class='form-control' name='video' value="<?php echo $row['video_link']; ?>">
    			</div>
		    </div>
		    <div class="form-group">
	        <div class="col-sm-3">
    			<label>Prep Direc:</label></div>
    			<div class="col-sm-9">
    				<textarea class="form-control" name="prep_dir"><?php echo $row['prep_dir']; ?></textarea>
    			</div>
		    </div>
	    </div>
	    <div class="col-sm-4 col-sm-offset-4">
<br><table>
<tr>
<th style="text-align:center">Servings</th>
<th style="text-align:center">Price</th></tr>
<?php while($rowa = mysqli_fetch_array($query)){ ?>
<tr>
<td><input type="number" min="1" class="form-control" name="serving[]" value="<?php echo $rowa['servings']; ?>"></td>
<td><input type="number" min="1" class="form-control" name="price[]" value="<?php echo $rowa['price']; ?>"></td>
</tr>  
<?php } ?>
<tr>
<td><input type="number" min="1" class="form-control" name="serving[]" placeholder="Enter Serving"></td>
<td><input type="number" min="1" class="form-control" name="price[]" placeholder="Enter Price"></td>
</tr>
<tr>
<td><input type="number" min="1" class="form-control" name="serving[]" placeholder="Enter Serving"></td>
<td><input type="number" min="1" class="form-control" name="price[]" placeholder="Enter Price"></td>
</tr>
<tr>
<td><input type="number" min="1" class="form-control" name="serving[]" placeholder="Enter Serving"></td>
<td><input type="number" min="1" class="form-control" name="price[]" placeholder="Enter Price"></td>
</tr>
<tr>
<td><input type="number" min="1" class="form-control" name="serving[]" placeholder="Enter Serving"></td>
<td><input type="number" min="1" class="form-control" name="price[]" placeholder="Enter Price"></td>
</tr>
</table></div>

<center><input class="btn btn-success" type="submit" value="Update" name="submit"></center>
	        </form>
	</div>
<script type="text/javascript">
$(function() {
    $(":file").change(function() {
        var tag =$(this);
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                tag.next().attr('src', e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
        }
    });
    $.getScript('http://cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.min.js',function(){
      var select = $('.selectrec').select2();
    }); 
});

</script>
</body>
</html>
<?php    
}
?>