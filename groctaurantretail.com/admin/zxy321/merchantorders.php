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

li,h2,h1{font-family: 'Oswald', sans-serif; font-size:17px; letter-spacing:0.8px;}
.hidden{
  display: none;
}
li.active{
  background: #d0d0d0;
}
a.active{
  color: #000;
}
.Paid{
    background-color: lightgreen;
}
}
</style>
</head>

<body>
<?php include 'navbar.php'; ?>


        <div class="wrapper" id="wrapper">
        <div class="container-fluid" style="margin-top:60px;">
            <h1><center>Loan Orders of <?php echo $mer_id; ?></center></h1>

            <a data-toggle="modal" data-target="#myModal" class="btn btn-primary clear_payment">Clear Payment</a>

            <br>
            <div class="table-responsive"> <table class='table table-bordered' id="recipetable">
                <tr>
                    <th><input type="checkbox" class="check_all" onclick="select_all()"></th>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Customer Phone</th>
                    <th>Customer Address</th>
                    <th>Recipe Name</th>
                    <th>Serving</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Price</th>
                    <th>Payment Type</th>
                    <th>Delivery Time</th>
                    <th>Status</th>
                </tr>
                <?php
                $payment_type = "Pay Via Loan Wallet";

                $sql="SELECT * from grret_orders where mer_id = '$mer_id' and payment_type= '$payment_type' order by id desc";
                $result = mysqli_query($con, $sql);
                while($row = mysqli_fetch_array($result))
                {
                    echo "<tr class='".$row['payment_status']."'>";
                    if($row['payment_status'] == "Unpaid" || $row['payment_status'] == "Requested"){
                        echo "<td><input type='checkbox' class='case'></td>";
                    } else {
                        echo "<td></td>";
                    }
                    echo "<td>" . $row['ord_id'] . "</td>";
                    echo "<td>" . $row['cus_name'] . "</td>";
                    echo "<td>" . $row['cus_phone'] . "</td>";
                    echo "<td>" . $row['cus_address'] . "</td>";
                    echo "<td>" . str_replace(', ','<br>', $row['rec_name']). "</td>";
                    echo "<td>" . str_replace(', ','<br>', $row['rec_serving']). "</td>";
                    echo "<td>" . str_replace(', ','<br>', $row['rec_qty']). "</td>";
                    echo "<td>" . str_replace(', ','<br>', $row['rec_price']). "</td>";
                    echo "<td>" . $row['total_price'] . "</td>";
                    echo "<td>" . $row['payment_type'] . "</td>";
                    echo "<td>" . $row['del_time'] . "</td>";
                    echo "<td>" . $row['ord_status'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><center>Clear Payment</center></h4>
                </div>
                <div class="modal-body"><br>
                    <form class="form-horizontal" action="merchantwalletloan.php" method="POST">
                        <div class="form-group">
                            <label class="control-label col-sm-3">Order ID(s) :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control ord_id" name="ord_id" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Amount :</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control amount" name="amount" readonly>
                            </div>
                        </div>
                        <input type="hidden" value="<?php echo $mer_id; ?>" name="mer_id">
                        <div class="form-group">
                            <label class="control-label col-sm-3">Unique PIN :</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="unique_pin" placeholder="Enter PIN" required>
                            </div>
                        </div>
                        <center><button type="submit" class="w3-btn w3-blue">Submit</button></center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function select_all(){
        $('input[class=case]:checkbox').each(function(){ 
            if($('input[class=check_all]:checkbox:checked').length == 0){ 
                $(this).prop("checked", false); 
            } else {
                $(this).prop("checked", true); 
            } 
        });
    }
    $(document).ready(function(){
        $(".clear_payment").on('click', function() {
            var td1="", td2=0;
            $('.case:checkbox:checked').parents("tr").each(function(){
                for (var i = 0; i < $(this).length; i++) {
                    td1 = td1+"'"+$(this)[i].getElementsByTagName("td")[1].innerHTML+"'"+",";
                    td2 += parseFloat($(this)[i].getElementsByTagName("td")[9].innerHTML);
                }
            });
            td1 = td1.replace(/,+$/,'');
            $('.amount').val(td2);
            $('.ord_id').val(td1);
            
        });
    });
</script>
</body>
</html>