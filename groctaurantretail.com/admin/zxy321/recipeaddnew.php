<?php
include('session.php');
if($login_role != "admin" && $login_role == "Order Platform"){
    header("location: orders.php");
}
include '../../db/config.php';
if(isset($_POST['submit'])){
  $rec_sku = $_POST['rec_sku'];
  $rec_name = $_POST['rec_name'];
  $rec_cuisine = $_POST['rec_cuisine'];
  $rec_vegtag = $_POST['rec_vegtag'];
  $rec_serving = $_POST['rec_serving'];
  $rec_price = $_POST['rec_price'];
  mysqli_query($con, "INSERT INTO grret_recipes(rec_sku, rec_name, rec_cuisine, rec_vegtag, rec_serving, rec_price) VALUES('$rec_sku', '$rec_name', '$rec_cuisine', '$rec_vegtag', '$rec_serving', '$rec_price')");
  header("Location: recipe.php");
}
?>
<html>
<head>
  <title>GROCTAURANT</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link href="https://fonts.googleapis.com/css?family=Oswald:500,600" rel="stylesheet">
   <style>
.container{
  margin-top: 120px;
}
li,h2,h1{font-family: 'Oswald', sans-serif;}
.hidden{
  display: none;
}
li.active{
  background: #d0d0d0;
}
a.active{
  color: #000;
}
</style>
</head>

<body>
<?php include'navbar.php'; ?>

<div id="wrapper" class="wrapper">
   <div class="container">
    <h1 class="text-center">Add New Recipe</h1>
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
                    <div class="panel-body">
           <form class="form-horizontal" role="form" method="POST" action=""> 

       <div class="form-group">
            <label for="sku" class="col-md-4 control-label">SKU :</label>
            <div class="col-md-6">
            <input id="sku" type="text" class="form-control" name="rec_sku" required>
            </div></div>

      <div class="form-group">
            <label for="recipe_name" class="col-md-4 control-label">Recipe Name :</label>
            <div class="col-md-6">
            <input id="recipe_name" type="text" class="form-control" name="rec_name" required>
            </div></div>

      <div class="form-group">
            <label for="cuisine" class="col-md-4 control-label">Cuisine :</label>
            <div class="col-md-6">
            <input id="cuisine" type="text" class="form-control" name="rec_cuisine" required>
            </div></div>

      <div class="form-group">
            <label for="vega_tag" class="col-md-4 control-label">Veg Tag :</label>
            <div class="col-md-6">
            <label class="radio-inline"><input id="veg_tag" type="radio" name="rec_vegtag" value="Veg" required>Veg</label>
            <label class="radio-inline"><input id="veg_tag" type="radio" name="rec_vegtag" value="Non-Veg" required>Non-Veg</label>
            </div></div>

      <div class="form-group">
            <label for="serving" class="col-md-4 control-label">Serving :</label>
            <div class="col-md-6">
            <input id="serving" type="number" class="form-control" name="rec_serving" required>
            </div></div>

      <div class="form-group">
            <label for="price" class="col-md-4 control-label">Price :</label>
            <div class="col-md-6">
            <input id="price" type="number" class="form-control" name="rec_price" required>
            </div></div>

       <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" name="submit" class="btn btn-primary">
                  ADD RECIPE
                </button>
              </div>
            </div>

          </form> 
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</body>
</html>