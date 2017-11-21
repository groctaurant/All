<?php
include('session.php');
include '../../db/config.php';
session_start();
$querysound = mysqli_query($con, "SELECT * from grret_orders");
$countsound = mysqli_num_rows($querysound);
$_SESSION['countsound'] = $countsound;

$query1 = mysqli_query($con, "SELECT ord_acc from grret_ordersautoaccept where id=1");
$row1 = mysqli_fetch_array($query1,MYSQLI_ASSOC);
$order_accept = $row1['ord_acc'];

$query2 = mysqli_query($con, "SELECT * from grret_shopstat where id=1");
$row2 = mysqli_fetch_array($query2,MYSQLI_ASSOC);
$shop_stat = $row2['shop_stat'];
$deliver_now_bool = $row2['deliver_now'];

$query3 = mysqli_query($con,"SELECT discount FROM grret_discounts WHERE id = 1");
$row3 = mysqli_fetch_array($query3,MYSQLI_ASSOC);
$discount = $row3['discount'];

date_default_timezone_set("Asia/Kolkata");
$date_start = date("Y-m-d");
?>
<html>
<head>
  <link rel="shortcut icon" type="image/png" href="../../images/GR.png"/>
  <title>GROCTAURANT</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link href="https://fonts.googleapis.com/css?family=Oswald:500,600" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<style>

.Processing {background-color: lightcyan; }
.Dispatched {background-color: lightskyblue; }
.Cancelled {background-color: lightsalmon; }

.row{
   font-family: 'Open Sans', sans-serif;letter-spacing: 0.1px;   
  }

nav li{
    cursor:pointer;
    font-family: 'Oswald', sans-serif; font-size:17px; letter-spacing:0.8px;
}
h2,h1{font-family: 'Oswald', sans-serif;}
.hidden{
  display: none;
}
</style>
</head>

<body>
<nav class="navbar navbar-default navbar-fixed-top navbar-custom">
    <div class="container-fluid" id="nav1">
    <div class="navbar-header">
        <span data-toggle="modal" data-target="#myModal" style="position:relative;top:15px;left:20pxcursor:pointer"><b>Send Message</b></span>
        
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
        </button>
    </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
              <li>
                  <a href="home.php">Home</a>
              </li>

              
              <li>
                  <a href="accounting.php">Accounting</a>
              </li>
    
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown">Orders
                <span class="caret"></span></a>
                 <ul class="dropdown-menu">
                  <li><a href="orders.php">Orders</a></li>
                  <li class="divider"></li>
                  <li><a href="ordersproccessed.php">Delivered Orders</a></li>
                  <li class="divider"></li>
                  <li><a href="ordersnotproccessed.php">Rejected Orders</a></li>
                </ul>
              </li>
              
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown">Recipe
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="recipe.php">View Recipe</a></li>
                  <li class="divider"></li>
                  <li><a href="recipeaddnew.php">Add New Recipe</a></li>
                  <li class="divider"></li>
                  <li><a href="http://groctaurantretail.com/json/" target="_blank">Test JSON</a></li>
                  <li class="divider"></li>
                  <li><a href="webrecipes.php" target="_blank">Web Recipe</a></li>
                   <li class="divider"></li>
                  <li><a href="process.php" target="_blank">Ing Process</a></li>
                </ul>
              </li>
              
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown">Merchants
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="merchant.php">View Merchnats</a></li>
                  <li class="divider"></li>
                  <li><a href="merchantaddnew.php">Add New Merchant</a></li>
                  <li class="divider"></li>
                  <li><a href="merchantapps.php">Merchant Apps</a></li>
                </ul>
              </li>
              <li>
                  <a href="notifications.php">Notifications</a>
              </li>
              <li>
                  <a href="logout.php">Logout</a>
              </li>
          </ul>
      </div>
  </div>
</nav>
<div class="wrapper" id="wrapper">
    <div class="container-fluid" style="margin-top:50px;">
    <h1 class="text-center">Orders</h1>
     <div class="row">
         <div class="col-sm-6">
  <input type="hidden" value="<?php echo $_SESSION['countsound']; ?>" class="countval"><audio id="audio" src="beep.mp3"></audio>
  
  <a href="ordershopstatus.php" class="w3-btn w3-teal"><?php echo $shop_stat; ?></a>
  <a href="ordersproccessed.php" class="w3-btn w3-brown">Delivered/Rejected Orders</a>
	  <?php if($deliver_now_bool){ ?>
	    <input type="checkbox" data-toggle="toggle" class="toggle toggle1" data-size="small" data-on="ON" data-off="OFF" data-onstyle="warning" checked value="0">
	   <?php } else { ?>
	    <input type="checkbox" data-toggle="toggle" class="toggle toggle1" data-size="small" data-on="ON" data-off="OFF" data-onstyle="warning" value="1">
	   <?php   } ?>
  </div>
