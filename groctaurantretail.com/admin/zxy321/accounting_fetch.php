<?php
include '../../db/config.php';
$date_start = date("Y-m-d", strtotime("-2 days"));
$date_end = date("Y-m-d", strtotime("+1 days"));
if(isset($_POST['date_start'])){
  $date_start = $_POST['date_start'];
  $date_end = $_POST['date_end'];
}
      $sqlz="SELECT * from grret_orders where ord_status='Delivered' and order_at >= '$date_start' and order_at <= '$date_end'";
      $queryz=mysqli_query($con,$sqlz);
      $subTotal = 0;
      $preOrderDiscount=0;
      $new_cus_discount=0;
      $sgst=0;
      $cgst=0;
      $del_charges=0;
      $total_price=0;
      $grcash=0;
      $walletcash=0;
      $final_amount=0;
      while($rowz=$queryz->fetch_assoc()){
        $subtotal += (float)$rowz['sub_total'];
        $preOrderDiscount +=(float)$rowz['discount'];
        $new_cus_discount +=(float)$rowz['new_cus_discount'];
        $sgst += (float)$rowz['sgst'];
        $cgst += (float)$rowz['cgst'];
        $del_charges += (float)$rowz['del_charges'];
        $total_price += (float)$rowz['total_price'];
        $grcash += (float)$rowz['grcash'];
        $walletcash += (float)$rowz['walletcash'];
        $final_amount += (float)$rowz['final_amount'];
      }
      $sql="SELECT * from grret_orders where payment_type='Pay Via Eazy Wallet' and order_at >= '$date_start' and order_at <= '$date_end'";
      $query = mysqli_query($con,$sql);
      while($row=mysqli_fetch_array($query)){
        $easy_wallet += $row['total_price'];
      }
 ?>
    <div class="col-sm-4">
      <label>M.R.P : </label>
      <?php echo $subtotal ?>
    </div>
    <div class="col-sm-4">
      <label>Easy Wallet : </label>
      <?php echo $easy_wallet ?>
    </div>
    <div class="col-sm-4">
      <label>PreOrderDiscount : </label>
      <?php echo $preOrderDiscount ?>
    </div>
    <div class="col-sm-4">
      <label>New Customer Discount : </label>
      <?php echo $new_cus_discount; ?>
    </div>
    <div class="col-sm-4">
      <label>GST : </label>
      <?php echo $cgst*2; ?>
    </div>
    <div class="col-sm-4">
      <label>Delivery Charges : </label>
      <?php echo$del_charges ?>
    </div>
    <div class="col-sm-4">
      <label>Total Price : </label>
      <?php echo $total_price; ?>
    </div>
    <div class="col-sm-4">
      <label>GrCash : </label>
      <?php echo $grcash ?>
    </div>
    <div class="col-sm-4">
      <label>Wallet Cash : </label>
      <?php echo $walletcash; ?>
    </div>
    <div class="col-sm-4">
      <label>Final Amount : </label>
      <?php echo $final_amount; ?>
    </div>