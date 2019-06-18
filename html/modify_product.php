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
    .update-container {
      position: relative;
      left: 30%;
    }
    </style>
  </head>
  <?php include('./navbar.php'); ?>
  <?php include('./login.php'); ?>
<body>
<?php 
$id = $_POST['id'];

$product_info = $bdd->prepare("select * from produit where idproduit like :id");
$product_info->bindValue(":id", $id);
$product_info->execute();
$product_info=$product_info->fetch();
$description = htmlspecialchars($product_info['designation']);
echo "<div class='update-container'>";
echo "<form action='../php/update_product.php' method='post'><input type='text' name='description' value=\"$description\">";
echo "<input type='int' name='price' value={$product_info['prix']}>";
echo "<input type='int' name='stock' value={$product_info['stock']}>";
echo "<input type='hidden' name='id' value='{$id}'><input type='submit' value='Modifier'></form>";
echo "<form action='../php/upload.php' method='post' enctype='multipart/form-data'>
    <p>Selectionnez l'image à uploader: <input type='file' name='fileToUpload' id='fileToUpload'></p>
    <input type='submit' value='Upload Image' name='submit'>
</form></div>";
?>
</body>
</html>