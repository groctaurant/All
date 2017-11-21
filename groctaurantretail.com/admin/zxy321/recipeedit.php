<?php
include('session.php');
if($login_role != "admin" && $login_role == "Order Platform"){
    header("location: orders.php");
}
include '../../db/config.php';
$id = $_GET['id'];
$query = mysqli_query($con, "SELECT * from grret_recipes where id='$id'");
$row = mysqli_fetch_array($query);

$name = $row['rec_name'];
$queryjs = mysqli_query($con, "SELECT * from grret_recipejson where recipe_name = '$name'");
$rowjs = mysqli_fetch_array($queryjs);
$pathjs = $rowjs['json_path'];
$data = file_get_contents ('../../'.$pathjs);
$json = json_decode($data, TRUE);
$serving = $row['rec_serving'];
$i = 1;


if(isset($_POST['submit'])){
  $rec_sku = $_POST['rec_sku'];
  $rec_name = $_POST['rec_name'];
  $rec_cuisine = $_POST['rec_cuisine'];
  $rec_vegtag = $_POST['rec_vegtag'];
  $rec_serving = $_POST['rec_serving'];
  $rec_price = $_POST['rec_price'];
  mysqli_query($con, "UPDATE grret_recipes set rec_sku='$rec_sku', rec_name='$rec_name', rec_cuisine='$rec_cuisine', rec_vegtag='$rec_vegtag', rec_serving='$rec_serving', rec_price='$rec_price' where id='$id'");
  header("Location: recipe.php");
}
?>
<html>
<head>
<link rel="shortcut icon" type="image/png" href="../../images/GR.png"/>
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
<?php include 'navbar.php'; ?>

<div id="wrapper" class="wrapper">

<div class="container">
  <div class="row">
      <h1>Edit Recipe</h1>
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        
        <div class="panel-body">
          <form class="form-horizontal" role="form" method="POST" action=""> 

          <div class="form-group">
            <label for="sku" class="col-md-4 control-label">SKU :</label>
            <div class="col-md-6">
            <input id="sku" type="text" class="form-control" name="rec_sku" value="<?php echo $row['rec_sku']; ?>" required>
            </div></div>

          <div class="form-group">
            <label for="recipe_name" class="col-md-4 control-label">Recipe Name :</label>
            <div class="col-md-6">
            <input id="recipe_name" type="text" class="form-control" name="rec_name" value="<?php echo $row['rec_name']; ?>" required>
            </div></div>

      <div class="form-group">
            <label for="cuisine" class="col-md-4 control-label">Cuisine :</label>
            <div class="col-md-6">
            <input id="cuisine" type="text" class="form-control" name="rec_cuisine" value="<?php echo $row['rec_cuisine']; ?>" required>
            </div></div>

      <div class="form-group">
            <label for="vega_tag" class="col-md-4 control-label">Veg Tag :</label>
            <div class="col-md-6">
            <?php if($row['rec_vegtag'] == "Veg"){ ?>
              <label class="radio-inline"><input id="veg_tag" type="radio" name="rec_vegtag" value="Veg" checked="true" required>Veg</label>
              <label class="radio-inline"><input id="veg_tag" type="radio" name="rec_vegtag" value="Non-Veg" required>Non-Veg</label>
            <?php } else { ?>
              <label class="radio-inline"><input id="veg_tag" type="radio" name="rec_vegtag" value="Veg" required>Veg</label>
              <label class="radio-inline"><input id="veg_tag" type="radio" name="rec_vegtag" value="Non-Veg" checked="true" required>Non-Veg</label>
            <?php } ?>
            </div></div>

            <div class="form-group">
      <label for="serving" class="col-md-4 control-label">Serving :</label>
            <div class="col-md-6">
            <input id="serving" type="number" class="form-control" name="rec_serving" value="<?php echo $row['rec_serving']; ?>" required>
            </div></div>


      <div class="form-group">
      <label for="price" class="col-md-4 control-label">Price :</label>
            <div class="col-md-6">
            <input id="price" type="number" class="form-control" name="rec_price" value="<?php echo $row['rec_price']; ?>" required>
            </div></div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" name="submit" class="btn btn-primary">
                  UPDATE RECIPE
                </button>
              </div>
            </div>
          </form> 
        </div>
      </div>
    </div>
  </div>
  <form method="post" action="jsonedit.php">
  <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
  <div class="table-responsive">
  <table class="table table-bordered">
    <tr>
      <th>S. No.</th>
      <th>Packing Name</th>
      <th>Ingredient Name</th>
      <th>Processing</th>
      <th>Quantity</th>
      <th>Measure</th>
      <th>Section</th>
  </tr>
  <?php
      foreach($json as $key => $val){
          echo '<tr>';

          echo '<td>';
              echo $i;
          echo '</td>';

          echo '<td>';
              if(is_array($val)){
                  echo "<input type='text' name='slip_name".$i."' value='".$key."' readonly>";
              }
          echo '</td>';

          echo '<td>';
              for($j=0;$j<count($json[$key]);$j++) {
                  echo "<input type='text' class='form-control' name='ing_name".$i.$j."' value='".$json[$key][$j]['NAME']."'>";
                  echo "<br>";
              }
          echo '</td>';

          echo '<td>';
              for($j=0;$j<count($json[$key]);$j++) {
                  echo "<input type='text' class='form-control' name='ing_process".$i.$j."' value='".$json[$key][$j]['PROCESSING']."'>";
                  echo "<br>";
              }
          echo '</td>';

          echo '<td>';
              for($j=0;$j<count($json[$key]);$j++) {
                  echo "<input type='text' class='form-control' name='ing_qty".$i.$j."' size='3' value='".$json[$key][$j]['SERVING'][0][$serving]."' >";
                  echo "<br>";
              }
          echo '</td>';

          echo '<td>';
              for($j=0;$j<count($json[$key]);$j++) {
                  echo "<input type='text' class='form-control' name='ing_msr".$i.$j."' size='4' value='".$json[$key][$j]['MEASURE']."'>";
                  echo "<br>";
              }
          echo '</td>';

          echo '<td>';
              for($j=0;$j<count($json[$key]);$j++) {
                  echo "<input type='text' class='form-control' name='ing_section".$i.$j."' value='".$json[$key][$j]['SECTION']."'>";
                  echo "<br>";
              }
          echo '</td>';

          echo '</tr>';

              $i++;
      }
  ?>
  </table>
  <center><input type="submit" name="submit1" class="btn btn-primary" value="Update JSON"></center>
  </div>
  </form>
</div>
</div>
</body>
</html>