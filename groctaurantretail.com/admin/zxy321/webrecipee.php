<?php
include('session.php');
if($login_role != "admin" && $login_role == "Order Platform"){
    header("location: orders.php");
    die();
}
$query = mysqli_query($con, "SELECT * from admin_recipee order by recipe_name1");
$rec_name = "";
while($result = mysqli_fetch_array($query)){
    $rec_name .= "<option>".$result['recipe_name1']."</option>"; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head><link rel="shortcut icon" type="image/png" href="../../images/GR.png"/>
    <title>GROCTAURANT</title>
	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	  <link href="https://fonts.googleapis.com/css?family=Oswald:500,600" rel="stylesheet">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2-bootstrap.css"> 
	
</head>
<body>
    
    <?php include 'navbar.php'; ?> 	
	<div class="container" style="margin-bottom:80px; margin-top:50px">
	    
	    <a href="webrecipes.php" class="btn btn-danger">Go Back Simon!</a>
		<h3><center><b>Recipe Form</b></center></h3>
		<br><form class="form-horizontal" role="form" method="POST" action="recipe1.php" enctype="multipart/form-data">

		<div class="form-group">
			<label class="control-label col-sm-2 col-sm-offset-1">Category:</label>
			<div class="col-sm-8">
				<select class='form-control' id="cname" name='cname' required>
				<option>Chef-La-Pumb</option>
				<option>Kitchen Protein</option>
				<option>Add-ons</option>
			
				</select>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-sm-2 col-sm-offset-1">SKU:</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="sku" name="sku" placeholder="FORMAT- REC-GR/KEY/ALL" required>
			</div>
		</div>


		<div class="form-group">
			<label class="control-label col-sm-2 col-sm-offset-1">Availability:</label>
			<div class="col-sm-8">
				<select class='form-control' id="vis" name='vis' required>
					<option>Available</option>
					<option>Unavailable</option>
				</select>
			</div>
		</div>


		<div class="form-group">
			<label class="control-label col-sm-2 col-sm-offset-1">Recipe Name 1:</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" name="name1" placeholder="Enter Recipe Name 1" required>
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label col-sm-2 col-sm-offset-1">Recipe Name 2:</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" name="name2" placeholder="Enter Recipe Name 2">
			</div>
		</div>


		<div class="form-group">
			<label class="control-label col-sm-2 col-sm-offset-1">Description:</label>
			<div class="col-sm-8">
				<textarea type="text" class="form-control expanding" name="desc" placeholder="Recipe Description"></textarea>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-sm-2 col-sm-offset-1">Cuisine:</label>
			<div class="col-sm-8">
				<select class='form-control' id="cuisine" name='cuisine' placeholder="Select Cuisne" required>
					<option>Indian</option>
					<option>Italian</option>
					<option>Chinese</option>
					<option>Thai</option>
					<option>Proteins</option>
					<option>Carbs</option>
					<option>Salads</option>
					<option>Shakes And Smoothies</option>
					<option>Breakfast</option>
					<option>Combos</option>
					<option>Beverages</option>
				    <option>Desserts</option>
				    <option>Breads</option>
				    <option>KP</option>
				</select>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-sm-2 col-sm-offset-1">Recipe By:</label>
			<div class="col-sm-8">
				<input type="text" class='form-control' name='by' placeholder="Enter Chef Name">
			</div>
		</div>


		<div class="form-group">
			<label class="control-label col-sm-2 col-sm-offset-1">Veg Tag:</label>
			<div class="col-sm-8">
				<label class="radio-inline">
					<input type="radio" name="vegtag" value="Veg" checked required>Veg
				</label>
				<label class="radio-inline">
					<input type="radio" name="vegtag" value="Non-veg">Non-veg
				</label>
			</div>
		</div>


		<center><div class="form-group">
			<label class="control-label col-sm-2 col-sm-offset-1">Dish Image 1:</label>
			<div class="col-sm-8">
				<input type='file' name="image[]" /><img src="" width="300px">
			</div></div></center>
			
			<center><div class="form-group">
			<label class="control-label col-sm-2 col-sm-offset-1">Dish Image 2:</label>
			<div class="col-sm-8">
				<input type='file' name="image[]" /><img src="" width="300px">
			</div></div></center>
			
			<div class="form-group">
			<label class="control-label col-sm-2 col-sm-offset-1">Video Link:</label>
			<div class="col-sm-8">
				<input type="text" class='form-control' name='video' placeholder="Enter Video Link">
			</div>
		</div>

			<br>
			<div class="form-group">
				<label class="control-label col-sm-2 col-sm-offset-1">Max time:</label>
				<div class="col-sm-4"><div class="input-group">
					<input type="number" class="form-control" name="time" min="1" placeholder="Time" >
					<span class="input-group-addon">Minute(s)</span>
				</div></div>
			</div>
			
		
			<div class="form-group">
				<label class="control-label col-sm-2 col-sm-offset-1">Difficulty:</label>
				<div class="col-sm-4">
 <label class="radio-inline">
      <input type="radio" name="difficulty" value="1" checked required> 1
    </label>
    <label class="radio-inline">
      <input type="radio" name="difficulty" value="2" > 2
    </label>
    <label class="radio-inline">
      <input type="radio" name="difficulty" value="3" > 3
    </label>
				</div>
			</div>


			<br><div class="form-group">
			<label class="control-label col-sm-2 col-sm-offset-1">Utensils:</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" name="utensils" placeholder="Enter Utensils" >
				</div>
		</div>


		<div class="form-group">
			<label class="control-label col-sm-2 col-sm-offset-1">Allergies:</label>
			<div class="col-sm-8">
				<input type="text" class='form-control' name='allergy' placeholder="Enter Allergies">
				</div>
		</div>


		<div class="form-group">
			<label class="control-label col-sm-2 col-sm-offset-1">Recipe Keywords:</label>
			<div class="col-sm-8">
				<textarea type="text" class="form-control expanding" name="keyword" placeholder="Comma Separated Recipe Keywords"></textarea>
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label col-sm-2 col-sm-offset-1">Accompanients:</label>
			<div class="col-sm-3">
				<select class='form-control selectrec' id="accomp" name='accomp1'>
				    <option></option>
					<?php
					echo $rec_name;
					?>
				</select>
			</div>
			<div class="col-sm-3">
				<select class='form-control selectrec' id="accomp" name='accomp2'>
				    <option></option>
					<?php
					echo $rec_name;
					?>
				</select>
			</div>
			<div class="col-sm-3">
				<select class='form-control selectrec' id="accomp" name='accomp3'>
				    <option></option>
					<?php
					echo $rec_name;
					?>
				</select>
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label col-sm-2 col-sm-offset-1">Try other Dishes:</label>
			<div class="col-sm-3">
				<select class='form-control selectrec' id="accomp" name='other_dish1'>
				    <option></option>
					<?php
					echo $rec_name;
					?>
				</select>
			</div>
			<div class="col-sm-3">
				<select class='form-control selectrec' id="accomp" name='other_dish2'>
				    <option></option>
					<?php
					echo $rec_name;
					?>
				</select>
			</div>
			<div class="col-sm-3">
				<select class='form-control selectrec' id="accomp" name='other_dish3'>
				    <option></option>
					<?php
					echo $rec_name;
					?>
				</select>
			</div>
		</div>

<div class="form-group">
			<label class="control-label col-sm-2 col-sm-offset-1">Preparation Directions:</label>
			<div class="col-sm-8">
				<textarea type="text" class="form-control expanding" name="prep_dir" placeholder="Preparation Directions" rows="8"></textarea>
			</div>
		</div>
<div class="col-sm-4 col-sm-offset-4">
<br><table>
<tr>
<th style="text-align:center">Servings</th>
<th style="text-align:center">Price</th></tr>
<tr>
<td><input type="number" min="1" class="form-control" name="serving[]" placeholder="Enter Serving" required></td>
<td><input type="number" min="1" class="form-control" name="price[]" placeholder="Enter Price" required></td>
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
<tr>
<td><input type="number" min="1" class="form-control" name="serving[]" placeholder="Enter Serving"></td>
<td><input type="number" min="1" class="form-control" name="price[]" placeholder="Enter Price"></td>
</tr>
<tr>
<td><input type="number" min="1" class="form-control" name="serving[]" placeholder="Enter Serving"></td>
<td><input type="number" min="1" class="form-control" name="price[]" placeholder="Enter Price"></td>
</tr>
</table></div>
		
		<div class="form-group">
			<div class="col-sm-offset-6 col-sm-12">
				<br><input type="submit" class="btn btn-success" name="submit" value="Next" style="">
			</div>
		</div>

	</form></div>
<script type="text/javascript">
$(document).ready(function() {
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
