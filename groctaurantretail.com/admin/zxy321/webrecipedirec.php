<?php
include 'session.php';
if($login_role != "admin" && $login_role == "Order Platform"){
    header("location: orders.php");
    die();
}
if(isset($_GET['id'])){ 
    $id = $_GET['id'];
    //echo $id;
    include '../../db/config.php';
    $result = mysqli_query($con, "SELECT * from admin_recipee where id='$id'");
    $row= mysqli_fetch_array($result);
    $name = $row['recipe_name1'];
    echo "<h2>".$name."</h2>";
    $name_dir = "direc_".str_replace(" ", "_", $name);
mysqli_set_charset($con, 'utf8');
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" type="image/png" href="../../images/GR.png"/>
    <title>GROCTAURANT</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" />
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Oswald:500,600" rel="stylesheet">
</head>
<body>
<form method="post" action="webrecipedirec1.php" enctype="multipart/form-data">
    <input type="text" value="<?php echo $name_dir; ?>" name="name_dir" hidden>
    <input type="text" value="<?php echo $id; ?>" name="id" hidden>
<div class="cook_dir">
    <h3>Cooking Directions</h3>
<?php
$query1 = mysqli_query($con, "SELECT * from $name_dir where type='cooking' or type='' order by id");
while($row1 = mysqli_fetch_array($query1)){ ?>
<div class="cook_step">
<input type="text" name="imagea[]" value="<?php echo $row1['image']; ?>" hidden>
<input type="text" name="type[]" value="cooking" hidden>
<div class="col-sm-1">
    <center><button type="button" class="btn btn-danger remove_step">X</button></center>
</div>
    <div class="col-sm-5">
Step: <textarea class="form-control" name="desc[]" rows="3" required><?php echo $row1['description']; ?></textarea></div>
<div class="col-sm-4">
Step Hindi: <textarea class="form-control" name="desc_hindi[]" rows="3" required><?php echo $row1['description_hindi']; ?></textarea></div>
<div class="col-sm-2"><br><input type='file' name="image[]"><img src="<?php echo $row1['image']; ?>" width="200px"></div>
</div>
<?php }
?>
</div><br>
<center><button type="button" class="btn btn-warning btn_add_cook">Add Step</button></center><br>
<hr>
<div class="prep_dir">
        <h3>Preparation Directions</h3>
<?php
$query2 = mysqli_query($con, "SELECT * from $name_dir where type='prep' order by id ");
while($row2 = mysqli_fetch_array($query2)){ ?>
<div class="prep_step">
<input type="text" name="imagea[]" value="" hidden>
<input type="text" name="type[]" value="prep" hidden>
<div class="col-sm-1">
    <center><button type="button" class="btn btn-danger remove_step">X</button></center>
</div>
    <div class="col-sm-6">
Step: <textarea class="form-control" name="desc[]" rows="3" required><?php echo $row2['description']; ?></textarea></div>
<div class="col-sm-5">
Step Hindi: <textarea class="form-control" name="desc_hindi[]" rows="3" required><?php echo $row2['description_hindi']; ?></textarea></div>
</div>
<?php }
?>
</div><br>
<center><button type="button" class="btn btn-warning btn_add_prep">Add Step</button></center><br>
<hr>

<div class="chef_dir">
<h3>Chef's Notes</h3>
<?php
$query3 = mysqli_query($con, "SELECT * from $name_dir where type='chef' order by id ");
while($row3 = mysqli_fetch_array($query3)){ ?>
<div class="chef_step">
<input type="text" name="imagea[]" value="" hidden>
<input type="text" name="type[]" value="chef" hidden>
<div class="col-sm-1">
    <center><button type="button" class="btn btn-danger remove_step">X</button></center>
</div>
    <div class="col-sm-6">
Step: <textarea class="form-control" name="desc[]" rows="3" required><?php echo $row3['description']; ?></textarea></div>
<div class="col-sm-5">
Step Hindi: <textarea class="form-control" name="desc_hindi[]" rows="3" required><?php echo $row3['description_hindi']; ?></textarea></div>
</div>
<?php }
?>
</div><br>
<center><button type="button" class="btn btn-warning btn_add_chef">Add Step</button></center><br>
<hr>
<center><input class="btn btn-success" type="submit" value="Update" name="submit"></center>
	        </form>
<script type="text/javascript">
$(function() {
    $(document).on("change", ":file", function() {
        var tag =$(this);
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                tag.next().attr('src', e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
        }
    });
    
    $(document).on("click", ".btn_add_cook", function(){
        $(".cook_dir").append('<div class="cook_step"><input type="text" name="imagea[]" value="" hidden><input type="text" name="type[]" value="cooking" hidden><div class="col-sm-1"><center><button type="button" class="btn btn-danger remove_step">X</button></center></div><div class="col-sm-5">Step: <textarea class="form-control" name="desc[]" rows="3" required></textarea></div><div class="col-sm-4">Step Hindi: <textarea class="form-control" name="desc_hindi[]" rows="3" required></textarea></div><div class="col-sm-2"><br><input type="file" name="image[]"><img src="" width="200px"></div></div>');
    });
    
    $(document).on("click", ".btn_add_prep", function(){
        $(".prep_dir").append('<div class="prep_step"><input type="text" name="imagea[]" value="" hidden><input type="text" name="type[]" value="prep" hidden><div class="col-sm-1"><center><button type="button" class="btn btn-danger remove_step">X</button></center></div><div class="col-sm-6">Step: <textarea class="form-control" name="desc[]" rows="3" required></textarea></div><div class="col-sm-5">Step Hindi: <textarea class="form-control" name="desc_hindi[]" rows="3" required></textarea></div></div>');
    });
    
    $(document).on("click", ".btn_add_chef", function(){
        $(".chef_dir").append('<div class="chef_step"><input type="text" name="imagea[]" value="" hidden><input type="text" name="type[]" value="chef" hidden><div class="col-sm-1"><center><button type="button" class="btn btn-danger remove_step">X</button></center></div><div class="col-sm-6">Step: <textarea class="form-control" name="desc[]" rows="3" required></textarea></div><div class="col-sm-5">Step Hindi: <textarea class="form-control" name="desc_hindi[]" rows="3" required></textarea></div></div>');
    });
    
    $(document).on("click", ".remove_step", function(){
        $(this).parent().parent().parent().remove();
    });
});

</script>
	    </body>
	    </html>