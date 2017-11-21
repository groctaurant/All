<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="shortcut icon" type="image/png" href="../../images/GR.png"/>
  <title>GROCTAURANT</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container" style="margin-bottom:40px; padding-top:40px;">
<a href="process_show.php" target="_blank" class="btn btn-primary pull-right">Show All</a>
  <h3><center><b>Processing Pricing</b></center></h3><br>
  <form class="form-horizontal" action="process_page.php" method="POST">
    <div class="form-group">
      <label class="control-label col-sm-3">Ingredient:</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" name="ingredient" placeholder="Ingredient Name" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-3">Processing Name:</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="processname" placeholder="Processing Name">
      </div>
    </div>
	 <div class="form-group">
      <label class="control-label col-sm-3">Steps Involved:</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="steps" placeholder="Steps Involved">
      </div>
    </div>
		 <div class="form-group">
      <label class="control-label col-sm-3">Difficulty Level:</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="difficulty" placeholder="Difficulty Level">
      </div>
    </div>
			 <div class="form-group">
      <label class="control-label col-sm-3">Generic Processing Name:</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="genericprocess" placeholder="Generic Processing Name">
      </div>
    </div>
			 <div class="form-group">
      <label class="control-label col-sm-3">Tasking:</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="tasking" placeholder="Tasking">
      </div>
    </div>
			 <div class="form-group">
      <label class="control-label col-sm-3">Time Taken/K.G.:</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="timetaken" placeholder="Time Taken Per K.G.">
      </div>
    </div>
			 <div class="form-group">
      <label class="control-label col-sm-3">Utensils Used:</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="utensils" placeholder="Utensils Used">
      </div>
    </div>
			 <div class="form-group">
      <label class="control-label col-sm-3">Section Involved:</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="section" placeholder="Section Involved">
      </div>
    </div>
			 <div class="form-group">
      <label class="control-label col-sm-3">Source Price:</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="sourceprice" placeholder="Source Price">
      </div>
    </div>
			 <div class="form-group">
      <label class="control-label col-sm-3">Base Price(Per KG):</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="baseprice" placeholder="Base Price Per K.G.">
      </div>
    </div>
			 <div class="form-group">
      <label class="control-label col-sm-3">Yield %:</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="yield" placeholder="Yield Percentage">
      </div>
    </div>
			 <div class="form-group">
      <label class="control-label col-sm-3">Yielded Price:</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="yieldprice" placeholder="Yield Price">
      </div>
    </div>
			 <div class="form-group">
      <label class="control-label col-sm-3">Processing 1:</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="process1" placeholder="Processing 1">
      </div>
    </div>
			 <div class="form-group">
      <label class="control-label col-sm-3">Time 1:</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="time1" placeholder="Time 1">
      </div>
    </div>
			 <div class="form-group">
      <label class="control-label col-sm-3">Cost 1:</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="cost1" placeholder="Cost 1">
      </div>
    </div>
			 <div class="form-group">
      <label class="control-label col-sm-3">Processing 2:</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="process2" placeholder="Processing 2">
      </div>
    </div>
			 <div class="form-group">
      <label class="control-label col-sm-3">Time 2:</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="time2" placeholder="Time 2">
      </div>
    </div>
			 <div class="form-group">
      <label class="control-label col-sm-3">Cost 2:</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="cost2" placeholder="Cost 2">
      </div>
    </div>
			 <div class="form-group">
      <label class="control-label col-sm-3">Processing 3:</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="process3" placeholder="Processing 3">
      </div>
    </div>
			 <div class="form-group">
      <label class="control-label col-sm-3">Time 3:</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="time3" placeholder="Time 3">
      </div>
    </div>
			 <div class="form-group">
      <label class="control-label col-sm-3">Cost 3:</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="cost3" placeholder="Cost 3">
      </div>
    </div>
			 <div class="form-group">
      <label class="control-label col-sm-3">Processing 4:</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="process4" placeholder="Processing 4">
      </div>
    </div>
			 <div class="form-group">
      <label class="control-label col-sm-3">Time 4:</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="time4" placeholder="Time 4">
      </div>
    </div>
			 <div class="form-group">
      <label class="control-label col-sm-3">Cost 4:</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="cost4" placeholder="Cost 4">
      </div>
    </div>
			 <div class="form-group">
      <label class="control-label col-sm-3">Processing 5:</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="process5" placeholder="Processing 5">
      </div>
    </div>
			 <div class="form-group">
      <label class="control-label col-sm-3">Time 5:</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="time5" placeholder="Time 5">
      </div>
    </div>
			 <div class="form-group">
      <label class="control-label col-sm-3">Cost 5:</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="cost5" placeholder="Cost 5">
      </div>
    </div>
			 <div class="form-group">
      <label class="control-label col-sm-3">Total Steps:</label>
      <div class="col-sm-7">          
        <input type="number" class="form-control" name="totsteps" placeholder="Total Steps in numbers">
      </div>
    </div>
			 <div class="form-group">
      <label class="control-label col-sm-3">Processed price:</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="processedprice" placeholder="Processed Price">
      </div>
    </div>
			 <div class="form-group">
      <label class="control-label col-sm-3">Usage:</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="usage" placeholder="Usage">
      </div>
    </div>
			 <div class="form-group">
      <label class="control-label col-sm-3">Risk Factor:</label>
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="riskfact" placeholder="Risk Factore">
      </div>
    </div>
			 <div class="form-group">
      <label class="control-label col-sm-3">Possible Risks:</label>	
      <div class="col-sm-7">          
        <input type="text" class="form-control" name="possiblerisks" placeholder="Possible Risks">
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-7 text-center">
        <button type="submit" class="btn btn-success">Submit</button>
      </div>
    </div>
  </form>
</div>

</body>
</html>
