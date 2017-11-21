<?php
$name = $_GET['name'];
echo $name;
?>
<html>
<head>    
</head>

<body>
  <iframe onload="isLoaded()" id="pdf" name="pdf" src="<?php echo $name; ?>.pdf"></iframe>
<script>
function isLoaded()
{
  var pdfFrame = window.frames["pdf"];
  pdfFrame.focus();
  pdfFrame.print();
}
</script>
</body>
</html>