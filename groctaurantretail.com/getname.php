<?php  
 include ('db/config.php'); 
 if(!empty($_POST["number"]))  
 {  
      $number = $_POST["number"]; 
      $query = "SELECT * FROM grret_customers WHERE cus_phone ='$number'";  
      $result = mysqli_query($con, $query);
      $resulta = mysqli_query($con, $query); ?>
      <input type="text" name="customer_name" list="cus_name" id="customer_name" class="form-control" placeholder="Select/Enter Name" required>
       <datalist id="cus_name">
      <?php
      while($row=mysqli_fetch_array($result))
        { ?>
          <option value="<?php echo $row['cus_name']; ?>"><?php echo $row['cus_name']; ?></option>
        <?php
        } ?>
        </datalist>|<input type="text" name="customer_address" list="cus_address" id="customer_address" class="form-control" placeholder="Select/Enter Address" required>
       <datalist id="cus_address">
      <?php
      while($rowa=mysqli_fetch_array($resulta))
        { ?>
          <option value="<?php echo $rowa['cus_address']; ?>"><?php echo $rowa['cus_address']; ?></option>
        <?php
        }  ?>
        </datalist>
 <?php        
 }  
?> 