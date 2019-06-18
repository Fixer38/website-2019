<?php 
include('../secret/mdp.php');
// ------ connexion à la base de données ------------------------
try
  {$bdd = new PDO("mysql:host=$host;dbname=$db", $user, $userpswd);}

catch(Exception $e)
  {die('Erreur : '.$e->getMessage());}  // arrêt en cas d'erreur

$description = $_POST['description'];
$price = $_POST['price'];
$stock = $_POST['stock'];
$id = $_POST['id'];

$product_update = $bdd->prepare("update produit set designation = :description, stock = :stock, prix = :price where idproduit like :id");
$product_update->bindValue(":description", $description);
$product_update->bindValue(":stock", $stock);
$product_update->bindValue(":price", $price);
$product_update->bindValue(":id", $id);
$product_update->execute();
header("Location: ../html/admin.php");

?>