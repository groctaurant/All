<?php
include('session.php');
if($login_role != "admin" && $login_role == "Recipe Writer"){
    //echo "<script> alert('NOT ALLOWED'); window.location='recipe.php';</script>";
    header("location: recipe.php");
} else if($login_role != "admin" && $login_role == "Order Platform"){
    //echo "<script> alert('NOT ALLOWED');</script>";
    header("location: orders.php");
}
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
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link href="https://fonts.googleapis.com/css?family=Oswald:500,600" rel="stylesheet">
<style>

.table-responsive{height:35em; overflow-y:auto;}

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
<?php include 'navbar.php'; ?>

<div id="wrapper" class="wrapper">
<div class="container-fluid" style="margin-top:60px;">
<h1 class="text-center" style="font-size: 30px">Customers</h1>
<br>
<div class="table-responsive">
<table class='table table-bordered'>
<tr>
    <th>ID</th>
    <th>Image</th>
    <th>Name</th>
    <th>Phone</th>
    <th>Email</th>
    <th>Eazy Wallet</th>
    <th>Eazy Update</th>
    <th>GR Cash</th>
    <th>GR Update</th>
    <th>Referral Code</th>
    <th>Referral Count</th>
    <th>Applied Code</th>
</tr>

<?php
$sql="SELECT * from web_customers order by id desc";
$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($result)){ ?> 
  <tr>
    <td><a href="#"><?php echo $row['id']; ?></a></td>
    <td><img src="http://groctaurant.com/<?php echo $row['image']; ?>" width="50" height="50"></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['phone']; ?></td>
    <td><?php echo $row['email']; ?></td>
    
    <td>₹<?php echo ($row['wallet']-$row['earned_money']); ?></td>
    <td>
    <center><form class="form-inline" method="GET" action="cuseazywallet.php">
    <div class="form-group">
    <input class="form-control" type="number" name="wallet" size="20" placeholder="Enter Amount" required></div>
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <input type="submit" class="btn btn-success" value="Update" >
    </form>
    </center>
    </td>
    
    <td>₹<?php echo $row['earned_money']; ?></td>
    <td>
    <center><form class="form-inline" method="GET" action="cusgrcash.php">
    <div class="form-group">
    <input class="form-control" type="number" name="wallet" size="20" placeholder="Enter Amount" required></div>
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <input type="submit" class="btn btn-success" value="Update" >
    </form>
    </center>
    </td>
    <td><?php echo $row['referral_code']; ?></td>
    <td><?php echo $row['referral_count']; ?></td>
    <td><?php echo $row['applied_code']; ?></td>
   
  </tr> 
  
<?php
}
?>
</table>
</div>
</div>
</div>
<script type="text/javascript">
$(function() {

});
</script>
</body>
</html>