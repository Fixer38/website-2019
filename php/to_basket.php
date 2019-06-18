<?php
session_start();
include('../secret/mdp.php');
// ------ connexion à la base de données ------------------------
try
	{$bdd = new PDO("mysql:host=$host;dbname=$db", $user, $userpswd);}

catch(Exception $e)
	{die('Erreur : '.$e->getMessage());} // arrêt en cas d'erreur

if($_SESSION['logged'] === True && !empty($_POST['quantity'])) {
			if(in_array($_POST['idproduit'], $_SESSION['panier']['codeproduit'])) {
				$key = array_search($_POST['idproduit'], $_SESSION['panier']['codeproduit']);
				$key2 = array_search($_POST['idproduit'], $_SESSION['idproducts']);	
				$_SESSION['panier']['quantite'][$key] = $_SESSION['panier']['quantite'][$key] + $_POST['quantity'];
					if($_SESSION['panier']['quantite'][$key] > $_SESSION['stocks'][$key2]) {
						$_SESSION['panier']['quantite'][$key] = $_SESSION['stocks'][$key2];
					}
				}
				else {
					$_SESSION['panier']['codeproduit'][] = $_POST['idproduit'];
					$_SESSION['panier']['quantite'][] = $_POST['quantity'];
					$key = array_search($_POST['idproduit'], $_SESSION['panier']['codeproduit']);
					$key2 = array_search($_POST['idproduit'], $_SESSION['idproducts']);	
					if($_SESSION['panier']['quantite'][$key] > $_SESSION['stocks'][$key2]) {
						$_SESSION['panier']['quantite'][$key] = $_SESSION['stocks'][$key2];
					}
				}
				header('Location:../index.php');
				exit();	 
			}
else {
	header("Location:../index.php?logged=false");
	exit();
}

?>