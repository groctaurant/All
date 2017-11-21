<?php
include('session.php');
include '../../db/config.php';
if($login_role != "admin" && $login_role == "Recipe Writer"){
    //echo "<script> alert('NOT ALLOWED'); window.location='recipe.php';</script>";
    header("location: recipe.php");
} else if($login_role != "admin" && $login_role == "Order Platform"){
    //echo "<script> alert('NOT ALLOWED');</script>";
    header("location: orders.php");
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
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<style>
.Paid { background-color: lightgreen; }
li,h2,h1{font-family: 'Oswald', sans-serif;}
.hidden{
  display: none;
}
</style>
</head>

<body>
<?php include 'navbar.php'; ?>

<div class="container-fluid" style="margin-top:60px">
<h1 class="text-center">Notifications</h1>
<?php
$sql="SELECT * from grret_notifications where not_status = 'Unread' order by not_time desc";
$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($result)){ ?>
<div class="alert alert-info alert-dismissable">
  <a href="notifications1.php" id="close-<?php echo $row['id']; ?>" class="close" data-dismiss="alert" aria-label="close">×</a>
  <?php echo $row['notification'] ?><p class="pull-right"><?php echo $row['not_time'] ?></p>
</div>

</div>
<script>
  $(function() {
    $('#close-<?php echo $row['id']; ?>').on('click', function(){
      var val = <?php echo $row['id']; ?>;
      //console.log(val);
      $.ajax({
        type : "post",
        url : "notifications1.php",
        data : 'data='+val,
        success : function(data){
            console.log("ok");
        }
      });
    })
  })
</script>
<?php 
}
?>

</body>
</html>