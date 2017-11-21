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
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<style>

.table-responsive{height:27em; overflow-y:auto;}

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
<div class="container-fluid" style="margin-top:63px;">
<h1 class="text-center" style="font-size: 36px">Merchants</h1>
<a href="merchantaddnew.php" class="w3-btn w3-blue">Add New</a>
<a href="merchantapps.php" class="w3-btn w3-red pull-right">View Applications</a>
<br><br>
<span style="display: inline-block;"><input id="checkbox1" class="checkboxx" type="checkbox" name="merchId"><label for="checkbox1"> ID &nbsp;&nbsp;</label></span>
<span style="display: inline-block;"><input id="checkbox2" class="checkboxx" type="checkbox" name="merchName"><label for="checkbox2"> Name &nbsp;&nbsp;</label></span>
<span style="display: inline-block;"><input id="checkbox3" class="checkboxx" type="checkbox" name="merchPh"><label for="checkbox3"> Phone &nbsp;&nbsp;</label></span> 
<span style="display: inline-block;"><input id="checkbox12" class="checkboxx" type="checkbox" name="merchem"><label for="checkbox12"> Email &nbsp;&nbsp;</label></span>
<span style="display: inline-block;"><input id="checkbox4" class="checkboxx" type="checkbox" name="merchAdd"><label for="checkbox4"> Address &nbsp;&nbsp;</label></span>
<span style="display: inline-block;"><input id="checkbox5" class="checkboxx" type="checkbox" name="Tag"><label for="checkbox5"> Veg Tag &nbsp;&nbsp;</label></span>
<span style="display: inline-block;"><input id="checkbox6" class="checkboxx" type="checkbox" name="Wallet"><label for="checkbox6"> Wallet &nbsp;&nbsp;</label></span>
<span style="display: inline-block;"><input id="checkbox7" class="checkboxx" type="checkbox" name="Upwall"><label for="checkbox7"> Update Wallet &nbsp;&nbsp;</label></span>
<span style="display: inline-block;"><input id="checkbox8" class="checkboxx" type="checkbox" name="LoanWall"><label for="checkbox8"> Loan Wallet&nbsp;&nbsp;</label></span>
<span style="display: inline-block;"><input id="checkbox9" class="checkboxx" type="checkbox" name="CredLim"><label for="checkbox9">Credit Limit &nbsp;&nbsp;</label></span>
<span style="display: inline-block;"><input id="checkbox10" class="checkboxx" type="checkbox" name="SetLim"><label for="checkbox10"> Set Limit &nbsp;&nbsp;</label></span>
<span style="display: inline-block;"><input id="checkbox11" class="checkboxx" type="checkbox" name="action"><label for="checkbox11"> Action &nbsp;&nbsp;</label></span>
<br><br>
<div class="table-responsive">
<table class='table table-bordered'>
<tr>
  
    <th class="merchID">Merchant ID </th>
    <th class="merchName">Merchant Name </th>
    <th class="merchPh">Merchant Phone </th>
    <th class="merchem">Merchant Email </th>
    <th class="merchAdd">Merchant Address </th>
    <th class="Tag">Veg Tag </th>
    <th class="wallet">Wallet </th>
    <th class="text-center Upwall">Update Wallet </th>
    <th class="LoanWall">Loan Wallet </th>
    <th class="CredLim">Credit Limit </th>
    <th class="text-center SetLim">Set Limit </th>
    <th class="text-center feestat">Fee Status </th>
    <th class="text-center action" colspan="2">Action </th>
</tr>

<?php
$sql="SELECT * from grret_merchants order by id";
$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($result))
{ ?> 
  
  <tr>
    
    <td class="merchID"><a href="merchantorders1.php?id=<?php echo $row['mer_id']; ?>"><?php echo $row['mer_id']; ?></a></td>
    <td class="merchName"><a href="merchantorders.php?id=<?php echo $row['mer_id']; ?>"><?php echo $row['mer_name']; ?></a></td>
    <td class="merchPh"><?php echo $row['mer_phone']; ?></td>
    <td class="merchem"><?php echo $row['mer_email']; ?></td>
    <td class="merchAdd"><?php echo $row['mer_address']; ?></td>
    
    <td class="Tag"><?php echo $row['mer_vegtag']; ?></td>
    <td class="Wallet"><a href="merchantwallettrans.php?id=<?php echo $row['mer_id']; ?>">₹<?php echo $row['mer_wallet']; ?></a></td>
    <td class="Upwall">
    <center><form class="form-inline" method="GET" action="merchantwallet.php">
    <div class="form-group">
    <input class="form-control" type="number" name="wallet" size="20" placeholder="Enter Amount" required></div>
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <input type="submit" class="btn btn-success" value="Update" >
    </form>
    </center>
    </td>
    <td class="LoanWall"><a href="merchantloanwallettrans.php?id=<?php echo $row['mer_id']; ?>">₹<?php echo $row['mer_loanwallet']; ?></a>
    <?php if($row['mer_lwstatus'] == "ON"){ ?>
      <input type="checkbox" data-toggle="toggle" class="toggle"  data-size="small" data-on="ON" data-off="OFF" data-onstyle="warning" checked value="<?php echo $row['id']; ?>,<?php echo $row['mer_lwstatus']; ?>"></td>
     <?php } else { ?>
      <input type="checkbox" data-toggle="toggle" class="toggle" data-size="small" data-on="ON" data-off="OFF" data-onstyle="warning" value="<?php echo $row['id']; ?>,<?php echo $row['mer_lwstatus']; ?>"></td>
     <?php   } ?>
    
    <td class="CredLim">₹<?php echo $row['credit_limit']; ?></td>
    <td class="SetLim">
    <center><form class="form-inline" method="GET" action="merchantcreditlimit.php">
    <div class="form-group">
    <input class="form-control" type="number" name="credit_limit" size="20" placeholder="Enter Amount" required></div>
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <input type="submit" class="btn btn-success" value="Update">
    </form>
    </center>
    </td>
    <td>
      <a href="feestatus.php?id=<?php echo $row['id']; ?>"><?php echo $row['fee_status']; ?></a>
    </td>
    <td class="action"><center><a href="merchantedit.php?id=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
    </center>
    </td>
    <td class="action"><center><a href="merchantdelete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
    </center>
    </td>
   
  </tr> 
  
<?php
echo "</tr>";
}
?>
</table>
</div>
</div>
</div>
<script type="text/javascript">
  $(function() {
    $('.toggle').on('change', function(){
      var tag = $(this);
      var val = $(this).val();
      //console.log(val);
      $.ajax({
        type : "post",
        url : "merchantlwstatus.php",
        data : 'data='+val,
        success : function(data){
            tag.val(data);
        }
      });
    });
  
$(".checkboxx").change(function(){
  var col ="." + $(this).attr("name");
  
  if(this.checked){
    $(col).addClass("hidden");
  }
  else{
   $(col).removeClass("hidden"); 
  }

});

});
</script>
</body>
</html>