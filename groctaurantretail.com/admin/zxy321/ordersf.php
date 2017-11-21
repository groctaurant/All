<?php
include '../../db/config.php';
$load = $_POST['load'];
?>
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