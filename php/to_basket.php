<?php
session_start();
include('../secret/mdp.php');
// ------ connexion à la base de données ------------------------
try
	{$bdd = new PDO("mysql:host=$host;dbname=$db", $user, $userpswd);}

catch(Exception $e)
	{die('Erreur : '.$e->getMessage());} // arrêt en cas d'erreur

if($_SESSION['logged'] === True) {
	for($i=0; $i<sizeof($_SESSION['images']); $i++) {
		$buttoname = "quantity{$i}";
		if(!empty($_POST[$buttoname])) {
			$_SESSION['panier']['codeproduit'][] = $_SESSION['idproducts'][$i];
			$_SESSION['panier']['quantite'][] = $_POST[$buttoname];
			header('Location:../index.php');
			exit();	 
		}
	}
}
else {
	header("Location:../index.php");
	exit();
}

?>