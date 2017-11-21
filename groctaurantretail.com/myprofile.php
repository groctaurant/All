<?php
include('session.php');
include ('db/config.php');
?>
<?php
// initializ shopping cart class
include 'cart1.php';
$cart = new Cart;
$query1 = mysqli_query($con, "SELECT shop_stat from grret_shopstat where id=1");
$merRow1 = mysqli_fetch_array($query1);
$shop_stat = $merRow1['shop_stat'];
?>
<html>
<head>
    <link rel="shortcut icon" type="image/png" href="images/GR.png"/>
    <title>GROCTAURANT</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Bhaina" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Arima+Madurai:700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
  
<script id="_webengage_script_tag" type="text/javascript">
var webengage; !function(w,e,b,n,g){function o(e,t){e[t[t.length-1]]=function(){r.__queue.push([t.join("."),arguments])}}var i,s,r=w[b],z=" ",l="init options track screen onReady".split(z),a="feedback survey notification".split(z),c="options render clear abort".split(z),p="Open Close Submit Complete View Click".split(z),u="identify login logout setAttribute".split(z);if(!r||!r.__v){for(w[b]=r={__queue:[],__v:"6.0",user:{}},i=0;i<l.length;i++)o(r,[l[i]]);for(i=0;i<a.length;i++){for(r[a[i]]={},s=0;s<c.length;s++)o(r[a[i]],[a[i],c[s]]);for(s=0;s<p.length;s++)o(r[a[i]],[a[i],"on"+p[s]])}for(i=0;i<u.length;i++)o(r.user,["user",u[i]]);setTimeout(function(){var f=e.createElement("script"),d=e.getElementById("_webengage_script_tag");f.type="text/javascript",f.async=!0,f.src=("https:"==e.location.protocol?"https://ssl.widgets.webengage.com":"http://cdn.widgets.webengage.com")+"/js/webengage-min-v-6.0.js",d.parentNode.insertBefore(f,d)})}}(window,document,"webengage");

webengage.init("11b564bd0");
</script>

    <style>

        li{font-family: 'Baloo Bhaina', cursive; font-size:17px; letter-spacing:0.8px;}
        h3{font-family: 'Baloo Bhaina', cursive; font-size:22px; letter-spacing:0.8px;}
        .navbar{background-color:white}


    </style>
</head>