<div class="col-sm-6">
  <form class="form-inline  pull-right" method="POST" action="orderpreorderdiscount.php">
    <div class="form-group">
      <label for="discount">Preorder Discount(%):</label>
      <input type="number" name="discount" class="form-control" value="<?php echo $discount; ?>">
    </div>
    <button type="submit" name="submit" value="Update" class="w3-btn w3-green">Update</button>
  </form></div></div>
<div class="container">
    <div class="row">
        <div class="col-sm-3"><b><p style="font-size:20px; font-weight:bold">Today Order Value: </b><span id="today_order_value">
            <?php
                $queryt = mysqli_query($con, "SELECT sum(total_price) as tov from grret_orders where ord_status='Delivered' and order_at > '$date_start'");
                $tov = mysqli_fetch_array($queryt);
                echo $tov['tov'];
            ?>
        </span></p></div>
<div class="col-sm-2"><b><p style="font-size:20px; font-weight:bold">Total Orders: </b><span class="total_orders_no"></span></p></div>
<div class="col-sm-2"><b><p style="font-size:20px; font-weight:bold">Under Review: </b><span class="under_review_no"></span></p></div>
<div class="col-sm-3"><b><p style="font-size:20px; font-weight:bold">Under Processing: </b><span class="under_processing_no"></span></p></div>
<div class="col-sm-2"><b><p style="font-size:20px; font-weight:bold">Dispatched: </b><span class="dispatched_no"></span></p></div></div></div>
<hr style="border:1px solid black; margin:0px">
<div class="fetchorders">
<?php
$sql="SELECT * from grret_orders WHERE NOT (ord_status='Delivered' or ord_status='Rejected' or ord_status='Cancelled by Merchant') order by del_time_real";
$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($result)){ ?>
<div class="container-fluid <?php echo $row['ord_status']; ?>"  style="margin: 5px;">
  <?php
    $time = new DateTime($row['delivery_expected']);
    $time->sub(new DateInterval('PT30M'));
    $dispatch_expected = $time->format('Y-m-d H:i:s');
  ?>
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      <center><b><u><i>Expected Dispatch: <span style="font-size: 19px"><?php echo $dispatch_expected; ?></span></i></u></b></center>
    </div>   
    <div class="col-sm-2">
      <span>Order No: </span><span style="font-size: 19px"><b><?php echo $row['order_number']; ?></b></span>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-3">
      <span>Order Id: </span><span style="font-size: 19px"><b><a href="orderdetails.php?id=<?php echo $row['ord_id']; ?>" target="_blank"><?php echo $row['ord_id']; ?></a></b></span>
    </div>
    <div class="col-sm-3">
      <span>Order At: </span><span style="font-size: 19px"><b><?php echo $row['order_at']; ?></b></span>
    </div>
    <div class="col-sm-4">
      <span>Delivery Time: </span><span style="font-size: 17px"><b><?php echo $row['del_time']; ?></b></span>
    </div>
    <div class="col-sm-2">
        <?php 
        if($row['ord_status'] == "Cancelled"){ ?>
        <button class="btn btn-danger rejectOrder" value="<?php echo $row['id']; ?>" style="padding: 5px 20px">Remove</button>
        <?php
        } else { ?>
        <button class="btn btn-danger rejectOrder" value="<?php echo $row['id']; ?>" style="padding: 5px 20px">Reject</button>
        <?php } 
      ?>
    </div>
  </div>
  <div class="row" style="margin-top: 7px">
    <div class="col-sm-2">
      <a href="kot.php?id=<?php echo $row['ord_id']; ?>" target='_blank' class="btn btn-warning" style="padding: 3px 14px; font-size: 14px">KOT</a>
      <a href="orderbill.php?id=<?php echo $row['ord_id']; ?>" target='_blank' class="btn btn-warning" style="padding: 3px 14px; font-size: 14px">BILL</a>
    </div>
    <div class="col-sm-3">
      <?php 
        if($row['ord_status'] == "Under Review"){ ?>
          <button class="btn btn-primary acceptOrder btnstat" style="padding: 3px 14px; font-size: 14px" value="<?php echo $row['id']; ?>" disabled><b><?php echo $row['ord_status']; ?></b></button>
        <?php
        } else if($row['ord_status'] == "Under Processing"){ ?>
          <button class="btn btn-success dispatchOrder btnstat" style="padding: 3px 14px; font-size: 14px" value="<?php echo $row['id']; ?>"><b><?php echo $row['ord_status']; ?></b></button>
        <?php
        } else if($row['ord_status'] == "Dispatched"){ ?>
          <button class="btn btn-warning deliverOrder btnstat" style="padding: 3px 14px; font-size: 14px" value="<?php echo $row['id']; ?>"><b><?php echo $row['ord_status']; ?></b></button>
        <?php
        } else {
          echo "<p style='color:red; font-weight:bold; font-size:20px;'>".$row['ord_status']."</p>";
        }
      ?>

      <img src="../../images/load.gif" class="loader<?php echo $row['id']; ?>" width="30px" height="30px" hidden />

    </div>
    <div class="col-sm-2" style="padding: 0 5px">
      <span>Mer ID: </span><span style="font-size: 15px"><b><?php echo $row['mer_id']; ?></b></span>
    </div>
    <div class="col-sm-5" style="padding: 0 5px 0 0">
      <span style="font-size: 15px">Cus. Address: </span><span style="font-size: 15px"><b><?php echo $row['cus_address']; ?></b></span>
    </div>
  </div>
  <?php
  $rec_name = explode(', ', $row['rec_name']);
  $rec_serving = explode(', ', $row['rec_serving']);
  $rec_qty = explode(', ', $row['rec_qty']);
  $rec_cuisine = explode(', ', $row['rec_cuisine']);
  $rec_price = explode(', ', $row['rec_price']);
  ?>
  <div class="row" style="margin-top: 10px">
    <div class="col-sm-8">
      <table class="table table-condensed">          
       <tr>
          <th>Serving</th>
          <th class="text-center">Name</th>
          <th class="text-center">Qty</th>
          <th class="text-center">Cuisine</th>
          <th class="text-center">Price</th>
        </tr>
        <?php
        for($i=0;$i<count($rec_name);$i++){ ?>
        <tr>
          <td><?php echo $rec_serving[$i]; ?></td>
          <td class="text-center" style="color: #185418 "><b><?php echo $rec_name[$i]; ?></b></td>
          <td class="text-center"><?php echo $rec_qty[$i]; ?></td>
          <td class="text-center"><?php echo $rec_cuisine[$i]; ?></td>
          <td class="text-center"><?php echo $rec_price[$i]; ?></td>
        </tr>
        <?php } ?>
      </table>
    </div>
    <div class="col-sm-2" style="padding:0 10px 0 5px;">
      <div class="well text-center" style="padding: 5px;margin-bottom: 0"><b>Notes: </b><p style="margin: 0; color:red"><?php echo $row['add_notes']; ?></p>
      </div>
    </div>
    <div class="col-sm-2" style="padding: 5px 2px 0 0;vertical-align: middle;">
      <p style="margin: 0">Name: <?php echo $row['cus_name']; ?></p>
      <p style="margin: 0">Phone: <?php echo $row['cus_phone']; ?></p>
    </div>
  </div>
  <div class="row" style="margin-top: 0px; margin-bottom: 0px;">
    <div class="col-sm-3">
      <p>Payment Type: <b><?php echo $row['payment_type']; ?></b></p>  
      <p><b>GR Cash: ₹<?php echo $row['grcash']; ?></b></p>
      <p><b>Wallet: ₹<?php echo $row['walletcash']; ?></b></p>
    </div>
    <div class="col-sm-2">
      <p>Sub Total: ₹<?php echo $row['sub_total']; ?></p>
    </div>
    <div class="col-sm-2">
      <p>Del Charges: ₹<?php echo $row['del_charges']; ?>
      <?php if($row['del_charges'] == 11){ ?>
        <input type="checkbox" class="toggle" checked value="<?php echo $row['id']; ?>,<?php echo $row['del_charges']; ?>,<?php echo $row['total_price']; ?>,<?php echo $row['final_amount']; ?>">
      <?php } else { ?>
        <input type="checkbox" class="toggle" value="<?php echo $row['id']; ?>,<?php echo $row['del_charges']; ?>,<?php echo $row['total_price']; ?>,<?php echo $row['final_amount']; ?>">
      <?php } ?><img src="../../images/load.gif" width="30px" height="30px" hidden />
      </p>
    </div>
    <div class="col-sm-2">
      <p>Pre order Discount: ₹<?php echo $row['discount']; ?></p>
      <p><a class="btn btn-default" target="_blank" href="calculatemisa.php?ord_id=<?php echo $row['ord_id']; ?>&order_no=<?php echo $row['order_number']; ?>">Misa</a></p>
    </div>
    <div class="col-sm-2">
      <p>New Cus Discount: ₹<?php echo $row['new_cus_discount']; ?></p>
    </div>
    <div class="col-sm-1">
      <p style="font-size: 25px;color:#a72323;">₹<?php echo $row['final_amount']; ?></p><p style="font-size: 20px;color:#a72323;margin-top:-5px">(₹<?php echo $row['total_price']; ?>)</p>
    </div>
  </div>



</div><hr style="border:2px solid black; margin:0px">
<?php 
} ?>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $(document).on('click', ".toggle", function(){
      var tag = $(this);
      var val = $(this).val();
      tag.next().removeAttr("hidden");
      //console.log(val);
      $.ajax({
        type : "post",
        url : "deliveryprice.php",
        data : 'data='+val,
        success : function(data){
          //console.log(data);
          tag.next().attr("hidden", "true");
          loadit();
        }
      });
    });
    setInterval(function(){
      $.ajax({
        url: 'sound.php',
        success: function(data){
          var value = $('.countval').val();
          if(data > value){
            play();
            setTimeout(function() { loadit(); countit(); },1000);
            $('.countval').val(data);
          }
        }
      });
    },2000);
    countit();

    setInterval(function(){ loadit(); countit(); },5000);
    
    $(document).on('click', '.acceptOrder', function(){
      var val = $(this).val();
      $(".loader"+val).removeAttr("hidden");
      //console.log(val);
      $.ajax({
        type : "post",
        url : "orderaccept.php",
        data : 'id='+val,
        success : function(data){
          $(".loader"+val).attr("hidden", "true");
          //console.log(data);
          setTimeout(function() { loadit(); countit(); },100);
        }
      });
    });
    $(document).on('click', '.dispatchOrder', function(){
      var val = $(this).val();
      $(".loader"+val).removeAttr("hidden");
      //console.log(val);
      $.ajax({
        type : "post",
        url : "orderdispatch.php",
        data : 'id='+val,
        success : function(data){
          $(".loader"+val).attr("hidden", "true");
          //console.log(data);
          setTimeout(function() { loadit(); countit(); },100);
        }
      });
    });
    $(document).on('click', '.deliverOrder', function(){
      var val = $(this).val();
      $(".loader"+val).removeAttr("hidden");
      //console.log(val);
      $.ajax({
        type : "post",
        url : "orderdeliver.php",
        data : 'id='+val,
        success : function(data){
          $(".loader"+val).attr("hidden", "true");
          //console.log(data);
          setTimeout(function() { loadit(); countit(); },100);
        }
      });
    });
    $(document).on('click', '.rejectOrder', function(){
      var val = $(this).val();
      $(".loader"+val).removeAttr("hidden");
      //console.log(val);
      $.ajax({
        type : "post",
        url : "orderreject.php",
        data : 'id='+val,
        success : function(data){
          $(".loader"+val).attr("hidden", "true");
          //console.log(data);
          setTimeout(function() { loadit(); countit();  },100);
        }
      });
    });
    $(document).on('change','.toggle1', function(){
      var tag = $(this);
      var val = parseInt($(this).val());
      //console.log(val);
      $.ajax({
        type : "post",
        url : "order_deliver_now.php",
        data : 'data='+val,
        success : function(data){
        //console.log(data);
            tag.val(parseInt(data));
        }
      });
    });
  });

  function play(){
     var audio = document.getElementById("audio");
     audio.play();
  }

  function loadit(){
    $.ajax({
        type: "POST",
        url: "ordersf.php",
        data:"load=ok",
        success: function(data){
          $(".fetchorders").html(data);
          //console.log(data);
        }
      });
  }
