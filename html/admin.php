<?php 
  session_start();
  if($_SESSION['admin'] != 1) {
    header("Location:../index.php");
  }
  include('../secret/mdp.php');
  // ------ connexion à la base de données ------------------------
  try
    {$bdd = new PDO("mysql:host=$host;dbname=$db", $user, $userpswd);}

  catch(Exception $e)
    {die('Erreur : '.$e->getMessage());}  // arrêt en cas d'erreur
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" type="text/css" href="./css/login-modal.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
    body {
      background-color: black;
      color: white;
    }
    .admin-grid {
      display: inline-grid;
      grid-template-columns: 100px 200px 200px 200px;
      grid-gap: 8px;
      position: relative;
      left: 30%;
      justify-content: center;
      font-family: Roboto;
    }

    .admin-grid > div {
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
      font-size: 20px;
      text-align: center;
    }

    .admin-grid input {
      background-color: black;
      border: none;
    }

    .admin-image {
      width: 100px;
      height: 100px;
    }

    #add-element {
      grid-column-start: 3;
      grid-column-end: 4;
    }
    </style>
  </head>
  <?php include('./navbar.php'); ?>
  <?php include('./login.php'); ?>
  <body>
  <?php 
    $products = $bdd->query("select * from produit");
    echo "<div class='admin-grid'>";
    while($info = $products->fetch()) {
      echo "<div><img class='admin-image' src='../images/{$info['image']}'></div>";
      echo "<div>{$info['designation']}</div>";
      echo "<div><form action='./modify_product.php' method='post'><input type='hidden' name='id' value='{$info['idproduit']}'><input type='submit' value='Modifier'></form></div>";
      echo "<div><form action='../php/delete_product.php' method='post'><input type='hidden' name='id' value='{$info['idproduit']}'><input type='submit' value='Supprimer'></form></div>";
    }
    echo "<div id='add-element'><a href='./add_product.php'>Ajouter un élément</a></div>";
    echo "<div id='check-receipts'><a href='./check_receipts.php'>Voir les factures</a></div>";

    echo "</div>";
  ?>
  </body>
  </html>