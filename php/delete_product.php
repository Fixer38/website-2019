<?php
include('../secret/mdp.php');
// ------ connexion à la base de données ------------------------
try
  {$bdd = new PDO("mysql:host=$host;dbname=$db", $user, $userpswd);}

catch(Exception $e)
  {die('Erreur : '.$e->getMessage());}  // arrêt en cas d'erreur

$id = $_POST['id'];
$delete_product=$bdd->prepare("delete from produit where idproduit like :id");
$delete_product->bindValue(":id", $id);
$delete_product->execute();
echo "produit supprimé";
?>