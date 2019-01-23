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
      .right-content {margin: 0; position: absolute; top: 50%;-ms-transform: translateY(-50%);transform: translateY(-50%);left: 50%}
      .left-content {margin: 0; position: absolute; top: 50%; -ms-transform: translateY(-50%);transform: translateY(-50%);right: 75%}
      .mySlides {display: None}
      .w3-left, .w3-right, .w3-badge {cursor:pointer}
      .w3-badge {height:13px;width:13px;padding:0} 
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>

<div class="w3-content w3-display-container right-content" style="max-width:50%">
  <img class="mySlides" src="./images/registration-background.jpg" style="width:100%">
  <img class="mySlides" src="./images/registration-background.jpg" style="width:100%">
  <img class="mySlides" src="./images/registration-background.jpg" style="width:100%">
  <div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-bottommiddle" style="width:100%">
    <div class="w3-left w3-hover-text-khaki" onclick="plusDivs(-1)">&#10094;</div>
    <div class="w3-right w3-hover-text-khaki" onclick="plusDivs(1)">&#10095;</div>
    <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(1)"></span>
    <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(2)"></span>
    <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(3)"></span>
    <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(4)"></span>
    <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv(5)"></span>
  </div>
</div>

<div class="w3-content w3-display-container left-content" style="max-width:50%">
  <div class="mySlides2"style="width:100%"><h1>There is some text</h1></div>
  <div class="mySlides2"style="width:100%"><h1>There is some text2</h1></div>
  <div class="mySlides2"style="width:100%"><h1>There is some text3</h1></div>
  <div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-bottommiddle" style="width:100%">
  </div>
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
  x[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " w3-white";
}
</script>
</body>
</html>