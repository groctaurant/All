<?php
include('session.php');
include '../../db/config.php';
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

#search {
  width: 50%;
  font-size: 16px;
  border:1.5px solid #ba8e2d;
}

.btn1{font-family: 'Oswald', sans-serif; letter-spacing:1.2px;}

.Paid { background-color: lightgreen; }
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

<?php
$query = mysqli_query($con, "SELECT * FROM grret_merchants WHERE mer_id = '$login_session' ");
$merRow = mysqli_fetch_array($query);
?>
<div class="wrapper" id="wrapper">
<div class="container" style="margin-top:20px; margin-bottom:40px;">
<center>
<input type="text" id="search" onkeyup="myFunction()" class="form-control" placeholder="Search for Recipes.." style="padding:20px 20px;"> 
</center>
<br>
<div class="col-sm-8">
<div class="w3-bar">
<button type="button" id="Indian" class="w3-btn w3-black btn1" value="Indian" onclick="myFunction1(id)">INDIAN</button>
<button type="button" id="Chinese" class="w3-btn w3-black btn1" value="Chinese" onclick="myFunction1(id)">CHINESE</button>
<button type="button" id="All" class="w3-btn w3-black btn1" value="" onclick="myFunction1(id)">ALL</button>
<button type="button" id="Continental" class="w3-btn w3-black btn1" value="Thai" onclick="myFunction1(id)">THAI</button>
<button type="button" id="Italian" class="w3-btn w3-black btn1" value="Italian" onclick="myFunction1(id)">ITALIAN</button>
</div>
</div>
</div>

<div class="container-fluid">

<div class="table-responsive">
<table class='table table-bordered text-center' id="recipetable">
<tr>
<th class="text-center">RECIPE</th>
<th class="text-center">CUISINE</th>
<th class="text-center">VEG-TAG</th>
<th class="text-center">PRICE</th>
</tr>
<?php

$sql="SELECT * from grret_recipes order by id";
$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td><a class='print'>" . $row['rec_name']."-". $row['rec_serving'] . "</a></td>";
echo "<td>" . $row['rec_cuisine'] . "</td>";
echo "<td>" . $row['rec_vegtag'] . "</td>";
echo "<td>" . $row['rec_price'] . "</td>";
echo "</tr>";
}

?>
</table>
</div>
</div>
</div>
<script>
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

    $('.print').on('click', function(){
      var name = $(this).html();
      myWindow=window.open("print.php?name="+name);
      myWindow.close;
    });
});

function myFunction(){
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
</body>
</html>