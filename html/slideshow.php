<?php session_start(); 
include('./php/products_info.php');?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/registration.css">
    <link rel="stylesheet" type="text/css" href="./css/login-modal.css">
    <link rel="stylesheet" type="text/css" href="./css/mountain-background.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <style>
      
      .right-content {margin: 0 auto; }
      .left-content {margin: 0; position: absolute; top: 50%; -ms-transform: translateY(-50%);transform: translateY(-50%);right: 50%; background-color: GhostWhite;}
      #bottom-content {display: None; background-color: black; color: white;}
      #detailButton {background-color: black; border-color: black;}
      #leftDetail {float: left;}
      #rightDetail {float: right;}
      .mySlides {display: None}
      .infos {font-family: 'Roboto';}
      .description {font-size: 32px; margin-left: 70px;}
      .price {font-size: 28px; color: red; margin-left: 70px;}
      .stock {font-size: 20px; margin-left: 70px;}
      .mySlides2 {width: 900px; height: 300px; display: table-cell; vertical-align: top; text-align: center; font-family: 'Roboto'; font-size: 25px;}
      .w3-left, .w3-right, 
      .w3-badge {cursor:pointer}
      .w3-badge {height:13px;width:13px;padding:0}
      .resize {width: 954px; height: 600px; position: relative; right: 0px;} 
      .btn-details {width: 954px; margin:0 auto;}
      .form-style2 {background-color: black; position: relative; float: right;}
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
<div class="w3-content w3-display-container right-content" style="max-width:50%">
<?php
for($i = 0; $i < sizeof($_SESSION['idproducts']); $i++) {
  if($_SESSION['stocks'][$i] != 0) {
    echo "<img class='mySlides resize' src='./images/{$_SESSION['images'][$i]}'>";
  }
}
?>
  <div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-bottommiddle" style="width:100%">
    <div class="w3-left w3-hover-text-khaki" onclick="plusDivs(-1)">&#10094;</div>
    <div class="w3-right w3-hover-text-khaki" onclick="plusDivs(1)">&#10095;</div>
    <?php
    for($i = 0; $i < sizeof($_SESSION['idproducts']); $i++) {
      if($_SESSION['stocks'][$i] != 0) {
        echo "<span class='w3-badge demo w3-border w3-transparent w3-hover-white' onclick='currentDiv($i)'></span>";    
      } 
    }
    ?>
  </div>
</div>
<button type="button" class="btn btn-primary btn-block btn-details" id="detailButton" onclick="showDetails()">↓</button>

<div class="w3-content w3-display-container" id='bottom-content' style="max-width:50%; clear: both;">
<?php
for($i = 0; $i <sizeof($_SESSION['idproducts']); $i++) {
  if($_SESSION['stocks'][$i] != 0) {
    echo "<div class='mySlides2'><div id='leftDetail'>";
    echo "<div class='infos description'>{$_SESSION['descriptions'][$i]} 20x20</div><br>";
    echo "<div class='infos price'>Prix: ".number_format($_SESSION['prices'][$i], 2)."</div><br>";
    echo "<div class='infos stock'>Stock: {$_SESSION['stocks'][$i]}</div></div>";
    
    echo "<div id='rightDetail'>";
    echo "<form class='form-style form-style2' action='./php/to_basket.php' method='post'>";
    echo "Quantité: </br><input type='hidden' value={$_SESSION['idproducts'][$i]} name='idproduit'><input type='int' name=quantity style='font-family: Roboto; color:black;'></br></br>";
    echo "<input type='submit' value='Ajouter au panier' style='padding: 10px 10px 10px 10px; width: 58%; font-family: Roboto'></form></div></div>";   
  }
}
?>
</div>
<script>
var slideIndex = 1;
showDivs(slideIndex);
showDivs2(slideIndex);
function plusDivs(n) {
  showDivs(slideIndex += n);
  showDivs2(slideIndex);
}
function currentDiv(n) {
  showDivs(slideIndex = n);
  showDivs2(slideIndex);
}
function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) { 
    dots[i].className = dots[i].className.replace(" w3-white", "");
  }
  x[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " w3-white";
}
function showDivs2(n) {
  var i;
  var x = document.getElementsByClassName("mySlides2");
  var dots = document.getElementsByClassName("demo");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" w3-white", "");
  }
  x[slideIndex-1].style.display = "table-cell";  
  dots[slideIndex-1].className += " w3-white";
}

function showDetails() {
  var x = document.getElementById("bottom-content");
  if (x.style.display === "none") {
    x.style.display = "block";
  }
  else {
    x.style.display = "none";
  }
}
</script>
</body>
</html>