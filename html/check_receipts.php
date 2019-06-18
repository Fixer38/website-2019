<?php 
  session_start();
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
  
  </head>
  <?php include('./navbar.php'); ?>
  <?php include('./login.php'); ?>
  <body>
  
  <form action='' method='post'><input type='int' name='idclient'><input type='submit' name='validate_search' value='rechercher le client'></form>
  <?php
  if(isset($_POST['validate_search'])) {
    $idclient = (string)$_POST['idclient'];
    $pdf_files = glob('../php/pdfs/*.pdf');

    foreach($pdf_files as $file) {
      $name = pathinfo($file, PATHINFO_FILENAME);
      $id_on_file = explode("_", $name)[1];
      if($id_on_file === $idclient) {
        echo "Facture numéro ".explode("_", $name)[0]." ";
        echo "<form action='view_pdf.php' method='post'><input type='hidden' value='$name' name='pdf_name'><input type='submit' value='Voir la facture' name='show_pdf'></form>";
      }
    }
  }
?>