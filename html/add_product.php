<?php
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
      font-family: Roboto;
    }

    input {
      background-color
    }

    p {
      color: white;
    }
    .add-container {
      position: relative;
      left: 35%;
    }
    </style>
  </head>
  <?php include('./navbar.php'); ?>
  <?php include('./login.php'); ?>
<body>
<?php 
echo "<div class='add-container'";
echo "<form action='../php/add_product.php' method='post' enctype='multipart/form-data'>";
echo "<input type='text' required name='description' value=''>";
echo "<input type='int' required name='price' value=''>";
echo "<input type='int' required name='stock' value=''>";
echo "<p>Selectionnez l'image à uploader:
    <input required type='file' name='fileToUpload' id='fileToUpload'></p>
    <input type='submit' value=\"Ajouter l'article\" name='submit'>
</form></div>";
?>
</body>
</html>