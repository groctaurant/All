<?php
include('session.php');
if($login_role != "admin" && $login_role == "Order Platform"){
    header("location: orders.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" type="image/png" href="../../images/GR.png"/>
    <title>GROCTAURANT</title>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2-bootstrap.css"> 

</head>
<body>

<!--Cooking Directions-->
<form class="form-horizontal" method="POST" action="cook1.php" enctype="multipart/form-data" style="margin-bottom:120px">
    <div class="container" style="margin-top:10px">
        <h2><center>Add Steps</center></h2>
        <br>
            <div class="form-group">
                <label class="control-label col-sm-2">Recipe :</label>
                <div class="col-sm-10">
                    <select class="form-control selectrec" name="rec">
                        <option>Select Recipe</option>
                        <?php 
                        $query = mysqli_query($con, "SELECT * from admin_recipee");
                        while($row = mysqli_fetch_array($query)){
                            echo "<option>".$row['recipe_name1']."</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
        <div class="cookdir">
                <div class="form-group">
                    <label class="control-label col-sm-2">Step :</label>
                    <div class="col-sm-10">
                        <textarea name="desc[]" class="form-control" placeholder="Enter Step Description" required></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2">Image :</label>
                    <div class="col-sm-10">
                        <input type="file" name="image[]">
                    </div>
                </div>
                <hr style="border:1px solid teal;">

            </div>
            
        <center>
            <input type="submit" name="submit" value="Submit" class="btn btn-success">
            <button type="button" class="btn btn-primary pull-right add">ADD</button>
        </center>          
    </div>

</form>
<script>
$(document).ready(function() {
    $(document).on("click", ".add", function(){
        $(".cookdir").append('<div><button type="button" class="btn btn-danger remove">REMOVE</button><div class="form-group"><label class="control-label col-sm-2">Step :</label><div class="col-sm-10"><textarea name="desc[]" class="form-control" placeholder="Enter Step Description" required></textarea></div></div><div class="form-group"><label class="control-label col-sm-2">Image :</label><div class="col-sm-10"><input type="file" name="image[]"></div></div><hr style="border:1px solid teal;"></div>')
    });
    $.getScript('http://cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.min.js', function(){
        var select = $('.selectrec').select2();
    });
    $(document).on("click", ".remove", function(){
        $(this).parent().remove();
    });
});
</script>
