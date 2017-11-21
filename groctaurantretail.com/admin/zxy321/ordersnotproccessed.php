<?php
include('session.php');
if($login_role != "admin" && $login_role == "Recipe Writer"){
    header("location: recipe.php");
}
include '../../db/config.php';
date_default_timezone_set("Asia/Kolkata");
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
<style>

li{font-family: 'Oswald', sans-serif; font-size:17px; letter-spacing:0.8px;}
h1,h2{font-family: 'Oswald', sans-serif;}
.Rejected{background-color: #f94949 }
.Delivered{background-color: lightgreen; }
.Cancelled { background-color: #d2bf9c; }
        #search {
  width: 30%;
  font-size: 16px;
}
.row{
   font-family: 'Open Sans', sans-serif;letter-spacing: 0.1px;
  }
</style>
</head>

<body>
<?php include 'navbar.php'; ?>
<br>
 <div class="container-fluid" style="margin-top:40px;">
  <h1 class="text-center">Rejected Orders</h1>
<br>
  <center><input type="text" id="search" onkeyup="myFunction()" class="form-control" placeholder="Search...." style="padding:20px 20px;"></center><br>
  <div class="row">
    <div class="col-sm-3">
      <input type="checkbox"  class="check_all" onclick="select_all()">
      <a data-toggle="modal" data-target="#myModal" class="btn btn-primary total_sale">Calculate Sale of Selected Orders</a>
    </div>
    <div class="col-sm-5">
      <div class="col-sm-6">From: <input type="date" id="date_start" name="date_start" min="2017-04-01" style='border-radius:5px;' max="<?php echo date("Y-m-d"); ?>" required></div>
      <div class="col-sm-6">To: <input type="date" id="date_endx" name="date_end" min="2017-04-01" style='border-radius:5px;' max="<?php echo date("Y-m-d"); ?>" required></div>
      <input type="date" id="date_end" name="date_end" min="2017-04-01" max="<?php echo date("Y-m-d"); ?>" required style="display:none; ">
      <img src="../../images/load.gif" class="loader" width="30px" height="30px" hidden />
    </div>
    <div class="col-sm-4">
      <form class="form-inline" action="export.php" method="POST">
        <input type="number" class="form-control" name="date" placeholder="20170715">
        <button type="submit" class="btn btn-success">Export</button>
      </form>
    </div>
  </div>

<div class="fetchorders">
<?php
$date_start = date("Y-m-d", strtotime("-1 days"));
$sql="SELECT * from grret_orders where (ord_status='Rejected' or ord_status = 'Cancelled by Merchant') and order_at >= '$date_start' order by id desc";
$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($result)){ ?>
<div class="container-fluid dorders <?php echo $row['ord_status']; ?>"  style="margin: 5px;">
  <?php
    $time = new DateTime($row['delivery_expected']);
    $time->sub(new DateInterval('PT30M'));
    $dispatch_expected = $time->format('Y-m-d H:i:s');
  ?>
  <div class="row">
    <div class="col-sm-1">
    <?php if($row['ord_status'] == "Rejected" || $row['ord_status'] == "Cancelled by Merchant"){ ?>
      <input type="checkbox" class="case checkok">
    <?php } ?>
    </div>
    <div class="col-sm-8">
      <div class="col-sm-6"><b>Expected Dispatch: <span style="font-size: 19px"><?php echo $dispatch_expected; ?></span></b></div>
      <div class="col-sm-6"><b>Dispatched At: <span style="font-size: 19px"><?php echo $row['dispatch_real']; ?></span></b></div>
    </div>
    <div class="col-sm-3">

      <?php
        if(!empty($row['dispatch_real'])){
        if(strtotime($row['dispatch_real']) - strtotime($dispatch_expected) > 1800){ ?>
        <div style="display:none;">dl3</div>
            <span class="fa fa-thumbs-down fa-2x" style="color: #618685;float:right; padding: 5px;"></span>
            <span class="fa fa-thumbs-down fa-2x" style="color: #618685;float:right; padding: 5px;"></span>
            <span class="fa fa-thumbs-down fa-2x" style="color: #618685; float:right; padding: 5px;"></span>
       <?php
       } else if(strtotime($row['dispatch_real']) - strtotime($dispatch_expected) > 600){ ?>
       <div style="display:none;">dl2</div>
           <span class="fa fa-thumbs-down fa-2x" style="color: #618685; float:right; padding: 5px;"></span>
            <span class="fa fa-thumbs-down fa-2x" style="color: #618685; float:right; padding: 5px;"></span>
       <?php
       } else if(strtotime($row['dispatch_real']) - strtotime($dispatch_expected) > 0){ ?>
       <div style="display:none;">dl1</div>
           <span class="fa fa-thumbs-down fa-2x" style="color: #618685; float:right; padding: 5px;"></span>
       <?php
       }
         if(strtotime($row['dispatch_real']) - strtotime($row['order_at']) <= 600){ ?>
         <div style="display:none;">de1</div>
            <span class="fa fa-flash fa-3x" style="color: #ff5400;float:right; padding: 5px;"></span>
       <?php
       }
        }
      ?>
      <span style="font-size: 19px; float:right; padding: 5px;">Order No: <b><?php echo $row['order_number']; ?></b></span>

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
      <span style="font-size: 17px">Status: <b><?php echo $row['ord_status']; ?></b></span>
    </div>
  </div>
  <div class="row" style="margin-top: 7px">
    <div class="col-sm-2">
      <span>Mer ID: </span><span style="font-size: 15px"><b><?php echo $row['mer_id']; ?></b></span>
    </div>
    <div class="col-sm-3">
      <p>Name: <?php echo $row['cus_name']; ?></p>
    </div>
    <div class="col-sm-2">
      <p>Phone: <?php echo $row['cus_phone']; ?></p>
    </div>
    <div class="col-sm-5">
      <span style="font-size: 15px">Cus. Address: </span><span style="font-size: 15px"><?php echo $row['cus_address']; ?></span>
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
          <td class="text-center" style="color: #185418"><b><?php echo $rec_name[$i]; ?></b></td>
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
    <div class="col-sm-2">
      <?php if($row['payment_status'] == "Payment not collected"){ ?>
      <div class="col-sm-6" style="margin-top: -12px">
        <div class="radio"><label><input type="radio" name="pay_type<?php echo $row['id']; ?>" class="pay_type" value="Cash" checked> Cash</label></div>
        <div class="radio"><label><input type="radio" name="pay_type<?php echo $row['id']; ?>" class="pay_type" value="Card"> Card</label></div>
        <div class="radio"><label><input type="radio" name="pay_type<?php echo $row['id']; ?>" class="pay_type" value="PayTM"> PayTM</label></div>
      </div>
      <div class="col-sm-3">
        <button value="<?php echo $row['id']; ?>" class="btn btn-success pay_btn">Collect</button>
        <img src="../../images/load.gif" class="loader1" width="30px" height="30px" hidden />
      </div>
      <?php } else {
        echo "<p>Payment Status:</p><span class='payment_status'>".$row['payment_status']."</span>";
      } ?>
    </div>
  </div>
  <div class="row" style="margin-top: 0px; margin-bottom: 0px;">
    <div class="col-sm-3">
      <p>Payment Type: <b class="payment_type"><?php echo $row['payment_type']; ?></b></p>
    </div>
    <div class="col-sm-2">
      <p>Sub Total: <?php echo $row['sub_total']; ?></p>
    </div>
    <div class="col-sm-2">
      Pre order Discount: <?php echo $row['discount']; ?>
      New_Cus Discount: <?php echo $row['new_cus_discount']; ?>
    </div>
    <div class="col-sm-2">
      CGST@6.00%: <?php echo $row['cgst']; ?>
      SGST@6.00%: <?php echo $row['sgst']; ?>
    </div>
    <div class="col-sm-2">
      <p>Del Charges: <?php echo $row['del_charges']; ?></p>
    </div>
    <div class="col-sm-1">
      <p style="font-size: 25px;color:#a72323;">₹<span class="final_amount"><?php echo $row['final_amount']; ?></span></p><p style="margin-top:-5px;font-size: 20px;color:#a72323;">(₹<span class="total_price"><?php echo $row['total_price']; ?></span>)</p>
    </div>
  </div>
</div>
<?php
} ?>
</div>

