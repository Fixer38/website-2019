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
      .mySlides {display: None}
      .w3-left, .w3-right, .w3-badge {cursor:pointer}
      .w3-badge {height:13px;width:13px;padding:0} 
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
  <?php include('./html/navbar.php'); ?>
  <?php include('./html/slideshow.php');?>
  <?php include('./html/login.php');?>
  
  </body>
</html>