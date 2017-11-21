<?php
include('session.php');
if($login_role != "admin" && $login_role == "Order Platform"){
    header("location: orders.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" type="image/png" href="../../images/GR.png"/>
    <title>GROCTAURANT</title>
	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	  <link href="https://fonts.googleapis.com/css?family=Oswald:500,600" rel="stylesheet">
	
</head>
<body>	
	
    <?php include 'navbar.php'; ?> 	
	<div class="container-fluid" style="margin-bottom:80px; margin-top:50px">
	    <h2><center>Web Recipes</center></h2>
	    <a href="recipe.php" class="btn btn-danger">Go Back Simon!</a>
	    <a href="webrecipee.php"   target="_blank" class="btn btn-primary pull-right">Add Recipe</a>
	    <a href="cook.php" class="btn btn-warning pull-right" target="_blank" style="margin-right:10px;">Add Steps</a>
	   <br><br><div class="table-responsive">
	       <table class="table table-bordered">
	        <tr>
	            <th>ID</th>
	            <th>Name1</th>
	            <th>Name2</th>
	            <th>Category</th>
	            <th>SKU</th>
	            <th>Cuisine</th>
	            <th>Veg Tag</th>
	            <th>Difficulty</th>
	            <th>Recipe By</th>
	            <th>Description</th>
	            <th>Max Time</th>
	            <th>Utensils</th>
	            <th>Allergies</th>
	            <th>Keywords</th>
	            <th>Availability</th>
	            <th>Action</th>
	        </tr>

<?php

include '../../db/config.php';

$sql="SELECT * from admin_recipee order by id desc";
$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td><a href='webrecipedirec.php?id=".$row['id']."' target='_blank'>" . $row['id'] . "</a></td>";
echo "<td><a href='webrecipeview.php?id=".$row['id']."' target='_blank'><b>" . $row['recipe_name1'] . "</b></a></td>";
echo "<td>" . $row['recipe_name2'] . "</td>";
echo "<td>" . $row['category'] . "</td>";
echo "<td>" . $row['sku'] . "</td>";
echo "<td>" . $row['cuisine'] . "</td>";
echo "<td>" . $row['veg_tag'] . "</td>";
echo "<td>" . $row['difficulty'] . "</td>";
echo "<td>" . $row['recipe_by'] . "</td>";
echo "<td>" . $row['description'] . "</td>";
echo "<td>" . $row['max_time'] . "</td>";
echo "<td>" . $row['utensils'] . "</td>";
echo "<td>" . $row['allergies'] . "</td>";
echo "<td>" . $row['recipe_keywords'] . "</td>";
echo "<td>" . $row['availability'] . "</td>";
echo "<td><center><a href='webrecipesdelete.php?id=".$row['id']."&name=".$row['recipe_name1']."' class='btn btn-danger'>X</a></center></td>";
}
?>
</tr>
	    </div></table>
	</div>
