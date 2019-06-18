<html>
<head>
<style type="text/css">
#myiframe {width:100%; height:100%;} 
</style>
</head>
<body>
<div>
<?php 
  if(isset($_POST['show_pdf'])) {
    $pdf_name = $_POST['pdf_name'].".pdf";
    echo "<iframe name='myiframe' id='myiframe' src='../php/pdfs/{$pdf_name}'>";
  }
?>
</div>
</body>
</html>