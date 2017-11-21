<?php
include('session.php');
if($login_role != "admin" && $login_role == "Order Platform"){
    header("location: orders.php");
}
include '../../db/config.php';
$query1 = "SELECT MIN(id),rec_name FROM grret_recipes GROUP BY rec_name ";
$result1 = mysqli_query($con, $query1);
$options1="";
while($row1=mysqli_fetch_array($result1))
{
  $options1=$options1."<option value='$row1[1]'>$row1[1]</option>";
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
  <link href="https://fonts.googleapis.com/css?family=Oswald:500,600" rel="stylesheet">
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.css">
 <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2-bootstrap.css">  
<style>
.btn1{font-family: 'Oswald', sans-serif; letter-spacing:1.2px;}

#search {
  width: 50%;
  font-size: 16px;
  border:1.5px solid #ba8e2d;
}

h2,h1{font-family: 'Oswald', sans-serif;}
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

<div class="container-fluid">
<div id="wrapper" class="wrapper">
<?php

$query = mysqli_query($con, "SELECT * FROM grret_merchants WHERE mer_id = '$login_session' ");
$merRow = mysqli_fetch_array($query);
?>

<div class="container" style="margin-top:50px; margin-bottom:40px;">
<h1 class="text-center">Recipe</h1>

<center><input type="text" id="search" onkeyup="myFunction()" class="form-control" placeholder="Search for Recipes.." style="padding:20px 20px;"> </center><br>

<div class="w3-bar">
<button type="button" id="Indian" class="w3-btn w3-black btn1" value="Indian" onclick="myFunction1(id)">INDIAN</button>
<button type="button" id="Chinese" class="w3-btn w3-black btn1" value="Chinese" onclick="myFunction1(id)">CHINESE</button>
<button type="button" id="All" class="w3-btn w3-black btn1" value="" onclick="myFunction1(id)">ALL</button>
<button type="button" id="Thai" class="w3-btn w3-black btn1" value="Thai" onclick="myFunction1(id)">THAI</button>
<button type="button" id="Italian" class="w3-btn w3-black btn1" value="Italian" onclick="myFunction1(id)">ITALIAN</button>
<button type="button" id="Kitchen Protein" class="w3-btn w3-black btn1" value="Kitchen Protein" onclick="myFunction1(id)">KITCHEN PROTEIN</button>
</div>
<a href="webrecipes.php" class="btn btn-primary pull-right">Web Recipes</a>
<br>
<center>
<div class="container">
<a href="http://groctaurantretail.com/json/" class="w3-btn w3-red" target="_blank">TEST JSON</a>
<a class="w3-btn w3-green" data-toggle="modal" data-target="#myModal">UPLOAD</a>
<a class="w3-btn w3-blue" data-toggle="modal" data-target="#myModal1">DOWNLOAD</a>
<a href="recipeaddnew.php" class="w3-btn w3-yellow">ADD RECIPE</a>
</div>
</center>
</div>

<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">
        

<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title"><center><b>UPLOAD JSON</b></center></h4>
        </div>
        <div class="modal-body">
          <form action="file.php" method="post" enctype="multipart/form-data">
              
<br><select class="form-control selectrec" name="name" placeholder="Select Recipe" required>
  <option>Select Recipe</option>
<?php echo $options1; ?>
</select><br>
<br><input type="file" name="file" required><br>
<input type="submit" value="Upload" class="btn btn-success" name="submit">
        </form>
        </div>
    
      </div>
      
    </div>
  </div>
  

<div id="myModal1" class="modal fade" role="dialog">
    <div class="modal-dialog">
<div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><center><b>DOWNLOAD JSON</b></center></h4>
        </div>
        <div class="modal-body">
                       <form method="POST" action="downloadjson.php">
<br><select id="downloadrec" class="form-control selectrec" name="name" placeholder="Select Recipe" required>
    <option>Select Recipe</option>
<?php echo $options1; ?>
</select>
<br>
<br>
<input type="submit" id="downloadrecbtn" class="btn btn-default" value="Download">
</form>
</div>
      </div>
      
    </div>
  </div>


<div class="container-fluid">
<div class="table-responsive"> <table class='table table-bordered text-center' id="recipetable">
<tr>
<th class="text-center">RECIPE</th>
<th class="text-center">SKU</th>
<th class="text-center">CUISINE</th>
<th class="text-center">VEG-TAG</th>
<th class="text-center">SERVING</th>
<th class="text-center">PRICE</th>
<th class="text-center">STATUS</th>
<th colspan="2"></th>
</tr>
<?php

$sql="SELECT * from grret_recipes order by id desc";
$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['rec_name'] . "</td>";
echo "<td>" . $row['rec_sku'] . "</td>";
echo "<td>" . $row['rec_cuisine'] . "</td>";
echo "<td>" . $row['rec_vegtag'] . "</td>";
echo "<td>" . $row['rec_serving'] . "</td>";
echo "<td>" . $row['rec_price'] . "</td>";
?>
<?php if($row['rec_status'] == "Available"){ ?>
    <td><input type="checkbox" data-toggle="toggle" class="toggle" data-size="small" data-on="Available" data-off="Unavailable" data-onstyle="warning" checked value="<?php echo $row['id']; ?>,<?php echo $row['rec_status']; ?>"></td>
   <?php } else { ?>
    <td><input type="checkbox" data-toggle="toggle" class="toggle" data-size="small" data-on="Available" data-off="Unavailable" data-onstyle="warning" value="<?php echo $row['id']; ?>,<?php echo $row['rec_status']; ?>"></td>
   <?php   } ?>
<?php
echo "<td><a href='recipeedit.php?id=".$row["id"]."' style='color:blue' target='_blank'><button class='btn btn-primary'>Edit</button></a></td>";
echo "<td><a href='recipedelete.php?id=".$row["id"]."''><button class='btn btn-danger'>Delete</button></a></td>";
echo "</tr>";
}
?>
</table>
</div>
</div>
</div>
</div>
<script type="text/javascript">
function myFunction1(id) {
 var input, filter, table, tr, td, i;
 input = document.getElementById(id);
 filter = input.value.toUpperCase();
 table = document.getElementById("recipetable");
 tr = table.getElementsByTagName("tr");
 for (i = 0; i < tr.length; i++) {
   td = tr[i].getElementsByTagName("td")[2];
   if (td) {
     if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
       tr[i].style.display = "";
     } else {
       tr[i].style.display = "none";
     }
   }
 }
}

$(document).ready(function(){

    $('.btn1').click(function(){
       $('.btn1').removeClass('w3-blue').addClass('w3-black');
        $(this).removeClass('w3-black').addClass('w3-blue');
   });
   $('.toggle').on('change', function(){
      var tag = $(this);
      var val = $(this).val();
      //console.log(val);
      $.ajax({
        type : "post",
        url : "recipestatus.php",
        data : 'data='+val,
        success : function(data){
            tag.val(data);
        }
      });
    });
});
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("search");
  filter = input.value.toUpperCase();
  table = document.getElementById("recipetable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
  if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

</script>
<script src="js/materialMenu.min.js"></script>
<script type="text/javascript">
  var menu = new Menu;
</script>

<script>

$.getScript('http://cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.min.js',function(){
           
  /* dropdown and filter select */
  var select = $('.selectrec').select2();
}); //script         
      
$(document).ready(function() {});

</script>
<script type="text/javascript">
$(".list2").hide();
$(".drop").click(function(){
  $(".list2").toggle(400, function(){
    });
});  
</script>
<script type="text/javascript">
$(".drop1").click(function(){
  $(".list3").toggle(400, function(){
    });
});  
</script>
</body>
</html>