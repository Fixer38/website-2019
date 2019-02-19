<?php
session_start();
include('../secret/mdp.php');
//------- recupération des valeurs du formulaire--------------
$email=$_POST['email'];
$pswd=$_POST['pswd'];
// ------ connexion à la base de données ------------------------
try
	{$bdd = new PDO("mysql:host=$host;dbname=$db", $user, $userpswd);}

catch(Exception $e)
	{die('Erreur : '.$e->getMessage());}  // arrêt en cas d'erreur

// Requête reprenant les informations nécessaires
$req = $bdd->prepare("select id, email, mdp, nom, prenom, rue, localite, cp, num_maison, nb_connection from client where email like :email");
$req->bindValue(":email", $email, PDO::PARAM_STR);
$req->execute();
$req = $req->fetch();

$check = $bdd->prepare("select count(id) from client where email like :email");
$check->bindValue(":email", $email, PDO::PARAM_STR);
$check->execute();
$check = $check->fetch();

if($check !== 1) {
	$_SESSION["error"] = "L'adresse email ou le mot de passe ne correspondent pas";
	header("Location:../index.php?logged=false");
}
// Si l'utilisateur n'a pas de connections restantes valides
if($req['nb_connection'] === 0) {
	// Redirection vers page pour utilisateur restreint
	header("Location:../html/restricted.php");
	exit();
}

else {
	// Check si l'addresse mail correspond avec le mot de passe entré que l'on vérifie en bcrypt
	if($req['email'] === $email && password_verify($pswd, $req['mdp'])) {
		$last_connection = date("Y/m/d");		
		// Requête changant la dernière date de connection de l'utilisateur
		$lastconnection_updater = $bdd->prepare("update client set last_connection = :last_connection where email like :email");
		$lastconnection_updater -> bindValue(":last_connection", $last_connection, PDO::PARAM_STR);
		$lastconnection_updater -> bindValue(":email", $email, PDO::PARAM_STR);
		$lastconnection_updater-> execute();
		// Requête réinitialisant le nombre de connections valables à 3
		$nb_connection_updater = $bdd->prepare("update client set nb_connection = 3 where email like :email");
		$nb_connection_updater -> bindValue(":email", $email, PDO::PARAM_STR);
		$nb_connection_updater -> execute();

		$_SESSION['logged'] = True;
		$_SESSION['name'] = $req['nom'];
		$_SESSION['fname'] = $req['prenom'];
		$_SESSION['idclient'] = $req['id'];
		$_SESSION['street'] = $req['rue'];
		$_SESSION['localite'] = $req['localite'];
		$_SESSION['cp'] = $req['cp'];
		$_SESSION['hnumber'] = $req['num_maison'];
		$_SESSION['panier'] = array();
		$_SESSION['panier']['codeproduit'] = array();
		$_SESSION['panier']['quantite'] = array();
		unset($_SESSION["error"]);
		// Retour à la page d'accueil
		header("Location:../index.php");

		exit();

	}

	// Si le mot de passe ne correspond pas avec l'addresse email entré
	elseif($req['email'] === $email && !password_verify($pswd, $req['mdp'])) {
		// Décrémentation du nombre de connection valide à l'utilisateur
		$nbconnection_updater = $bdd->prepare("update client set nb_connection = nb_connection - 1 where email like :email");
		$nbconnection_updater->bindValue(":email", $email, PDO::PARAM_STR);
		$nbconnection_updater->execute(); 	
		// Message d'erreur qui sera affiché sur la page html
		$_SESSION["error"] = "L'adresse email ou le mot de passe ne correspondent pas";
		header("Location:../index.php?logged=false");
	}}
$bdd->closeCursor();
?>