</div>

</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"><center><b>SALE</b></center></h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal">
              <div class="form-group">
                  <label class="control-label col-sm-3">Amount :</label>
                  <div class="col-sm-8">
                      <input type="number" class="form-control amount" name="amount" style="text-align: center;" readonly>
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-sm-3">AOV :</label>
                  <div class="col-sm-8">
                      <input type="number" class="form-control aov" name="aov" style="text-align: center;" readonly>
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-sm-3">Count :</label>
                  <div class="col-sm-8">
                      <input type="number" class="form-control count" name="count" style="text-align: center;" readonly>
                  </div>
              </div>
            </form>
          </div>
      </div>
  </div>
</div>

<script type="text/javascript">
function select_all(){
  $('.case').each(function(){
      if($('.check_all').is(":checked")){
          if($(this).hasClass("checkok")){
            $(this).prop("checked", true);
          }
          //console.log($(this));
      } else {
          //console.log($(this));
            $(this).prop("checked", false);
      }
  });
}
$(document).ready(function(){
  $(".pay_btn").on('click', function(){
    var tag= $(this);
    var id= $(this).val();
    var pay_type = $(this).parent().prev().find(".pay_type:checked").val();
    //console.log(pay_type);
    $.ajax({
      type: "POST",
      url: "ordersproccessed1.php",
      data: {pay_type:pay_type, id:id},
      success: function(data){
        //console.log(data);
        tag.parent().parent().html(data);
      }
    })
  });

  $(".total_sale").on('click', function() {
    var td2=0, aov=0, count=0, cod_cash=0, cod_paytm=0, cod_card=0, cod_unknown=0, count_cash=0, count_paytm=0, count_card=0, count_unknown=0, pay_via_wallet=0, count_pay_via_wallet=0;
    $('.case:checkbox:checked').parent().parent().parent().each(function(){
      count++;
      //console.log($(this));
      var total_price = parseFloat($(this).find(".total_price").text());
      td2 += total_price;
      aov = td2/count;
      aov = Math.round(aov*100)/100;
      var payment_type = $(this).find(".payment_type").text();
      var payment_status = $(this).find(".payment_status").text();
      var final_amount = parseFloat($(this).find(".final_amount").text());
      if(payment_type  == "Cash On Delivery"){
            if(payment_status == "Payment Collected via Cash"){
                   cod_cash += final_amount;
                   count_cash++;
            } else if(payment_status == "Payment Collected via PayTM"){
                   cod_paytm += final_amount;
                   count_paytm++;
            } else if(payment_status == "Payment Collected via Card"){
                   cod_card += final_amount;
                   count_card++;
            } else {
                   cod_unknown += final_amount;
                   count_unknown++;
            }
      } else if(payment_type  == "Pay Via Wallet"){
            pay_via_wallet += total_price;
            count_pay_via_wallet++;
      }
    });
    $('.amount').val(td2);
    $('.aov').val(aov);
    $('.count').val(count);
    $('.cod_cash').val(cod_cash);
    $('.cod_paytm').val(cod_paytm);
    $('.cod_card').val(cod_card);
    $('.cod_unknown').val(cod_unknown);
    $('.count_cash').val(count_cash);
    $('.count_paytm').val(count_paytm);
    $('.count_card').val(count_card);
    $('.count_unknown').val(count_unknown);
    $('.pay_via_wallet').val(pay_via_wallet);
    $('.count_pay_via_wallet').val(count_pay_via_wallet);
  });

  $('#date_start')[0].valueAsDate = new Date();

  $('#date_endx').change(function() {
  $(".loader").removeAttr('hidden');
    var date= this.valueAsDate;
    date.setDate(date.getDate() + 1);
    //console.log(date);
    $('#date_end')[0].valueAsDate = date;
    var x= $('#date_end').val();
    var y= $('#date_start').val();
    //console.log(y);
    $.ajax({
        type: "POST",
        url: "ordersnotproccesseda.php",
        data:{date_start: y, date_end: x},
        success: function(data){
          $(".fetchorders").html(data);
          $(".loader").attr("hidden","true");
          //console.log(data);
        }
    });
  });
    //$('#date_start').change();
});
</script>
<script src="js/materialMenu.min.js"></script>
<script>
  var menu = new Menu;
</script>
<script type="text/javascript">
$(".list2").hide();
$(".drop").click(function(){
  $(".list2").toggle(400, function(){
    });
});
</script>
<script type="text/javascript">
$(".list3").hide();
$(".drop1").click(function(){
  $(".list3").toggle(400, function(){
    });
});
function myFunction() {
  var filter, table;
  filter = $("#search").val().toUpperCase();
  console.log($("#search").val());
  console.log(filter);
  table = $(".dorders").each(function(){
      if($(this).text().toUpperCase().indexOf(filter) > -1){
          $(this).show();
          $(this).find(".case").addClass("checkok");
      } else {
          $(this).hide();
          $(this).find(".case").removeClass("checkok");
      }
  });
}
</script>
</body>
</html>