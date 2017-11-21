<?php
include '../../db/config.php';
$date_start = $_POST['date_start'];
$date_end = $_POST['date_end'];
// echo $date_end." ";
// echo $date_start;
?>
<?php
$sql="SELECT * from grret_orders where (ord_status='Delivered') and order_at >= '$date_start' and order_at <= '$date_end' order by id desc";
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
    <?php } else { ?>
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
        echo "<p>Payment Status:</p>".$row['payment_status'];
      } ?>
    </div>
  </div>
  <div class="row" style="margin-top: 0px; margin-bottom: 0px;">
    <div class="col-sm-3">
      <p>Payment Type: <b><?php echo $row['payment_type']; ?></b></p>
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
      <p style="font-size: 25px;color:#a72323;">₹<?php echo $row['final_amount']; ?></p><p style="margin-top:-5px;font-size: 20px;color:#a72323;">(₹<span class="total_price"><?php echo $row['total_price']; ?></span>)</p>
    </div>
  </div>
</div>
<?php
} ?>
</div>