function countit(){
    var total_orders_no=under_review_no=under_processing_no=dispatched_no=cancelled_no=0;
    $(".btnstat").each(function(){
      var status= $(this).text();
      if(status == "Under Review"){
        under_review_no++;
        total_orders_no++;
      } else if(status == "Under Processing"){
        under_processing_no++;
        total_orders_no++;
      } else if(status == "Dispatched"){
        dispatched_no++;
        total_orders_no++;
      } else{
        cancelled_no++;
        total_orders_no++;
      }
    });
    $(".under_review_no").html(" " + under_review_no);
    $(".under_processing_no").html(" " + under_processing_no);
    $(".dispatched_no").html(" " + dispatched_no);
    $(".total_orders_no").html(" " + total_orders_no);
    $("#today_order_value").load(" #today_order_value");
  }
</script>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><center>Send Message</center></h4>
      </div>
      <div class="modal-body">
        <br>
        <form class="form-horizontal" action="smsapi.php" method="POST">
          <div class="form-group"><label class="control-label col-sm-3">Phone :</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="number" placeholder="Enter Phone">
            </div>
          </div>
          <div class="form-group"><label class="control-label col-sm-3">Message :</label>
            <div class="col-sm-8">
              <textarea type="text" class="form-control" name="msg" placeholder="Enter Message"></textarea>
            </div>
          </div>
          <center><button type="submit" class="w3-btn w3-blue">Submit</button></center>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
</body>
</html>