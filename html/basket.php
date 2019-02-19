<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/registration.css">
    <link rel="stylesheet" type="text/css" href="../css/login-modal.css">
    <link rel="stylesheet" type="text/css" href="../css/basket.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
<?php include('./navbar.php'); ?>

<?php
echo "<div class='textbox' style='clear: both;'>";
echo "<p class='alignleft'>".$_SESSION['street']." ".$_SESSION['hnumber']."</p>";
echo "<p class='alignright'>".$_SESSION['localite']." ".$_SESSION['cp']."</p></div>";
if (!empty($_SESSION['panier']['codeproduit'])) {
  echo  "<div class='absolute'>";
  echo "<div class='grid-container'>";
  for($i=0;$i<sizeof($_SESSION['panier']['codeproduit']);$i++) {
    $product_number = $_SESSION['panier']['codeproduit'][$i]-1;
    $remove = "remove{$i}";
    echo "<div><form action='../php/removeitem.php' method='post'><input type='submit' value='x' name=$remove class='btn-minus'></form></div>";
    echo "<div><img class='resize' src='../images/{$_SESSION['images'][$product_number]}'></div>";
    echo "<div>{$_SESSION['descriptions'][$product_number]}</div>";
    $add = "add{$i}";
    $minus = "minus{$i}";
    echo "<div><form action='../php/incrementquant.php' method='post'><input type='submit' value='-' name=$minus class='btn-minus'><input type='submit' value='+' name=$add class='btn-plus'></form></div>";
    echo "<div>{$_SESSION['panier']['quantite'][$i]}</div>";
    $total += $_SESSION['prices'][$i] * $_SESSION['panier']['quantite'][$i];
    $current = $_SESSION['prices'][$i] * $_SESSION['panier']['quantite'][$i];
    echo "<div>{$current}</div>";
    if($i === sizeof($_SESSION['panier']['codeproduit'])-1) {
      echo "<div></div>";
      echo "<div></div>";
      echo "<div></div>";
      echo "<div></div>";
      echo "<div>Total</div>";
      echo "<div>{$total}</div></div></div>";
    }
  } 
}

else {
  echo "<div>Votre panier est vide</div>";
}
?>
