<?php
session_start();
include('./secret/mdp.php');
try
	{$bdd = new PDO("mysql:host=$host;dbname=$db", $user, $userpswd);}

catch(Exception $e)
    {die('Erreur : '.$e->getMessage());}  // arrêt en cas d'erreur
  
    
$products_info = $bdd->prepare("select * from produit");
$products_info->execute();
$products_info = $products_info->FetchAll();
unset($_SESSION['idproducts']);
unset($_SESSION['images']);
unset($_SESSION['prices']);
unset($_SESSION['descriptions']);
unset($_SESSION['stocks']);
$_SESSION['idproducts'] = array();
$_SESSION['images'] = array();
$_SESSION['prices'] = array();
$_SESSION['descriptions'] = array();
$_SESSION['stocks'] = array();
foreach($products_info as $row) {
    $_SESSION['idproducts'][] = $row['idproduit'];
    $_SESSION['images'][] = $row['image'];
    $_SESSION['prices'][] = $row['prix'];
    $_SESSION['descriptions'][] = $row['designation'];
    $_SESSION['stocks'][] = $row['stock'];
}
?>