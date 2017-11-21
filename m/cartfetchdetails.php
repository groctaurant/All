<?php 
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['login_phone'])){
    include 'session.php';
}
include 'config.php';
?>
<div class="well" style="background:white;">
<div class="row">
    <div class="col-xs-6">
        <input style="border-top:0; border-left:0; border-right:0; width:100%; border-bottom:1px solid #696969; padding:8px 0 0 8px; font-size:14px;" type="number" name="customer_phone" list="cus_phone" id="customer_phone" class="customer_phone" placeholder="Enter Phone" value="<?php echo $login_session1; ?>">
    </div>
<div class="col-xs-6">
<input style="border-top:0; border-left:0; border-right:0; width:100%; border-bottom:1px solid #696969; padding:8px 0 0 8px; font-size:14px;" type="text" name="customer_name" class="customer_name" placeholder="Enter Name" value="<?php echo $login_session; ?>" required>
</div>
</div>
<div class="form-group">
    <label style="font-size:11px; color:silver; font-weight:400;">Address:</label>
	<div class="row">
<?php
$query = mysqli_query($con, "SELECT * from web_cus_address where cus_phone='$login_session1' order by id desc");
$count=mysqli_num_rows($query);
if($count>0){ ?>
    <div class="col-xs-10 address_select" data-toggle="buttons">
<?php
while($row = mysqli_fetch_array($query)){
    $address = $row['address1']."|".$row['address2']."|".$row['address3']; 
    if($row['default_address'] == "default"){ ?>
        <label class="btn btn-default active btn_select_tag" style="color:#696969; font-size:13px;">
            <input type="radio" class="btn_addressx" value="<?php echo $address; ?>" checked><?php echo $row['tag']; ?>
        </label>
    <?php
    } else { ?>
        <label class="btn btn-default btn_select_tag" style="color:#696969; font-size:13px;">
            <input type="radio" class="btn_addressx" value="<?php echo $address; ?>"><?php echo $row['tag']; ?>
        </label>
    <?php
    }
}
?>  
</div>
<div class="col-xs-2 text-center">
<a data-toggle="modal" data-target="#myModal" style="cursor:pointer; font-size:22px; font-weight:bold; color:silver; text-decoration:none;">+</a> 
</div>
<?php } else { ?>
<div class="container-fluid" style="padding:10px;">
<input type="text" data-toggle="modal" data-target="#myModal" class="click_address" placeholder="Click to add address" style="width:100%;margin-bottom:20px; border-top:0; border-right:0; border-left:0; border-bottom:1px solid grey; padding:10px 10px; border-radius:0; " required>
</div>
<?php } ?>
</div>
    <?php
	if($count>0){ 
    $query1 = mysqli_query($con, "SELECT * from web_cus_address where cus_phone='$login_session1' and default_address='default'");
    $row1 = mysqli_fetch_array($query1); ?>
    <input style="border-top:0; border-left:0; border-right:0; width:100%; border-bottom:1px solid #696969; padding:8px 0 0 8px; font-size:14px;"  type="text"  placeholder="House/Flat No." class="customer_address1" name="add1" value="<?php echo $row1['address1']; ?>" required>
    <br>
    <input style="border-top:0; border-left:0; border-right:0; width:100%; border-bottom:1px solid #696969; padding:8px 0 0 8px; font-size:14px;"  type="text" placeholder="Area/Sector" class="customer_address2" name="add2" value="<?php echo $row1['address2']; ?>" required>
    <br>
    <input style="border-top:0; border-left:0; border-right:0; width:100%; border-bottom:1px solid #696969; padding:8px 0 0 8px; font-size:14px;"  type="text" placeholder="City/State" class="customer_address3" name="add3" value="<?php echo $row1['address3']; ?>" required>
	<?php } ?>
</div></div>