<body>
    <?php
    $query = mysqli_query($con, "SELECT * FROM grret_merchants WHERE mer_id = '$login_session' ");
    $merRow = mysqli_fetch_array($query);
    ?>

   <?php include'navbar.php'; ?>

    <br>
    <form action="myprofile1.php" method="post"> 
    <div class="container-fluid" style="margin-top: 6em;">

    

    <div class="col-sm-6">
  <a class="btn btn-default pull-right hidden-sm hidden-md hidden-lg" data-toggle="modal" data-target="#myModal">Change Password</a>
    <h3 style="font-family: 'Questrial', sans-serif; text-align:center"><b>My Profile</b></h3><br>
    <input type="hidden" name="id" value="<?php echo $merRow['id']; ?>">
    <div class="form-group">                
       <label>Name :</label>
       <input id="merchant_name" type="text" class="form-control editfield" name="mer_name" value="<?php echo $merRow['mer_name']; ?>" required readonly>
     </div>
     <div class="form-group">       
       <label>ID :</label>
       <input id="merchant_id" type="text" class="form-control" name="mer_id" value="<?php echo $merRow['mer_id']; ?>" required readonly>
       </div>
     <div class="form-group">
       <label>Phone :</label>
       <input id="merchant_phone" type="number" class="form-control editfield" name="mer_phone" value="<?php echo $merRow['mer_phone']; ?>" required readonly>
     </div>
     <div class="form-group">
       <label>Address :</label>
       <textarea id="merchant_address" type="text" class="form-control editfield" name="mer_address" required readonly><?php echo $merRow['mer_address']; ?></textarea>
     </div>
     <div class="form-group">
       <label>Email :</label>
       <input id="merchant_email" type="text" class="form-control editfield" name="mer_email" value="<?php echo $merRow['mer_email']; ?>" required readonly>
     </div>
     <div class="form-group">                     
       <label>Veg Tag : </label>
       <?php if($merRow['mer_vegtag'] == "Veg") { ?>
          <label class="radio-inline"><input id="veg_tag" class="editradio" type="radio" name="mer_vegtag" value="Veg" checked disabled>Veg</label>
       <label class="radio-inline"><input id="veg_tag" class="editradio" type="radio" name="mer_vegtag" value="Non-Veg" disabled>Non-Veg</label>
       <label class="radio-inline"><input id="veg_tag" class="editradio" type="radio" name="mer_vegtag" value="Both" disabled>Both</label>
      <?php
       } else if($merRow['mer_vegtag'] == "Non-Veg") { ?>
          <label class="radio-inline"><input id="veg_tag" class="editradio" type="radio" name="mer_vegtag" value="Veg" disabled>Veg</label>
       <label class="radio-inline"><input id="veg_tag" class="editradio" type="radio" name="mer_vegtag" value="Non-Veg" disabled checked>Non-Veg</label>
       <label class="radio-inline"><input id="veg_tag" class="editradio" type="radio" name="mer_vegtag" value="Both" disabled>Both</label>

       <?php } else { ?>
          <label class="radio-inline"><input id="veg_tag" class="editradio" type="radio" name="mer_vegtag" value="Veg" disabled> Veg</label>
       <label class="radio-inline"><input id="veg_tag" class="editradio" type="radio" name="mer_vegtag" value="Non-Veg" disabled> Non-Veg</label>
       <label class="radio-inline"><input id="veg_tag" class="editradio" type="radio" name="mer_vegtag" value="Both" checked disabled> Both</label>
       <?php } ?>
    </div>
     </div>

    
    <div class="col-sm-6">
  <a class="btn btn-default pull-right hidden-xs" data-toggle="modal" data-target="#myModal">Change Password</a>
     <h3 style="font-family: 'Questrial', sans-serif; text-align:center"><b>Bank Details</b></h3>
     <br>
    <div class="col-sm-12">
    <div class="form-group">                
       <label>Bank Name :</label>
       <input id="bank_name" type="text" class="form-control editfield" name="mer_bank_name" value="<?php echo $merRow['mer_bank_name']; ?>" readonly>
     </div>
     <div class="form-group">       
       <label>Branch Name :</label>
       <input id="branch_name" type="text" class="form-control editfield" name="mer_bank_branch_name" value="<?php echo $merRow['mer_bank_branch_name']; ?>" readonly>
       </div>
       <div class="form-group">
       <label>Branch Code :</label>
       <input id="branch_code" type="text" class="form-control editfield" name="mer_bank_branch_code" value="<?php echo $merRow['mer_bank_branch_code']; ?>"  readonly>
     </div>
     <div class="form-group">
       <label>Account No. :</label>
       <input id="account_no" type="text" class="form-control editfield" name="mer_bank_acc_no" value="<?php echo $merRow['mer_bank_acc_no']; ?>"  readonly>
     </div>
     <div class="form-group">
       <label>IFSC Code :</label>
       <input id="ifsc_code" type="text" class="form-control editfield" name="mer_bank_ifsc_code" value="<?php echo $merRow['mer_bank_ifsc_code']; ?>"  readonly>
     </div>
     
    </div>
    </div>
    </div>
    
    <div class="editdiv">
    <center><button role="button" id="editbtn" class="btn btn-danger"  style="padding:8px 18px; font-family: 'Baloo Bhaina', cursive; font-size:23px; letter-spacing:0.8px;">EDIT DETAILS</button></center>
    </div>
    </form>
    

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title"><center>Change Password</center></h3>
            </div>
            <div class="modal-body"><br>
                <form class="form-horizontal" action="mypassword1.php" method="POST">
                    <div class="form-group">
                        <label class="control-label col-sm-4">Old Password:</label>
                        <div class="col-sm-7">
                            <input type="password" id="old_password" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">New Password:</label>
                        <div class="col-sm-7">
                            <input type="password" id="password" class="form-control" name="new_password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Confirm Password:</label>
                        <div class="col-sm-7">
                            <input type="password" id="confirm_password" class="form-control" required>
                        </div>
                    </div>
                    <input type="hidden" name="mer_id" value="<?php echo $merRow['mer_id']; ?>">
                    <center><button type="submit" name="submit" id="btnsub" class="btn btn-info"  style="padding:6px 15px; font-family: 'Baloo Bhaina', cursive; font-size:22px; letter-spacing:0.8px;" disabled>Submit</button></center>
                </form>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        $('#editbtn').on('click', function(){
            $('.editfield').removeAttr('readonly');
            $('.editradio').removeAttr('disabled');
            $('.editdiv').html('<center><input type="submit" name="submit" id="updatebtn" class="btn btn-success"  style="padding:8px 18px; font-family: Baloo Bhaina, cursive; font-size:25px; letter-spacing:0.8px;" value="UPDATE"></center>')
        });
        
          $.ajax({
            type : "post",
            url : "mypassword.php",
            data : 'data=<?php echo $login_session; ?>',
            success : function(data){
              //console.log(data);
              $('#old_password').on('input', function(){
                var val = $(this).val();
                if(val == data){
                  $('#old_password').css('border', '3px solid green');
                  $('#btnsub').removeAttr('disabled');
                } else {
                  $('#old_password').css('border', '3px solid red');
                  $('#btnsub').attr('disabled','true');
                }
              });
            }
          });
        
        $('#password, #confirm_password').on('input', function () {
          
            if ($('#password').val() == $('#confirm_password').val()) {
                $('#confirm_password').css('border', '3px solid green');
                $('#btnsub').removeAttr('disabled');
            } else { 
                $('#confirm_password').css('border', '3px solid red');
                $('#btnsub').attr('disabled','true');
            }
          
      });
    });
</script>


</body>
</html>