<?php
if(isset($_POST['rec'])){
    $rec = $_POST['rec'];
    $lang = $_POST['lang'];
}  
?>
<h3>Preparation Directions</h3>
<?php 
include 'config.php';
$rec1 = str_replace(" ", "_", $rec);
mysqli_set_charset($con, 'utf8');
$sql=mysqli_query($con,"SELECT * from direc_".$rec1." where type='prep' order by id");
while($row=mysqli_fetch_array($sql)){
    $des=$row['description'];
    if($lang == "hindi"){
        $des=$row['description_hindi'];
    }
    ?>
    <div class="w3-panel w3-light-grey">
                <p class="recname" style="padding-top:16px; text-align:left"><?php echo $des; ?></p>
       </div>
<?php } ?>
<?php 
mysqli_set_charset($con, 'utf8');
$sql=mysqli_query($con,"SELECT * from direc_".$rec1." where type='chef' order by id");
if(mysqli_num_rows($sql)>0){
?>
<h3>Chef Notes</h3>
<?php
while($row=mysqli_fetch_array($sql)){
    $img=$row['image'];
    $des=$row['description'];
    if($lang == "hindi"){
        $des=$row['description_hindi'];
    }
    ?>
   <div class="w3-panel w3-leftbar w3-sand w3-large w3-serif">
  <p  class="recname" class="text-left"><?php echo $des; ?></p>
</div> 
          
<?php } } ?>
<h3>Cooking Directions</h3>
<?php
mysqli_set_charset($con, 'utf8');
$sql=mysqli_query($con,"SELECT * from direc_".$rec1." where type='cooking' order by id");
while($row=mysqli_fetch_array($sql)){
    $img=$row['image'];
    $des=$row['description'];
    if($lang == "hindi"){
        $des=$row['description_hindi'];
    }
    ?>
    <div class="col-sm-6">
        <div class="card">
            <?php 
            if($img != NULL){ ?>
				<center><img src="http://groctaurantretail.com/admin/zxy321/<?php echo $img; ?>" style="width: 250px; height:150px;"></center>
            <?php 
            } ?>
			<p class="recname cookdesc" style="padding-top:10px; text-align:justify; font-size:15px;"><?php echo $des; ?></p><br>
        </div>
        <br>
    </div>
<?php } ?>