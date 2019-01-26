<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/registration.css">
    <link rel="stylesheet" type="text/css" href="./css/login-modal.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
      .w3-content {position: absolute;
      max-width: 1200px;
      height: 650px;
      width: 1200px;
      margin: -100px 0 0 -200px;
      top: 20%;
      left: 30%;}
      .mySlides {display: None; width: 100%; height: 100%; right:50%}
      .w3-left, .w3-right, .w3-badge {cursor:pointer}
      .w3-badge {height:13px;width:13px;padding:0} 
      .product-info {top: 850px; height: 400px;}
      .get-hidden {display: none;}
      .activee {height: 100%; width: 100%;}
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
  
<?php 
include('./secret/mdp.php');
try
	{$bdd = new PDO("mysql:host=$host;dbname=$db", $user, $userpswd);}

catch(Exception $e)
    {die('Erreur : '.$e->getMessage());}  // arrêt en cas d'erreur
    
$products_info = $bdd->prepare("select * from produit");
$products_info->execute();
$products_info = $products_info->fetchAll();
?>

<!-- Slideshow pour images produit -->

<a href="#" class="show_hide"><div class="w3-content w3-display-container ">
<?php 
foreach($products_info as $row) {
  $image = $row['image'];
  echo "<img class='mySlides' src='./images/{$image}'>"; 
}?>

<div class='w3-center w3-container w3-section w3-large w3-text-white w3-display-bottommiddle' style='width:100%'>
  <div class='w3-left w3-hover-text-khaki' onclick='plusDivs(-1)'>&#10094;</div>
  <div class='w3-right w3-hover-text-khaki' onclick='plusDivs(1)'>&#10095;</div>
  <span class='w3-badge demo w3-border w3-transparent w3-hover-white' onclick='currentDiv(1)'></span>
  <span class='w3-badge demo w3-border w3-transparent w3-hover-white' onclick='currentDiv(2)'></span>
  <span class='w3-badge demo w3-border w3-transparent w3-hover-white' onclick='currentDiv(3)'></span>
  <span class='w3-badge demo w3-border w3-transparent w3-hover-white' onclick='currentDiv(4)'></span>
  <span class='w3-badge demo w3-border w3-transparent w3-hover-white' onclick='currentDiv(5)'></span>
</div>
</div></a>

<div class="w3-content product-info slidingDiv">
  <p>Here is some text</p>
</div>



<!-- script permettant de gérer les 2 slideshows -->
<script>
  $(".slidingDiv").hide();

  $('.show_hide').click(function() {
    $(this).next(".slidingDiv").slideToggle();
 });


var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function currentDiv(n) {
  showDivs(slideIndex = n);
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
</script>

</body>
</html>