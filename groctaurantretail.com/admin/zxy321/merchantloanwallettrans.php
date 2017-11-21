<?php
include('session.php');
if($login_role != "admin" && $login_role == "Recipe Writer"){
    header("location: recipe.php");
} else if($login_role != "admin" && $login_role == "Order Platform"){
    header("location: orders.php");
}
include '../../db/config.php';
$mer_id = $_GET['id'];
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
   .Paid { background-color: lightgreen; }

li,h2,h1{font-family: 'Oswald', sans-serif; 
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

<div id="wrapper" class="wrapper"><div class="container-fluid" style="margin-top:60px;">
            <h1><center>Loan Wallet Transactions of <?php echo $mer_id; ?></center></h1><br>

<div class="table-responsive"> <table class='table table-bordered'>
<tr>
  <th>Date</th>
  <th>Transaction Type</th>
  <th>New Customer</th>
  <th>Credit</th>
  <th>Debit</th>
  <th>Balance</th>
</tr>
<?php


$sql="SELECT * from grret_loantransactions where mer_id = '$mer_id' order by id desc";
$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['trans_date'] . "</td>";
echo "<td>" . $row['trans_type'] . "</td>";
echo "<td>" . $row['new_cus'] . "</td>";
echo "<td>" . $row['credit'] . "</td>";
echo "<td>" . $row['debit'] . "</td>";
echo "<td>" . $row['balance'] . "</td>";
echo "</tr>";
}
?>
</table>
</div>
</div>
</div>
</body>
</html>