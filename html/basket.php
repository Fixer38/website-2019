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
    <link rel="stylesheet" type="text/css" href="../css/mountain-background.css">
    <link rel="stylesheet" type="text/css" href="../css/basket.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">    
    <style>
      .absolute {font-family: 'Roboto'}
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
<?php include('./navbar.php'); ?>

<?php
if (!empty($_SESSION['panier']['codeproduit'])) {
  echo "<div class='grid-container' style='font-family: Roboto;'>";
  echo "<div class='names'>".$_SESSION['name']." ".$_SESSION['fname']."</div>";
  echo "<div class='street_hnumber'>".$_SESSION['street']." ".$_SESSION['hnumber']."</div>";
  echo "<div class='gap'></div>";
  echo "<div class='localite_cp'>".$_SESSION['localite']." ".$_SESSION['cp']."</div>";
  for($i=0;$i<sizeof($_SESSION['panier']['codeproduit']);$i++) {
    $product_number = $_SESSION['panier']['codeproduit'][$i]-1;
    $remove = "remove{$i}";
    echo "<div class='del_button'><form action='../php/removeitem.php' method='post'><input type='submit' value='x' name=$remove class='btn-minus'></form></div>";
    echo "<div class'prod_image'><img class='resize' src='../images/{$_SESSION['images'][$product_number]}'></div>";
    echo "<div class='prod_desc'>{$_SESSION['descriptions'][$product_number]}</div>";
    $add = "add{$i}";
    $minus = "minus{$i}";
    echo "<div class='quant_buttons'><form action='../php/incrementquant.php' method='post'><input type='submit' value='-' name=$minus class='btn-minus'><input type='submit' value='+' name=$add class='btn-plus'></form></div>";
    echo "<div class='quant'>{$_SESSION['panier']['quantite'][$i]}</div>";
    $total += $_SESSION['prices'][$product_number] * $_SESSION['panier']['quantite'][$i];
    $current = $_SESSION['prices'][$product_number] * $_SESSION['panier']['quantite'][$i];
    echo "<div class='price'>{$current}</div>";
    if($i === sizeof($_SESSION['panier']['codeproduit'])-1) {
      echo "<div></div>";
      echo "<div></div>";
      echo "<div></div>";
      echo "<div></div>";
      echo "<div>Total</div>";
      echo "<div>{$total}</div>";
      echo "<div class='val'><form action='../php/basket_validation.php' method='post'>
      <input class='valid_button' type='submit' value='Valider le panier'/></form></div></div>";
    }
  } 
}

else {
  echo "<div>Votre panier est vide</div>";
}
?>
</body> 
