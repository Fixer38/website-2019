<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="../css/welcome.css">
    <link rel="stylesheet" type="text/css" href="../css/login-modal.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
<body>
<?php include('./navbar.php'); ?>
<div id="main" style="font-family: Roboto; font-size: 100px">20x20 Photo Print</div>
<div class="icon">
  <a href='../index.php'><div class="arrow"></div></a>
</div>
<?php include('./login.php'); ?>
</body>

<script>
const $icon = document.querySelector('.icon');
const $arrow = document.querySelector('.arrow');

$icon.onclick = () => {
  $arrow.animate([
    {left: '0'},
    {left: '10px'},
    {left: '0'}
  ],{
    duration: 700,
    iterations: Infinity
  });
}
</script> 